<?php $args = isset($args) ? $args : array();
$review_count = isset($args['review_count']) ? $args['review_count'] : 0;

?>

<div class="tour-details-header d-flex flex-lg-row flex-column gap-lg-4 align-items-start justify-content-between">
    <div class="col-12 col-lg-9">
        <div class="tour-details-meta py-2 mb-3 d-lg-flex d-none">
            <ul class="list-unstyled d-flex flex-wrap gap-2">
                <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
                <li>/</li>
                <li><a href="<?php echo home_url('/day-trips'); ?>">Tours</a></li>
                <li>/</li>
                <li><?php the_title() ?></li>
            </ul>
        </div>
        <h2 class="mb-3"><?php the_title() ?></h2>
        <ul class="list-unstyled mb-3 d-lg-flex d-none flex-row gap-2 align-items-center text-black review_list"
            style="font-size:14px; font-weight: 500;">
            <li class="d-flex flex-lg-row flex-column align-items-center">
                <span class="d-flex">
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                </span>
                <span class="d-lg-inline-flex d-none text-decoration-underline"><?php echo $review_count ?>
                    Reviews</span>
            </li>
            <li>
                <i class=' pe-1 ti ti-rosette-discount-check' style="color: #e25a3a;font-size: 120%;"></i>
                Recommended by 95% of travelers
            </li>
        </ul>
        <ul class="list-unstyled mb-3 d-flex d-lg-none flex-row gap-2 align-items-center text-black review_list"
            style="font-size:14px; font-weight: 500;">
            <li class="d-flex flex-lg-row flex-column align-items-center">
                <span class="d-inline-flex d-lg-none text-decoration-underline"><?php echo $review_count ?>4.9 </span>
                <span class="d-flex">
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                    <i class='text-success pe-1 ti ti-star-filled'></i>
                </span>
            </li>
            <li>
                <i class=' pe-1 ti ti-rosette-discount-check' style="color: #e25a3a;font-size: 120%;"></i>
                Recommended by 95% of travelers
            </li>
        </ul>
    </div>
    <div class="col-12 col-lg-3">
        <ul class="list-unstyled d-lg-flex d-none flex-column gap-1 text-black"
            style="font-size:14px; font-weight: 500;">
            <li> <i class='text-success pe-1 ti ti-phone'></i>
                Book online or call: <a href="tel:+4901701479446" target="_blank" class="text-decoration-underline">+49
                    0 170 1479446</a>
            </li>
            <li> <i class='text-success pe-1 ti ti-brand-wechat'></i>
                <a href="#" target="_blank" class="text-decoration-underline">Chat now</a>
            </li>
        </ul>
        <ul class="list-unstyled d-lg-flex d-none justify-content-lg-end justify-content-start text-black mt-5"
            style="font-size:14px; font-weight: 500;">
            <li style="background-color:#f5f5f5; width: fit-content; padding: .25rem; border-radius: .375rem;">
                <i class='text-success pe-1 ti ti-tag'></i> Lowest Price Guarantee
            </li>
        </ul>
        <a href="#tour_booking" class="btn btn-success w-100 d-lg-none d-flex">Book now</a>
    </div>
</div>