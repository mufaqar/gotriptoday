<?php
defined( 'ABSPATH' ) || exit;

$order_id = $order->get_id();
?>

<h2 style="font-size:22px; font-weight:bold; text-align:center;">
    You are one step away from your trip!
</h2>

<p style="text-align:center; font-size:15px;">
    Hi <?php echo esc_html( $order->get_billing_first_name() ); ?>, <br><br>
    We’ve received your order and it’s currently on hold.  
    Here are your booking details:
</p>

<div style="background:#f3f9ff; padding:20px; border-radius:10px; margin:20px 0;">
    <h3 style="margin-bottom:10px; font-size:16px;">TRIP DETAILS</h3>

    <p><strong>Tour ID:</strong> <?php echo $order_id; ?></p>
    <p><strong>Order Date:</strong> <?php echo $order->get_date_created()->date_i18n( 'F j, Y g:i A' ); ?></p>
    <p><strong>Passengers:</strong> <?php echo $order->get_item_count(); ?></p>
    <p><strong>Total Price:</strong> <?php echo $order->get_formatted_order_total(); ?></p>
</div>

<p style="text-align:center; margin-top:25px;">
    <a href="<?php echo esc_url( $order->get_checkout_order_received_url() ); ?>"
       style="background:#0073ff; color:#fff; padding:12px 30px; border-radius:30px;
              text-decoration:none; font-weight:bold; display:inline-block;">
       Complete My Booking
    </a>
</p>
