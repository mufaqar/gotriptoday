<?php

    include_once('ajax_calls.php');
     include_once('driver.php');
    function handle_contact_form() {
        check_ajax_referer('ajax-contact-nonce', 'security');

        $name    = sanitize_text_field($_POST['name']);
        $email   = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);

        if(empty($name) || empty($email) || empty($message)){
            wp_send_json_error('Please fill all required fields.');
        }

        if(!is_email($email)){
            wp_send_json_error('Invalid email address.');
        }

        // Send Email
        $to = 'booking@gotriptoday.com,info@gotriptoday.com';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $body = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Subject:</strong> $subject<br><strong>Message:</strong><br>$message";

        if(wp_mail($to, 'Contact Form: '.$subject, $body, $headers)){
            wp_send_json_success('Thank you! Your message has been sent.');
        } else {
            wp_send_json_error('Email could not be sent. Please try again later..');
        }
    }
    add_action('wp_ajax_submit_contact_form', 'handle_contact_form');
    add_action('wp_ajax_nopriv_submit_contact_form', 'handle_contact_form');




function register_booking_cpt() {
    $labels = array(
        'name'                  => _x( 'Bookings', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Booking', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Bookings', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Booking', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Booking', 'textdomain' ),
        'new_item'              => __( 'New Booking', 'textdomain' ),
        'edit_item'             => __( 'Edit Booking', 'textdomain' ),
        'view_item'             => __( 'View Booking', 'textdomain' ),
        'all_items'             => __( 'All Bookings', 'textdomain' ),
        'search_items'          => __( 'Search Bookings', 'textdomain' ),
        'not_found'             => __( 'No bookings found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No bookings found in Trash.', 'textdomain' ),
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'booking' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-calendar-alt',
        'supports'              => array( 'title', 'editor', 'custom-fields' ),
        'show_in_rest'          => true, // Enables Gutenberg editor and REST API support
    );

    register_post_type( 'booking', $args );
}
add_action( 'init', 'register_booking_cpt' );


 function generateTimeSlots($start_time, $end_time, $interval_minutes)    {
        $times = [];
        $start = strtotime($start_time);
        $end = strtotime($end_time);
        $interval_seconds = $interval_minutes * 60;

        while ($start <= $end) {
            $times[] = date('h:i A', $start);
            $start += $interval_seconds;
        }

        return $times;
    }




function get_discounted_price($post_id, $formatted = true) {
    $price    = (float) get_post_meta($post_id, "pricing", true);   // Original price
    $discount = (float) get_post_meta($post_id, "discount", true);  // Discount percent

    if ($price <= 0) {
        return $formatted ? "N/A" : number_format(0, 2);
    }

    // Calculate discounted price if discount exists
    if ($discount > 0) {
        $discounted_price = $price - ($price * ($discount / 100));

        if ($formatted) {
            return sprintf(
                '<del class="sale_price">%s€</del> %s€',
                number_format($price, 2),
                number_format($discounted_price, 2)
            );
        }
        return number_format($discounted_price, 2);
    }
    // No discount case
    return $formatted ? number_format($price, 2) . "€" : number_format($price, 2);
}

/**
 * Remove WooCommerce My Account menu items
 */
add_filter( 'woocommerce_account_menu_items', 'mufaqar_remove_my_account_links', 999 );
function mufaqar_remove_my_account_links( $menu_links ) {    
    // Remove Dashboard
    unset( $menu_links['dashboard'] );
    unset( $menu_links['downloads'] );
    unset( $menu_links['edit-address'] );
    if ( isset( $menu_links['orders'] ) ) {
        $menu_links['orders'] = __( 'Day Trip Orders', 'textdomain' );
    }
    return $menu_links;
}

function mufaqar_enqueue_flatpickr() {
    // Flatpickr CSS
    wp_enqueue_style( 'flatpickr-css', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css' );

    // Flatpickr JS
    wp_enqueue_script( 'flatpickr-js', 'https://cdn.jsdelivr.net/npm/flatpickr', array('jquery'), null, true );

  
   // Your custom init script
    wp_add_inline_script( 'flatpickr-js', "
        jQuery(document).ready(function($) {
            flatpickr('#tour_datetime', {
                enableTime: true,
                dateFormat: 'Y-m-d h:i K',
                minDate: 'today',
                time_24hr: false,
                minuteIncrement: 30,
                minTime: '09:00',
                defaultDate: new Date().setHours(9,0,0,0) // today at 9:00 AM
            });
        });
    " );
}
add_action( 'wp_enqueue_scripts', 'mufaqar_enqueue_flatpickr' );



// Reusable social icons function
function gotriptoday_social_icons() {
    ?>
<div class="cloud-img"></div>
<div class="social-icons d-none d-sm-flex">
    <a href="https://www.facebook.com/profile.php?id=61577812495327" target="_blank" rel="noopener">
        <i class="ti ti-brand-facebook"></i>
    </a>
    <a href="https://www.tiktok.com/@gotriptoday" target="_blank" rel="noopener">
        <i class="ti ti-brand-tiktok"></i>
    </a>
    <a href="https://www.instagram.com/gotriptodaycom/" target="_blank" rel="noopener">
        <i class="ti ti-brand-instagram"></i>
    </a>
</div>
<?php
}


/**
 * Exclude selected order item meta from customer/admin emails.
 */
add_filter( 'woocommerce_order_item_display_meta_key', function( $display_key, $meta, $item ) {
    $hidden_keys = array(
        'Adults',
        'Children',
        'Base Price (per px)',
        'PX (vehicle multiplier)',
        'Final Price',
        'Invoice Required',
        'Invoice Street',
        'Invoice ZIP',
        'Invoice Country',
        'Passenger Email',
        'Passenger Phone',
        'Invoice City',
        'VAT ID'
    );

    if ( in_array( $display_key, $hidden_keys ) ) {
        return ''; // Hide it
    }

    return $display_key;
}, 10, 3 );
