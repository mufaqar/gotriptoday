<?php /* Template Name: Page2*/ get_header(); ?>
<div class="divider"></div>
<div class="container">
    <div class="card shadow-xl border-0 p-4 thankyou_page">
        <div class="col-12 col-lg-12">
            <?php if (have_posts()):
                    while (have_posts()):
                        the_post(); ?>
            <div class="post" id="post-<?php the_ID(); ?>">
                <?php the_content(); ?>
            </div>
            <?php endwhile; endif; ?>
        </div>
        <!-- Divider -->
        <div class="divider-sm"></div>
    </div>
</div>
<?php get_footer(); ?>