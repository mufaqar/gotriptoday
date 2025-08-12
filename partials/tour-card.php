 <div class="trip-card wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1000ms">
     <a href="<?php the_permalink() ?>">
         <?php if ( has_post_thumbnail() ) {
				           the_post_thumbnail('full', ['class' => 'tour_feature']);
					} else { ?>
         <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tour.jpg" alt="Featured Thumbnail" />
         <?php } ?></a>

     <div class="trip-body">
         <h4 class="mb-2 trip-title"> <a href="<?php the_permalink() ?>"><?php the_title()?></a></h4>
         <p class="mb-3 d-flex flex-wrap align-items-center gap-2 justify-content-between">
             <span>
                 <span class="text-warning">
                     <i class="ti ti-star-filled"></i>
                     <i class="ti ti-star-filled"></i>
                     <i class="ti ti-star-filled"></i>
                     <i class="ti ti-star-filled"></i>
                     <i class="ti ti-star-filled"></i>
                 </span>
                 <span>4.9 (120 reviews)</span>
             </span>
             <span>
                 <i class="ti ti-clock"></i>
                 <?php echo get_post_meta($post->ID, "duration_time", true); ?>
             </span>


         </p>
         <div class="trip-meta d-flex align-items-center justify-content-between gap-3 gap-xxl-4">
             <ul class="list-unstyled d-flex flex-column gap-3">
                 <li><i class="ti ti-map-pin-cog"></i>
                     <?php echo get_post_meta($post->ID, "address", true); ?> </li>


                 <li><i class="ti ti-checkbox"></i> 24h Free Cancellation </li>
                 <li><i class="ti ti-certificate"></i> TripAdvisor Certified</li>




             </ul>
             <div class="line"></div>
             <div class="text-end">
                 <span class="badge bg-success mb-2"><i class="ti ti-badge"></i>
                     Popular</span>
                 <h2 class="mb-0 trip-price">
                     <?php echo get_post_meta($post->ID, "pricing", true); ?><span>€</span>
                 </h2>
             </div>
         </div>
         <a href="<?php the_permalink() ?>" class="btn btn-light w-100">View Tour</a>
     </div>

 </div>