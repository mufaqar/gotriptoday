<?php get_header(); ?>
<?php 

$bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/img/bg-img/97.jpg';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]);



 ?>

<!-- Hotel Details Section -->
<section class="hotel-details-section">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     
        <div class="hotel-details-header mb-5">
            <div class="row g-5 align-items-end">
                <div class="col-12 col-lg-4">
                    <h2 class="mb-3">Book your Business Class</h2>
                    <p class="mb-0 d-flex flex-wrap align-items-center gap-2">
                       
                        <span><i class="ti ti-car text-success"></i> <?php echo get_post_meta($post->ID, "car_equivalent", true); ?></span>
                    </p>
                </div>

                <div class="col-12 col-lg-8">


                    <div class="d-flex flex-wrap align-items-center justify-content-md-end gap-4">


                        <a href="#">
                            <div class="icon">
                                <i class="ti ti-car-4wd"></i>
                            </div>
                            <span><?php 

                  
                       

                        $term = wp_get_post_terms(get_the_ID(), 'vehicle-type', array('fields' => 'all'));

                            if (!empty($term) && !is_wp_error($term)) {
                                // Since it's single value, take the first one
                                $vehicle_type = $term[0];
                              
                                echo esc_html($vehicle_type->name) ;
                              
                            }
                                                    
                        
                        ?></span>
                        </a>

                  
                    </div>
                </div>
            </div>
        </div>

        <img class="rounded-4" src="<?php echo $bg_image ?>" alt="">

        <div class="divider-sm"></div>

        <div class="row g-5">
            <div class="col-12 col-lg-8">
                <!-- Tour Details Content -->
                <div class="tour-details-content">
                    <!-- Hotel Meta Info Card -->
                    <div class="hotel-meta-info-card">
                        <div class="row g-4">

                            <!-- Hotel Meta Info Card Item -->
                            <div class="col-12 col-sm-6 col-md-4 col-xl-4">
                                <div class="hotel-meta-info-card-item">
                                    <div class="icon">
                                        <i class="ti ti-users"></i>
                                    </div>
                                    <div>
                                        <h6>Passengers </h6>
                                        <p><?php echo get_post_meta($post->ID, "passengers", true); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Hotel Meta Info Card Item -->
                            <div class="col-12 col-sm-6 col-md-4 col-xl-4">
                                <div class="hotel-meta-info-card-item">
                                    <div class="icon">

                                        <i class="ti ti-luggage"></i>
                                    </div>
                                    <div>
                                        <h6>Luggage</h6>
                                        <p><?php echo get_post_meta($post->ID, "large_bag", true); ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Hotel Meta Info Card Item -->
                            <div class="col-12 col-sm-6 col-md-4 col-xl-4">
                                <div class="hotel-meta-info-card-item">
                                    <div class="icon">
                                        <i class="ti ti-car"></i>
                                    </div>
                                    <div>
                                        <h6><?php echo get_post_meta($post->ID, "car_equivalent", true); ?></h6>
                                        <p>similar or a higher class</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <h2>Overview</h2>
                    <?php the_content()?>





                    <h2>Features & Amenities</h2>
                    <ul class="list-unstyled style-two">
                        <li><i class="ti ti-rosette-discount-check"></i> Meet & Greet included</li>
                        <li><i class="ti ti-rosette-discount-check"></i>Free cancellation</li>
                        <li><i class="ti ti-rosette-discount-check"></i> Free Waiting time</li>
                        <li><i class="ti ti-rosette-discount-check"></i> Safe and secure travel</li>
                    </ul>


                </div>


            </div>

            <div class="col-12 col-lg-4">
                <div class="d-flex flex-column gap-5">
                    <!-- Widget -->
                    <div class="sidebar-widget">
                       
                       <?php echo do_shortcode('[jet_fb_form form_id="23745" submit_type="reload" required_mark="*" fields_layout="column" fields_label_tag="div" markup_type="div" enable_progress="" clear=""]')?>
                        <!-- Follow  -->
                        <div class="hotel-follow-nav mt-4">
                            <a href="#"><i class="ti ti-brand-facebook"></i></a>
                            <a href="#"><i class="ti ti-brand-x"></i></a>
                            <a href="#"><i class="ti ti-brand-instagram"></i></a>
                            <a href="#"><i class="ti ti-brand-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php endwhile; endif; ?>
    </div>

    <!-- Divider -->
    <div class="divider"></div>
</section>




<?php get_footer(); ?>