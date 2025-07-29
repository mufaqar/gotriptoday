<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <?php if (is_search()) { ?>
    <meta name="robots" content="noindex, nofollow" />
    <?php } ?>
    <title>
        <?php
				/*
				 * Print the <title> tag based on what is being viewed.
				 */
				global $page, $paged, $post;
			
				wp_title( '|', true, 'right' );
			
				// Add the blog name.
				bloginfo( 'name' );
			
				// Add the blog description for the home/front page.
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) )
					echo " | $site_description";
			
				// Add a page number if necessary:
				if ( $paged >= 2 || $page >= 2 )
					echo ' | ' . sprintf( __( 'Page %s', 'wpv' ), max( $paged, $page ) );
            ?>
    </title>
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/animate.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/tabler-icons.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/nice-select2.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/flatpickr.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/venobox.min.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/custom.css">
</head>

<body <?php body_class(); ?>>

    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="spinner-grow" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Right Side Offcanvas -->
    <div class="offcanvas offcanvas-end right-side-touria-offcanvas shadow-lg" tabindex="-1" id="sideMenuOffcanvas">
        <!-- Offcanvas Header -->
        <div class="offcanvas-header">
            <div>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" width="150" alt="">
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <!-- Offcanvas Body -->
        <div class="offcanvas-body">
            <div class="container-fluid">
                <div class="d-flex flex-column gap-5 mb-5">
                    <!-- Single Item -->
                    <div class="about-card-sm d-flex align-items-center gap-3">
                        <div class="icon text-success">
                            <i class="ti ti-map-pin"></i>
                        </div>
                        <div>
                            <h4>Choose Trip Type</h4>
                            <p class="mb-0">Select from Airport Transfer, City-to-City Ride, Day Trip, or Hourly Service
                            </p>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="about-card-sm d-flex align-items-center gap-3">
                        <div class="icon text-success">
                            <i class="ti ti-file-pencil"></i>
                        </div>
                        <div>
                            <h4>Enter Your Details</h4>
                            <p class="mb-0">Add pickup & drop-off locations, date, time, and any extra preferences</p>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="about-card-sm d-flex align-items-center gap-3">
                        <div class="icon text-success">
                            <i class="ti ti-message-2-dollar"></i>
                        </div>
                        <div>
                            <h4>Get Instant Price & Confirm</h4>
                            <p class="mb-0">See your price instantly. Review the service and confirm your booking with a
                                few clicks</p>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="about-card-sm d-flex align-items-center gap-3">
                        <div class="icon text-success">
                            <i class="ti ti-car"></i>
                        </div>
                        <div>
                            <h4>Ride in Comfort</h4>
                            <p class="mb-0">Your professional driver arrives on time. Enjoy Wi-Fi, bottled water, and a
                                smooth journey</p>
                        </div>
                    </div>

                    <a href="<?php echo home_url('/custom-booking'); ?>" class="btn btn-success">Book Now <i
                            class="icon-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Form Overlay -->
    <div class="search-bg-overlay" id="searchOverlay"></div>

    <!-- Search Form Popup -->
    <div class="search-form-popup">
        <h2 class="mb-5 display-6 fw-bold text-white">How can I help you, Today?</h2>
        <button type="button" class="close-btn" id="searchClose" aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
        <form class="search-form">
            <input type="search" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-success d-none"><i class="ti ti-search"></i></button>
        </form>
    </div>

    <!-- Header Area-->
    <header class="header-area style-three">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-xl">
                <!-- Navbar Brand -->
                <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" width="190"
                        alt="<?php bloginfo('name'); ?>">
                </a>

                <!-- Navbar Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#touriaNav"
                    aria-controls="touriaNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-menu-deep"></i>
                </button>

                <!-- Navbar Nav -->
                <div class="collapse justify-content-xl-end navbar-collapse" id="touriaNav">
                    <!-- <ul class="navbar-nav align-items-xl-center navbar-nav-scroll">
                        <li class="touria-dd">
                            <a href="#">Home <i class="ti ti-chevron-down"></i></a>
                            <ul class="touria-dd-menu">
                                <li>
                                    <a href="index.html">Tour Booking</a>
                                </li>
                                <li>
                                    <a href="index-2.html">Air Booking</a>
                                </li>
                                <li>
                                    <a href="index-3.html">Hotel Booking</a>
                                </li>
                            </ul>
                        </li>
                        <li class="touria-dd">
                            <a href="#">Tours <i class="ti ti-chevron-down"></i></a>
                            <ul class="touria-dd-menu">
                                <li>
                                    <a href="tour-list.html">Tour List</a>
                                </li>
                                <li>
                                    <a href="tour-details.html">Tour Details</a>
                                </li>
                            </ul>
                        </li>
                        <li class="touria-dd">
                            <a href="#">Destinations <i class="ti ti-chevron-down"></i></a>
                            <ul class="touria-dd-menu">
                                <li>
                                    <a href="destination.html">Destination</a>
                                </li>
                                <li>
                                    <a href="destination-details.html">Destination Details</a>
                                </li>
                            </ul>
                        </li>
                        <li class="touria-dd">
                            <a href="#">Pages <i class="ti ti-chevron-down"></i></a>
                            <ul class="touria-dd-menu">
                                <li class="touria-dd">
                                    <a href="about-us.html">About Us</a>
                                </li>
                                <li class="touria-dd">
                                    <a href="#">Destinations <i class="ti ti-chevron-right"></i></a>
                                    <ul class="touria-dd-menu">
                                        <li>
                                            <a href="destination.html">Destination</a>
                                        </li>
                                        <li>
                                            <a href="destination-details.html">Destination Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="touria-dd">
                                    <a href="#">Tours <i class="ti ti-chevron-right"></i></a>
                                    <ul class="touria-dd-menu">
                                        <li>
                                            <a href="tour-list.html">Tour List</a>
                                        </li>
                                        <li>
                                            <a href="tour-details.html">Tour Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="touria-dd">
                                    <a href="#">Hotels <i class="ti ti-chevron-right"></i></a>
                                    <ul class="touria-dd-menu">
                                        <li>
                                            <a href="hotel-list.html">Hotel List</a>
                                        </li>
                                        <li>
                                            <a href="hotel-details.html">Hotel Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="touria-dd">
                                    <a href="#">Guider <i class="ti ti-chevron-right"></i></a>
                                    <ul class="touria-dd-menu">
                                        <li>
                                            <a href="guider.html">Guider</a>
                                        </li>
                                        <li>
                                            <a href="guider-details.html">Guider Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="faqs.html">FAQs</a>
                                </li>
                                <li>
                                    <a href="gallery.html">Gallery</a>
                                </li>
                                <li>
                                    <a href="404.html">404</a>
                                </li>
                            </ul>
                        </li>
                        <li class="touria-dd">
                            <a href="#">Blog <i class="ti ti-chevron-down"></i></a>
                            <ul class="touria-dd-menu">
                                <li>
                                    <a href="blog-list.html">Blog List</a>
                                </li>
                                <li>
                                    <a href="blog-grid.html">Blog Grid</a>
                                </li>
                                <li>
                                    <a href="blog-details.html">Blog Details</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="contact.html">Contact</a>
                        </li>
                    </ul> -->


                    <?php wp_nav_menu([
						'theme_location' => 'main',
						'container' => false,
						'menu_class' => 'navbar-nav align-items-xl-center navbar-nav-scroll',
						'walker' => new Touria_Walker_Nav_Menu()
					]); ?>
                    <!-- Header Navigation -->
                    <div class="header-navigation d-flex flex-wrap align-items-center gap-3 mt-4 mt-xl-0">
                        <!-- Search Button -->
                        <div class="header-search-btn">
                            <a href="" class="btn">
                                <i class="ti ti-user-check"></i>
                            </a>
                        </div>

                        <!-- Get A Quote -->
                        <a class="btn btn-success" href="<?php echo home_url('/custom-booking'); ?>">Get A Quote<i
                                class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>