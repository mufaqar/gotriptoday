<?php
/* Template Name: Booking Details */
get_header();

// Initialize variables
$tour_id       = isset($_GET['tour_id']) ? intval($_GET['tour_id']) : 0;
$tour_price    = isset($_GET['tour_price']) ? floatval($_GET['tour_price']) : 0;
$tour_adults   = isset($_GET['adult_count']) ? intval($_GET['adult_count']) : 0;
$tour_child    = isset($_GET['child_count']) ? intval($_GET['child_count']) : 0;
$tour_date     = isset($_GET['tour_date']) ? sanitize_text_field($_GET['tour_date']) : '';
$tour_time     = isset($_GET['tour_time']) ? sanitize_text_field($_GET['tour_time']) : '';

// Get tour details if valid tour ID
if ($tour_id > 0) {
    $tour = get_post($tour_id);
    if ($tour && $tour->post_type === 'tours') {
        $tour_title = esc_html($tour->post_title);
        $tour_image = get_the_post_thumbnail_url($tour_id, 'medium');
    }
}

$total_persons = $tour_adults + $tour_child;

// Format datetime-local value
$datetime_value = '';
if ($tour_date && $tour_time) {
    $formatted_time = sprintf("%02d:00", intval($tour_time));
    $datetime_value = $tour_date . 'T' . $formatted_time;
}

// Define hidden product ID for bookings
$booking_product_id = 26324 ; 

?>
<div class="divider-sm"></div>
<div class="booking_details">
    <div class="divider"></div>
    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-lg-8">
                <div class="content">
                  
                <form id="booking-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                        <?php wp_nonce_field('booking_nonce', 'booking_nonce_field'); ?>
                        <input type="hidden" name="tour_id" value="<?php echo esc_attr($tour_id); ?>">
                        <input type="hidden" name="tour_date" value="<?php echo esc_attr($tour_date); ?>">
                        <input type="hidden" name="tour_adults" value="<?php echo esc_attr($tour_adults); ?>">
                        <input type="hidden" name="tour_child" value="<?php echo esc_attr($tour_child); ?>">
                        <input type="hidden" name="tour_price" value="<?php echo esc_attr($tour_price); ?>">
                        <input type="hidden" name="booking_product_id" value="<?php echo esc_attr($booking_product_id); ?>">
                        <input type="hidden" name="action" value="process_booking">

                        <!-- Step Indicators -->
                        <div class="stepper-wrapper mb-5">
                            <div class="stepper-item active">
                                <div class="step-counter">1</div>
                                <div class="step-name">Trip & Pax</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">2</div>
                                <div class="step-name">Instructions</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">3</div>
                                <div class="step-name">Payment</div>
                            </div>
                        </div>

                        <!-- Step 1: Contact Info -->
                        <div class="step active p-4 shadow-sm border-0 mb-5">
                            <h5 class="mb-3">Booking details</h5>
                            <div class="row g-3">
                                <!-- Pax -->
                                <div class="col-md-6">
                                    <label class="form-label">Number of Passengers (1–14)</label>
                                    <input type="number" name="pax" min="1" max="14" value="<?php echo $total_persons?>" class="form-control" required>
                                </div>

                                <!-- Pickup date & time -->
                                <div class="col-md-6">
                                    <label class="form-label">Pickup Date & Time</label>
                                    <input type="datetime-local" name="pickup_datetime" class="form-control"   value="<?php echo esc_attr($datetime_value); ?>"  required>
                                </div>

                                <!-- Pickup address -->
                                <div class="col-12">
                                    <label class="form-label">Pickup Address</label>
                                    <input type="text" name="pickup_address" placeholder="Enter pickup location"
                                        class="form-control" required>
                                </div>

                                <!-- Drop-off address -->
                                <div class="col-12">
                                    <label class="form-label">Drop-off Address (optional if hourly)</label>
                                    <input type="text" name="dropoff_address" placeholder="Enter drop-off location"
                                        class="form-control">
                                </div>

                                <!-- Trip type -->
                                <div class="col-md-6">
                                    <label class="form-label">Trip Type</label>
                                    <select name="trip_type" class="form-select">
                                        <option value="one-way" selected>One-way</option>
                                        <option value="hourly">Hourly</option>
                                    </select>
                                </div>

                                <!-- Flight / Port / Train info -->
                                <div class="col-md-6">
                                    <label class="form-label">Flight / Ship / Train No. (optional)</label>
                                    <input type="text" name="transport_info"
                                        placeholder="e.g. BA249, MSC Virtuosa, ICE 789" class="form-control">
                                </div>

                                <!-- Notes to driver -->
                                <div class="col-12">
                                    <label class="form-label">Notes to Driver (optional)</label>
                                    <textarea name="driver_notes" rows="3" class="form-control"
                                        placeholder="Any special instructions for your driver..."></textarea>
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="button" class="btn btn-success next">Next</button>
                            </div>
                        </div>

                        <!-- Step 2: Activity Details -->
                        <div class="step p-4 shadow-sm border-0 mb-5">
                            <div id="step2Form" class="needs-validation" novalidate>

                                <!-- Vehicle Section -->
                                <div class="mb-4">
                                    <h5>Vehicle Selection</h5>
                                    <select name="vehicle" id="vehicle" class="form-select" required>
                                        <option value="">Select Vehicle</option>
                                        <option value="sedan">Sedan (1–3 pax)</option>
                                        <option value="mpv">MPV (1–4 pax)</option>
                                        <option value="van">Van (1–7 pax)</option>
                                        <option value="van_sedan">Van + Sedan (1–10 pax)</option>
                                        <option value="two_vans">Two Vans (1–14 pax)</option>
                                        <option value="sprinter">Sprinter (1–14 pax)</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a vehicle.</div>
                                </div>

                                <!-- Premium Upgrade (only visible if Sedan is chosen via JS) -->
                                <div class="form-check mb-4" id="premiumWrapper" style="display:none;">
                                    <input class="form-check-input" type="checkbox" id="premium_upgrade"
                                        name="premium_upgrade" value="1">
                                    <label class="form-check-label" for="premium_upgrade">
                                        Premium Upgrade (+20%)
                                    </label>
                                </div>

                                <!-- Extras Section -->
                                <div class="mb-4">
                                    <h5>Extras</h5>
                                    <label class="form-label">Child Seats</label>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="baby_seat" min="0" max="5"
                                                value="0" placeholder="Baby Seat (0–3 yrs)">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="toddler_seat" min="0"
                                                max="5" value="0" placeholder="Toddler Seat (3–6 yrs)">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" name="booster_seat" min="0"
                                                max="5" value="0" placeholder="Booster (6+ yrs)">
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label for="extra_hours" class="form-label">Additional Hours</label>
                                        <input type="number" class="form-control" id="extra_hours" name="extra_hours"
                                            min="0" max="8" value="0">
                                    </div>
                                </div>

                                <!-- Passenger & Invoice Details -->
                                <div class="mb-4">
                                    <h5>Passenger Details</h5>

                                    <div class="mb-3">
                                        <label for="passenger_name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="passenger_name"
                                            name="passenger_name" required>
                                        <div class="invalid-feedback">Full name is required.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="passenger_email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="passenger_email"
                                            name="passenger_email" required>
                                        <div class="invalid-feedback">Valid email is required.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="passenger_mobile" class="form-label">Mobile / WhatsApp</label>
                                        <input type="text" class="form-control" id="passenger_mobile"
                                            name="passenger_mobile" required>
                                        <div class="invalid-feedback">Mobile/WhatsApp is required.</div>
                                    </div>

                                    <!-- Invoice Toggle -->
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="need_invoice"
                                            name="need_invoice">
                                        <label class="form-check-label" for="need_invoice">Need Invoice?</label>
                                    </div>

                                    <!-- Invoice Fields (hidden until toggle is on) -->
                                    <div id="invoiceFields" style="display:none;">
                                        <div class="mb-3">
                                            <label for="company_name" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" id="company_name"
                                                name="company_name">
                                            <div class="invalid-feedback">Company name is required if invoice is
                                                selected.</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="invoice_address" class="form-label">Invoice Address</label>
                                            <input type="text" class="form-control mb-2" id="invoice_street"
                                                name="invoice_street" placeholder="Street">
                                            <input type="text" class="form-control mb-2" id="invoice_city"
                                                name="invoice_city" placeholder="City">
                                            <input type="text" class="form-control mb-2" id="invoice_zip"
                                                name="invoice_zip" placeholder="ZIP">
                                            <input type="text" class="form-control" id="invoice_country"
                                                name="invoice_country" placeholder="Country">
                                            <div class="invalid-feedback">All invoice address fields are required.</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="vat_id" class="form-label">VAT ID (optional)</label>
                                            <input type="text" class="form-control" id="vat_id" name="vat_id">
                                        </div>
                                    </div>
                                </div>

                                <!-- Consent -->
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="consent_terms"
                                        name="consent_terms" required>
                                    <label class="form-check-label" for="consent_terms">
                                        I agree to the GDPR terms and conditions.
                                    </label>
                                    <div class="invalid-feedback">You must agree before continuing.</div>
                                </div>

                                <!-- Price Box -->
                                <div class="mb-4 p-3 border rounded bg-light">
                                    <h5>Total Price</h5>
                                    <p class="mb-0"><strong id="grand_total">€<?php echo $tour_price?></strong></p>
                                </div>

                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev">Previous</button>
                                <button type="button" class="btn btn-success next">Continue to Payment</button>
                            </div>
                        </div>

                        <!-- Step 3: Payment -->
                        <div class="step p-4 shadow-sm border-0">
                            <h5 class="mb-3">Payment details</h5>

                            <!-- WooCommerce Payment Methods -->
                            <div class="mb-4">
                                <label class="form-label">Pay with</label>
                                <?php 
                                // Get available payment gateways
                                if (class_exists('WC_Payment_Gateways')) {
                                    $gateways = WC()->payment_gateways->get_available_payment_gateways();
                                    
                                    if ($gateways) {
                                        $first = true;
                                        foreach ($gateways as $gateway) {
                                            echo '<div class="form-check mb-3">';
                                            echo '<input class="form-check-input" type="radio" name="payment_method" value="' . esc_attr($gateway->id) . '" id="payment-method-' . esc_attr($gateway->id) . '" ' . ($first ? 'checked' : '') . '>';
                                            echo '<label class="form-check-label fw-semibold" for="payment-method-' . esc_attr($gateway->id) . '">' . esc_html($gateway->get_title()) . '</label>';
                                            echo '</div>';
                                            $first = false;
                                        }
                                    } else {
                                        echo '<p class="text-danger">No payment methods available. Please configure payment methods in WooCommerce.</p>';
                                    }
                                }
                                ?>
                            </div>

                            <div class="text-muted small mb-4">
                                🔒 You'll be charged €<?php echo number_format($tour_price, 2); ?>.
                                By clicking <strong>Pay Now</strong>, you agree to our
                                <a href="#" class="text-decoration-underline">Terms of Use</a> and
                                <a href="#" class="text-decoration-underline">Privacy Policy</a>.
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev">Previous</button>
                                <button type="submit" class="btn btn-success" id="woocommerce-pay-button">
                                    Pay €<?php echo number_format($tour_price, 2); ?>
                                </button>
                            </div>
                        </div>
                    </form>
                  
                </div>
            </div>

            <div class="col-12 col-lg-4 booking_sidebar">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-3"><?php echo esc_html($tour_title); ?></h3>
                        <?php if ($tour_image): ?>
                        <img src="<?php echo esc_url($tour_image); ?>" class="img-fluid rounded mb-3 w-100"
                            alt="<?php echo esc_attr($tour_title); ?>">
                        <?php endif; ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Date:</span>
                                <span><?php echo esc_html($tour_date); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Adults:</span>
                                <span><?php echo esc_html($tour_adults); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Childs:</span>
                                <span><?php echo esc_html($tour_child); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between fw-bold">
                                <span>Total:</span>
                                <span>€<?php echo number_format($tour_price, 2); ?></span>
                            </li>
                        </ul>
                        <div class="icon footer_pickup">
                            <i class="ti ti-calendar"></i>
                            Free cancellation up to 24 hours before your pickup time.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="divider"></div>
    <div class="divider-sm"></div>
</div>

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll(".step");
    const stepperItems = document.querySelectorAll(".stepper-item");
    let currentStep = 0;

    function showStep(step) {
        // Show the correct step content
        steps.forEach((s, i) => s.classList.toggle("active", i === step));

        // Update stepper status
        stepperItems.forEach((item, i) => {
            item.classList.remove("active", "completed");
            if (i < step) {
                item.classList.add("completed"); // previous steps
            } else if (i === step) {
                item.classList.add("active"); // current step
            }
        });
    }

    document.querySelectorAll(".next").forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    document.querySelectorAll(".prev").forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    // Initialize first step
    showStep(currentStep);
});

// Bootstrap validation + toggle for invoice and premium
(function () {
  'use strict';
  const form = document.querySelector('#step2Form');
  const needInvoice = document.querySelector('#need_invoice');
  const invoiceFields = document.querySelector('#invoiceFields');
  const vehicleSelect = document.querySelector('#vehicle');
  const premiumWrapper = document.querySelector('#premiumWrapper');

  // Invoice toggle
  if (needInvoice) {
    needInvoice.addEventListener('change', function() {
      invoiceFields.style.display = this.checked ? 'block' : 'none';
      document.querySelectorAll('#invoiceFields input').forEach(input => {
        input.required = this.checked && input.name !== "vat_id";
      });
    });
  }

  // Premium toggle (only if Sedan selected)
  if (vehicleSelect) {
    vehicleSelect.addEventListener('change', function() {
      if (this.value === 'sedan') {
        premiumWrapper.style.display = 'block';
      } else {
        premiumWrapper.style.display = 'none';
        document.querySelector('#premium_upgrade').checked = false;
      }
    });
  }

  // Bootstrap validation
  if (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  }
})();


// Price calculation
function calculateTotalPrice() {
    let basePrice = <?php echo $tour_price; ?>;
    let extraCost = 0;
    
    // Vehicle premium upgrade
    if (document.querySelector('#premium_upgrade').checked) {
        extraCost += basePrice * 0.2; // 20% premium
    }
    
    // Child seats (example: €5 each)
    const babySeats = parseInt(document.querySelector('input[name="baby_seat"]').value) || 0;
    const toddlerSeats = parseInt(document.querySelector('input[name="toddler_seat"]').value) || 0;
    const boosterSeats = parseInt(document.querySelector('input[name="booster_seat"]').value) || 0;
    extraCost += (babySeats + toddlerSeats + boosterSeats) * 5;
    
    // Additional hours (example: €50 per hour)
    const extraHours = parseInt(document.querySelector('input[name="extra_hours"]').value) || 0;
    extraCost += extraHours * 50;
    
    const totalPrice = basePrice + extraCost;
    document.getElementById('grand_total').textContent = '€' + totalPrice.toFixed(2);
    
    // Update payment button text
    const payButton = document.getElementById('woocommerce-pay-button');
    if (payButton) {
        payButton.textContent = 'Pay €' + totalPrice.toFixed(2);
    }
    
    return totalPrice;
}

// Add event listeners for price-changing elements
document.querySelectorAll('#premium_upgrade, input[name="baby_seat"], input[name="toddler_seat"], input[name="booster_seat"], input[name="extra_hours"]').forEach(element => {
    element.addEventListener('change', calculateTotalPrice);
    element.addEventListener('input', calculateTotalPrice);
});

// Initial calculation
calculateTotalPrice();
</script>