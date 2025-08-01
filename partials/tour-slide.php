  <!-- Single Slide -->
  <div class="swiper-slide">
      <div class="trip-card wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1000ms">
          <?php if ( has_post_thumbnail() ) {
				           the_post_thumbnail('full', ['class' => 'tour_feature']);
					} else { ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tour.jpg" alt="Featured Thumbnail" />
          <?php } ?>

          <!-- Trip Body -->
          <div class="trip-body">
              <h4 class="mb-4 trip-title"><?php the_title()?></h4>
              <p><i class="ti ti-map-pin-filled"></i>
                          <?php echo get_post_meta($post->ID, "address", true); ?> </p>
              <!-- Trip Meta -->
              <div class="trip-meta d-flex align-items-center justify-content-between gap-3 gap-xxl-4">
                  <ul class="list-unstyled d-flex flex-column gap-3">
                     
                      <li><i class="ti ti-map-pin-cog"></i>
                          <?php echo get_post_meta($post->ID, "departure", true); ?> </li>
                      <li><i class="ti ti-location"></i>   <?php echo get_post_meta($post->ID, "distination", true); ?>  </li>
                         <li><i class="ti ti-clock"></i>   <?php echo get_post_meta($post->ID, "duration_time", true); ?>  </li>
                  </ul>
                  <div class="line"></div>
                  <div class="text-end">
                      <span class="badge bg-success mb-2"><i class="ti ti-clock"></i>
                     <?php echo get_post_meta($post->ID, "duration_time", true); ?> Hours</span>
                      <h2 class="mb-0 trip-price"><?php echo get_post_meta($post->ID, "pricing", true); ?><span>€</span>
                      </h2>
                  </div>
              </div>
              <!-- Button -->
              <a href="<?php the_permalink() ?>" class="btn btn-light w-100">Book Now</a>
          </div>

      </div>

  </div>