<?php get_header(); ?>

<?php get_template_part( 'partials/content', 'breadcrumb' ); ?>

<!-- Tour Details Section -->
<div class="tour-details-section">
    <!-- Divider -->
    <div class="divider"></div>

    <div class="container">

        <div class="row g-5">
            <div class="col-12 col-lg-12">
                <div class="tour-details-content">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="post" id="post-<?php the_ID(); ?>">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>

                    </div>
                </div>
                <?php endwhile; endif; ?>
            </div>
            <!-- Divider -->
            <div class="divider"></div>
        </div>

    </div>
</div>
        <?php get_footer(); ?>