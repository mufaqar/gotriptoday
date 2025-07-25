<?php
/*Template Name: Transfer*/

get_header(); ?>

<?php $bg_image =  get_template_directory_uri() . '/assets/images/car_ride.jpg';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]); ?>


<!-- Booking Section -->
<section class="booking-section">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 tour-details-content mtn">
                <ul class="list-unstyled style-two style-three mb-3">
                    <li><i class="ti ti-lock-check"></i>Secure Booking </li>
                    <li><i class="ti ti-rosette-discount-check"></i>Satisfaction Guarantee </li>
                    <li><i class="ti ti-heart-check"></i> Flexible Scheduling </li>
                    <li><i class="ti ti-help"></i>24/7 Customer Support </li>
                    <li><i class="ti ti-star"></i>5-Star Rated Service </li>
                    <li><i class="ti ti-plane-arrival"></i>Airport Pickup Guaranteed </li>
                </ul>
                <!-- Accommodation Card -->
                <div class="accommodation-card wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="accommodation-hidden-content">
                        <!-- Accommodation Info -->
                        <ul class="accommodation-info list-unstyled mb-0">
                            <li>
                                <i class="ti ti-users"></i>
                                <span>2 Guests</span>
                            </li>
                            <li>
                                <i class="ti ti-air-conditioning"></i>
                                <span>Air conditioner</span>
                            </li>
                            <li>
                                <i class="ti ti-bed"></i>
                                <span>1 Bed</span>
                            </li>
                            <li>
                                <i class="ti ti-router"></i>
                                <span>Unlimited Wi-Fi</span>
                            </li>
                            <li>
                                <i class="ti ti-bath"></i>
                                <span>Shower bathtub</span>
                            </li>
                            <li>
                                <i class="ti ti-square-off"></i>
                                <span>1869 sqft</span>
                            </li>
                            <li>
                                <i class="ti ti-ironing-steam"></i>
                                <span>Free laundry service</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-12 go_trip_bookingform">


                <?php echo do_shortcode('[chbs_booking_form booking_form_id="10007"]') ?>
            </div>
        </div>
        <!-- Divider -->
        <div class="divider"></div>
    </div>
</section>

<section>
    <!-- Divider -->
    <div class="divider-sm"></div>

    <div class="container">
        <div class="row g-4 g-xxl-5">
            <?php
            $args = array(
                'post_type' => 'chbs_vehicle',
                'posts_per_page' => -1, // Get all vehicles
                'post_status' => 'publish',
            );

            $vehicle_query = new WP_Query($args);

            if ($vehicle_query->have_posts()):
                while ($vehicle_query->have_posts()):
                    $vehicle_query->the_post();
                    ?>
            <?php get_template_part('partials/veh', 'card'); ?>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>No vehicles found.</p>';
            endif;
            ?>
        </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>
</section>

<?php get_footer(); ?>