<?php
/* Template Name: Booking Confirmation */
get_header();

// Retrieve the payment intent ID from URL
$payment_intent_id = $_GET['payment_intent'] ?? '';

if ($payment_intent_id) {
    // Initialize Stripe
    require_once get_template_directory() . '/stripe-php/init.php';
    \Stripe\Stripe::setApiKey(get_option('stripe_secret_key'));
    
    try {
        // Retrieve payment intent
        $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
        
        // Find the booking
        $bookings = get_posts([
            'post_type' => 'booking',
            'meta_key' => 'payment_intent_id',
            'meta_value' => $payment_intent_id,
            'posts_per_page' => 1
        ]);
        
        if ($bookings) {
            $booking = $bookings[0];
            $tour = get_post(get_post_meta($booking->ID, 'tour_id', true));
            ?>
            <div class="container py-5 text-center">
                <div class="text-success display-1 mb-3">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h1>Booking Confirmed!</h1>
                <p class="lead">Your payment was successful.</p>
                
                <div class="card mt-4 text-start">
                    <div class="card-body">
                        <h3><?php echo $tour->post_title; ?></h3>
                        <p>Booking ID: <?php echo $booking->post_title; ?></p>
                        <p>Amount Paid: €<?php echo get_post_meta($booking->ID, 'amount', true); ?></p>
                        <p>A confirmation has been sent to your email.</p>
                    </div>
                </div>
            </div>
            <?php
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">Error retrieving booking details.</div>';
    }
}

get_footer();