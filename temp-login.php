<?php
/*Template Name: Login */

get_header(); ?>

<?php $bg_image =  get_template_directory_uri() . '/assets/images/car_ride.jpg';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]); ?>


<div class="contact-form">
    <?php echo do_shortcode('[ultimatemember form_id="26381"]')?>
</div>



<?php get_footer(); ?>