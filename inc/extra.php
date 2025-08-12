
<?php

// Enqueue scripts and localize AJAX URL
add_action('wp_enqueue_scripts', 'tours_ajax_scripts');
function tours_ajax_scripts() {
    wp_enqueue_script('tours-ajax', get_template_directory_uri() . '/js/tours-ajax.js', array('jquery'), null, true);
    
    // Localize the script with AJAX URL and nonce
    wp_localize_script(
        'tours-ajax',
        'tours_ajax_obj',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('filter_tours_nonce'),
        )
    );
}

    include_once('ajax_calls.php');
    include_once('stripe-payments.php');

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
        $to = 'mufaqar@gmail.com';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $body = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Subject:</strong> $subject<br><strong>Message:</strong><br>$message";

        if(wp_mail($to, 'Contact Form: '.$subject, $body, $headers)){
            wp_send_json_success('Thank you! Your message has been sent.');
        } else {
            wp_send_json_error('Email could not be sent. Please try again later.');
        }
    }
    add_action('wp_ajax_submit_contact_form', 'handle_contact_form');
    add_action('wp_ajax_nopriv_submit_contact_form', 'handle_contact_form');



// Add Stripe settings page
add_action('admin_menu', 'add_stripe_settings_page');
function add_stripe_settings_page() {
    add_options_page(
        'Stripe Settings',
        'Stripe',
        'manage_options',
        'stripe-settings',
        'stripe_settings_page'
    );
}

function stripe_settings_page() {
    ?>
    <div class="wrap">
        <h1>Stripe Payment Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('stripe-settings-group'); ?>
            <?php do_settings_sections('stripe-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Stripe Publishable Key</th>
                    <td>
                        <input type="text" name="stripe_publishable_key" value="<?php echo esc_attr(get_option('stripe_publishable_key')); ?>" class="regular-text">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Stripe Secret Key</th>
                    <td>
                        <input type="password" name="stripe_secret_key" value="<?php echo esc_attr(get_option('stripe_secret_key')); ?>" class="regular-text">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Webhook Secret</th>
                    <td>
                        <input type="password" name="stripe_webhook_secret" value="<?php echo esc_attr(get_option('stripe_webhook_secret')); ?>" class="regular-text">
                        <p class="description">Endpoint: <?php echo rest_url('stripe/v1/webhook'); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register settings
add_action('admin_init', 'register_stripe_settings');
function register_stripe_settings() {
    register_setting('stripe-settings-group', 'stripe_publishable_key');
    register_setting('stripe-settings-group', 'stripe_secret_key');
    register_setting('stripe-settings-group', 'stripe_webhook_secret');
}


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