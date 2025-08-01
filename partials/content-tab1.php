<div class="hero-content home-one">
    <h2 class="text-white mb-5 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1000ms">Your Journey Begins in
        Comfort and Style</h2>

    <div class="flight-type-selector mb-4 wow fadeInUp" data-wow-delay="900ms" data-wow-duration="1000ms">
        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
            <!-- One Way -->
            <label class=" btn-flight-type active">
                <input type="radio" name="flightType" id="oneway" autocomplete="off" checked>
                One way
            </label>

            <!-- Return -->
            <label class=" btn-flight-type">
                <input type="radio" name="flightType" id="return" autocomplete="off">
                Return
            </label>
        </div>
    </div>
    <div class="hero-search-form wow fadeInUp" data-wow-delay="900ms" data-wow-duration="1000ms">
        <form class="row align-items-center g-3 g-xxl-2" method="GET"
            action="<?php echo esc_url(home_url('/day-trips')); ?>">
            <div class="col-xxl">
                <div class="search-item d-flex align-items-center gap-3">
                    <div class="icon">
                        <i class="ti ti-map-pin"></i>
                    </div>
                    <div class="form-group">
                        <label for="location" class="form-label">City From</label>
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
                        <i class="ti ti-map-pin"></i>
                    </div>
                    <div class="form-group">
                        <label for="location" class="form-label">To City</label>
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

            <div class="col-xxl return-date-field" style="display: none;">
                <div class="search-item d-flex align-items-center gap-3">
                    <div class="icon">
                        <i class="ti ti-calendar"></i>
                    </div>
                    <div class="form-group">
                        <label for="adults" class="form-label">Return Date</label>
                        <input type="date" id="check-out" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-xxl">
                <button type="submit" class="btn btn-success w-100">Search Now</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const oneWayRadio = document.getElementById('oneway');
    const returnRadio = document.getElementById('return');
    const returnDateField = document.querySelector('.return-date-field');

    // Initial check
    if (returnRadio.checked) {
        returnDateField.style.display = 'block';
    }

    // Add event listeners
    oneWayRadio.addEventListener('change', function() {
        returnDateField.style.display = 'none';
    });

    returnRadio.addEventListener('change', function() {
        returnDateField.style.display = 'block';
    });
});

// This ensures the active state works properly
document.querySelectorAll('.btn-flight-type').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-flight-type').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>