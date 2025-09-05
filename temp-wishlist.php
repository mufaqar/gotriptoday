<?php
/*Template Name: WishList*/

get_header(); ?>

<?php $bg_image =  get_template_directory_uri() . '/assets/images/car_ride.jpg';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]);


?>

<div class="wishlist-container">
    <h1>Your Wishlist</h1>
    
    <div id="wishlist-items">
        <!-- Wishlist items will be dynamically populated here -->
    </div>
</div>

<?php get_footer(); ?>

