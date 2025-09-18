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

$totalTravelers = $tour_adults + $tour_child;

// Get tour details if valid tour ID
if ($tour_id > 0) {
    $tour = get_post($tour_id);
    if ($tour && $tour->post_type === 'tours') {
        $tour_title = esc_html($tour->post_title);
        $tour_image = get_the_post_thumbnail_url($tour_id, 'medium');
    }
}


 $tour_price = get_discounted_price($tour_id, false);
 $discounted_price = get_discounted_price($tour_id, false);     

   

$total_persons = $tour_adults + $tour_child;

// Format datetime-local value
$datetime_value = '';
if ($tour_date && $tour_time) {
    $formatted_time = sprintf("%02d:00", intval($tour_time));
    $datetime_value = $tour_date . ' ' . $formatted_time;
}

// Define hidden product ID for bookings
$booking_product_id = 26324 ; 

$vehicles = [
    "Sedan (1–3 Persons)"         => ["price" => 150, "px" => 3,  "capacity" => "1–3", "icon" => "🚘", "luggage" => "2 large + 2 small"],
    "MPV (4 Persons)"             => ["price" => 200, "px" => 4,  "capacity" => "4", "icon" => "🚙", "luggage" => "3 large + 3 small"],
    "Van (5–7 Persons)"           => ["price" => 250, "px" => 5,  "capacity" => "5–7", "icon" => "🚐", "luggage" => "6 large + 6 small"],
    "Sedan + Van (7–10 Persons)"  => ["price" => 400, "px" => 7,  "capacity" => "7–10", "icon" => "🚘 + 🚐", "luggage" => "10 large + 10 small"],
    "Two Vans / Sprinter (11–14)" => ["price" => 500, "px" => 11, "capacity" => "11–14", "icon" => "🚐 + 🚐", "luggage" => "14 large + 14 small"],
];
// Determine vehicle based on travelers
$highlightVehicle = '';
if ($totalTravelers <= 3) {
    $highlightVehicle = "Sedan (1–3 Persons)";
} elseif ($totalTravelers == 4) {
    $highlightVehicle = "MPV (4 Persons)";
} elseif ($totalTravelers >= 5 && $totalTravelers <= 7) {
    $highlightVehicle = "Van (5–7 Persons)";
} elseif ($totalTravelers >= 8 && $totalTravelers <= 10) {
    $highlightVehicle = "Sedan + Van (7–10 Persons)";
} elseif ($totalTravelers >= 11 && $totalTravelers <= 14) {
    $highlightVehicle = "Two Vans / Sprinter (10–14)";
}



$updated_total_price =  $vehicles[$highlightVehicle]['px']*$discounted_price ;

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
                        <input type="hidden" name="booking_product_id"
                            value="<?php echo esc_attr($booking_product_id); ?>">
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

                              

                                <div class="col-md-6 d-none">
                                    <label class="form-label">Number of Passengers (1–14)</label>
                                    <input type="number" name="pax" min="1" max="14" value="<?php echo $total_persons?>"
                                        class="form-control" required>
                                </div>

                                <!-- Pickup date & time -->
                                <div class="col-md-6 d-none">
                                    <label class="form-label">Pickup Date & Time</label>
                                    <input type="datetime-local" name="pickup_datetime" class="form-control"
                                        value="<?php echo esc_attr($datetime_value); ?>" required>
                                </div>

                                <!-- Pickup address -->
                                <div class="col-12">
                                    <label class="form-label">Pickup Address</label>
                                    <input type="text" name="pickup_address" placeholder="Enter pickup location"
                                        class="form-control" required>
                                </div>


                                <div class="col-12">
                                    <label class="form-label">Drop-off Address (optional if pre discussed)</label>
                                    <input type="text" name="dropoff_address" placeholder="Enter drop-off location"
                                        class="form-control">
                                </div>

                                <!-- Child Seat Selection -->
                                <?php if ($tour_child > 0): ?>
                                <div class="col-12">
                                    <div class="card border-0  mt-4">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Child Seat Requirements</h6>
                                        </div>
                                        <div class="child-body">
                                            <?php for ($i = 1; $i <= $tour_child; $i++): ?>
                                            <div class="child-seat-selection mb-3 p-3 border-bottom">

                                                <input type="hidden" name="child_seat_type[]"
                                                    id="child_seat_<?php echo $i; ?>" value="">
                                                <button type="button" class="btn btn-outline-success select-seat-btn"
                                                    data-child="<?php echo $i; ?>" data-bs-toggle="modal"
                                                    data-bs-target="#childSeatModal">
                                                    Select Child Seat Type <?php echo $i; ?>
                                                </button>
                                                <span class="badge text-dark ms-2 text-h2"
                                                    id="child_seat_label_<?php echo $i; ?>">Not selected</span>
                                            </div>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                
                                <div class="row" id="vehicleOptions">
                                         <h6 class="mb-0">Vehicle Type</h6>
                                    <?php foreach ($vehicles as $name => $details): ?>
                                    <div class="mt-3 mb-3">
                                        <div class="card d-flex flex-lg-row  p-3 vehicle-option <?php echo ($name === $highlightVehicle) ? 'active border-primary bg-light' : 'border'; ?>"
                                            data-px="<?php echo esc_attr($details['px']); ?>"
                                            data-name="<?php echo esc_attr($name); ?>">
                                            <h5 class="mb-1"><?php echo $details['icon']; ?>
                                                <?php echo esc_html($name); ?></h5>
                                            <p class="mb-1 small">👤 Capacity: <?php echo $details['capacity']; ?>
                                                persons</p>
                                            <p class="mb-1 small">💰 Luggage: <?php echo $details['luggage']; ?></p>
                                            <?php if ($name === $highlightVehicle): ?>
                                            <span class="badge bg-primary">Selected</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
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
                                <span>Pickup Date & Time:</span>
                                <span><?php echo esc_attr($datetime_value); ?></span>
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
                                <span>Total Price: </span>                               
                               <span> €<span id="totalPrice"> <?php echo $updated_total_price ?></span></span>
                              
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

<!-- Child Seat Modal -->
<div class="modal fade" id="childSeatModal" tabindex="-1" aria-labelledby="childSeatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="childSeatModalLabel">Select Child Seat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Select your child's age and weight at the time of travel:</p>
                <ul class="list-group seat-options">
                    <li class="list-group-item seat-option" data-value="rear_facing">
                        <strong>Rear-facing infant seat</strong><br>
                        <small>0–1 year, 0–26 lbs (0–12 kg)</small>
                    </li>
                    <li class="list-group-item seat-option" data-value="forward_facing">
                        <strong>Forward-facing w/harness</strong><br>
                        <small>1–4 years, 18–36 lbs (8–16 kg)</small>
                    </li>
                    <li class="list-group-item seat-option" data-value="booster_high_back">
                        <strong>Booster seat with high back</strong><br>
                        <small>4–6 years, 30–50 lbs (14–23 kg)</small>
                    </li>
                    <li class="list-group-item seat-option" data-value="backless_booster">
                        <strong>Backless booster</strong><br>
                        <small>6–12 years, 44–72 lbs (20–32 kg)</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll(".step");
    const stepperItems = document.querySelectorAll(".stepper-item");
    let currentStep = 0;

    function showStep(step) {
        steps.forEach((s, i) => s.classList.toggle("active", i === step));

        stepperItems.forEach((item, i) => {
            item.classList.remove("active", "completed");
            if (i < step) {
                item.classList.add("completed");
            } else if (i === step) {
                item.classList.add("active");
            }
        });
    }

    function validateStep(stepIndex) {
        let valid = true;
        const inputs = steps[stepIndex].querySelectorAll("input, select, textarea");

        inputs.forEach(input => {
            if (!input.checkValidity()) {
                valid = false;
                input.classList.add("is-invalid");
            } else {
                input.classList.remove("is-invalid");
            }
        });

        return valid;
    }

    document.querySelectorAll(".next").forEach(btn => {
        btn.addEventListener("click", () => {
            if (validateStep(currentStep)) {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
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
(function() {
    'use strict';
    const form = document.querySelector('#step2Form');
    const needInvoice = document.querySelector('#need_invoice');
    const invoiceFields = document.querySelector('#invoiceFields');

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



    // Bootstrap validation
    if (form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }
})();


// Price calculation with detailed breakdown
function calculateTotalPrice() {
    let basePrice = <?php echo $tour_price; ?>;
    let totalPrice = basePrice;
    // Update display
    document.getElementById('grand_total').textContent = '€' + totalPrice.toFixed(2);
    // Update payment button text
    const payButton = document.getElementById('woocommerce-pay-button');
    if (payButton) {
        payButton.textContent = 'Pay €' + totalPrice.toFixed(2);
    }

    // Update breakdown display (if you have one)
    const breakdownElement = document.getElementById('price-breakdown');
    if (breakdownElement) {
        if (breakdown.length > 0) {
            breakdownElement.innerHTML = '<strong>Price Breakdown:</strong><br>' + breakdown.join('<br>') +
                '<br><strong>Total: €' + totalPrice.toFixed(2) + '</strong>';
        } else {
            breakdownElement.innerHTML = '';
        }
    }

    return totalPrice;
}



// Initial calculation
calculateTotalPrice();


document.addEventListener("DOMContentLoaded", function() {
    let currentChild = null;
    // When "Select Child Seat" button is clicked
    document.querySelectorAll(".select-seat-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            currentChild = this.getAttribute("data-child");
        });
    });

    // Handle seat option click inside modal
    document.querySelectorAll(".seat-option").forEach(option => {
        option.addEventListener("click", function() {
            if (currentChild) {
                const seatValue = this.getAttribute("data-value");
                const seatLabel = this.querySelector("small").textContent;

                // Set hidden input value
                document.getElementById("child_seat_" + currentChild).value = seatValue;

                // Update label next to button
                document.getElementById("child_seat_label_" + currentChild).textContent =
                    seatLabel;

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById(
                    "childSeatModal"));
                modal.hide();
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function() {
    let totalTravelers = <?php echo intval($total_persons); ?>;
    let carTypeDisplay = document.getElementById("carTypeDisplay");
    let carTypeHTML = "";

    if (totalTravelers <= 3) {
        carTypeHTML = `
            <p class="mb-1"><strong>Sedan (1–3 Persons)</strong></p>
            <p class="mb-1 small">👤 Capacity: 1–3 persons</p>
            <p class="mb-1 small">🧳 Luggage: 2 large + 2 small</p>
            <p class="mb-0 small">🚘 Car Type: Sedan</p>
        `;
    } else if (totalTravelers === 4) {
        carTypeHTML = `
            <p class="mb-1"><strong>MPV (4 Persons)</strong></p>
            <p class="mb-1 small">👤 Capacity: 4 persons</p>
            <p class="mb-1 small">🧳 Luggage: 3 large + 3 small</p>
            <p class="mb-0 small">🚘 Car Type: MPV</p>
        `;
    } else if (totalTravelers >= 5 && totalTravelers <= 7) {
        carTypeHTML = `
            <p class="mb-1"><strong>Van (5–7 Persons)</strong></p>
            <p class="mb-1 small">👤 Capacity: 5–7 persons</p>
            <p class="mb-1 small">🧳 Luggage: 6 large + 6 small</p>
            <p class="mb-0 small">🚐 Car Type: Van</p>
        `;
    } else if (totalTravelers >= 8 && totalTravelers <= 10) {
        carTypeHTML = `
            <p class="mb-1"><strong>Sedan + Van (7–10 Persons)</strong></p>
            <p class="mb-1 small">👤 Capacity: 7–10 persons</p>
            <p class="mb-1 small">🧳 Luggage: 8–10 large + 8–10 small</p>
            <p class="mb-0 small">🚘 + 🚐 Car Type: 1 Sedan + 1 Van</p>
        `;
    } else if (totalTravelers >= 11 && totalTravelers <= 14) {
        carTypeHTML = `
            <p class="mb-1"><strong>Two Vans / Sprinter (10–14 Persons)</strong></p>
            <p class="mb-1 small">👤 Capacity: 10–14 persons</p>
            <p class="mb-1 small">🧳 Luggage: 12–14 large + 12–14 small</p>
            <p class="mb-0 small">🚐 + 🚐 Car Type: 2 Vans / 1 Sprinter</p>
        `;
    }

    carTypeDisplay.innerHTML = carTypeHTML;
});


document.addEventListener("DOMContentLoaded", function() {
    const vehicleOptions = document.querySelectorAll(".vehicle-option");
    const totalPriceEl = document.getElementById("totalPrice");

    vehicleOptions.forEach(option => {
        option.addEventListener("click", function() {
            // Remove active class from all
            vehicleOptions.forEach(opt => opt.classList.remove("active", "border-primary",
                "bg-light"));
            vehicleOptions.forEach(opt => {
                const badge = opt.querySelector(".badge");
                if (badge) badge.remove();
            });

            // Add active class to selected
            this.classList.add("active", "border-primary", "bg-light");
            this.insertAdjacentHTML("beforeend",
                '<span class="badge bg-primary">Selected</span>');

            // Update total price
            const px = this.getAttribute("data-px");
            totalPriceEl.textContent = px*<?php echo $discounted_price; ?>;
        });
    });
});
</script>