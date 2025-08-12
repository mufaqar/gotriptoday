<?php

// AJAX handler for tour filtering
add_action('wp_ajax_filter_tours', 'filter_tours_callback');
add_action('wp_ajax_nopriv_filter_tours', 'filter_tours_callback');

function filter_tours_callback() {
    // Verify nonce for security (recommended)
    // if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'filter_tours_nonce')) {
    //     die('Permission denied');
    // }
    
    $args = array(
        'post_type' => 'tours',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    );
    
    // Add taxonomy query if categories are selected
    if (!empty($_POST['categories'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'tour-category',
                'field'    => 'slug',
                'terms'    => $_POST['categories'],
                'operator' => 'IN',
            )
        );
    }
    
    $tours_query = new WP_Query($args);
    
    if ($tours_query->have_posts()):
        while ($tours_query->have_posts()):
            $tours_query->the_post();
            echo '<div class="col-12 col-lg-6">';
            get_template_part('partials/tour', 'card');
            echo '</div>';
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>No tours found matching your criteria.</p>';
    endif;
    
    wp_die(); // Required to terminate immediately and return a proper response
}