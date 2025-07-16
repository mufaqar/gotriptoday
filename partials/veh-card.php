  <div class="col-12 col-sm-6 col-lg-4">
      <!-- Blog Card -->
      <div class="blog-card style-two wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">

          <!-- Post Body -->
          <div class="post-body">

              <h3> <a class="post-title h4" href="<?php the_permalink() ?>">Economy Van</a></h3>
              <p> Mercedes-Benz Vito or similar</p>

              <div class="post-img mb-3">
                  <a class="" href="<?php the_permalink() ?>">
                      <?php if ( has_post_thumbnail() ) {
				           the_post_thumbnail('full', ['class' => 'vehicle_feature']);
					} else { ?>

                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tour.jpg"
                          alt="Featured Thumbnail" />
                      <?php } ?>
                  </a>
              </div>

              <ul class="list-unstyled d-flex flex-row gap-3">
                  <li><i class="ti ti-location"></i>
                      <?php //echo get_post_meta($post->ID, "distination", true); ?>Passengers 12 </li>
                  <li><i class="ti ti-clock"></i> <?php echo get_post_meta($post->ID, "duration_time", true); ?>Luggage
                      10-12 </li>
              </ul>
          </div>
      </div>
  </div>