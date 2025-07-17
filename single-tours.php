<?php get_header(); ?>
<?php 

$bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/img/bg-img/97.jpg';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]);


 ?>
Test
<?php get_footer(); ?>