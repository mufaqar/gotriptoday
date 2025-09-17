<?php 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140, true );
	add_image_size( 'single-post-thumbnail', 300, 9999 );

    	add_image_size( 'tour-thumbnail', 300, 200, true );

         add_image_size('tour_slide', 1350, 500, true); // true = hard crop





    include_once('inc/class-walker-touria.php');
    include_once('inc/extra.php');


	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
		// Declare sidebar widget zone
	if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h4>',
    		'after_title'   => '</h4>'
    	));
    }

function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

if (function_exists('register_nav_menus')) {
register_nav_menus( array(
		'main' => __( 'Main Menu', '' ),
		'footer_routes' => __( 'Footer Routes Menu', '' ),
        'footer_offer' => __( 'Footer Offer Menu', '' ),
        'footer_legal' => __( 'Footer Legaal Menu', '' ),
	) );
}


function fallbackmenu1(){ ?>
<div id="menu">
    <ul>
        <li> Go to Adminpanel > Appearance > Menus to create your menu. You should have WP 3.0+ version for custom menus
            to work.</li>
    </ul>
</div>
<?php }

function fallbackmenu2(){ ?>
<div id="menu">
    <ul>
        <li> Go to Adminpanel > Appearance > Menus to create your menu. You should have WP 3.0+ version for custom menus
            to work.</li>
    </ul>
</div>
<?php }

function add_more_buttons($buttons) {
 $buttons[] = 'hr';
 $buttons[] = 'del';
 $buttons[] = 'sub';
 $buttons[] = 'sup';
 $buttons[] = 'fontselect';
 $buttons[] = 'fontsizeselect';
 $buttons[] = 'cleanup';
 $buttons[] = 'styleselect';
 $buttons[] = 'lineheight';
 return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");

function add_first_and_last($items) {
    $items[1]->classes[] = 'first-menu-item';
    $items[count($items)]->classes[] = 'last-menu-item';
    return $items;
}
 
add_filter('wp_nav_menu_objects', 'add_first_and_last');

function enqueue_ajax_contact_form_script() {
    wp_enqueue_script('ajax-contact', get_stylesheet_directory_uri() . '/assets/js/ajax.js', array('jquery'), null, true);
    wp_localize_script('ajax-contact', 'ajaxContact', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('ajax-contact-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_contact_form_script');



function enqueue_wishlist_script() {
    if (is_singular('tours') || is_page_template('wishlist.php')) { 
        // enqueue on single tour AND wishlist page
        wp_enqueue_script(
            'wishlist-script',
            get_stylesheet_directory_uri() . '/assets/js/wishlist.js',
            array('jquery'),
            null,
            true
        );
        wp_localize_script('wishlist-script', 'wpvars', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_wishlist_script');



function get_tour_details_ajax() {
    if (isset($_GET['tour_id'])) {
        $tour_id = intval($_GET['tour_id']);
        $tour = get_post($tour_id);

        // ✅ Correct post type check
        if ($tour && $tour->post_type === 'tours') {
            wp_send_json(array(
                'title'     => get_the_title($tour_id),
                'permalink' => get_permalink($tour_id),
                'thumbnail' => get_the_post_thumbnail_url($tour_id, 'thumbnail') // optional
            ));
        }
    }
    wp_send_json_error('Invalid tour ID');
}
add_action('wp_ajax_get_tour_details', 'get_tour_details_ajax');
add_action('wp_ajax_nopriv_get_tour_details', 'get_tour_details_ajax');



function get_tour_comments($post_id) {
    $args = array(
        'post_id' => $post_id,
        'status'  => 'approve', // only approved comments
        'order'   => 'DESC',    // newest first
    );

    $comments = get_comments($args);
    $data = array();

    foreach ($comments as $comment) {
        $rating = get_comment_meta($comment->comment_ID, 'rating', true);

        $data[] = array(
            'comment_ID' => $comment->comment_ID,
            'author'     => $comment->comment_author,
            'content'    => $comment->comment_content,
            'date'       => get_comment_date('', $comment),
            'rating'     => $rating ? intval($rating) : null,
        );
    }

    return $data;
}



// Process booking and create WooCommerce order
add_action('admin_post_process_booking', 'process_booking_form');
add_action('admin_post_nopriv_process_booking', 'process_booking_form');

function process_booking_form() {
    // Verify nonce
    if (!isset($_POST['booking_nonce_field']) || !wp_verify_nonce($_POST['booking_nonce_field'], 'booking_nonce')) {
        wp_die('Security check failed');
    }
    
    // Get form data
    $tour_id = isset($_POST['tour_id']) ? intval($_POST['tour_id']) : 0;
    $tour_date = isset($_POST['tour_date']) ? sanitize_text_field($_POST['tour_date']) : '';
    $tour_adults = isset($_POST['tour_adults']) ? intval($_POST['tour_adults']) : 0;
    $tour_child = isset($_POST['tour_child']) ? intval($_POST['tour_child']) : 0;
    $tour_price = isset($_POST['tour_price']) ? floatval($_POST['tour_price']) : 0;
    $booking_product_id = isset($_POST['booking_product_id']) ? intval($_POST['booking_product_id']) : 0;
    
    // Get all form fields
    $pax = isset($_POST['pax']) ? intval($_POST['pax']) : 0;
    $pickup_datetime = isset($_POST['pickup_datetime']) ? sanitize_text_field($_POST['pickup_datetime']) : '';
    $pickup_address = isset($_POST['pickup_address']) ? sanitize_text_field($_POST['pickup_address']) : '';
    $dropoff_address = isset($_POST['dropoff_address']) ? sanitize_text_field($_POST['dropoff_address']) : '';
    $trip_type = isset($_POST['trip_type']) ? sanitize_text_field($_POST['trip_type']) : '';
    $transport_info = isset($_POST['transport_info']) ? sanitize_text_field($_POST['transport_info']) : '';
    $driver_notes = isset($_POST['driver_notes']) ? sanitize_textarea_field($_POST['driver_notes']) : '';
    $vehicle = isset($_POST['vehicle']) ? sanitize_text_field($_POST['vehicle']) : '';
    $premium_upgrade = isset($_POST['premium_upgrade']) ? intval($_POST['premium_upgrade']) : 0;
    $baby_seat = isset($_POST['baby_seat']) ? intval($_POST['baby_seat']) : 0;
    $toddler_seat = isset($_POST['toddler_seat']) ? intval($_POST['toddler_seat']) : 0;
    $booster_seat = isset($_POST['booster_seat']) ? intval($_POST['booster_seat']) : 0;
    $extra_hours = isset($_POST['extra_hours']) ? intval($_POST['extra_hours']) : 0;
    $customer_name = isset($_POST['passenger_name']) ? sanitize_text_field($_POST['passenger_name']) : '';
    $customer_email = isset($_POST['passenger_email']) ? sanitize_email($_POST['passenger_email']) : '';
    $customer_phone = isset($_POST['passenger_mobile']) ? sanitize_text_field($_POST['passenger_mobile']) : '';
    $need_invoice = isset($_POST['need_invoice']) ? intval($_POST['need_invoice']) : 0;
    $company_name = isset($_POST['company_name']) ? sanitize_text_field($_POST['company_name']) : '';
    $invoice_street = isset($_POST['invoice_street']) ? sanitize_text_field($_POST['invoice_street']) : '';
    $invoice_city = isset($_POST['invoice_city']) ? sanitize_text_field($_POST['invoice_city']) : '';
    $invoice_zip = isset($_POST['invoice_zip']) ? sanitize_text_field($_POST['invoice_zip']) : '';
    $invoice_country = isset($_POST['invoice_country']) ? sanitize_text_field($_POST['invoice_country']) : '';
    $vat_id = isset($_POST['vat_id']) ? sanitize_text_field($_POST['vat_id']) : '';
    
    // Calculate final price with extras
    $final_price = calculate_final_price($tour_price, $premium_upgrade, $baby_seat, $toddler_seat, $booster_seat, $extra_hours);
    
    // Create WooCommerce order
    if (class_exists('WooCommerce')) {
        // Create order
        $order = wc_create_order();
        
        // Get the booking product
        $product = wc_get_product($booking_product_id);
        
        if ($product) {
            // Add product to order with custom price
            $item_id = $order->add_product($product, 1, array(
                'subtotal' => $final_price,
                'total' => $final_price
            ));
            
            // Add all booking details as item meta data (visible in order items)
            if ($item_id) {
                wc_add_order_item_meta($item_id, 'Tour ID', $tour_id);
                wc_add_order_item_meta($item_id, 'Tour Date', $tour_date);
                wc_add_order_item_meta($item_id, 'Adults', $tour_adults);
                wc_add_order_item_meta($item_id, 'Children', $tour_child);
                wc_add_order_item_meta($item_id, 'Total Passengers', $pax);
                wc_add_order_item_meta($item_id, 'Pickup Date & Time', $pickup_datetime);
                wc_add_order_item_meta($item_id, 'Pickup Address', $pickup_address);
                wc_add_order_item_meta($item_id, 'Drop-off Address', $dropoff_address);
                wc_add_order_item_meta($item_id, 'Trip Type', $trip_type);
                wc_add_order_item_meta($item_id, 'Transport Info', $transport_info);
                wc_add_order_item_meta($item_id, 'Driver Notes', $driver_notes);
                wc_add_order_item_meta($item_id, 'Vehicle Type', $vehicle);
                
                if ($premium_upgrade) {
                    wc_add_order_item_meta($item_id, 'Premium Upgrade', 'Yes');
                }
                
                if ($baby_seat > 0) {
                    wc_add_order_item_meta($item_id, 'Baby Seats', $baby_seat);
                }
                
                if ($toddler_seat > 0) {
                    wc_add_order_item_meta($item_id, 'Toddler Seats', $toddler_seat);
                }
                
                if ($booster_seat > 0) {
                    wc_add_order_item_meta($item_id, 'Booster Seats', $booster_seat);
                }
                
                if ($extra_hours > 0) {
                    wc_add_order_item_meta($item_id, 'Extra Hours', $extra_hours);
                }
                
                wc_add_order_item_meta($item_id, 'Passenger Name', $customer_name);
                wc_add_order_item_meta($item_id, 'Passenger Email', $customer_email);
                wc_add_order_item_meta($item_id, 'Passenger Phone', $customer_phone);
                
                if ($need_invoice) {
                    wc_add_order_item_meta($item_id, 'Invoice Required', 'Yes');
                    wc_add_order_item_meta($item_id, 'Company Name', $company_name);
                    wc_add_order_item_meta($item_id, 'Invoice Street', $invoice_street);
                    wc_add_order_item_meta($item_id, 'Invoice City', $invoice_city);
                    wc_add_order_item_meta($item_id, 'Invoice ZIP', $invoice_zip);
                    wc_add_order_item_meta($item_id, 'Invoice Country', $invoice_country);
                    
                    if (!empty($vat_id)) {
                        wc_add_order_item_meta($item_id, 'VAT ID', $vat_id);
                    }
                }
                
                // Add base price and extras breakdown
                wc_add_order_item_meta($item_id, 'Base Price', wc_price($tour_price));
                
                $extras_breakdown = array();
                if ($premium_upgrade) {
                    $premium_cost = $tour_price * 0.2;
                    $extras_breakdown[] = 'Premium Upgrade: ' . wc_price($premium_cost);
                }
                
                $seat_cost = ($baby_seat + $toddler_seat + $booster_seat) * 5;
                if ($seat_cost > 0) {
                    $extras_breakdown[] = 'Child Seats: ' . wc_price($seat_cost);
                }
                
                $hours_cost = $extra_hours * 50;
                if ($hours_cost > 0) {
                    $extras_breakdown[] = 'Extra Hours: ' . wc_price($hours_cost);
                }
                
                if (!empty($extras_breakdown)) {
                    wc_add_order_item_meta($item_id, 'Extras', implode(', ', $extras_breakdown));
                }
                
                wc_add_order_item_meta($item_id, 'Final Price', wc_price($final_price));
            }
            
            // Set addresses
            $address = array(
                'first_name' => $customer_name,
                'email'      => $customer_email,
                'phone'      => $customer_phone,
            );
            
            $order->set_address($address, 'billing');
            $order->set_address($address, 'shipping');
            
            // Set payment method
            $payment_method = isset($_POST['payment_method']) ? sanitize_text_field($_POST['payment_method']) : '';
            $order->set_payment_method($payment_method);
            
            // Add order notes with booking details
            $order_notes = "Booking Details:\n";
            $order_notes .= "Tour: #{$tour_id}\n";
            $order_notes .= "Date: {$tour_date}\n";
            $order_notes .= "Passengers: {$tour_adults} adults, {$tour_child} children\n";
            $order_notes .= "Pickup: {$pickup_datetime} at {$pickup_address}\n";
            
            if (!empty($dropoff_address)) {
                $order_notes .= "Drop-off: {$dropoff_address}\n";
            }
            
            $order_notes .= "Vehicle: {$vehicle}\n";
            
            if (!empty($driver_notes)) {
                $order_notes .= "Driver Notes: {$driver_notes}\n";
            }
            
            $order->add_order_note($order_notes);
            
            // Calculate totals
            $order->calculate_totals();            
            // Also save as order meta for easy access
            $order->update_meta_data('_booking_tour_id', $tour_id);
            $order->update_meta_data('_booking_tour_date', $tour_date);
            $order->update_meta_data('_booking_adults', $tour_adults);
            $order->update_meta_data('_booking_children', $tour_child);
            $order->update_meta_data('_booking_pickup_datetime', $pickup_datetime);
            $order->update_meta_data('_booking_pickup_address', $pickup_address);
            $order->update_meta_data('_booking_dropoff_address', $dropoff_address);
            $order->update_meta_data('_booking_trip_type', $trip_type);
            $order->update_meta_data('_booking_transport_info', $transport_info);
            $order->update_meta_data('_booking_notes', $driver_notes);
            $order->update_meta_data('_booking_vehicle', $vehicle);
            $order->update_meta_data('_booking_premium_upgrade', $premium_upgrade);
            $order->update_meta_data('_booking_baby_seats', $baby_seat);
            $order->update_meta_data('_booking_toddler_seats', $toddler_seat);
            $order->update_meta_data('_booking_booster_seats', $booster_seat);
            $order->update_meta_data('_booking_extra_hours', $extra_hours);
            $order->update_meta_data('_booking_passenger_name', $customer_name);
            $order->update_meta_data('_booking_passenger_email', $customer_email);
            $order->update_meta_data('_booking_passenger_phone', $customer_phone);
            
            // Save order
            $order->save();
            
            // Redirect to checkout
            wp_redirect($order->get_checkout_payment_url());
            exit;
        }
    }
    
    // If we get here, something went wrong
    wp_redirect(home_url('/booking-error'));
    exit;
}

// Helper function to calculate final price with extras
function calculate_final_price($base_price, $premium_upgrade, $baby_seat, $toddler_seat, $booster_seat, $extra_hours) {
    $final_price = $base_price;
    
    // Premium upgrade (20%)
    if ($premium_upgrade) {
        $final_price += $base_price * 0.2;
    }
    
    // Child seats (€5 each)
    $seat_cost = ($baby_seat + $toddler_seat + $booster_seat) * 5;
    $final_price += $seat_cost;
    
    // Extra hours (€50 per hour)
    $hours_cost = $extra_hours * 50;
    $final_price += $hours_cost;
    
    return $final_price;
}

