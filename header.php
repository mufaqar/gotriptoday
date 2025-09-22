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
				global $page, $paged, $post;			
				wp_title( '|', true, 'right' );
				bloginfo( 'name' );
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) )
					echo " | $site_description";
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


    <!-- <div class="preloader" id="preloader">
        <div class="spinner-grow" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->

    <header class="header-area style-three">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-xl">
                <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" width="190"
                        alt="<?php bloginfo('name'); ?>">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#touriaNav"
                    aria-controls="touriaNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-menu-deep"></i>
                </button>
                <!-- Navbar Nav -->
                <div class="collapse justify-content-xl-end navbar-collapse" id="touriaNav">
                    <?php wp_nav_menu([
						'theme_location' => 'main',
						'container' => false,
						'menu_class' => 'navbar-nav align-items-xl-center navbar-nav-scroll',
						'walker' => new Touria_Walker_Nav_Menu()
					]); ?>
                    <div class="header-navigation d-flex flex-wrap align-items-center gap-3 mt-4 mt-xl-0">
                        <div class="header-search-btn">
                            <a href="<?php echo is_user_logged_in() ? site_url('/my-account/orders/') : site_url('/login')  ?>" class="btn">
                                    <i class="ti ti-user-check"></i>
                            </a>
                        </div>
                        <a class="btn btn-success" href="<?php echo home_url('/custom-booking'); ?>">Get A Quote<i
                                class="icon-arrow-right"></i></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>