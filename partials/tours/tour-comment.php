<?php


$avg = get_tour_average_rating(get_the_ID());
if ($avg) {
    echo '<p class="avg-rating">Average Rating: ' . $avg . ' / 5</p>';
}