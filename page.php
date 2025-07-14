<?php get_header(); ?>

<?php get_template_part( 'partials/content', 'breadcrumb' ); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
        <h1><?php the_title(); ?></h1>
        <div class="entry">
          
			<?php the_content(); ?>
			
        </div>
    </div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>