<?php
/*Template Name: Tours*/
get_header();
?>
<section class="hero-section bg-dark">
    <!-- Cloud Image -->
    <div class="cloud-img"></div>

    <!-- Social Icons -->
    <div class="social-icons d-none d-sm-flex">
        <a href="https://www.facebook.com/profile.php?id=61577812495327" target="_blank"><i
                class="ti ti-brand-facebook"></i></a>
        <a href="https://www.tiktok.com/@gotriptoday" target="_blank"><i class="ti ti-brand-tiktok"></i></a>
        <a href="https://www.instagram.com/gotriptodaycom/" target="_blank"><i class="ti ti-brand-instagram"></i></a>
    </div>

    <!-- Background Slider -->
    <div class="swiper background-swiper">
        <div class="swiper-wrapper h-100">
            <div class="swiper-slide h-100"
                style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/bg-img/slide1.webp')">
            </div>
            <div class="swiper-slide h-100"
                style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/bg-img/1.jpg')">
            </div>
        </div>
    </div>

    <!-- Background Slider Navigation -->
    <div class="background-slider-nav d-none d-sm-flex">
        <div class="background-button-prev">
            <i class="icon-arrow-left"></i>
        </div>
        <div class="background-button-next">
            <i class="icon-arrow-right"></i>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="search_banner tour_banner mt-5">
                <h2>Explore around, wherever you are, in one day.</h2>
                <div class="hero-search-form wow fadeInUp w-full mt-3" data-wow-delay="900ms"
                    data-wow-duration="1000ms">
                    <form class="row align-items-center g-3 g-xxl-2 search-form" role="search" method="get" class=""
                        action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="col-12 col-md-8">
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
                                    <input type="text" id="name" class="form-control" placeholder="Explore from"
                                        value="<?php echo get_search_query(); ?>" name="s">
                                    <input type="hidden" name="post_type" value="tours" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button type="submit" class="btn btn-success w-100">Search Now</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</section>







<!-- Tour List Section -->
<section class="tour-list-section">
    <div class="divider-sm"></div>
    <!-- Divider -->
    <div class="container">

        <div class="row">
            <div class="col-12 col-md-12">
                <div class="tour-list-content">
                    <div id="tour-results" class="row g-4">
                        <?php
                        $args = array(
                            'post_type' => 'tours',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                        );

                        $tours_query = new WP_Query($args);
                        if ($tours_query->have_posts()):
                            while ($tours_query->have_posts()):
                                $tours_query->the_post();
                                $tour_comments = get_tour_comments(get_the_ID());
                                $review_count = count($tour_comments);
                                echo '<div class="col-12 col-lg-3">';
                                get_template_part('partials/tour', 'box',array('review_count' => $review_count  )  );
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
<div class="divider"></div>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/isotope.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/flatpickr.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/nice-select2.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/nouislider.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/wow.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/active.js"></script>
<?php get_footer(); ?>