 <section class="related-tours">
     <div class="divider"></div>
     <div class="container">
         <div class="row g-5">

         <h2>Day trips that might interest you</h2>
             <?php
                            $args = array(
                                'post_type' => 'tours',
                                'posts_per_page' =>3,
                                'post_status' => 'publish',
                            );

                            $tours_query = new WP_Query($args);
                            if ($tours_query->have_posts()):
                                while ($tours_query->have_posts()):
                                    $tours_query->the_post();
                                     echo '<div class="col-12 col-lg-4">';
                                    get_template_part('partials/tour', 'card'); 
                                    echo '</div>';
                                endwhile;
                                wp_reset_postdata();
                            else:
                                echo '<p>No tours found.</p>';
                            endif;
             ?>
         </div>
     </div>
 </section>