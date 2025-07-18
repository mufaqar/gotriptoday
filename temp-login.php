<?php
/*Template Name: Login*/

get_header(); ?>

<?php $bg_image =  get_template_directory_uri() . '/assets/images/car_ride.jpg';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]); ?>




<?php get_footer(); ?>