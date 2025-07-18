<?php
/*Template Name: Custom Booking*/

get_header(); ?>

<?php $bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/images/custom-booking.webp';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]); ?>

<section class="">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">
        <div class="row g-5">
            <!-- Form -->
            <div class="col-12 col-lg-6">
                <div class="go_trip_Customform wow fadeInUp" data-wow-delay="900ms" data-wow-duration="1000ms">
                    <?php echo do_shortcode('[jet_fb_form form_id="23868" submit_type="ajax" required_mark="*" fields_layout="column" fields_label_tag="div" markup_type="div" enable_progress="1" clear=""]') ?>
                </div>
            </div>

            <!-- Content -->
            <div class="col-12 col-lg-6">
                <div class="about-content ps-md-5">
                    <div class="section-heading">
                        <span class="sub-title text-success"></span>
                        <h2 class="mb-4">Your Custom Ride</h2>
                        <p>
                            If no suitable ride is available for your needs, you can easily make a manual booking here.
                            We offer you the flexibility to customize your ride. Simply enter the details, and we’ll
                            take care of ensuring you reach your destination safely and comfortably.
                        </p>
                    </div>

                    <div class="d-flex flex-column gap-4 mb-5">
                        <!-- Single Item -->
                        <div class="about-card-sm d-flex align-items-center gap-3">
                            <div class="icon">
                                <i class="ti ti-shopping-cart-cog"></i>

                            </div>
                            <div>
                                <h4>Custom Booking</h4>
                                <p class="mb-0">Didn’t find a suitable ride? Book your ride according to your personal
                                    requirements.</p>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="about-card-sm d-flex align-items-center gap-3">
                            <div class="icon">
                                <i class="ti ti-table-options"></i>
                            </div>
                            <div>
                                <h4>Flexible Customization </h4>
                                <p class="mb-0">Have special requests? Let us know your needs, and we’ll tailor the ride
                                    accordingly.</p>
                            </div>
                        </div>
                        <!-- Single Item -->
                        <div class="about-card-sm d-flex align-items-center gap-3">
                            <div class="icon">
                                <i class="ti ti-clock-bolt"></i>
                            </div>
                            <div>
                                <h4>Fast Confirmation</h4>
                                <p class="mb-0">After your manual booking, we’ll quickly confirm the details and ensure
                                    a punctual pickup.</p>
                            </div>
                        </div>

                        <!-- Single Item -->
                        <div class="about-card-sm d-flex align-items-center gap-3">
                            <div class="icon">
                                <i class="ti ti-shield-half"></i>
                            </div>
                            <div>
                                <h4>Comfort & Safety</h4>
                                <p class="mb-0">Even with manual bookings, we guarantee the highest level of comfort and
                                    a safe ride with an experienced chauffeur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>
</section>

<?php get_footer(); ?>