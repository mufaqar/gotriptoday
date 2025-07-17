<?php
/*Template Name: Transfer*/

get_header(); ?>




  <?php get_template_part('partials/content', 'breadcrumb'); ?>
<!-- Tour Details Section -->
<section class="tour-details-section">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-lg-12">
              <?php echo do_shortcode('[chbs_booking_form booking_form_id="10007"]') ?>
            </div>
        </div>

        <!-- Divider -->
        <div class="divider"></div>
    </div>
</section>





<section>
    <!-- Divider -->
    <div class="divider"></div>
    <div class="divider-sm"></div>

    <div class="container">
        <div class="row g-4 g-xxl-5">
            <?php
            $args = array(
                'post_type' => 'chbs_vehicle',
                'posts_per_page' => -1, // Get all vehicles
                'post_status' => 'publish',
            );

            $vehicle_query = new WP_Query($args);

            if ($vehicle_query->have_posts()):
                while ($vehicle_query->have_posts()):
                    $vehicle_query->the_post();
                    ?>
            <?php get_template_part( 'partials/veh', 'card' ); ?>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>No vehicles found.</p>';
            endif;
            ?>

        </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>
</section>

<?php get_footer(); ?>