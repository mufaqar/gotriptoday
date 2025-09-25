<?php
defined( 'ABSPATH' ) || exit;

$order_id = $order->get_id();
?>

<h2 style="font-size:22px; font-weight:bold; text-align:center; margin-bottom:20px;">
    You are one step away from completing your booking!
</h2>

<p style="font-size:15px; text-align:center; margin-bottom:20px;">
    Thanks for booking with us! We’ve received your order and here are your trip details.
</p>

<div style="background:#f3f9ff; padding:20px; border-radius:10px; margin-bottom:25px;">
    <h3 style="margin-bottom:10px; font-size:16px; font-weight:bold;">TRIP DETAILS</h3>

    <p><strong>Start in:</strong> <?php echo $order->get_billing_city(); ?></p>
    <p><strong>Visit:</strong> Palace of Versailles</p>
    <p><strong>End in:</strong> <?php echo $order->get_shipping_city() ?: $order->get_billing_city(); ?></p>
    <p><strong>Departure:</strong> 
        <?php echo date_i18n( 'l, F j, Y \a\t g:i A', strtotime( $order->get_date_created() ) ); ?>
    </p>
    <p><strong>Passengers:</strong> <?php echo $order->get_item_count(); ?> total items</p>
    <p><strong>Price:</strong> <?php echo $order->get_formatted_order_total(); ?></p>
</div>

<p style="text-align:center; margin-top:25px;">
    <a href="<?php echo $order->get_checkout_order_received_url(); ?>"
       style="background:#0073ff; color:#fff; padding:12px 30px; border-radius:30px; 
              text-decoration:none; font-size:16px; font-weight:bold;">
       Complete my booking now
    </a>
</p>
