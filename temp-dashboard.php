<?php
/*Template Name: Dashboard */

defined('ABSPATH') || exit;

if ( ! is_user_logged_in() ) {
    wp_redirect( wc_get_page_permalink('myaccount') ); // Redirect to login if not logged in
    exit;
}

get_header();

// Get current user
$current_user = wp_get_current_user();
$user_id      = $current_user->ID;

// Get WooCommerce orders for this user
$args = array(
    'customer_id' => $user_id,
    'limit'       => 10, // show last 10 orders
    'orderby'     => 'date',
    'order'       => 'DESC',
);
$orders = wc_get_orders($args);

?>

<?php $bg_image = get_template_directory_uri() . '/assets/images/car_ride.jpg';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]); ?>

<!-- Why Choose Section -->
<section class="why-choose-section style-two bg-secondary">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">
        <div class="row g-5">

        <?php
/* Template Name: User Dashboard */

?>

<div class="container my-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="<?php echo wc_get_account_endpoint_url('edit-account'); ?>" class="list-group-item list-group-item-action">
                    <i class="bi bi-person"></i> Account Details
                </a>
                <a href="<?php echo wc_get_account_endpoint_url('orders'); ?>" class="list-group-item list-group-item-action">
                    <i class="bi bi-bag-check"></i> Orders
                </a>
                <a href="<?php echo wc_get_account_endpoint_url('customer-logout'); ?>" class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4">Welcome, <?php echo esc_html($current_user->display_name); ?> 👋</h3>

                    <h5 class="mb-3">Your Recent Orders</h5>
                    <?php if ( ! empty($orders) ) : ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $orders as $order ) : ?>
                                        <tr>
                                            <td>#<?php echo $order->get_id(); ?></td>
                                            <td><?php echo esc_html( $order->get_date_created()->date('M d, Y') ); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo $order->get_status() === 'completed' ? 'success' : 'warning'; ?>">
                                                    <?php echo wc_get_order_status_name( $order->get_status() ); ?>
                                                </span>
                                            </td>
                                            <td><?php echo $order->get_formatted_order_total(); ?></td>
                                            <td>
                                                <a href="<?php echo $order->get_view_order_url(); ?>" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <p class="text-muted">You haven’t placed any orders yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>



            
        </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>
</section>



<?php get_footer(); ?>