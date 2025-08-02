<?php
/* Template Name: Booking Details */
get_header();

// Initialize variables
$tour_id = $tour_date = $tour_adults = $tour_price = $tour_title = $tour_image = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $tour_id = isset($_POST['tour_id']) ? intval($_POST['tour_id']) : 0;
    $tour_date = isset($_POST['tour_date']) ? sanitize_text_field($_POST['tour_date']) : '';
    $tour_adults = isset($_POST['tour_adults']) ? intval($_POST['tour_adults']) : 0;
    $tour_price = isset($_POST['tour_price']) ? floatval($_POST['tour_price']) : 0;

    // Get tour details if valid tour ID
    if ($tour_id > 0) {
        $tour = get_post($tour_id);
        if ($tour && $tour->post_type === 'tours') {
            $tour_title = esc_html($tour->post_title);
            $tour_image = get_the_post_thumbnail_url($tour_id, 'medium');
        }
    }
}
?>

<div class="booking_details">
    <div class="divider"></div>
    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-lg-8">
                <div class="content">
                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $tour_id > 0) : ?>
                    <form id="booking-form" action="<?php echo esc_url(site_url('/process-booking')); ?>" method="POST">
                        <?php wp_nonce_field('booking_nonce', 'booking_nonce_field'); ?>
                        <input type="hidden" name="tour_id" value="<?php echo esc_attr($tour_id); ?>">
                        <input type="hidden" name="tour_date" value="<?php echo esc_attr($tour_date); ?>">
                        <input type="hidden" name="tour_adults" value="<?php echo esc_attr($tour_adults); ?>">
                        <input type="hidden" name="tour_price" value="<?php echo esc_attr($tour_price); ?>">
                        <!-- Step 1: Contact Info -->
                        <div class="step p-4 shadow-sm border-0 mb-5">
                            <h5 class="mb-3"><span class="step_number">1</span> Contact details</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First name</label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last name</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Phone number</label>
                                    <div class="input-group">
                                        <select class="form-select" name="country_code" style="max-width: 150px;">
                                            <option value="+1">(+1) USA</option>
                                            <option value="+92" selected>(+92) Pakistan</option>
                                            <option value="+44">(+44) UK</option>
                                        </select>
                                        <input type="text" name="phone" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2: Activity Details -->
                        <div class="step step2 p-4 shadow-sm border-0 mb-5">
                            <h5 class="mb-4"><span class="step_number">2</span> Activity details</h5>
                            <div class="d-flex gap-3 mb-4">
                                <?php if ($tour_image) : ?>
                                <img src="<?php echo esc_url($tour_image); ?>"
                                    alt="<?php echo esc_attr($tour_title); ?>" width="300">
                                <?php endif; ?>
                                <div>
                                    <h6 class="mb-1"><?php echo $tour_title; ?></h6>
                                    <p class="mb-1 small text-muted">
                                        <i class="bi bi-person"></i><?php echo $tour_adults; ?> Adults
                                    </p>
                                    <p class="mb-1 small text-muted">
                                        <i class="bi bi-calendar-event"></i><?php echo esc_html($tour_date); ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Travelers -->
                            <?php for ($i = 1; $i <= $tour_adults; $i++) : ?>
                            <div class="mb-4">
                                <h6 class="pb-2">Traveler <?php echo $i; ?> (Adult)</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" name="traveler[<?php echo $i; ?>][first_name]"
                                            class="form-control" placeholder="First name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="traveler[<?php echo $i; ?>][last_name]"
                                            class="form-control" placeholder="Last name" required>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <!-- Step 3: Payment -->
                        <div class="step step3 p-4 shadow-sm border-0">
                            <h5 class="mb-3"><span class="step_number">3</span> Payment details</h5>

                            <!-- Payment Method Selection -->
                            <div class="mb-4">
                                <label class="form-label">Pay with</label>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" value="card"
                                        id="payment-method-card" checked>
                                    <label class="form-check-label fw-semibold" for="payment-method-card">Credit/Debit
                                        Card</label>
                                </div>
                            </div>

                            <!-- Stripe Payment Element -->
                            <div id="card-payment-section">
                                <div id="payment-element" class="mb-3"></div>
                                <div id="payment-errors" class="alert alert-danger d-none mb-3"></div>

                                <!-- Test mode notice (only show in development) -->
                                <?php if (WP_DEBUG) : ?>
                                <div class="alert alert-info mb-3">
                                    <small>TEST MODE: Use test card 4242 4242 4242 4242 with any future date and
                                        CVC</small>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="text-muted small mb-4">
                                🔒 You'll be charged €<?php echo number_format($tour_price, 2); ?>.
                                By clicking <strong>Pay Now</strong>, you agree to our
                                <a href="#" class="text-decoration-underline">Terms of Use</a> and
                                <a href="#" class="text-decoration-underline">Privacy Policy</a>.
                            </div>

                            <button id="submit-button" class="btn btn-success w-100 py-2">
                                <span id="button-text">Pay €<?php echo number_format($tour_price, 2); ?></span>
                                <span id="button-spinner" class="spinner-border spinner-border-sm d-none"></span>
                            </button>
                        </div>
                    </form>
                    <?php else : ?>
                    <div class="alert alert-warning">
                        No booking information found. Please go back and fill the booking form.
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo esc_html($tour_title); ?></h3>
                        <?php if ($tour_image) : ?>
                        <img src="<?php echo esc_url($tour_image); ?>" class="img-fluid rounded mb-3"
                            alt="<?php echo esc_attr($tour_title); ?>">
                        <?php endif; ?>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Date:</span>
                                <span><?php echo esc_html($tour_date); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Adults:</span>
                                <span><?php echo esc_html($tour_adults); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between fw-bold">
                                <span>Total:</span>
                                <span>€<?php echo number_format($tour_price, 2); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php get_footer(); 


?>

<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stripe = Stripe('<?php echo esc_js(get_option('stripe_publishable_key')); ?>');
    let elements;

    initializeStripePayment();

    async function initializeStripePayment() {
        try {
            const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'stripe_create_payment_intent',
                    tour_id: '<?php echo $tour_id; ?>',
                    amount: '<?php echo $tour_price * 100; ?>', // in cents
                    nonce: '<?php echo wp_create_nonce("stripe_payment_nonce"); ?>'
                })
            });

            const data = await response.json();
            console.log('Stripe server response:', data);

            if (!data.success || !data.data?.clientSecret) {
                throw new Error(data.data?.message || 'Missing clientSecret from server');
            }

            const clientSecret = data.data.clientSecret;

            // Customize Stripe Elements appearance
            const appearance = {
                theme: 'stripe',
                variables: {
                    colorPrimary: '#28a745',
                    colorBackground: '#ffffff',
                    colorText: '#212529',
                    fontFamily: 'system-ui, -apple-system, sans-serif'
                }
            };

            elements = stripe.elements({
                clientSecret,
                appearance
            });

            const paymentElement = elements.create('payment', {
                layout: 'tabs',
                fields: {
                    billingDetails: {
                        name: 'auto',
                        email: 'auto'
                    }
                }
            });

            paymentElement.mount('#payment-element');

        } catch (error) {
            console.error('Error:', error);
            const errorElement = document.getElementById('payment-errors');
            errorElement.textContent = 'Error initializing payment. Please try again.';
            errorElement.classList.remove('d-none');
        }
    }

    document.getElementById('booking-form').addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitButton = document.getElementById('submit-button');
        const buttonText = document.getElementById('button-text');
        const buttonSpinner = document.getElementById('button-spinner');
        const errorElement = document.getElementById('payment-errors');

        submitButton.disabled = true;
        buttonText.textContent = 'Processing...';
        buttonSpinner.classList.remove('d-none');
        errorElement.classList.add('d-none');

        const {
            error
        } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: '<?php echo esc_url(site_url('/booking-confirmation')); ?>',
                receipt_email: document.querySelector('input[name="email"]').value,
            }
        });

        if (error) {
            errorElement.textContent = error.message;
            errorElement.classList.remove('d-none');
            submitButton.disabled = false;
            buttonText.textContent = 'Pay €<?php echo number_format($tour_price, 2); ?>';
            buttonSpinner.classList.add('d-none');
        }
    });
});
</script>