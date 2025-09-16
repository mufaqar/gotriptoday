<div class="trip-box wow fadeInUp position-relative" data-wow-delay="400ms" data-wow-duration="1000ms">
    <ul class="list-unstyled d-flex justify-content-between gap-2 wishlist">
         <li>
        <?php 
            $badge = get_post_meta($post->ID, 'badge', true); 
            if (!empty($badge)) : ?>
               
                    <span class="badge bg-success mb-2">
                        <i class="ti ti-badge"></i> <?php echo esc_html($badge); ?>
                    </span>
               
            <?php endif; ?>
             </li>
        <li>
            <button class="wishlist_btn" id="add-to-wishlist" data-tour-id="<?php the_ID(); ?>">
                <i class='icon ti ti-heart'></i>
            </button>
        </li>
    </ul>
    <a href="<?php the_permalink() ?>" class="position-relative z-3">
        <?php if (has_post_thumbnail()) {
            the_post_thumbnail('full', ['class' => 'tour_feature']);
        } else { ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tour.jpg" alt="Featured Thumbnail" />
        <?php } ?>
    </a>
    <div class="trip-body mt-2 d-flex flex-column justify-content-between">
        <p class="mb-1">
            <span class="text-success">
                <i class="ti ti-star-filled"></i>
            </span>
            <span>4.9 (120 reviews)</span>
        </p>
        <h6 class="mb-2 trip-title"> <a href="<?php the_permalink() ?>"><?php the_title() ?></a></h6>
        <div class="trip-meta mb-1">
            <ul class="list-unstyled d-flex flex-column gap-1">
                <li><i class="ti ti-checkbox"></i> 24h Free Cancellation </li>
                <li><i class="ti ti-clock"></i>
                    <?php echo get_post_meta($post->ID, "duration_time", true); ?> hours</li>
            </ul>
            <div class="text-start">
                <h6 class="mt-1 trip-price">
                    <?php
                   

                   echo get_discounted_price(get_the_ID());

                   
                    ?>
                </h6>
            </div>
        </div>

    </div>

</div>