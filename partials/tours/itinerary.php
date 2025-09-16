<div class="tour_itinerary d-lg-block d-none">
    <h2 class="pb-3">Trip Itinerary</h2>

    <?php $trip_itinerary = get_post_meta($post->ID, "trip_itinerary", true);
    ?>
    <div>
        <?php
        $counter = 0;
        foreach ($trip_itinerary as $itinerary) {
            $counter++;
            $title = $itinerary['title'];
            $description = $itinerary['description'];
            $ticket_info = $itinerary['ticket_info'];
            ?>
            <div class="itinerary_item">
                <span class="list_marker"><?php echo $counter; ?></span>
                <div>
                    <h5 class="pb-3"> <?php echo $title; ?></h5>
                    <p>
                        <?php echo $description; ?>
                    </p>
                    <p class="itinerary_detail">
                        <?php echo $ticket_info; ?>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<div class="tour_itinerary d-block d-lg-none">
    <h2 class="pb-3">Trip Itinerary</h2>

    <?php $trip_itinerary = get_post_meta($post->ID, "trip_itinerary", true); ?>

    <?php if (!empty($trip_itinerary)) : ?>
        <div class="accordion" id="itineraryAccordion">
            <?php
            $counter = 0;
            foreach ($trip_itinerary as $itinerary) {
                $counter++;
                $title = $itinerary['title'];
                $description = $itinerary['description'];
                $ticket_info = $itinerary['ticket_info'];
                ?>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $counter; ?>">
                        <button 
                            class="accordion-button <?php echo $counter > 1 ? 'collapsed' : ''; ?>" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapse<?php echo $counter; ?>" 
                            aria-expanded="<?php echo $counter === 1 ? 'true' : 'false'; ?>" 
                            aria-controls="collapse<?php echo $counter; ?>">
                            
                            <span class="list_marker me-2"><?php echo $counter; ?>.</span> 
                            <?php echo $title; ?>
                        </button>
                    </h2>

                    <div 
                        id="collapse<?php echo $counter; ?>" 
                        class="accordion-collapse collapse <?php echo $counter === 1 ? 'show' : ''; ?>" 
                        aria-labelledby="heading<?php echo $counter; ?>" 
                        data-bs-parent="#itineraryAccordion">
                        
                        <div class="accordion-body">
                            <p><?php echo $description; ?></p>
                            <p class="itinerary_detail"><?php echo $ticket_info; ?></p>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    <?php endif; ?>
</div>
