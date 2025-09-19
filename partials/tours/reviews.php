<?php $args = isset($args) ? $args : array();
$tour_comments = isset($args['tour_comments']) ? $args['tour_comments'] : array();
$review_count = isset($args['review_count']) ? $args['review_count'] : 0; 
// Limit to 2 comments only
$tour_comments = array_slice($tour_comments, 0, 2);
?>


<div class="tour_reviews">
    <div class="d-flex flex-lg-row flex-column justify-content-between">
        <h2 class="pb-3">Why travelers loved this</h2>
        <!-- <h4><i class='text-success pe-1 ti ti-star-filled'></i> 4.9 · 
        <p class="d-inline-flex text-black text-decoration-underline"><?php //echo $review_count ?> Reviews</p>
        </h4> -->
    </div>
    <div class="review_list d-flex flex-lg-row flex-column gap-4">
        <?php if (!empty($tour_comments)): ?>
            <?php foreach ($tour_comments as $c): ?>
                <div class="review_box col-12 col-lg-6">
                    <div class="d-flex flex-lg-row flex-column justify-content-between">
                        <ul class="list-unstyled d-flex">
                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                            <li><i class='text-success pe-1 ti ti-star-filled'></i></li>
                        </ul>
                        <p class="d-inline-flex"><?php echo esc_html($c['author']); ?>·
                            <?php echo esc_html($c['date']); ?>
                        </p>
                    </div>
                    <p><?php echo esc_html($c['content']); ?></p>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>