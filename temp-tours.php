<?php
/*Template Name: Tours*/

get_header(); 


?>


<!-- Breadcrumb Section -->
<div class="breadcrumb-section bg-img jarallax" data-jarallax data-speed="0.6"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/bg-img/slide1.webp');">
    <div class="container">
        <!-- Breadcrumb Content -->
        <div class="search_banner">
            <div class="divider"></div>
            <h2>Tour Details</h2>
            <div class="hero-search-form wow fadeInUp w-full" data-wow-delay="900ms" data-wow-duration="1000ms">
                <form class="row align-items-center g-3 g-xxl-2" action="#">
                    <div class="col-12 col-md-6 col-xxl">
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

                    <div class="col-12 col-md-6 col-xxl">
                        <div class="search-item d-flex align-items-center gap-3">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="none">
                                    <path
                                        d="M4.5384 0C4.68692 0 4.82936 0.0589998 4.93438 0.16402C5.0394 0.269041 5.0984 0.411479 5.0984 0.56V1.6072H11.112V0.5672C11.112 0.418679 11.171 0.276241 11.276 0.17122C11.381 0.0661998 11.5235 0.0072 11.672 0.0072C11.8205 0.0072 11.963 0.0661998 12.068 0.17122C12.173 0.276241 12.232 0.418679 12.232 0.5672V1.6072H14.4C14.8242 1.6072 15.2311 1.77566 15.5311 2.07555C15.8311 2.37543 15.9998 2.78219 16 3.2064V14.4008C15.9998 14.825 15.8311 15.2318 15.5311 15.5317C15.2311 15.8315 14.8242 16 14.4 16H1.6C1.17579 16 0.768947 15.8315 0.468912 15.5317C0.168877 15.2318 0.000212104 14.825 0 14.4008L0 3.2064C0.000212104 2.78219 0.168877 2.37543 0.468912 2.07555C0.768947 1.77566 1.17579 1.6072 1.6 1.6072H3.9784V0.5592C3.97861 0.410817 4.03771 0.268585 4.1427 0.163737C4.2477 0.0588899 4.39002 -1.51411e-07 4.5384 0ZM1.12 6.1936V14.4008C1.12 14.4638 1.13242 14.5263 1.15654 14.5845C1.18066 14.6427 1.21602 14.6956 1.26059 14.7402C1.30516 14.7848 1.35808 14.8201 1.41631 14.8443C1.47455 14.8684 1.53697 14.8808 1.6 14.8808H14.4C14.463 14.8808 14.5255 14.8684 14.5837 14.8443C14.6419 14.8201 14.6948 14.7848 14.7394 14.7402C14.784 14.6956 14.8193 14.6427 14.8435 14.5845C14.8676 14.5263 14.88 14.4638 14.88 14.4008V6.2048L1.12 6.1936ZM5.3336 11.6952V13.028H4V11.6952H5.3336ZM8.6664 11.6952V13.028H7.3336V11.6952H8.6664ZM12 11.6952V13.028H10.6664V11.6952H12ZM5.3336 8.5136V9.8464H4V8.5136H5.3336ZM8.6664 8.5136V9.8464H7.3336V8.5136H8.6664ZM12 8.5136V9.8464H10.6664V8.5136H12ZM3.9784 2.7264H1.6C1.53697 2.7264 1.47455 2.73882 1.41631 2.76294C1.35808 2.78706 1.30516 2.82242 1.26059 2.86699C1.21602 2.91156 1.18066 2.96448 1.15654 3.02271C1.13242 3.08095 1.12 3.14337 1.12 3.2064V5.0744L14.88 5.0856V3.2064C14.88 3.14337 14.8676 3.08095 14.8435 3.02271C14.8193 2.96448 14.784 2.91156 14.7394 2.86699C14.6948 2.82242 14.6419 2.78706 14.5837 2.76294C14.5255 2.73882 14.463 2.7264 14.4 2.7264H12.232V3.4696C12.232 3.61812 12.173 3.76056 12.068 3.86558C11.963 3.9706 11.8205 4.0296 11.672 4.0296C11.5235 4.0296 11.381 3.9706 11.276 3.86558C11.171 3.76056 11.112 3.61812 11.112 3.4696V2.7264H5.0984V3.4624C5.0984 3.61092 5.0394 3.75336 4.93438 3.85838C4.82936 3.9634 4.68692 4.0224 4.5384 4.0224C4.38988 4.0224 4.24744 3.9634 4.14242 3.85838C4.0374 3.75336 3.9784 3.61092 3.9784 3.4624V2.7264Z"
                                        fill="#767676" />
                                </svg>
                            </div>
                            <div class="form-group d-flex align-items-end">
                                <div>
                                    <label class="form-label d-block" for="time-range-picker">Time Period</label>
                                    <input type="text" id="time-range-picker" class="time-range-picker"
                                        placeholder="Select date range" readonly>
                                </div>
                                <i class="ti ti-chevron-down me-5"></i>
                            </div>
                        </div>
                    </div>



                    <div class="col-12 col-md-6 col-xxl-2">
                        <button type="submit" class="btn btn-success w-100">Search Now</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Divider -->
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




<?php get_footer(); ?>