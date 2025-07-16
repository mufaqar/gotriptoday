<?php
/*Template Name: Fleet*/

get_header(); ?>


<?php get_template_part('partials/content', 'breadcrumb'); ?>

<section>
    <!-- Divider -->
    <div class="divider"></div>
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
                    <div class="col-12 col-sm-6 col-lg-4">
                        <!-- Blog Card -->
                        <div class="blog-card style-two wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">
                            <div class="post-img">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tour.jpg"
                                    alt="Featured Thumbnail" class="tour_feature" />
                            </div>
                            <!-- Post Body -->
                            <div class="post-body">
                                <div class="blog-meta d-flex flex-wrap align-items-center gap-2">
                                    <a href="#">By Admin</a>
                                    <div class="dot"></div>
                                    <a href="#">26 June 2025</a>
                                </div>
                                <a class="post-title h4" href="blog-details.html">The Ultimate Guide to Traveling</a>
                                <div class="d-block mt-3">
                                    <a class="btn btn-link" href="blog-details.html">View Details <i
                                            class="icon-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
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