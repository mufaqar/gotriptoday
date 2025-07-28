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
                                <img src="<?php echo esc_url($tour_image); ?>" alt="<?php echo esc_attr($tour_title); ?>" width="300">
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

                             <!-- Credit/Debit Card -->
                            <div class="mb-4">
                                <label class="form-label">Pay with</label>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method" value="card"
                                        checked>
                                    <label class="form-check-label fw-semibold">Credit/Debit Card</label>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="card_number" class="form-control" placeholder="Card Number"
                                        value="4242424242424242" required>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" name="card_expiry" class="form-control" placeholder="MM / YY"
                                            value="07/26" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="card_cvc" class="form-control" placeholder="CVC"
                                            value="123" required>
                                    </div>
                                </div>
                            </div>

                            <div class="text-muted small mb-4">
                                🔒 You’ll be charged after confirmation. By clicking <strong>Book Now</strong>, you
                                agree to our
                                <a href="#" class="text-decoration-underline">Terms of Use</a> and <a href="#"
                                    class="text-decoration-underline">Privacy Policy</a>.
                            </div>

                            <button id="submit-button" class="btn btn-success w-100 py-2">
                                <span id="button-text">Pay Now</span>
                                <span id="button-spinner" class="spinner-border spinner-border-sm d-none"
                                    role="status"></span>
                            </button>
                            
                          
                            
                            <div class="text-muted small mb-4">
                                🔒 You'll be charged €<?php echo number_format($tour_price, 2); ?>. 
                                By clicking <strong>Pay Now</strong>, you agree to our terms.
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
                        <h3 class="card-title">Booking Summary</h3>
                        <?php if ($tour_image) : ?>
                        <img src="<?php echo esc_url($tour_image); ?>" class="img-fluid rounded mb-3" alt="<?php echo esc_attr($tour_title); ?>">
                        <?php endif; ?>
                        
                        <h5><?php echo esc_html($tour_title); ?></h5>
                        
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

<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stripe = Stripe('<?php echo esc_js(get_option('stripe_publishable_key')); ?>');
    let elements;
    
    initializePayment();
    
    async function initializePayment() {
        try {
            const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'stripe_create_payment_intent',
                    tour_id: '<?php echo $tour_id; ?>',
                    amount: '<?php echo $tour_price * 100; ?>', // in cents
                    nonce: '<?php echo wp_create_nonce("stripe_payment_nonce"); ?>'
                })
            });
            
            if (!response.ok) throw new Error('Network response was not ok');
            
            const {clientSecret} = await response.json();
            
            elements = stripe.elements({clientSecret});
            const paymentElement = elements.create('payment');
            paymentElement.mount('#payment-element');
            
        } catch (error) {
            console.error('Error:', error);
            const errorElement = document.getElementById('payment-errors');
            errorElement.textContent = error.message;
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
        
        const {error} = await stripe.confirmPayment({
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

<?php get_footer(); ?>