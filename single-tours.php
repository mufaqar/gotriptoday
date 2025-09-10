<?php get_header(); ?>
<?php

$bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/img/bg-img/97.jpg';

// get_template_part('partials/content', 'breadcrumb', [
//     'bg' => $bg_image
// ]);




$tour_comments = get_tour_comments(get_the_ID());
$review_count = count($tour_comments);


?>


<style>
    .traveler-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
        padding: 20px;
    }

    .date-display {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }

    .traveler-count {
        font-size: 1.5rem;
        font-weight: 600;
        color: #0d6efd;
    }

    .info-text {
        color: #6c757d;
        font-size: 0.85rem;
        margin-bottom: 20px;
    }

    .age-group {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e9ecef;
    }

    .age-group:last-child {
        border-bottom: none;
    }

    .counter {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    .counter-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #6c757d;
        cursor: pointer;
    }

    .counter-btn:hover {
        background-color: #e9ecef;
    }

    .counter-value {
        margin: 0 15px;
        font-weight: 500;
        min-width: 30px;
        text-align: center;
    }

    .apply-btn {
        background-color: #0d6efd;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 500;
        width: 100%;
        margin-top: 15px;
    }

    .apply-btn:hover {
        background-color: #0b5ed7;
    }

    .age-title {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .age-range {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .traveler-selection {
        margin-top: 15px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 12px;
        cursor: pointer;
    }

    .traveler-selection:hover {
        border-color: #0d6efd;
    }

    .traveler-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .traveler-modal-content {
        background: white;
        border-radius: 10px;
        padding: 20px;
        width: 90%;
        max-width: 500px;
        max-height: 80vh;
        overflow-y: auto;
    }
</style>
<div class="tour-details-section">
    <div class="divider"></div>
    <div class="container">
        <div class="divider-sm"></div>
        <div
            class="tour-details-header d-flex flex-lg-row flex-column gap-lg-4 align-items-start justify-content-between">
            <div class="col-12 col-lg-9">
                <div class="tour-details-meta py-2 mb-3">
                    <ul class="list-unstyled d-flex flex-wrap gap-2">
                        <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
                        <li>/</li>
                        <li><a href="<?php echo home_url('/day-trips'); ?>">Tours</a></li>
                        <li>/</li>
                        <li><?php the_title() ?></li>
                    </ul>
                </div>
                <h2 class="mb-3"><?php the_title() ?></h2>
                <ul class="list-unstyled mb-3 d-flex flex-wrap gap-2 text-black"
                    style="font-size:14px; font-weight: 500;">
                    <li class="d-flex align-items-center">
                        <i class='text-success pe-1 ti ti-star-filled'></i>
                        <i class='text-success pe-1 ti ti-star-filled'></i>
                        <i class='text-success pe-1 ti ti-star-filled'></i>
                        <i class='text-success pe-1 ti ti-star-filled'></i>
                        <i class='text-success pe-1 ti ti-star-filled'></i>
                        <span class="d-inline-flex text-decoration-underline"><?php echo $review_count ?> Reviews</span>
                    </li>
                    <li>|</li>
                    <li>
                        <i class=' pe-1 ti ti-rosette-discount-check' style="color: #e25a3a;font-size: 120%;"></i>
                        Recommended by 95% of travelers
                    </li>
                    <li>|</li>
                    <li>
                        Frankfurt, Germany
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-3">
                <ul class="list-unstyled d-flex flex-column gap-1 text-black" style="font-size:14px; font-weight: 500;">
                    <li> <i class='text-success pe-1 ti ti-phone'></i>
                        Book online or call: <a href="tel:+4901701479446" target="_blank"
                            class="text-decoration-underline">+49 0 170 1479446</a>
                    </li>
                    <li> <i class='text-success pe-1 ti ti-brand-wechat'></i>
                        <a href="#" target="_blank" class="text-decoration-underline">Chat now</a>
                    </li>
                </ul>
                <ul class="list-unstyled d-flex justify-content-lg-end justify-content-start text-black mt-5"
                    style="font-size:14px; font-weight: 500;">
                    <li style="background-color:#f5f5f5; width: fit-content; padding: .25rem; border-radius: .375rem;">
                        <i class='text-success pe-1 ti ti-tag'></i> Lowest Price Guarantee
                    </li>
                </ul>

            </div>
        </div>
        <div class="divider-xs"></div>
        <div class="row g-5">
            <div class="col-12 col-lg-8">
                <div class="d-flex flex-row gap-4 align-items-start">
                    <!-- Vertical Thumbs -->
                    <div class="swiper destination-thumbs col-lg-2 col-3 d-lg-flex d-none">
                        <div class="swiper-wrapper d-flex flex-column gap-3">
                            <?php

                            $gallery = get_post_meta($post->ID, "gallery", true);
                            if (!empty($gallery)) {
                                $image_ids = explode(',', $gallery);
                                $index = 0;
                                foreach ($image_ids as $image_id) {
                                    $thumb_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                                    if ($thumb_url) { ?>
                                        <div class="swiper-slide  <?php echo $index === 0 ? 'active' : ''; ?>">
                                            <img src="<?php echo esc_url($thumb_url); ?>" alt="" class="w-100 rounded">
                                        </div>
                                    <?php }
                                }
                            } ?>
                        </div>

                    </div>

                    <!-- Main Slider -->
                    <div class="swiper destination-details-wrapper col-lg-10 col-12 position-relative">
                        <ul class="list-unstyled d-flex gap-2 wishlist">
                            <li>
                                <button class="wishlist_btn">
                                    <i class='icon ti ti-share'></i> Share <i
                                        class='icon ti ti-chevron-down open_share_links'></i>
                                </button>
                                <ul class="list-unstyled share_links">
                                    <li>
                                        <a href="#"><i class='icon ti ti-link'></i> Copy Link</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class='icon ti ti-mail'></i> Email</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <button class="wishlist_btn" id="add-to-wishlist" data-tour-id="<?php the_ID(); ?>">
                                    <i class='icon ti ti-heart'></i> Add to Wishlist
                                </button>
                            </li>
                        </ul>
                        <div class="swiper-wrapper">
                            <?php
                            if (!empty($gallery)) {
                                foreach ($image_ids as $image_id) {
                                    $image_url = wp_get_attachment_image_url($image_id, 'full');
                                    if ($image_url) { ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="" class="w-100 rounded">
                                        </div>
                                    <?php }
                                }
                            } ?>
                        </div>
                        <button class="destination-details-button-prev"><i class="icon-arrow-left"></i></button>
                        <button class="destination-details-button-next"><i class="icon-arrow-right"></i></button>
                    </div>
                </div>
                <div class="meta_info">
                    <ul class="list-unstyled d-flex flex-lg-row flex-column align-items-center gap-lg-5 gap-3">
                        <li class="d-flex align-items-center gap-1">
                            <i class='icon ti ti-clock'></i> 5 hours 30 minutes (approx.)
                        </li>
                        <li class="d-flex align-items-center gap-1">
                            <i class='icon ti ti-device-mobile'></i> Mobile ticket
                        </li>
                        <li class="d-flex align-items-center gap-1">
                            <i class='icon ti ti-messages'></i> Offered in: English and 1 more
                        </li>
                    </ul>
                </div>
                <div class="tour_reviews">
                    <div class="d-flex flex-lg-row flex-column justify-content-between">
                        <h2 class="pb-3">Why travelers loved this</h2>
                        <h4><i class='text-success pe-1 ti ti-star-filled'></i> 4.8 · <p
                                class="d-inline-flex text-black text-decoration-underline"><?php echo $review_count ?>
                                Reviews</p>
                        </h4>
                    </div>









                    <div class="review_list d-flex flex-lg-row flex-column gap-4">

                        <?php if (!empty($tour_comments)): ?>
                            <?php foreach ($tour_comments as $c): ?>
                                <div class="review_box">
                                    <div class="d-flex flex-lg-row flex-column justify-content-between">
                                        <ul class="list-unstyled d-flex">
                                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                                        </ul>
                                        <p class="d-inline-flex"><?php echo esc_html($c['author']); ?>·
                                            <?php echo esc_html($c['date']); ?>
                                        </p>
                                    </div>
                                    <p><?php echo esc_html($c['content']); ?></p>
                                </div>
                            <?php endforeach; ?>

                        <?php endif; ?>





                    </div>
                </div>
                <!-- Tour Details Content -->
                <div class="tour-details-content">
                    <div class="tour_overview">
                        <h2 class="pb-3">Overview</h2>
                        <?php echo get_post_meta($post->ID, "tour_overview", true); ?>
                    </div>
                    <div class="tour_itinerary">
                        <h2 class="pb-3">Trip Itinerary</h2>

                        <?php $trip_itinerary = get_post_meta($post->ID, "trip_itinerary", true);
                        ?>
                        <div>
                            <?php
                            $counter = 0;
                            foreach ($trip_itinerary as $itinerary) {
                                $counter++;
                                $title = $itinerary['title'];
                                $description = $itinerary['description'];
                                $ticket_info = $itinerary['ticket_info'];
                                ?>
                                <div class="itinerary_item">
                                    <span class="list_marker"><?php echo $counter; ?></span>
                                    <div>
                                        <h5 class="pb-3"> <?php echo $title; ?></h5>
                                        <p>
                                            <?php echo $description; ?>
                                        </p>
                                        <p class="itinerary_detail">
                                            <?php echo $ticket_info; ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="tour_included">
                    <h2 class="pb-3">What's Included</h2>
                    <div class="d-flex flex-lg-row flex-column gap-2 align-items-start">
                        <div>
                            <ul class="list-unstyled d-flex flex-column gap-2">
                                <?php

                                // ✅ INCLUDED
                                $included = get_post_meta($post->ID, "included", true);

                                if (!empty($included) && is_array($included)) {
                                    foreach ($included as $feature => $is_included) {
                                        if ($is_included && $is_included !== 'false') {
                                            echo "<li class='d-flex gap-2 align-items-center'><i class='ti ti-check text-black'></i> $feature</li>";
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div>
                            <ul class="list-unstyled d-flex flex-column gap-2 ">
                                <?php
                                // ✅Not INCLUDED
                                $not_included = get_post_meta($post->ID, "not_included", true);

                                if (!empty($not_included) && is_array($not_included)) {
                                    foreach ($not_included as $nofeature => $is_not_included) {
                                        if ($is_not_included && $is_not_included !== 'false') {
                                            echo "<li class='d-flex gap-2 align-items-center'><i class='ti ti-x text-black'></i> $nofeature</li>";
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tour_additional">
                    <h2 class="pb-3">Additional Info</h2>
                    <?php echo get_post_meta($post->ID, "additional_info", true); ?>
                </div>
                <div class="tour_additional_list d-flex flex-lg-row flex-column gap-4 mt-5">
                    <div class="tour_additional_box col-lg-6 col-12">
                        <div class="d-flex flex-lg-row flex-column justify-content-between">
                            <h4>
                                Cancellation Policy
                            </h4>
                        </div>
                        <p>You can cancel up to 24 hours in advance of the experience for a full refund.</p>
                        <button onclick="openPopup()">
                            Show more
                        </button>
                    </div>
                    <div class="tour_additional_box col-lg-6 col-12">
                        <div class="d-flex flex-lg-row flex-column justify-content-between">
                            <h4>
                                Questions?
                            </h4>
                        </div>
                        <p>Need help? Contact us for any further questions</p>
                        <button>
                            <a href="<?php echo home_url('/contact'); ?>">
                                Contact Support
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="d-flex flex-column gap-5 sticky-sidebar">
                    <div class="sidebar-widget">
                        <?php $tour_price = get_post_meta($post->ID, "pricing", true); ?>
                        <div class="h4 fw-bold mb-4">From € <?php echo $tour_price; ?><span class="h6"> Per
                                Person</span>
                        </div>
                        <form class="Single_tour_booking" action="<?php echo home_url('/booking-details'); ?>"
                            method="POST">
                            <input type="hidden" id="tour_id" name="tour_id" value="<?php echo $post->ID ?>">
                            <input type="hidden" id="tour_price" name="tour_price" value="<?php echo $tour_price; ?>">
                            <input type="hidden" id="adult_count_input" name="adult_count" value="1">
                            <input type="hidden" id="child_count_input" name="child_count" value="0">
                            <div class="row">
                                <div class="col-12 gap-2 py-2 tour_date">
                                    <label for="tour_date" class="form-label mb-0 text-heading">Date</label>
                                    <input type="date" id="tour_date" name="tour_date"
                                        class="form-control p-0 bg-transparent h-auto"
                                        value="<?php echo date('Y-m-d'); ?>" required>
                                </div>

                                <div class="col-12 gap-2 py-2 tour_travelers">
                                    <label class="form-label mb-0 text-heading">Travelers</label>
                                    <div class="traveler-selection" onclick="openTravelerModal()">
                                        <span id="traveler-summary">1 Adult, 0 Children</span>
                                        <i class="ti ti-chevron-down float-end"></i>
                                    </div>
                                </div>

                                <div class="col-12 gap-2 py-2 tour_time">
                                    <label for="tour_time" class="form-label mb-0 text-heading">Start Time</label>
                                    <?php
                                    // Function to generate time slots
                                    function generateTimeSlots($start_time, $end_time, $interval_minutes)
                                    {
                                        $times = [];
                                        $start = strtotime($start_time);
                                        $end = strtotime($end_time);
                                        $interval_seconds = $interval_minutes * 60;

                                        while ($start <= $end) {
                                            $times[] = date('h:i A', $start);
                                            $start += $interval_seconds;
                                        }

                                        return $times;
                                    }

                                    // Define start and end times (e.g., 9:00 AM to 5:00 PM)
                                    $start_time = '09:00 AM';
                                    $end_time = '05:00 PM';
                                    $interval = 30; // 30-minute intervals
                                    
                                    // Get the time slots
                                    $time_slots = generateTimeSlots($start_time, $end_time, $interval);
                                    ?>

                                    <select name="tour_time" id="tour_time" class="py-2 touria-select2 bg-transparent">
                                        <option value="1" selected>Select Time</option>
                                        <?php foreach ($time_slots as $index => $time): ?>
                                            <option value="<?php echo $index + 2; ?>"><?php echo $time; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="tour-booking-summary py-2">
                                    <ul class="list-unstyled d-flex flex-column gap-2 bg-white p-0">
                                        <li>
                                            <span><strong>Adult (<span
                                                        id="summary-adult-count">1</span>x):</strong></span>
                                            <span id="price-per-adult">€<?php echo $tour_price; ?></span>
                                        </li>
                                        <li id="child-price-item" style="display: none;">
                                            <span><strong>Child (<span
                                                        id="summary-child-count">0</span>x):</strong></span>
                                            <span id="price-per-child">€0.00</span>
                                        </li>
                                        <li class="pt-2 border-top">
                                            <span><strong>Total:</strong></span>
                                            <span id="total_price"><strong>€<?php echo $tour_price; ?></strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success w-100">Check Availability <i
                                        class="icon-arrow-right"></i></button>
                            </div>
                            <div class="col-12 mt-4">
                                <ul class="list-unstyled d-flex flex-column gap-2">
                                    <li>
                                        <i class='ti ti-circle-check-filled'></i> <strong
                                            class="text-decoration-underline">Free cancellation</strong> Free
                                        cancellation up to 24 hours
                                    </li>
                                    <li>
                                        <i class='ti ti-circle-check-filled'></i><strong
                                            class="text-decoration-underline"> Reserve Now and Pay Later </strong> -
                                        Secure
                                        your spot while staying flexible
                                    </li>
                                </ul>
                            </div>
                        </form>
                        <div class="col-12 mt-4 p-2 pb-0 book_ahead">
                            <ul class="list-unstyled d-flex flex-column gap-2">
                                <li>
                                    <i class="ti ti-flame" style="color: #e25a3a;font-size: 120%;"></i>
                                    <strong>Book ahead!</strong><br />
                                    On average, this is booked 37 days in advance.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Traveler Selection Modal -->
<div class="traveler-modal" id="traveler-modal">
    <div class="traveler-modal-content">
        <h3 class="mb-3">Select Travelers</h3>
        <div class="info-text">
            You can select up to 15 travelers in total.
        </div>

        <div class="age-group">
            <div class="age-title">Adult (Age 13-99)</div>
            <div class="age-range">Minimum: 1, Maximum: 15</div>
            <div class="counter">
                <div class="counter-btn minus-btn" data-group="adult" onclick="updateCounter('adult', -1)">-</div>
                <div class="counter-value" id="adult-count">1</div>
                <div class="counter-btn plus-btn" data-group="adult" onclick="updateCounter('adult', 1)">+</div>
            </div>
        </div>

        <div class="age-group">
            <div class="age-title">Child (Age 0-12)</div>
            <div class="age-range">Minimum: 0, Maximum: 15</div>
            <div class="counter">
                <div class="counter-btn minus-btn" data-group="child" onclick="updateCounter('child', -1)">-</div>
                <div class="counter-value" id="child-count">0</div>
                <div class="counter-btn plus-btn" data-group="child" onclick="updateCounter('child', 1)">+</div>
            </div>
        </div>

        <button class="apply-btn" onclick="applyTravelerSelection()">Apply</button>
    </div>
</div>

<!-- Divider -->
<div class="divider"></div>
<!-- PopUp -->
<div class="pop_up_wrapper">
    <div class="cancellation_pop_up ">
        <div class="d-flex align-items-end justify-content-end mb-1">
            <button class="close_popup" onclick="closePopup()">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="pb-5">
            <h3 class="pb-3">
                Cancellation
            </h3>
            <p class="mb-3">
                You can cancel up to 24 hours in advance of the experience for a full refund.
            </p>
            <ul class="mb-3 d-flex flex-column gap-2">
                <li>For a full refund, you must cancel at least 24 hours before the experience's start time. </li>
                <li>If you cancel less than 24 hours before the experience's start time, the amount you paid will not be
                    refunded. </li>
                <li>Any changes made less than 24 hours before the experience's start time will not be accepted. </li>
                <li>Cut-off times are based on the experience's local time. </li>
                <li>This experience requires a minimum number of travelers. If it's canceled because the minimum isn't
                    met, you'll be offered a different date/experience or a full refund.</li>
            </ul>
            <a href="#" class="text-decoration-underline">
                Read more about Cancellation.
            </a>
        </div>
    </div>
</div>

<section class="tour-list-section">
    <!-- Divider -->
    <div class="divider"></div>
    <div class="container">
        <div class="row g-4">
            <div class="tour_overview">
                <h2 class="pb-3">Related Tours</h2>

            </div>

            <div class="col-12 col-md-8">
                <div class="tour-list-content">
                    <div id="tour-results" class="row g-4">
                        <?php
                        $args = array(
                            'post_type' => 'tours',
                            'posts_per_page' => 4,
                            'post_status' => 'publish',
                        );

                        $tours_query = new WP_Query($args);
                        if ($tours_query->have_posts()):
                            while ($tours_query->have_posts()):
                                $tours_query->the_post();
                                echo '<div class="col-12 col-lg-6">';
                                get_template_part('partials/tour', 'card');
                                echo '</div>';
                            endwhile;
                            wp_reset_postdata();
                        else:
                            echo '<p>No tours found.</p>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>


<script>
    // Traveler selection functionality
    let adultCount = 1;
    let childCount = 0;
    const maxTravelers = 15;
    const tourPrice = <?php echo $tour_price; ?>;

    function openTravelerModal() {
        document.getElementById('traveler-modal').style.display = 'flex';
    }

    function closeTravelerModal() {
        document.getElementById('traveler-modal').style.display = 'none';
    }

    function updateCounter(type, change) {
        if (type === 'adult') {
            if (change === 1 && (adultCount + childCount) < maxTravelers) {
                adultCount++;
            } else if (change === -1 && adultCount > 1) {
                adultCount--;
            }
        } else if (type === 'child') {
            if (change === 1 && (adultCount + childCount) < maxTravelers) {
                childCount++;
            } else if (change === -1 && childCount > 0) {
                childCount--;
            }
        }

        document.getElementById('adult-count').textContent = adultCount;
        document.getElementById('child-count').textContent = childCount;

        // Update button states
        document.querySelectorAll('.counter-btn').forEach(btn => {
            const group = btn.getAttribute('data-group');
            const isMinus = btn.classList.contains('minus-btn');

            if (group === 'adult') {
                if (isMinus) {
                    btn.disabled = adultCount <= 1;
                    btn.style.opacity = adultCount <= 1 ? 0.5 : 1;
                } else {
                    btn.disabled = (adultCount + childCount) >= maxTravelers;
                    btn.style.opacity = (adultCount + childCount) >= maxTravelers ? 0.5 : 1;
                }
            } else if (group === 'child') {
                if (isMinus) {
                    btn.disabled = childCount <= 0;
                    btn.style.opacity = childCount <= 0 ? 0.5 : 1;
                } else {
                    btn.disabled = (adultCount + childCount) >= maxTravelers;
                    btn.style.opacity = (adultCount + childCount) >= maxTravelers ? 0.5 : 1;
                }
            }
        });
    }

    function applyTravelerSelection() {
        // Update summary text
        const summaryText =
            `${adultCount} Adult${adultCount !== 1 ? 's' : ''}${childCount > 0 ? `, ${childCount} Child${childCount !== 1 ? 'ren' : ''}` : ''}`;
        document.getElementById('traveler-summary').textContent = summaryText;

        // Update hidden inputs
        document.getElementById('adult_count_input').value = adultCount;
        document.getElementById('child_count_input').value = childCount;

        // Update summary counts
        document.getElementById('summary-adult-count').textContent = adultCount;
        document.getElementById('summary-child-count').textContent = childCount;

        // Update prices
        updateTotalPrice();

        // Close modal
        closeTravelerModal();
    }

    function updateTotalPrice() {
        const adultPrice = adultCount * tourPrice;
        const childPrice = childCount * (tourPrice * 0.7); // Assuming children are 70% of adult price
        const totalPrice = adultPrice + childPrice;

        document.getElementById('price-per-adult').textContent = '€' + adultPrice.toFixed(2);

        if (childCount > 0) {
            document.getElementById('child-price-item').style.display = 'flex';
            document.getElementById('price-per-child').textContent = '€' + childPrice.toFixed(2);
        } else {
            document.getElementById('child-price-item').style.display = 'none';
        }

        document.getElementById('total_price').innerHTML = '<strong>€' + totalPrice.toFixed(2) + '</strong>';
        document.getElementById('tour_price').value = totalPrice.toFixed(2);
    }

    // Close modal when clicking outside
    document.getElementById('traveler-modal').addEventListener('click', function (e) {
        if (e.target === this) closeTravelerModal();
    });

    // Initialize button states
    document.addEventListener('DOMContentLoaded', function () {
        updateCounter('adult', 0);
        updateCounter('child', 0);
        updateTotalPrice();
    });

    // Existing functions
    function openPopup() {
        document.querySelector('.pop_up_wrapper').classList.add('active');
    }

    function closePopup() {
        document.querySelector('.pop_up_wrapper').classList.remove('active');
    }
    // Close when clicking outside popup
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('pop_up_wrapper')) {
            closePopup();
        }
    });

    document.querySelectorAll('.wishlist_btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            // Close other open dropdowns (optional)
            document.querySelectorAll('.share_links').forEach(menu => {
                if (menu !== this.nextElementSibling) {
                    menu.classList.remove('active');
                }
            });

            // Toggle this dropdown
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('active');
        });
    });

    // Close when clicking outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.wishlist li')) {
            document.querySelectorAll('.share_links').forEach(menu => {
                menu.classList.remove('active');
            });
        }
    });
</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/sticky.js"></script>