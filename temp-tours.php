<?php
/*Template Name: Tours*/

get_header(); 


?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/nouislider.min.css">

<?php $bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/img/bg-img/slide1.webp';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]); ?>

<!-- Tour List Section -->
<section class="tour-list-section">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">

        <div class="row g-4">
            <div class="col-12 col-md-4">

                <div class="tour-list-sidebar">
                    <!-- Widget -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title mb-5">Price</h4>
                        <!-- Range Slider -->
                        <div id="range-slider-price"></div>
                    </div>

                    <div class="sidebar-widget">
                        <h4 class="widget-title mb-4">Category</h4>

                        <?php
                        $terms = get_terms([
                            'taxonomy'   => 'tour-category',
                            'hide_empty' => false, // Set true to hide empty categories
                        ]);

                        if (!empty($terms) && !is_wp_error($terms)) :
                        ?>
                        <!-- Sidebar Checkbox List -->
                        <ul class="sidebar-checkbox-list list-unstyled">
                            <?php foreach ($terms as $term) : ?>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input tour-filter-checkbox" type="checkbox"
                                        id="term-<?php echo esc_attr($term->term_id); ?>"
                                        value="<?php echo esc_attr($term->slug); ?>">
                                    <label class="form-check-label flex-grow-1 ms-2"
                                        for="term-<?php echo esc_attr($term->term_id); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </label>
                                    <span class="text-muted"><?php echo esc_html($term->count); ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                    </div>

                    <div class="sidebar-widget">
                        <h4 class="widget-title mb-4">Tour Duration</h4>

                        <?php
                        $terms = get_terms([
                            'taxonomy'   => 'tour-duration',
                            'hide_empty' => false, // Set true to hide empty categories
                        ]);

                        if (!empty($terms) && !is_wp_error($terms)) :
                        ?>
                        <!-- Sidebar Checkbox List -->
                        <ul class="sidebar-checkbox-list list-unstyled">
                            <?php foreach ($terms as $term) : ?>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input tour-filter-checkbox" type="checkbox"
                                        id="term-<?php echo esc_attr($term->term_id); ?>"
                                        value="<?php echo esc_attr($term->slug); ?>">
                                    <label class="form-check-label flex-grow-1 ms-2"
                                        for="term-<?php echo esc_attr($term->term_id); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </label>
                                    <span class="text-muted"><?php echo esc_html($term->count); ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                    </div>

                    <div class="sidebar-widget">
                        <h4 class="widget-title mb-4">Properties</h4>

                        <?php
                        $terms = get_terms([
                            'taxonomy'   => 'toour-properties',
                            'hide_empty' => false, // Set true to hide empty categories
                        ]);

                        if (!empty($terms) && !is_wp_error($terms)) :
                        ?>
                        <!-- Sidebar Checkbox List -->
                        <ul class="sidebar-checkbox-list list-unstyled">
                            <?php foreach ($terms as $term) : ?>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input tour-filter-checkbox" type="checkbox"
                                        id="term-<?php echo esc_attr($term->term_id); ?>"
                                        value="<?php echo esc_attr($term->slug); ?>">
                                    <label class="form-check-label flex-grow-1 ms-2"
                                        for="term-<?php echo esc_attr($term->term_id); ?>">
                                        <?php echo esc_html($term->name); ?>
                                    </label>
                                    <span class="text-muted"><?php echo esc_html($term->count); ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

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