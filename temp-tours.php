<?php
/*Template Name: Tours*/

get_header(); 
?>
<div class="breadcrumb-section bg-img jarallax" data-jarallax data-speed="0.6"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/bg-img/slide1.webp');">
    <div class="container">
        <!-- Breadcrumb Content -->
        <div class="search_banner">
            <div class="divider"></div>
            <h2>Tour Details</h2>
            <div class="hero-search-form wow fadeInUp w-full mt-5" data-wow-delay="900ms" data-wow-duration="1000ms">
                <form class="row align-items-center g-3 g-xxl-2" action="#">
                    <div class="col-12 col-md-4 col-xxl">
                        <div class="search-item d-flex align-items-center gap-3">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.38467 18.4463C9.38467 18.4463 3.33301 13.3496 3.33301 8.33464C3.33301 6.56653 4.03539 4.87083 5.28563 3.62059C6.53587 2.37035 8.23156 1.66797 9.99967 1.66797C11.7678 1.66797 13.4635 2.37035 14.7137 3.62059C15.964 4.87083 16.6663 6.56653 16.6663 8.33464C16.6663 13.3496 10.6147 18.4463 10.6147 18.4463C10.278 18.7563 9.72384 18.753 9.38467 18.4463ZM9.99967 11.2513C10.3827 11.2513 10.762 11.1759 11.1158 11.0293C11.4697 10.8827 11.7912 10.6679 12.0621 10.397C12.3329 10.1262 12.5477 9.80466 12.6943 9.4508C12.8409 9.09693 12.9163 8.71766 12.9163 8.33464C12.9163 7.95161 12.8409 7.57234 12.6943 7.21848C12.5477 6.86461 12.3329 6.54308 12.0621 6.27224C11.7912 6.0014 11.4697 5.78656 11.1158 5.63999C10.762 5.49341 10.3827 5.41797 9.99967 5.41797C9.22613 5.41797 8.48426 5.72526 7.93728 6.27224C7.3903 6.81922 7.08301 7.56109 7.08301 8.33464C7.08301 9.10818 7.3903 9.85005 7.93728 10.397C8.48426 10.944 9.22613 11.2513 9.99967 11.2513Z"
                                        fill="#767676" />
                                </svg>
                            </div>
                            <div class="form-group">
                                <label for="location" class="form-label">Location</label>
                                <select name="location" id="location" class="touria-select">
                                    <option value="berlin">Berlin</option>
                                    <option value="hamburg">Hamburg</option>
                                    <option value="munich">Munich</option>
                                    <option value="frankfurt">Frankfurt</option>
                                    <option value="cologne">Cologne</option>
                                    <option value="stuttgart">Stuttgart</option>
                                    <option value="dusseldorf">Düsseldorf</option>
                                    <option value="leipzig">Leipzig</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xxl">
                        <div class="search-item d-flex align-items-center gap-3">
                            <div class="icon">
                                <i class="ti ti-calendar"></i>
                            </div>
                            <div class="form-group d-flex align-items-end">
                                <div>
                                    <label class="form-label d-block" for="departure-date">Departure Date</label>
                                    <input type="date" id="check-out" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-xxl-2">
                        <button type="submit" class="btn btn-success w-100">Search Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="divider"></div>
</div>

<!-- Tour List Section -->
<section class="tour-list-section">
    <!-- Divider -->
    <div class="divider"></div>
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="tour-list-sidebar">
                    <div class="sidebar-widget">
                        <h4 class="widget-title mb-4">Category</h4>
                        <?php
                        $terms = get_terms([
                            'taxonomy'   => 'tour-category',
                            'hide_empty' => false,
                        ]);
                        if (!empty($terms) && !is_wp_error($terms)) :
                        ?>
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


<script src="<?php echo get_template_directory_uri(); ?>/assets/js/isotope.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/flatpickr.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/nice-select2.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/nouislider.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/wow.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/active.js"></script>

<script>
jQuery(document).ready(function($) {
    // Handle category filter changes
    $('#category-filter').on('change', '.tour-filter-checkbox', function() {
        filterTours();
    });

    function filterTours() {
        // Show loading spinner
        $('#loading-spinner').show();

        // Get selected categories
        var selectedCategories = [];
        $('#category-filter input:checked').each(function() {
            selectedCategories.push($(this).val());
        });

        // AJAX request
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'filter_tours',
                categories: selectedCategories,
                // You can add other filter parameters here
            },
            success: function(response) {
                $('#tour-results').html(response);
                $('#loading-spinner').hide();
            },
            error: function() {
                $('#tour-results').html(
                    '<p>There was an error loading tours. Please try again.</p>');
                $('#loading-spinner').hide();
            }
        });
    }
});
</script>


<?php get_footer(); ?>