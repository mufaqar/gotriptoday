<?php
/* Template Name: Process Booking */
get_header();


 $bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/img/bg-img/slide1.webp';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]);


// Retrieve the payment intent ID from URL
$payment_intent_id = $_GET['payment_intent'] ?? '';




if ($payment_intent_id) {
    // Initialize Stripe
    // require_once get_template_directory() . '/stripe-php/init.php';
    // \Stripe\Stripe::setApiKey(get_option('stripe_secret_key'));

    


    
    try {
        // Retrieve payment intent
      //  $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

       if ($payment_intent->status === 'succeeded') {
      
                // 3. Get the booking post
            $bookings = get_posts([
                'post_type'      => 'booking',
                'post_status'    => 'any', // Include all statuses
                 'meta_query' => [
                                [
                                'key'   => 'payment_intent_id',
                                'value' => $payment_intent_id, // optional
                                'compare' => '='
                                ]
                            ]
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
         

            // 1. Save booking to database (custom post type, orders, whatever)
            // 2. Send confirmation email
            // 3. Show confirmation to user
        } else {
            // ❌ Payment failed, canceled, or pending
            echo "<div class='alert alert-danger'>Payment not completed. Status: {$payment_intent->status}</div>";
        }



       
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">Error retrieving booking details.</div>';
    }
}

get_footer();