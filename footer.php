<!-- Footer -->
<footer class="footer-wrapper style-two px-3 mx-3 mx-lg-4 mx-xxl-5 mb-3 mb-lg-4 mb-xxl-5 jarallax" data-jarallax
    data-speed="0.6" style="background-image: url('assets/img/bg-img/96.jpg');">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container-fluid">
        <div class="row g-5">
            <!-- Footer Card -->
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="footer-card pe-lg-5">
                    <a href="<?php bloginfo('url'); ?>" class="footer-logo mb-4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_white.png" width="190"
                            alt="">
                    </a>
                    <p class="mb-4 text-white"> connects you with exclusive chauffeur services, focusing on luxury,
                        comfort, and punctuality.
                        We partner with top-rated, English-speaking and local drivers to ensure seamless day trips,
                        transfers, and business travel—all with a premium fleet tailored to your needs.</p>


                    <div class="footer_rating">
                        <p>
                            <span>
                                <i class="ti ti-star"></i>
                                <i class="ti ti-star"></i>
                                <i class="ti ti-star"></i>
                                <i class="ti ti-star"></i>
                                <i class="ti ti-star"></i>
                            </span>
                            Rated 4.9/5 by 400+ happy travelers
                        </p>
                        <p>Secure booking guaranteed</p>
                    </div>

                    <!-- Subscribe Form -->
                    <div class="subscribe-form">
                        <input class="form-control" type="email" value="info@gotriptoday.com"
                            placeholder="Email Address">
                        <button type="submit" class="btn">
                            <i class="icon-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer Card -->
            <div class="col-12 col-sm-6 col-xl">
                <div class="footer-card">
                    <h5 class="mb-5 card-title text-white">Popular Routes</h5>

                    <?php wp_nav_menu(array('theme_location' => 'footer_routes', 'container' => false, 'menu_class' => 'footer-nav', )); ?>
                </div>
            </div>


            <!-- Footer Card -->
            <div class="col-12 col-sm-6 col-xl">
                <div class="footer-card">
                    <h5 class="mb-5 card-title text-white">We Offer</h5>
                    <?php wp_nav_menu(array('theme_location' => 'footer_offer', 'container' => false, 'menu_class' => 'footer-nav', )); ?>
                </div>
            </div>


            <!-- Footer Card -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="footer-card">

                    <h5 class="mb-5 card-title text-white">Legal Information</h5>
                    <div class="mb-3">
                        <?php wp_nav_menu(array('theme_location' => 'footer_legal', 'container' => false, 'menu_class' => 'footer-nav', )); ?>
                    </div>

                    <div class="d-flex flex-column gap-4">
                       

                        <!-- Contact Card -->
                        <div class="footer-contact-card">
                            <div class="icon">
                                <i class="ti ti-mail"></i>
                            </div>
                            <p class="mb-0 text-white">info@gotriptoday.com</p>
                        </div>

                        <!-- Contact Card -->
                        <div class="footer-contact-card">
                            <div class="icon">
                                <i class="ti ti-phone"></i>
                            </div>
                            <p class="mb-0 text-white">+49 0 170 1479446</p>
                        </div>
                    </div>
                    <!-- Social Nav -->
                    <div class="social-nav">
                        <a href="https://www.facebook.com/profile.php?id=61577812495327" target="_blank">
                            <i class="ti ti-brand-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/gotriptodaycom/" target="_blank">
                            <i class="ti ti-brand-instagram"></i>
                        </a>
                        <a href="https://www.tiktok.com/@gotriptoday" target="_blank">
                            <i class="ti ti-brand-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Copyright -->
    <div class="copyright-wrapper border-top">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Copyright -->
                <div class="col-12 col-md-6">
                    <p class="mb-3 mb-md-0 copyright">Copyright © <span id="year"></span> <a
                            href="https://gotriptoday.com/">Go Trip Today</a>
                        All rights reserved.</p>
                </div>

                <!-- Footer Bottom Nav -->
                <div class="col-12 col-md-6">
                    <div class="footer-bottom-nav">
                        <div class="icon">
                            <i class="ti ti-brand-visa"></i>
                        </div>
                        <div class="icon">
                            <i class="ti ti-brand-mastercard"></i>
                        </div>
                        <div class="icon">
                            <i class="ti ti-brand-paypal"></i>
                        </div>
                        <div class="icon">
                            <i class="ti ti-brand-amex"></i>
                        </div>
                        <div class="icon">
                            <i class="ti ti-brand-apple"></i>
                        </div>
                        <div class="icon">
                            <i class="ti ti-brand-visa"></i>
                        </div>
                        <div class="icon">
                            <i class="ti ti-brand-stripe"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Scroll To Top -->
<button id="scrollTopButton" class="touria-scrolltop theme-three scrolltop-hide">
    <i class="icon-arrow-up"></i>
</button>

<!-- All JavaScript Files-->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/slideToggle.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/swiper-bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jarallax.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/index.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/cookiealert.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/isotope.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/nice-select2.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/flatpickr.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/venobox.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/wow.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/active.js"></script>
<?php wp_footer(); ?>
</body>

</html>