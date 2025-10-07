<?php
/**
 * Checkout Form - Customized for Reservation/Booking with Bootstrap 5
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$booking_data = [];
foreach ( WC()->cart->get_cart() as $cart_item ) {
    if ( isset( $cart_item['booking_data'] ) ) {
        $booking_data = $cart_item['booking_data'];
        break; // Only one booking item
    }
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<div class="reservation-checkout-wrapper container py-4">
    <!-- Reservation Header -->
    <div class="reservation-header text-center mb-5">
        <h1 class="display-5 fw-bold text-dark mb-3"><?php esc_html_e( 'Reservation Details', 'woocommerce' ); ?></h1>
        <p class="lead text-muted">
            <?php esc_html_e( 'Review your booking information before proceeding', 'woocommerce' ); ?></p>
    </div>


    <!-- Reservation Details -->
    <div class="reservation-details card border-0 shadow-sm mb-5">
        <div class="card-body p-4">
            <!-- Journey Information -->
            <div class="journey-info mb-4">
                <h4 class="h5 fw-semibold text-dark border-bottom border-primary pb-2 mb-3"><?php esc_html_e( 'JOURNEY INFORMATION', 'woocommerce' ); ?>  
                <span class="d-inline-flex ms-5">
                <?php                 
                    $tour_id  =  esc_html( $booking_data['Tour ID'] ?? '' );               
                    $tour_title = get_the_title($tour_id);
                    echo $tour_title;
                ?>
                </span>
                </h4>
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <strong class="text-muted"><?php esc_html_e( 'Pickup Location', 'woocommerce' ); ?></strong>
                            <span
                                class="fw-semibold"><?php echo esc_html( $booking_data['Pickup Address'] ?? '' ); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <strong
                                class="text-muted"><?php esc_html_e( 'Drop-off Location', 'woocommerce' ); ?></strong>
                            <span
                                class="fw-semibold"><?php echo esc_html( $booking_data['Dropoff Address'] ?? '' ); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <strong class="text-muted"><?php esc_html_e( 'Date & Time', 'woocommerce' ); ?></strong>
                            <span
                                class="fw-semibold"><?php echo esc_html( $booking_data['Pickup DateTime'] ?? '' ); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passenger & Vehicle Details -->
            <div class="passenger-vehicle-info mb-4">
                <h4 class="h5 fw-semibold text-dark border-bottom border-primary pb-2 mb-3">
                    <?php esc_html_e( 'PASSENGER & VEHICLE DETAILS', 'woocommerce' ); ?></h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <strong class="text-muted"><?php esc_html_e( 'Adults', 'woocommerce' ); ?></strong>
                            <span class="fw-semibold"><?php echo esc_html( $booking_data['Adults'] ?? '0' ); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <strong class="text-muted"><?php esc_html_e( 'Children', 'woocommerce' ); ?></strong>
                            <span class="fw-semibold"><?php echo esc_html( $booking_data['Children'] ?? '0' ); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <strong class="text-muted"><?php esc_html_e( 'Passenger Name', 'woocommerce' ); ?></strong>
                            <span
                                class="fw-semibold"><?php echo esc_html( $booking_data['Passenger Name'] ?? '' ); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between py-2 border-bottom">
                            <strong class="text-muted"><?php esc_html_e( 'Vehicle Type', 'woocommerce' ); ?></strong>
                            <span
                                class="fw-semibold"><?php echo esc_html( $booking_data['Vehicle Type'] ?? '' ); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Special Instructions -->
            <?php if ( ! empty( $booking_data['Driver Notes'] ) ) : ?>
            <div class="special-instructions">
                <h4 class="h5 fw-semibold text-dark border-bottom border-primary pb-2 mb-3">
                    <?php esc_html_e( 'SPECIAL INSTRUCTIONS', 'woocommerce' ); ?></h4>
                <div class="alert alert-light border mt-3 mb-0">
                    <p class="mb-0"><?php echo esc_html( $booking_data['Driver Notes'] ); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>


    <form name="checkout" method="post" class="checkout woocommerce-checkout"
        action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data"
        aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

        <div class="row g-4">
            <!-- Customer Details Column -->
            <div class="col-lg-6">
                <div class="customer-details-column card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <?php if ( $checkout->get_checkout_fields() ) : ?>
                        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                        <div class="customer-details-section">
                            <h3 class="h4 fw-semibold text-dark mb-4">
                                <?php esc_html_e( 'Contact & Billing Details', 'woocommerce' ); ?></h3>
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>

                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Order Review Column -->
            <div class="col-lg-6">
                <div class="order-review-column card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <!-- Payment Security Notice -->
                        <div class="payment-security-notice alert alert-success text-center mb-4">
                            <i class="fas fa-shield-alt me-2"></i>
                            <?php esc_html_e( 'Your payment information is secure', 'woocommerce' ); ?>
                        </div>

                        <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                        <!-- Payment Method -->
                        <div id="order_review" class="woocommerce-checkout-review-order custom-order-review mb-4">
                            <h3 class="h4 fw-semibold text-dark mb-3">
                                <?php esc_html_e( 'Payment Method', 'woocommerce' ); ?></h3>
                            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                        </div>

                        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>



                        <!-- Footer Links -->
                        <div class="checkout-footer-links border-top pt-4 mt-4">
                            <div class="row g-2 text-center">
                                <div class="col-6 col-sm-3">
                                    <a href="<?php echo esc_url( wc_get_page_permalink( 'terms' ) ); ?>"
                                        class="text-decoration-none small"><?php esc_html_e( 'Terms of Service', 'woocommerce' ); ?></a>
                                </div>
                                <div class="col-6 col-sm-3">
                                    <a href="<?php echo esc_url( wc_get_page_permalink( 'privacy' ) ); ?>"
                                        class="text-decoration-none small"><?php esc_html_e( 'Privacy Policy', 'woocommerce' ); ?></a>
                                </div>
                                <div class="col-6 col-sm-3">
                                    <a href="<?php echo esc_url( wc_get_page_permalink( 'cancellation' ) ); ?>"
                                        class="text-decoration-none small"><?php esc_html_e( 'Cancellation Policy', 'woocommerce' ); ?></a>
                                </div>
                                <div class="col-6 col-sm-3">
                                    <a href="<?php echo esc_url( wc_get_page_permalink( 'contact' ) ); ?>"
                                        class="text-decoration-none small"><?php esc_html_e( 'Contact Support', 'woocommerce' ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>