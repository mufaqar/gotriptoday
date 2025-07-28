<?php

// Load Stripe library
require_once get_template_directory() . '/stripe-php/init.php';

// Create PaymentIntent
add_action('wp_ajax_stripe_create_payment_intent', 'stripe_create_payment_intent');
add_action('wp_ajax_nopriv_stripe_create_payment_intent', 'stripe_create_payment_intent');

function stripe_create_payment_intent() {
    try {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'stripe_payment_nonce')) {
            throw new Exception('Invalid nonce');
        }

        $amount = intval($_POST['amount']);
        $tour_id = intval($_POST['tour_id']);

        if ($amount <= 0 || $tour_id <= 0) {
            throw new Exception('Invalid amount or tour ID');
        }

        \Stripe\Stripe::setApiKey(get_option('stripe_secret_key'));

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
        ]);

        wp_send_json_success([
            'clientSecret' => $paymentIntent->client_secret,
            'paymentIntentId' => $paymentIntent->id
        ]);

    } catch (Exception $e) {
        error_log('Stripe Intent Error: ' . $e->getMessage());
        wp_send_json_error(['message' => $e->getMessage()], 400);
    }
}

// Finalize booking after payment confirmation
add_action('wp_ajax_stripe_finalize_booking', 'stripe_finalize_booking');
add_action('wp_ajax_nopriv_stripe_finalize_booking', 'stripe_finalize_booking');

function stripe_finalize_booking() {
    try {
        if (!isset($_POST['paymentIntentId']) || !wp_verify_nonce($_POST['nonce'], 'stripe_payment_nonce')) {
            throw new Exception('Invalid request');
        }

        $payment_intent_id = sanitize_text_field($_POST['paymentIntentId']);

        \Stripe\Stripe::setApiKey(get_option('stripe_secret_key'));

        $paymentIntent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

        if ($paymentIntent->status !== 'succeeded') {
            throw new Exception('Payment not successful');
        }

        // Prevent duplicate bookings
        $existing = get_posts([
            'post_type' => 'booking',
            'meta_key' => 'payment_intent_id',
            'meta_value' => $payment_intent_id,
            'posts_per_page' => 1
        ]);

        if ($existing) {
            wp_send_json_success(['message' => 'Booking already exists']);
        }

        $booking_id = wp_insert_post([
            'post_title' => 'Booking #' . $payment_intent_id,
            'post_type' => 'booking',
            'post_status' => 'publish',
            'meta_input' => [
                'tour_id' => $paymentIntent->metadata->tour_id,
                'booking_date' => current_time('mysql'),
                'amount' => $paymentIntent->amount / 100,
                'currency' => $paymentIntent->currency,
                'payment_intent_id' => $payment_intent_id,
                'customer_email' => $paymentIntent->receipt_email,
                'customer_name' => $paymentIntent->metadata->customer_name ?? '',
                'status' => 'confirmed',
            ]
        ]);

        if (is_wp_error($booking_id)) {
            throw new Exception('Could not save booking.');
        }

        send_booking_confirmation($booking_id, $paymentIntent);

        wp_send_json_success(['message' => 'Booking created', 'booking_id' => $booking_id]);

    } catch (Exception $e) {
        error_log('Finalize Booking Error: ' . $e->getMessage());
        wp_send_json_error(['message' => $e->getMessage()], 400);
    }
}

function send_booking_confirmation($booking_id, $payment_intent) {
    $to = $payment_intent->receipt_email;
    $subject = 'Booking Confirmation #' . get_the_title($booking_id);
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    ob_start(); ?>
    <h2>Thank you for your booking!</h2>
    <p><strong>Booking ID:</strong> <?php echo get_the_title($booking_id); ?></p>
    <p><strong>Tour:</strong> <?php echo get_the_title($payment_intent->metadata->tour_id); ?></p>
    <p><strong>Amount:</strong> <?php echo number_format($payment_intent->amount / 100, 2) . ' ' . strtoupper($payment_intent->currency); ?></p>
    <p><strong>Date:</strong> <?php echo date('F j, Y', $payment_intent->created); ?></p>
    <?php
    $message = ob_get_clean();

    wp_mail($to, $subject, $message, $headers);
}
