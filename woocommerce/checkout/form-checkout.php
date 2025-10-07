<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_checkout_form', $checkout);
?>

<div class="container my-5">
    <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="mb-3">Reservation Details</h4>
                <p class="text-muted mb-4">Review your booking information before proceeding</p>

                <!-- Why Book With Us -->
                <div class="mb-4">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="border rounded p-3">
                                <i class="bi bi-shield-lock fs-3 text-success"></i>
                                <p class="fw-semibold mt-2 mb-0">Secure Booking</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border rounded p-3">
                                <i class="bi bi-star-fill fs-3 text-warning"></i>
                                <p class="fw-semibold mt-2 mb-0">Top-Rated Service</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border rounded p-3">
                                <i class="bi bi-arrow-repeat fs-3 text-primary"></i>
                                <p class="fw-semibold mt-2 mb-0">Flexible Cancellation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout Form -->
                <div class="checkout-form">
                    <form name="checkout" method="post" class="checkout woocommerce-checkout"
                        action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
                        <?php if ($checkout->get_checkout_fields()) : ?>
                        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                        <div class="row" id="customer_details">
                            <div class="col-md-6 mb-4">
                                <?php do_action('woocommerce_checkout_billing'); ?>
                            </div>
                            <div class="col-md-6 mb-4">
                                <?php do_action('woocommerce_checkout_shipping'); ?>
                            </div>
                        </div>

                        <?php do_action('woocommerce_checkout_after_customer_details'); ?>
                        <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Payment Summary</h5>
                    <i class="bi bi-lock-fill text-success"></i>
                </div>

                <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>

                <div class="mt-4">
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="agree_terms">
                        <label for="agree_terms" class="form-check-label">I have read and accept the <a href="#">Terms
                                of Service</a></label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="agree_policy">
                        <label for="agree_policy" class="form-check-label">I understand and accept the <a
                                href="#">Cancellation Policy</a></label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="agree_privacy">
                        <label for="agree_privacy" class="form-check-label">I consent to the <a href="#">Data Protection
                                Policy</a></label>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                        Complete Payment
                    </button>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>