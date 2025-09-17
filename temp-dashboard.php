<?php
/*Template Name: Dashboard */

get_header(); ?>

<?php $bg_image = get_template_directory_uri() . '/assets/images/car_ride.jpg';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]); ?>

<!-- Why Choose Section -->
<section class="why-choose-section style-two bg-secondary">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">
        <div class="row g-5">
            
        </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>
</section>



<?php get_footer(); ?>