<?php
/* Template Name: Booking Details */
get_header();
?>


<!-- Destination Details Section -->
<div class="booking_details">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">

        <div class="row g-5">
            <div class="col-12 col-lg-8">

                <div class="content">                 
                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                    <form action="<?php echo esc_url(site_url('/process-booking')); ?>" method="POST">
                     
                        <input type="hidden" name="tour_date" value="<?php echo esc_attr($_POST['tour-date']); ?>">
                        <input type="hidden" name="adult" value="<?php echo esc_attr($_POST['tickets']); ?>">

                        <!-- Step 1: Contact Info -->
                        <div class="step p-4 shadow-sm border-0 mb-5">
                            <h5 class="mb-3"><span class="fw-bold">1</span> Contact details</h5>
                            <p class="text-muted">We’ll use this information to send you confirmation and updates about
                                your
                                booking</p>

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
                                <div class="form-check mt-3">
                                    <input type="checkbox" class="form-check-input" id="subscribe">
                                    <label class="form-check-label" for="subscribe">
                                        Get emails with special offers, inspiration, tips, and other updates.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Activity Details -->
                        <div class="step step2 p-4 shadow-sm border-0 mb-5">
                            <h5 class="mb-4"><span class="fw-bold">2</span> Activity details</h5>

                            <div class="d-flex gap-3 mb-4">
                                <img src="/images/tour.jpg" class="rounded" alt="Tour Image"
                                    style="width: 120px; height: 90px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-1">Rhine Valley Trip from Frankfurt including Rhine River Cruise</h6>
                                    <p class="mb-1 small text-muted"><i class="bi bi-person"></i> 3 Adults</p>
                                    <p class="mb-1 small text-muted"><i class="bi bi-calendar-event"></i> Tue, Aug 12,
                                        2025 •
                                        11:15 AM
                                    </p>
                                    <p class="small text-success"><i class="bi bi-check-circle"></i> Free cancellation
                                        before
                                        Aug 11</p>
                                    <a href="#" class="small">Details about the experience operator</a>
                                </div>
                            </div>

                            <!-- Travelers -->
                            <?php for ($i = 1; $i <= 3; $i++) : ?>
                            <div class="mb-4">
                                <h6 class="border-bottom pb-2">Traveler <?php echo $i; ?> (Adult)</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" name="traveler[<?php echo $i; ?>][first_name]"
                                            class="form-control" placeholder="First name"
                                            <?php echo $i == 1 ? 'value="Mufaqar"' : ''; ?> required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="traveler[<?php echo $i; ?>][last_name]"
                                            class="form-control" placeholder="Last name"
                                            <?php echo $i == 1 ? 'value="Islam"' : ''; ?> required>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>

                            <!-- Meeting Point -->
                            <div class="mt-4">
                                <h6>Meeting point</h6>
                                <p class="text-muted">
                                    <i class="bi bi-geo-alt-fill text-success"></i>
                                    Wiesenhüttenpl. 38, 60329 Frankfurt am Main, Germany
                                </p>
                            </div>
                        </div>

                        <!-- Step 3: Payment -->
                        <div class="step step3 p-4 shadow-sm border-0">
                            <h5 class="mb-3"><span class="fw-bold">3</span> Payment details</h5>

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
                                        required>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" name="card_expiry" class="form-control" placeholder="MM / YY"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="card_cvc" class="form-control" placeholder="CVC"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="text-muted small mb-4">
                                🔒 You’ll be charged after confirmation. By clicking <strong>Book Now</strong>, you
                                agree to our
                                <a href="#" class="text-decoration-underline">Terms of Use</a> and <a href="#"
                                    class="text-decoration-underline">Privacy Policy</a>.
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">Book Now</button>
                        </div>
                    </form>
                    <?php else : ?>
                    <p>No booking information found. Please go back and fill the booking form.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="blog-widget">
                    <div class="h4 fw-bold text-success mb-4">Some Information</div>

                    <!-- Destination Info List -->
                    <ul class="destination-info-list list-unstyled">
                        <li><span>County:</span> <span>London</span></li>
                        <li><span>Visa Requirements:</span> <span>Yes</span></li>
                        <li><span>Per Person:</span> <span>1500$</span></li>
                        <li><span>Languages:</span> <span>English, French, German</span></li>
                        <li><span>Area(Km4):</span> <span>90.000 Km5</span></li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

</div>
</div>

<?php get_footer(); ?>