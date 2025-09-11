<?php

function enqueue_tour_filter_scripts() {
    // Enqueue jQuery (already included in WordPress)
    wp_enqueue_script('jquery');

    // Enqueue custom script
    wp_enqueue_script('tour-filter', get_template_directory_uri() . '/assets/js/tour-filter.js', array('jquery'), '1.0', true);

    // Localize script to pass AJAX URL and nonce
    wp_localize_script('tour-filter', 'tourFilter', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('tour_filter_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_tour_filter_scripts');


function filter_tours_callback() {
    // Verify nonce
    check_ajax_referer('tour_filter_nonce', 'nonce');

    // Get selected term(s)
    $termIds = isset($_POST['termId']) 
        ? array_map('intval', (array) $_POST['termId']) 
        : [];

    // Build tax query
    $tax_query = [];

    if (!empty($termIds)) {
        $tax_query[] = [
            'taxonomy' => 'toour-properties',
            'field'    => 'id',   // since we're passing term_id
            'terms'    => $termIds,
        ];
    }

    // WP_Query arguments
    $args = [
        'post_type'      => 'tours',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    ];

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $tours_query = new WP_Query($args);

    // Start output buffering to capture HTML
    ob_start();

    if ($tours_query->have_posts()) {
        while ($tours_query->have_posts()) {
            $tours_query->the_post();
            echo '<div class="col-12 col-lg-3">';
            get_template_part('partials/tour', 'box');
            echo '</div>';
        }
        wp_reset_postdata();
    } else {
        echo '<p>No tours found.</p>';
    }

    $html = ob_get_clean();

    // Return JSON response
    wp_send_json_success(['html' => $html]);
}


add_action('wp_ajax_filter_tours', 'filter_tours_callback');
add_action('wp_ajax_nopriv_filter_tours', 'filter_tours_callback');