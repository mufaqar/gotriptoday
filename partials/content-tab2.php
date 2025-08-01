<div class="hero-content home-one">
    <h2 class="text-white mb-5 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1000ms">
        Explore around, wherever you are, in one day.</h2>

    <div class="hero-search-form wow fadeInUp" data-wow-delay="900ms" data-wow-duration="1000ms">
        <form class="row align-items-center g-3 g-xxl-2" method="GET"
            action="<?php echo esc_url(home_url('/day-trips')); ?>">
            <div class="col-12 col-md-6 col-xxl">
                <div class="search-item d-flex align-items-center gap-3">
                    <div class="icon">
                        <i class="ti ti-map-pin"></i>
                    </div>
                    <div class="form-group">
                        <label for="location" class="form-label">Location</label>
                        <?php                              
                            $terms = get_terms([
                                'taxonomy' => 'tour_city',
                                'hide_empty' => false,
                            ]); ?>
                        <select name="location" id="location" class="touria-select">
                            <?php foreach ($terms as $term): ?>
                            <option value="<?php echo esc_html($term->slug);  ?>">
                                <?php echo esc_html($term->name); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>
            </div>

            <div class="col-xxl">
                <div class="search-item d-flex align-items-center gap-3">
                    <div class="icon">
                        <i class="ti ti-calendar"></i>
                    </div>
                    <div class="form-group d-flex align-items-end">
                        <div>
                            <label class="form-label d-block" for="departure-date">Departure Date</label>
                            <input type="date" id="check-out" class="form-control">
                        </div>

                    </div>
                </div>
            </div>




            <div class="col-12 col-md-6 col-xxl-2">
                <button type="submit" class="btn btn-success w-100">Search Now</button>
            </div>
        </form>

    </div>
</div>