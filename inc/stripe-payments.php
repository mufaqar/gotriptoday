<?php
// Load Stripe library manually
require_once get_template_directory() . '/stripe-php/init.php';

// Create payment intent via AJAX
add_action('wp_ajax_stripe_create_payment_intent', 'stripe_create_payment_intent');
add_action('wp_ajax_nopriv_stripe_create_payment_intent', 'stripe_create_payment_intent');
function stripe_create_payment_intent() {
    try {
        // Verify nonce first
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'stripe_nonce')) {
            throw new Exception('Invalid nonce');
        }

        // Validate required parameters
        $required_params = ['amount', 'tour_id'];
        foreach ($required_params as $param) {
            if (!isset($_POST[$param])) {
                throw new Exception("Missing required parameter: $param");
            }
        }

        // Sanitize and validate inputs
        $amount = intval($_POST['amount']);
        $tour_id = intval($_POST['tour_id']);
        
        if ($amount <= 0) {
            throw new Exception('Invalid amount');
        }
        
        if ($tour_id <= 0) {
            throw new Exception('Invalid tour ID');
        }

        // Initialize Stripe with secret key
        \Stripe\Stripe::setApiKey(get_option('stripe_secret_key'));
        
        // Create payment intent with additional metadata
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            'metadata' => [
                'tour_id' => $tour_id,
                'wp_user_id' => get_current_user_id(),
                'customer_ip' => $_SERVER['REMOTE_ADDR'],
                'wp_site' => get_bloginfo('name')
            ],
            'description' => 'Tour Booking: ' . get_the_title($tour_id),
            'setup_future_usage' => 'off_session' // For potential future payments
        ]);
        
        wp_send_json_success([
            'clientSecret' => $paymentIntent->client_secret,
            'paymentIntentId' => $paymentIntent->id
        ]);
        
    } catch (Exception $e) {
        error_log('Stripe Payment Intent Error: ' . $e->getMessage());
        wp_send_json_error([
            'message' => $e->getMessage(),
            'code' => $e->getCode()
        ], 400);
    }
}

// Handle Stripe webhook
add_action('rest_api_init', function() {
    register_rest_route('stripe/v1', '/webhook', [
        'methods' => 'POST',
        'callback' => 'handle_stripe_webhook',
        'permission_callback' => '__return_true'
    ]);
});

function handle_stripe_webhook($request) {
    $payload = $request->get_body();
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    $endpoint_secret = get_option('stripe_webhook_secret');
    
    try {
        // Verify webhook signature
        $event = \Stripe\Webhook::constructEvent(
            $payload, 
            $sig_header, 
            $endpoint_secret
        );
        
        // Log webhook event for debugging
        error_log('Stripe Webhook Received: ' . $event->type);

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $payment_intent = $event->data->object;
                handle_successful_payment($payment_intent);
                break;
                
            case 'payment_intent.payment_failed':
                $payment_intent = $event->data->object;
                handle_failed_payment($payment_intent);
                break;
                
            // Add more event types as needed
        }
        
        return new WP_REST_Response(['success' => true], 200);
        
    } catch(Exception $e) {
        error_log('Stripe Webhook Error: ' . $e->getMessage());
        return new WP_REST_Response(['error' => $e->getMessage()], 400);
    }
}

function handle_successful_payment($payment_intent) {
    // Validate payment intent
    if ($payment_intent->status !== 'succeeded') {
        throw new Exception('Payment not succeeded');
    }

    // Check if booking already exists
    $existing_booking = get_posts([
        'post_type' => 'booking',
        'meta_key' => 'payment_intent_id',
        'meta_value' => $payment_intent->id,
        'posts_per_page' => 1
    ]);
    
    if (!empty($existing_booking)) {
        error_log('Booking already exists for payment intent: ' . $payment_intent->id);
        return;
    }

    // Create booking post
    $booking_id = wp_insert_post([
        'post_title' => 'Booking #' . $payment_intent->id,
        'post_type' => 'booking',
        'post_status' => 'publish',
        'meta_input' => [
            'tour_id' => $payment_intent->metadata->tour_id,
            'booking_date' => current_time('mysql'),
            'amount' => $payment_intent->amount / 100,
            'currency' => $payment_intent->currency,
            'payment_intent_id' => $payment_intent->id,
            'customer_email' => $payment_intent->receipt_email,
            'customer_name' => $payment_intent->metadata->customer_name ?? '',
            'status' => 'confirmed'
        ]
    ]);
    
    if (is_wp_error($booking_id)) {
        throw new Exception('Failed to create booking: ' . $booking_id->get_error_message());
    }

    // Send email confirmation
    send_booking_confirmation($booking_id, $payment_intent);
    
    // Additional actions after successful booking
    do_action('tour_booking_completed', $booking_id, $payment_intent);
}

function handle_failed_payment($payment_intent) {
    // Log failed payment
    error_log('Payment failed for intent: ' . $payment_intent->id);
    
    // You might want to create a failed booking record
    $booking_id = wp_insert_post([
        'post_title' => 'Failed Booking #' . $payment_intent->id,
        'post_type' => 'booking',
        'post_status' => 'draft',
        'meta_input' => [
            'tour_id' => $payment_intent->metadata->tour_id,
            'amount' => $payment_intent->amount / 100,
            'payment_intent_id' => $payment_intent->id,
            'status' => 'failed',
            'failure_reason' => $payment_intent->last_payment_error ? 
                $payment_intent->last_payment_error->message : 'Unknown'
        ]
    ]);
    
    // Send failure notification
    if (!is_wp_error($booking_id)) {
        send_payment_failure_notification($booking_id, $payment_intent);
    }
}

function send_booking_confirmation($booking_id, $payment_intent) {
    $to = $payment_intent->receipt_email;
    $subject = 'Your Booking Confirmation #' . get_the_title($booking_id);
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    
    ob_start();
    ?>
<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .header {
        background-color: #28a745;
        color: white;
        padding: 20px;
        text-align: center;
    }

    .content {
        padding: 20px;
        border: 1px solid #ddd;
    }

    .footer {
        margin-top: 20px;
        text-align: center;
        font-size: 12px;
        color: #777;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Booking Confirmed!</h1>
        </div>

        <div class="content">
            <h3>Booking Details</h3>
            <p><strong>Booking ID:</strong> <?php echo get_the_title($booking_id); ?></p>
            <p><strong>Tour:</strong> <?php echo get_the_title($payment_intent->metadata->tour_id); ?></p>
            <p><strong>Amount Paid:</strong> <?php echo number_format($payment_intent->amount / 100, 2); ?>
                <?php echo strtoupper($payment_intent->currency); ?></p>
            <p><strong>Date:</strong> <?php echo date('F j, Y', $payment_intent->created); ?></p>

            <p>Thank you for your booking. We look forward to seeing you!</p>
        </div>

        <div class="footer">
            <p>If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>

</html>
<?php
    $message = ob_get_clean();
    
    wp_mail($to, $subject, $message, $headers);
}

function send_payment_failure_notification($booking_id, $payment_intent) {
    $admin_email = get_option('admin_email');
    $subject = 'Payment Failed for Booking #' . get_the_title($booking_id);
    
    $message = "A payment failed for booking {$booking_id}.\n\n";
    $message .= "Payment Intent: {$payment_intent->id}\n";
    $message .= "Amount: " . ($payment_intent->amount / 100) . " {$payment_intent->currency}\n";
    $message .= "Reason: " . ($payment_intent->last_payment_error ? $payment_intent->last_payment_error->message : 'Unknown') . "\n";
    
    wp_mail($admin_email, $subject, $message);
}