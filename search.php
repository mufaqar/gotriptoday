<?php get_header(); ?>
<section class="tour-list-section">
    <div class="divider"></div>
    <div class="container">
        <div class="row g-4">
            <div class="col-12">
                <div class="tour-list-content">
                    <div id="tour-results" class="row g-4">
                        <?php if (have_posts()) : ?>
                        <h2><?php _e('Search Results','text_domain'); ?></h2>
                        <?php while (have_posts()) : the_post(); 
            
                                        echo '<div class="col-12 col-lg-6">';
                                        get_template_part('partials/tour', 'card'); 
                                        echo '</div>';
                                endwhile; ?>
                        <?php else : ?>
                        <h2><?php _e('Nothing Found','text_domain'); ?></h2>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>