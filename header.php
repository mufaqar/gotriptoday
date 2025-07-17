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
                            <p class="mb-0">Select from Airport Transfer, City-to-City Ride, Day Trip, or Hourly Service</p>
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
                            <p class="mb-0">See your price instantly. Review the service and confirm your booking with a few clicks</p>
                        </div>
                    </div>

                    <!-- Single Item -->
                    <div class="about-card-sm d-flex align-items-center gap-3">
                        <div class="icon text-success">
                            <i class="ti ti-car"></i>
                        </div>
                        <div>
                            <h4>Ride in Comfort</h4>
                            <p class="mb-0">Your professional driver arrives on time. Enjoy Wi-Fi, bottled water, and a smooth journey</p>
                        </div>
                    </div>

                    <a href="<?php echo home_url('/custom-booking'); ?>" class="btn btn-success">Book Now <i class="icon-arrow-right"></i></a>
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
                        <div class="header-search-btn" id="searchButton">
                            <button class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none">
                                    <rect width="20" height="20" fill="#F7F7F7" />
                                    <path
                                        d="M14.0772 14.0987L16.6438 16.6654M15.833 9.58203C15.833 11.2396 15.1745 12.8293 14.0024 14.0014C12.8303 15.1736 11.2406 15.832 9.58301 15.832C7.9254 15.832 6.33569 15.1736 5.16359 14.0014C3.99149 12.8293 3.33301 11.2396 3.33301 9.58203C3.33301 7.92443 3.99149 6.33472 5.16359 5.16261C6.33569 3.99051 7.9254 3.33203 9.58301 3.33203C11.2406 3.33203 12.8303 3.99051 14.0024 5.16261C15.1745 6.33472 15.833 7.92443 15.833 9.58203Z"
                                        stroke="#161920" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>

                        <!-- Offcanvas Icon -->
                        <div class="offcanvas-icon" data-bs-toggle="offcanvas" data-bs-target="#sideMenuOffcanvas"
                            aria-controls="sideMenuOffcanvas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="18" viewBox="0 0 26 18"
                                fill="none">
                                <path
                                    d="M19.5 1.28571C19.5 0.575658 18.9179 0 18.2 0H1.3C0.582056 0 0 0.575658 0 1.28571C0 1.99577 0.582056 2.57143 1.3 2.57143H18.2C18.9179 2.57143 19.5 1.99572 19.5 1.28571ZM1.3 7.71428H24.7C25.4179 7.71428 26 8.28999 26 9C26 9.71006 25.4179 10.2857 24.7 10.2857H1.3C0.582056 10.2857 0 9.71006 0 9C0 8.28999 0.582056 7.71428 1.3 7.71428ZM1.3 15.4286H13C13.7179 15.4286 14.3 16.0042 14.3 16.7143C14.3 17.4243 13.7179 18 13 18H1.3C0.582056 18 0 17.4243 0 16.7143C0 16.0042 0.582056 15.4286 1.3 15.4286Z"
                                    fill="#161920" />
                            </svg>
                        </div>

                        <!-- Get A Quote -->
                        <a class="btn btn-success" href="<?php echo home_url('/contact'); ?>">Get a Quote <i
                                class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    