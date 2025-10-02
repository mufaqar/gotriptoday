<?php
/**
 * Assign Driver to WooCommerce Order + Notify
 */

// ✅ Add driver dropdown in order edit screen
add_action('woocommerce_admin_order_data_after_order_details', 'chbs_add_driver_dropdown');
function chbs_add_driver_dropdown($order){
    $drivers = get_posts([
        'post_type'      => 'chbs_driver',
        'posts_per_page' => -1,
        'post_status'    => 'publish'
    ]);

    $assigned_driver = $order->get_meta('_chbs_assigned_driver');
    ?>
    <div class="order_data_column">
        <h4><?php _e('Assign Driver', 'textdomain'); ?></h4>
        <select name="chbs_assigned_driver" style="width:100%">
            <option value=""><?php _e('Select Driver', 'textdomain'); ?></option>
            <?php foreach ($drivers as $driver): ?>
                <option value="<?php echo $driver->ID; ?>" <?php selected($assigned_driver, $driver->ID); ?>>
                    <?php echo esc_html($driver->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php
}

// ✅ Save assigned driver
add_action('woocommerce_process_shop_order_meta', 'chbs_save_driver_assignment', 45, 2);
function chbs_save_driver_assignment($order_id, $post_data){
    if(isset($_POST['chbs_assigned_driver'])){
        $driver_id = intval($_POST['chbs_assigned_driver']);
        $order     = wc_get_order($order_id);

        // Save driver to order meta
        $order->update_meta_data('_chbs_assigned_driver', $driver_id);
        $order->save();

        // Trigger notification
        do_action('chbs_driver_assigned', $order_id, $driver_id);
    }
}

// ✅ When driver assigned → notify (email + WhatsApp + order note)
add_action('chbs_driver_assigned', function($order_id, $driver_id){
    $order       = wc_get_order($order_id);
    $driver_name = get_the_title($driver_id);

    // Get driver email & phone from post meta
    $driver_email = get_post_meta($driver_id, '_driver_email', true);
    $driver_phone = get_post_meta($driver_id, '_driver_phone', true);

    // -------------------------
    // 1. Send Email
    // -------------------------
    if ($driver_email) {
        $subject = "New Delivery Assigned - Order #{$order->get_order_number()}";
        $message = "Hello {$driver_name},\n\nYou have been assigned a new delivery.\nOrder ID: #{$order->get_order_number()}.\n\nPlease check your dashboard for details.";
        wp_mail($driver_email, $subject, $message);
    }

    // -------------------------
    // 2. Send WhatsApp (via Twilio API Example)
    // -------------------------
    if ($driver_phone) {
        $sid    = "YOUR_TWILIO_SID";
        $token  = "YOUR_TWILIO_AUTH_TOKEN";
        $from   = "whatsapp:+14155238886"; // Twilio sandbox sender
        $to     = "whatsapp:" . preg_replace('/[^0-9]/', '', $driver_phone); // clean phone

        $body   = "Hello {$driver_name}, you have been assigned to Order #{$order->get_order_number()}.";

        $url = "https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json";

        $response = wp_remote_post($url, [
            'body' => [
                'From' => $from,
                'To'   => $to,
                'Body' => $body,
            ],
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode("$sid:$token"),
            ]
        ]);
    }

    // -------------------------
    // 3. Add Order Note
    // -------------------------
    $order->add_order_note("Driver {$driver_name} assigned and notified (Email + WhatsApp).");
}, 10, 2);
