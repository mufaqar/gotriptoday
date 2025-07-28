<?php
// Load Stripe library manually
require_once get_template_directory() . '/stripe-php/init.php';

// Create payment intent via AJAX
add_action('wp_ajax_stripe_create_payment_intent', 'stripe_create_payment_intent');
add_action('wp_ajax_nopriv_stripe_create_payment_intent', 'stripe_create_payment_intent');
function stripe_create_payment_intent() {
    check_ajax_referer('stripe_nonce', 'nonce');
    
    try {
        // Initialize Stripe with secret key
        \Stripe\Stripe::setApiKey(get_option('stripe_secret_key'));
        
        // Create payment intent
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => intval($_POST['amount']), // in cents
            'currency' => 'eur',
            'metadata' => [
                'tour_id' => intval($_POST['tour_id']),
                'wp_user_id' => get_current_user_id()
            ]
        ]);
        
        wp_send_json_success(['clientSecret' => $paymentIntent->client_secret]);
        
    } catch (Exception $e) {
        wp_send_json_error(['message' => $e->getMessage()]);
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
        $event = \Stripe\Webhook::constructEvent(
            $payload, 
            $sig_header, 
            $endpoint_secret
        );
    } catch(Exception $e) {
        return new WP_REST_Response(['error' => $e->getMessage()], 400);
    }
    
    // Handle successful payment
    if ($event->type == 'payment_intent.succeeded') {
        $payment_intent = $event->data->object;
        
        // Create booking post
        $booking_id = wp_insert_post([
            'post_title' => 'Booking #' . $payment_intent->id,
            'post_type' => 'booking',
            'post_status' => 'publish',
            'meta_input' => [
                'tour_id' => $payment_intent->metadata->tour_id,
                'amount' => $payment_intent->amount / 100,
                'payment_intent_id' => $payment_intent->id,
                'customer_email' => $payment_intent->receipt_email,
                'status' => 'confirmed'
            ]
        ]);
        
        // Send email confirmation
        send_booking_confirmation($booking_id, $payment_intent->receipt_email);
    }
    
    return new WP_REST_Response(['success' => true], 200);
}

function send_booking_confirmation($booking_id, $email) {
    $subject = 'Your Booking Confirmation #' . get_the_title($booking_id);
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    
    ob_start();
    ?>
    <html>
    <body>
        <h2>Thank you for your booking!</h2>
        <p>Booking ID: <?php echo get_the_title($booking_id); ?></p>
        <p>Amount Paid: €<?php echo get_post_meta($booking_id, 'amount', true); ?></p>
        <p>We'll see you soon!</p>
    </body>
    </html>
    <?php
    $message = ob_get_clean();
    
    wp_mail($email, $subject, $message, $headers);
}