<?php
/**
 * Template Name:  Thank-You 
 */
get_header();
  ?>


<!-- Divider -->
<div class="divider"></div>

<?php

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
$order    = wc_get_order($order_id);

//print "<pre>";
//print_r($order); // For debugging purposes, remove in production




   







?>

<div class="container my-5">
    <?php if ($order) : 
    $billing_name  = $order->get_formatted_billing_full_name();
    $order_number  = $order->get_order_number();
    $order_total   = $order->get_formatted_order_total();
    $order_date    = wc_format_datetime($order->get_date_created(), 'D, d M Y');
    $payment_title = $order->get_payment_method_title();
    $items         = $order->get_items();

   
?>
    <div class="card shadow-xl border-0 p-4 thankyou_page">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="text-success mb-1">
                    <i class="bi bi-check-circle-fill"></i> Booking Confirmed
                </h4>
                <small class="text-muted">
                    Reservation #<?php echo esc_html($order_number); ?> · <?php echo esc_html($order_date); ?>
                </small>
            </div>
        </div>

        <div class="row g-4">
            <!-- Trip Summary -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-3 mb-4">
                    <h5 class="mb-3 text-success"><i class="bi bi-geo-alt"></i> Trip Summary</h5>
                    <?php foreach ($items as $item) :
                        $product = $item->get_product();

                        // echo '<pre>';
                        // print_r( $item->get_meta_data() );
                        // echo '</pre>';
                         // Tour title already set above
                        $pickup_date    = $item->get_meta('Pickup Date & Time');
                        $tour_id    = $item->get_meta('Tour ID');
                        $pickup_address = $item->get_meta('Pickup Address');

                        $tour_title = get_the_title($tour_id);

                        // If not found with underscore, try without
                        if (empty($pickup_date)) {
                            $pickup_date = $item->get_meta('pickup_date');
                        }
                       
                        if (empty($pickup_address)) {
                            $pickup_address = $item->get_meta('pickup_address');
                        }
                    ?>
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="badge bg-success">Day Trip</span>
                                <h6 class="mt-2 mb-1"><?php echo $tour_title ?></h6>
                                <!-- <small class="text-muted">
                                    Qty: <?php echo esc_html($item->get_quantity()); ?>
                                </small> -->
                            </div>
                           
                                            <div class="text-end fw-bold">
                                <?php echo wp_kses_post($order->get_formatted_line_subtotal($item)); ?>
                            </div>
                        </div>
                         <div class="mt-3">
                             <ul class="list-unstyled mb-0 small text-muted d-flex flex-column gap-2">
                                <?php if ($pickup_date): ?>
                                    <li><strong>Pickup Date & Time:</strong> <?php echo esc_html($pickup_date); ?></li>
                                <?php endif; ?>

                              

                                <?php if ($pickup_address): ?>
                                    <li><strong>Pickup Address:</strong> <?php echo esc_html($pickup_address); ?></li>
                                <?php endif; ?>
                            </ul>
                            </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="card border-0 shadow-sm p-3">
                    <h5 class="mb-3 text-success"><i class="bi bi-person"></i> Traveler & Contact</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted d-block">Name</small>
                            <p class="mb-0"><?php echo esc_html($billing_name); ?></p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Email</small>
                            <p class="mb-0"><?php echo esc_html($order->get_billing_email()); ?></p>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Phone</small>
                            <p class="mb-0"><?php echo esc_html($order->get_billing_phone()); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-3 mb-4">
                    <h5 class="mb-3 text-success"><i class="bi bi-credit-card"></i> Payment Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <strong><?php echo wp_kses_post($order->get_subtotal_to_display()); ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Payment Method:</span>
                        <strong><?php echo esc_html($payment_title); ?></strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span><?php echo wp_kses_post($order_total); ?></span>
                    </div>
                    <div class="mt-3 d-flex gap-2">
                        <!-- <a href="#" class="btn btn-success w-50">
                            <i class="bi bi-receipt"></i> Get Receipt
                        </a> -->
                        
                    </div>
                </div>

                <div class="card border-0 shadow-sm p-3">
                    <h5 class="mb-3 text-success"><i class="bi bi-file-earmark-text"></i> Order Confirmation</h5>
                    <p class="mb-2"><strong>Order #</strong> <?php echo esc_html($order_number); ?></p>
                    <p class="mb-3"><strong>Date:</strong> <?php echo esc_html($order_date); ?></p>
                    <div class="d-flex gap-2">
                        <a href="mailto:<?php echo esc_html($order->get_billing_email()); ?>"
                            class="btn btn-outline-success w-50">
                            <i class="bi bi-envelope"></i> Email
                        </a>
                        <button class="btn btn-success w-50" onclick="window.print()">
                            <i class="bi bi-printer"></i> Print
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else : ?>
    <div class="alert alert-danger text-center">
        Sorry, your order could not be found.
    </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>