<?php
/* Template Name: Booking Confirmation */
get_header();

$payment_intent_id = $_GET['payment_intent'];
$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
$booking = get_posts([
    'post_type' => 'booking',
    'meta_key' => 'payment_intent_id',
    'meta_value' => $payment_intent_id,
    'posts_per_page' => 1
]);

if ($booking) : 
$booking = $booking[0];
$tour = get_post(get_post_meta($booking->ID, 'tour_id', true));
?>

<div class="container py-5">
    <div class="text-center mb-5">
        <div class="text-success display-1 mb-3">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h1 class="mb-3">Booking Confirmed!</h1>
        <p class="lead">Thank you for your booking. A confirmation has been sent to your email.</p>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex gap-4 mb-4">
                        <?php if (has_post_thumbnail($tour->ID)) : ?>
                        <img src="<?php echo get_the_post_thumbnail_url($tour->ID, 'medium'); ?>" 
                             alt="<?php echo esc_attr($tour->post_title); ?>" 
                             class="rounded" width="200">
                        <?php endif; ?>
                        
                        <div>
                            <h3><?php echo $tour->post_title; ?></h3>
                            <p class="text-muted">Booking ID: <?php echo $booking->post_title; ?></p>
                            <p class="text-success fw-bold">€<?php echo get_post_meta($booking->ID, 'amount', true); ?></p>
                        </div>
                    </div>
                    
                    <div class="alert alert-success">
                        <i class="bi bi-info-circle me-2"></i>
                        Your payment was successful. You'll receive a detailed itinerary via email shortly.
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo get_permalink($tour->ID); ?>" class="btn btn-outline-secondary">
                            View Tour Again
                        </a>
                        <a href="<?php echo home_url(); ?>" class="btn btn-success">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else : ?>

<div class="container py-5 text-center">
    <div class="text-danger display-1 mb-3">
        <i class="bi bi-exclamation-triangle-fill"></i>
    </div>
    <h1 class="mb-3">Booking Not Found</h1>
    <p class="lead">We couldn't find your booking details. Please contact support.</p>
    <a href="<?php echo home_url(); ?>" class="btn btn-primary mt-3">Back to Home</a>
</div>

<?php endif;

get_footer();
?>