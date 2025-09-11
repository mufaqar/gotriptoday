<div class="tour-filters">
    <div class="filter_card">
        <h4 class="widget-title mb-4">Tour Duration</h4>
        <?php
        $terms = get_terms([
            'taxonomy' => 'tour-duration',
            'hide_empty' => true,
        ]);
        if (!empty($terms) && !is_wp_error($terms)): ?>
            <ul class="sidebar-checkbox-list list-unstyled">
                <?php foreach ($terms as $term): ?>
                    <li>
                        <div class="form-check pl-2">
                            <input class="form-check-input tour-filter-checkbox" type="checkbox"
                                id="term-<?php echo esc_attr($term->term_id); ?>" value="<?php echo esc_attr($term->slug); ?>">
                            <label class="form-check-label flex-grow-1 ms-2" for="term-<?php echo esc_attr($term->term_id); ?>">
                                <?php echo esc_html($term->name); ?>
                            </label>
                            <span class="text-muted"><?php echo esc_html($term->count); ?></span>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <hr class="my-2" />
    <div class="filter_card">
        <h4 class="widget-title mb-4">Properties</h4>
        <?php
        $terms = get_terms([
            'taxonomy' => 'toour-properties',
            'hide_empty' => true, // Set true to hide empty categories
        ]);

        if (!empty($terms) && !is_wp_error($terms)):
            ?>

            <ul class="sidebar-checkbox-list list-unstyled">
                <?php foreach ($terms as $term): ?>
                    <li>
                        <div class="form-check pl-2">
                            <input class="form-check-input tour-filter-checkbox" type="checkbox"
                                id="term-<?php echo esc_attr($term->term_id); ?>" value="<?php echo esc_attr($term->slug); ?>">
                            <label class="form-check-label flex-grow-1 ms-2" for="term-<?php echo esc_attr($term->term_id); ?>">
                                <?php echo esc_html($term->name); ?>
                            </label>
                            <span class="text-muted"><?php echo esc_html($term->count); ?></span>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
<div class="text-end mt-3 d-flex align-items-end justify-content-end">
    <button class="btn btn-secondary me-2">Clear All Filters</button>
    <button class="btn btn-success">Apply Filters</button>
</div>