<?php
/* Template Name: Booking Details */
get_header();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $tour_id = isset($_POST['tour_id']) ? $_POST['tour_id'] : '';
    $tour_date = isset($_POST['tour_date']) ? $_POST['tour_date'] : '';
    $tour_adults = isset($_POST['tour_adults']) ? $_POST['tour_adults'] : '';
    $tour_price = isset($_POST['tour_price']) ? $_POST['tour_price'] : '';

  


    // Get tour details
        $tour = get_post($tour_id);
        if ($tour && $tour->post_type === 'tours') {
        $tour_title = $tour->post_title;
        $tour_image = get_the_post_thumbnail_url($post_id, 'medium'); 
        }

}


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
                            <h5 class="mb-3"><span class="step_number">1</span> Contact details</h5>
                            <p class="text-muted">We’ll use this information to send you confirmation and updates about
                                your booking</p>

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

                                <?php
                                      if ($tour_image) {
                                         echo "<img src='" . esc_url($tour_image) . "' alt='" . esc_attr($tour_title) . "' width='300'>";
                                     } ?>
                                <div>
                                    <h6 class="mb-1"><?php echo $tour_title ?></h6>
                                    <p class="mb-1 small text-muted"><i
                                            class="bi bi-person"></i><?php echo $tour_adults ?> Adults</p>
                                    <p class="mb-1 small text-muted"><i class="bi bi-calendar-event"></i>
                                        <?php echo $tour_date ?>
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
                                <h6 class="pb-2">Traveler <?php echo $i; ?> (Adult)</h6>
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

                            <button type="submit" class="btn  btn-success w-100 py-2">Book Now</button>
                        </div>
                    </form>
                    <?php else : ?>
                    <p>No booking information found. Please go back and fill the booking form.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="blog-widget">
                    <div class="h4 fw-bold text-success mb-4"><?php echo $tour_title ?></div>

                    <!-- Destination Info List -->
                    <ul class="destination-info-list list-unstyled">
                        <li><span>Adult:</span> <span><?php echo $tour_adults  ?></span></li>
                        <li><span>Date:</span> <span><?php echo $tour_date  ?></span></li>
                        <li><span>Child:</span> <span><?php echo ""  ?></span></li>
                        <li> <span>Total:</span>€<span></span><?php echo $tour_price  ?></span></li>
                    </ul>


                </div>

            </div>

        </div>
    </div>

</div>
</div>

<?php get_footer(); ?>