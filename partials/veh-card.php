  <div class="col-12 col-sm-6 col-lg-4">
      <!-- Blog Card -->
      <div class="blog-card style-two wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">

          <!-- Post Body -->
          <div class="post-body">

              <h3> <a class="post-title h4" href="<?php the_permalink() ?>"><?php the_title()?></a></h3>
              <p> <?php echo get_post_meta($post->ID, "car_equivalent", true); ?></p>

              <div class="post-img mb-3">
                  <a  href="<?php the_permalink() ?>">
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
                     <?php echo get_post_meta($post->ID, "passengers", true); ?> Passengers  </li>
                  <li><?php echo get_post_meta($post->ID, "large_bag", true); ?> <i class="ti ti-clock"></i> Luggage    </li>
              </ul>
          </div>
      </div>
  </div>