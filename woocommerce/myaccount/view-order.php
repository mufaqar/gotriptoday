<?php


defined( 'ABSPATH' ) || exit;


// Initialize tour variables
$is_tour = false;
$tour_id = '';
$tour_pickup_datetime = '';
$tour_pickup_address = '';
$tour_dropoff_address = '';
$tour_adults = '';
$tour_child = '';
$special_requirements = '';
$tour_vehicle_type = '';

// Get order items and check if it's a tour
$order_items = $order->get_items();

foreach ($order_items as $item_id => $item) {
    // Check if this is a tour product (you might want to check by product type or category)
    $product = $item->get_product();
    
    // Get tour-specific metadata from order item meta
    $item_tour_id = $item->get_meta('Tour ID');
    $item_pickup_datetime = $item->get_meta('Pickup DateTime');
    $item_pickup_address = $item->get_meta('Pickup Address');
    $item_dropoff_address = $item->get_meta('Dropoff Address');
    $item_adults = $item->get_meta('Adults');
    $item_child = $item->get_meta('Children');
    $item_special_requirements = $item->get_meta('Driver Notes');
    $item_vehicle_type = $item->get_meta('Vehicle Type');
    
    // If we find any tour metadata, mark this as a tour order
    if ($item_tour_id || $item_pickup_datetime || $item_pickup_address) {
        $is_tour = true;
        
        // Use the first found tour metadata (assuming one tour per order)
        if ($item_tour_id && empty($tour_id)) $tour_id = $item_tour_id;
        if ($item_pickup_datetime && empty($tour_pickup_datetime)) $tour_pickup_datetime = $item_pickup_datetime;
        if ($item_pickup_address && empty($tour_pickup_address)) $tour_pickup_address = $item_pickup_address;
        if ($item_dropoff_address && empty($tour_dropoff_address)) $tour_dropoff_address = $item_dropoff_address;
        if ($item_adults && empty($tour_adults)) $tour_adults = $item_adults;
        if ($item_child && empty($tour_child)) $tour_child = $item_child;
        if ($item_special_requirements && empty($special_requirements)) $special_requirements = $item_special_requirements;
        if ($item_vehicle_type && empty($tour_vehicle_type)) $tour_vehicle_type = $item_vehicle_type;
    }
}

// Alternative approach if you want to get all meta from all items
// This collects all values in case there are multiple tour items
$all_tour_meta = [];
foreach ($order_items as $item_id => $item) {
    $item_meta = $item->get_meta_data();
    foreach ($item_meta as $meta) {
        $all_tour_meta[$meta->key][] = $meta->value;
    }
}

// Or if you prefer to work with the first tour item only:
$first_tour_item = null;
foreach ($order_items as $item_id => $item) {
    $item_tour_id = $item->get_meta('Tour ID');
    if ($item_tour_id) {
        $first_tour_item = $item;
        break;
    }
}

if ($first_tour_item) {
    $is_tour = true;
    $tour_id = $first_tour_item->get_meta('Tour ID');
    $tour_pickup_datetime = $first_tour_item->get_meta('Pickup DateTime');
    $tour_pickup_address = $first_tour_item->get_meta('Pickup Address');
    $tour_dropoff_address = $first_tour_item->get_meta('Dropoff Address');
    $tour_adults = $first_tour_item->get_meta('Adults');
    $tour_child = $first_tour_item->get_meta('Children');
    $special_requirements = $first_tour_item->get_meta('Driver Notes');
    $tour_vehicle_type = $first_tour_item->get_meta('Vehicle Type');
}







?>

<div class="woocommerce-order-details-wrapper">

    <!-- Order Header -->
    <div class="order-header-card">
        <div class="order-header-top">
            <div class="order-title-section">
                <h1 class="order-title">Order #<?php echo esc_html($order->get_order_number()); ?></h1>
                <p class="order-date">Placed on <?php echo esc_html(wc_format_datetime($order->get_date_created())); ?>
                </p>
            </div>
            <div class="order-status-section">
                <span class="order-status-badge status-<?php echo esc_attr($order->get_status()); ?>">
                    <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
                </span>
            </div>
        </div>

        <div class="order-header-bottom">
            <div class="order-summary">
                <div class="summary-item">
                    <strong>Total:</strong>
                    <span class="order-total"><?php echo $order->get_formatted_order_total(); ?></span>
                </div>
                <div class="summary-item">
                    <strong>Payment:</strong>
                    <span><?php echo esc_html($order->get_payment_method_title()); ?></span>
                </div>
                <div class="summary-item">
                    <strong>Items:</strong>
                    <span><?php echo count($order->get_items()); ?></span>
                </div>
            </div>

        </div>
    </div>

    <!-- Tour Information Section -->
    <?php if ($is_tour ) : ?>
    <div class="tour-info-card">
        <div class="card-header">
            <h2><i class="bi bi-geo-alt"></i> Tour Information</h2>
        </div>
        <div class="tour-details-grid">
            <?php if ($tour_pickup_datetime) : ?>
            <div class="tour-detail">
                <strong>Pickup Date & Time:</strong>
                <span><?php echo esc_html(date_i18n('l, F j, Y \a\t g:i A', strtotime($tour_pickup_datetime))); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($tour_pickup_address) : ?>
            <div class="tour-detail">
                <strong>Pickup Address:</strong>
                <span><?php echo esc_html($tour_pickup_address); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($tour_dropoff_address) : ?>
            <div class="tour-detail">
                <strong>Dropoff Address:</strong>
                <span><?php echo esc_html($tour_dropoff_address); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($tour_vehicle_type) : ?>
            <div class="tour-detail">
                <strong>Vehicle Type:</strong>
                <span><?php echo esc_html($tour_vehicle_type); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($tour_adults || $tour_child) : ?>
            <div class="tour-detail">
                <strong>Passengers:</strong>
                <span>
                    <?php 
                        $passengers = [];
                        if ($tour_adults) $passengers[] = $tour_adults . ' Adult' . ($tour_adults > 1 ? 's' : '');
                        if ($tour_child) $passengers[] = $tour_child . ' Child' . ($tour_child > 1 ? 'ren' : '');
                        echo esc_html(implode(', ', $passengers));
                        ?>
                </span>
            </div>
            <?php endif; ?>

            <?php if ($tour_id) : ?>
            <div class="tour-detail">
                <strong>Tour ID:</strong>
                <span class="confirmation-number"><?php echo esc_html($tour_id); ?></span>
            </div>
            <?php endif; ?>
        </div>

        <?php if ($special_requirements) : ?>
        <div class="special-requirements">
            <strong>Special Instructions:</strong>
            <p><?php echo esc_html($special_requirements); ?></p>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Order Details -->
    <div class="order-details-card">
        <div class="card-header">
            <h2>Order Details</h2>
        </div>
        <div class="card-body">
            <div class="order-items-section">

                <div class="tour_itinerary">
                    <h2 class="pb-3">Trip Itinerary</h2>

                    <?php 
	
	
                        // Get post ID and post type (you can pass these as parameters or via GET)
                    $post_id = $tour_id; // Example: Get from URL or current post
                    $post_type = $_GET['post_type'] ?? get_post_type($post_id); // Example: Get from URL or current post type

                    // Fetch trip itinerary data
                    $trip_itinerary = get_post_meta($post_id, 'trip_itinerary', true) ?: [];

                        ?>
                    <div>
                        <?php
                            $counter = 0;
                            foreach ($trip_itinerary as $itinerary) {
                                $counter++;
                                $title = $itinerary['title'];
                                $description = $itinerary['description'];
                                $ticket_info = $itinerary['ticket_info'];
                                ?>
                                            <div class="itinerary_item">
                                                <span class="list_marker"><?php echo $counter; ?></span>
                                                <div>
                                                    <h5 class="pb-3"> <?php echo $title; ?></h5>
                                                    <p>
                                                        <?php echo $description; ?>
                                                    </p>
                                                    <p class="itinerary_detail">
                                                        <?php echo $ticket_info; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php
                            }
                            ?>
                    </div>
                </div>



            </div>

        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="order-additional-info">
        <div class="info-column">
            <!-- Customer Information -->
            <div class="info-card">
                <div class="card-header">
                    <h3>Customer Information</h3>
                </div>
                <div class="card-body">
                    <div class="customer-details">
                        <div class="detail-section">
                            <h4>Contact Information</h4>
                            <p><strong>Email:</strong> <?php echo esc_html($order->get_billing_email()); ?></p>
                            <p><strong>Phone:</strong> <?php echo esc_html($order->get_billing_phone()); ?></p>
                        </div>

                        <div class="detail-section">
                            <h4>Billing Address</h4>
                            <address>
                                <?php echo wp_kses_post($order->get_formatted_billing_address()); ?>
                            </address>
                        </div>

                        <?php if ($order->get_shipping_method()) : ?>
                        <div class="detail-section">
                            <h4>Shipping Address</h4>
                            <address>
                                <?php echo wp_kses_post($order->get_formatted_shipping_address()); ?>
                            </address>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-column">
            <!-- Order Updates -->



            <!-- Additional Actions -->
            <div class="info-card">
                <div class="card-header">
                    <h3>Order Actions</h3>
                </div>
                <div class="card-body">
                    <div class="order-actions-list">
                        <?php if ($order->get_status() === 'completed') : ?>
                        <a href="#" class="action-link">
                            <i class="bi bi-chat-left-text"></i> Leave a Review
                        </a>
                        <?php endif; ?>

                        <a href="mailto:info@gotriptoday.com" class="action-link">
                            <i class="bi bi-question-circle"></i> Get Help
                        </a>

                        <?php if ($order->get_status() === 'completed' && $is_tour) : ?>
                        <a href="mailto:info@gotriptoday.com" class="action-link">
                            <i class="bi bi-calendar-check"></i> Manage Tour Booking
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.woocommerce-order-details-wrapper {

    margin: 0 auto;

}

/* Order Header Styles */
.order-header-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 24px;
    overflow: hidden;
}

.order-header-top {
    background: #3cb371;
    color: white;
    padding: 24px;
    display: flex;
    justify-content: between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.order-title {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
    color: #fff;
}

.order-date {
    margin: 8px 0 0 0;

    color: #fff;
}

.order-status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-completed {
    background: #e6f4ea;
    color: #28a745;
}

.status-processing {
    background: #e8f0fe;
    color: #7f54b3;
}

.status-pending {
    background: #fff8e1;
    color: #ffc107;
}

.status-cancelled {
    background: #fde8e8;
    color: #dc3545;
}

.order-header-bottom {
    padding: 20px 24px;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.order-summary {
    display: flex;
    gap: 32px;
    flex-wrap: wrap;
}

.summary-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.order-total {
    font-size: 20px;
    font-weight: 700;
    color: #7f54b3;
}

.order-actions {
    display: flex;
    gap: 12px;
}

.btn {
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: #7f54b3;
    color: white;
}

.btn-secondary {
    background: #f8f9fa;
    color: #4a5568;
    border: 1px solid #e2e8f0;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Card Styles */
.tour-info-card,
.order-details-card,
.info-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 24px;
    overflow: hidden;
}

.card-header {
    background: #f8f9fa;
    padding: 20px 24px;
    border-bottom: 1px solid #e2e8f0;
}

.card-header h2,
.card-header h3 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.card-body {
    padding: 24px;
}

/* Tour Information Styles */
.tour-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 16px;
    margin-bottom: 20px;
}

.tour-detail {
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 15px;
}

.confirmation-number {
    font-family: monospace;
    background: #f1f3f4;
    padding: 4px 8px;
    border-radius: 4px;
}

.special-requirements {
    background: #f0f9ff;
    border-left: 4px solid #7f54b3;
    padding: 16px;
    border-radius: 4px;
    margin: 20px 0;
}

.alert {
    padding: 16px;
    border-radius: 8px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.alert-info {
    background: #e8f4fd;
    color: #055a8c;
    border: 1px solid #b6e0fe;
}

/* Order Items Styles */
.order-items-list {
    space-y: 16px;
}

.order-item {
    display: flex;
    gap: 16px;
    padding: 16px 0;
    border-bottom: 1px solid #e2e8f0;
}

.order-item:last-child {
    border-bottom: none;
}

.item-image img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

.item-details {
    flex: 1;
}

.item-name {
    margin: 0 0 8px 0;
    font-size: 16px;
    font-weight: 600;
}

.item-sku {
    margin: 0 0 8px 0;
    color: #6c757d;
    font-size: 14px;
}

.item-tour-meta {
    margin-top: 8px;
}

.tour-meta-item {
    margin: 4px 0;
    font-size: 14px;
}

.item-quantity-price {
    text-align: right;
    min-width: 120px;
}

.quantity {
    margin: 0 0 4px 0;
    color: #6c757d;
}

.total {
    margin: 0;
    font-weight: 600;
}

/* Order Totals */
.order-totals {
    border-top: 2px solid #e2e8f0;
    padding-top: 20px;
    max-width: 300px;
    margin-left: auto;
}

.total-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #f1f3f4;
}

.grand-total {
    border-top: 2px solid #e2e8f0;
    border-bottom: none;
    padding-top: 12px;
    margin-top: 8px;
    font-size: 18px;
}

/* Two Column Layout */
.order-additional-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.info-column {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

/* Customer Details */
.customer-details {
    space-y: 20px;
}

.detail-section h4 {
    margin: 0 0 12px 0;
    font-size: 16px;
    font-weight: 600;
    color: #4a5568;
}

.detail-section p {
    margin: 8px 0;
}

address {
    font-style: normal;
    line-height: 1.6;
}

/* Order Updates */
.order-updates {
    space-y: 20px;
}

.order-update {
    padding-bottom: 20px;
    border-bottom: 1px solid #e2e8f0;
}

.order-update:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.update-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6c757d;
    font-size: 14px;
    margin-bottom: 8px;
}

.update-content {
    line-height: 1.6;
}

/* Order Actions */
.order-actions-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.action-link {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    background: #f8f9fa;
    border-radius: 8px;
    text-decoration: none;
    color: #4a5568;
    transition: all 0.2s;
}

.action-link:hover {
    background: #e9ecef;
    color: #7f54b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .woocommerce-order-details-wrapper {
        padding: 16px;
    }

    .order-header-top,
    .order-header-bottom {
        flex-direction: column;
        align-items: flex-start;
    }

    .order-summary {
        flex-direction: column;
        gap: 16px;
    }

    .order-actions {
        width: 100%;
        flex-direction: column;
    }

    .btn {
        justify-content: center;
    }

    .order-additional-info {
        grid-template-columns: 1fr;
    }

    .tour-details-grid {
        grid-template-columns: 1fr;
    }

    .order-item {
        flex-direction: column;
        text-align: center;
    }

    .item-quantity-price {
        text-align: center;
    }

    .order-totals {
        max-width: none;
    }
}

/* Utility Classes */
.space-y>*+* {
    margin-top: 1em;
}
</style>

<?php //do_action( 'woocommerce_view_order', $order_id ); ?>