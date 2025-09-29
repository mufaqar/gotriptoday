<?php
/*Template Name: Transfer*/

get_header(); ?>


<section class="hero-section bg-dark">
     <?php gotriptoday_social_icons(); ?>
    <!-- Background Slider -->
    <div class="background-swiper1">
        <div class="h-100">
            <div class="h-100 tour_slide"
                style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/bg-img/slide1.webp')">
            </div>            
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="search_banner tour_banner mt-5">
                <ul class="nav forms-tabs mb-3 mx-auto" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="tab-link active" href="<?php echo home_url('/booking-page'); ?>" type="button">Transfer</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="tab-link " href="<?php echo home_url('/day-trip'); ?>" type="button">Day
                            Trip</a>
                    </li>
                </ul>
                <h2><?php the_title()?></h2>
                
            </div>


        </div>
    </div>
</section>



<!-- Booking Section -->
<section class="booking-section">
    <!-- Divider -->
    <div class="divider-sm"></div>

    <div class="container">
        <div class="row">
           
            <div class="col-12 col-lg-12 go_trip_bookingform ">
                <?php echo do_shortcode('[chbs_booking_form booking_form_id="10007"]') ?>
            </div>
        </div>
        <!-- Divider -->
        <div class="divider"></div>
         <div class="col-12 col-md-12 tour-details-content mtn">
                <ul class="list-unstyled mb-3">
                    <li><i class="ti ti-lock-check"></i>Secure Booking </li>
                    <li><i class="ti ti-rosette-discount-check"></i>Satisfaction Guarantee </li>
                    <li><i class="ti ti-heart-check"></i> Flexible Scheduling </li>
                    <li><i class="ti ti-help"></i>24/7 Customer Support </li>
                    <li><i class="ti ti-star"></i>5-Star Rated Service </li>
                    <li><i class="ti ti-plane-arrival"></i>Airport Pickup Guaranteed </li>
                </ul>          

            </div>
    </div>
</section>
<section>
    <!-- Divider -->
    <div class="divider-sm"></div>
    <div class="container">
        <div class="row g-4 g-xxl-5">
            <?php
            $args = array(
                'post_type' => 'cars',
                'posts_per_page' => -1, 
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