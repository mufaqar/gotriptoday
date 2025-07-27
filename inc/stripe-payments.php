<?php
// Initialize Stripe
add_action('init', 'init_stripe');
function init_stripe() {
    require_once get_template_directory() . '/vendor/autoload.php'; // If using Composer
    \Stripe\Stripe::setApiKey(get_option('stripe_secret_key'));
}

// Create payment intent via AJAX
add_action('wp_ajax_create_stripe_payment_intent', 'create_stripe_payment_intent');
add_action('wp_ajax_nopriv_create_stripe_payment_intent', 'create_stripe_payment_intent');
function create_stripe_payment_intent() {
    check_ajax_referer('stripe_payment_nonce', 'nonce');
    
    try {
        $tour_id = intval($_POST['tour_id']);
        $amount = floatval($_POST['tour_price']) * 100; // Convert to cents
        
        $payment_intent = \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur', // or 'usd' depending on your currency
            'metadata' => [
                'tour_id' => $tour_id,
                'customer_ip' => $_SERVER['REMOTE_ADDR']
            ]
        ]);
        
        wp_send_json(['clientSecret' => $payment_intent->client_secret]);
    } catch (Exception $e) {
        wp_send_json_error($e->getMessage(), 400);
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

function handle_stripe_webhook(WP_REST_Request $request) {
    $payload = $request->get_body();
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    $endpoint_secret = get_option('stripe_webhook_secret');
    
    try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
    } catch(\UnexpectedValueException $e) {
        return new WP_REST_Response('Invalid payload', 400);
    } catch(\Stripe\Exception\SignatureVerificationException $e) {
        return new WP_REST_Response('Invalid signature', 400);
    }
    
    switch ($event->type) {
        case 'payment_intent.succeeded':
            $payment_intent = $event->data->object;
            handle_successful_payment($payment_intent);
            break;
        // Handle other event types as needed
    }
    
    return new WP_REST_Response('Success', 200);
}

function handle_successful_payment($payment_intent) {
    $tour_id = $payment_intent->metadata->tour_id;
    $amount = $payment_intent->amount / 100;
    $customer_email = $payment_intent->receipt_email;
    
    // Create booking post
    $booking_id = wp_insert_post([
        'post_title' => 'Booking #' . $payment_intent->id,
        'post_type' => 'booking',
        'post_status' => 'publish',
        'meta_input' => [
            'tour_id' => $tour_id,
            'amount' => $amount,
            'payment_intent_id' => $payment_intent->id,
            'customer_email' => $customer_email,
            'status' => 'confirmed'
        ]
    ]);
    
    // Send confirmation email
    send_booking_confirmation($booking_id, $customer_email);
}

function send_booking_confirmation($booking_id, $email) {
    $subject = 'Your Booking Confirmation';
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    
    ob_start();
    include get_template_directory() . '/emails/booking-confirmation.php';
    $message = ob_get_clean();
    
    wp_mail($email, $subject, $message, $headers);
}