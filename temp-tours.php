<?php
/*Template Name: Tours*/

get_header(); 


?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/nouislider.min.css">

<?php get_template_part('partials/content', 'breadcrumb'); ?>

<!-- Tour List Section -->
<section class="tour-list-section">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">

        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="tour-list-sidebar">
                    <div class="sidebar-widget">
                        <h4 class="widget-title mb-4">Activities</h4>

                        <!-- Sidebar Checkbox List -->
                        <ul class="sidebar-checkbox-list list-unstyled">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="canada2">
                                    <label class="form-check-label flex-grow-1 ms-2" for="canada2">Canada</label>
                                    <span class="text-muted">04</span>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="france2">
                                    <label class="form-check-label flex-grow-1 ms-2" for="france2">France</label>
                                    <span class="text-muted">05</span>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="europe2">
                                    <label class="form-check-label flex-grow-1 ms-2" for="europe2">Europe</label>
                                    <span class="text-muted">03</span>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="indonesia2">
                                    <label class="form-check-label flex-grow-1 ms-2" for="indonesia2">Indonesia</label>
                                    <span class="text-muted">04</span>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="nepal2">
                                    <label class="form-check-label flex-grow-1 ms-2" for="nepal2">Nepal</label>
                                    <span class="text-muted">04</span>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="maldives2">
                                    <label class="form-check-label flex-grow-1 ms-2" for="maldives2">Maldives</label>
                                    <span class="text-muted">04</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title mb-5">Price</h4>
                        <!-- Range Slider -->
                        <div id="range-slider-price"></div>
                    </div>
                </div>
            </div>



            <div class="col-12 col-md-8">
                <div class="tour-list-content">
                    <div class="row g-4">
                        <?php
                            $args = array(
                                'post_type' => 'tours',
                                'posts_per_page' =>-1,
                                'post_status' => 'publish',
                            );

                            $tours_query = new WP_Query($args);
                            if ($tours_query->have_posts()):
                                while ($tours_query->have_posts()):
                                    $tours_query->the_post();
                                    get_template_part('partials/tour', 'card'); 
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



 <script src="<?php echo get_template_directory_uri(); ?>/assets/js/nouislider.min.js"></script>
   <script src="<?php echo get_template_directory_uri(); ?>/assets/js/wow.min.js"></script>
   <script src="<?php echo get_template_directory_uri(); ?>/assets/js/active.js"></script>

<?php get_footer(); ?>


 