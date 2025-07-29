<?php
/*Template Name: Fleet */

get_header(); ?>
<?php $bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/img/bg-img/slide1.webp';
get_template_part('partials/content', 'breadcrumb', ['bg' => $bg_image]);?>

<section>
    <div class="divider"></div>
    <div class="container">
        <div class="row g-4 g-xxl-5">
            <?php
            $args = array(
                'post_type' => 'cars',
                'posts_per_page' => -1, 
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
    <div class="divider"></div>
</section>
<?php get_footer(); ?>