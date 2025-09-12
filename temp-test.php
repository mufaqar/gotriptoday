<?php
/*Template Name: Test */
get_header(); ?>

<div class="tour-details-section">
    <div class="divider"></div>
    <div class="container">
        <div class="divider-sm"></div>

        <form class="single_tour_booking" id="tourForm" method="POST" 
            <label>Tour Date</label>
            <input type="date" id="tour_date" name="tour_date" required>
            <div class="error text-danger" id="error-date"></div>
            <br>

            <label>Traveler Selection</label>
            <select id="traveler_selection" name="traveler_selection" required>
                <option value="">Select Travelers</option>
                <option value="1">1 Person</option>
                <option value="2">2 People</option>
            </select>
            <div class="error text-danger" id="error-travelers"></div>
            <br>

            <div class="col-12 gap-2 py-2 tour_times">
                <label for="tour_time" class="form-label mb-0 text-heading">Start Time</label>
                <?php
                function generateTimeSlots($start_time, $end_time, $interval_minutes) {
                    $times = [];
                    $start = strtotime($start_time);
                    $end = strtotime($end_time);
                    $interval_seconds = $interval_minutes * 60;

                    while ($start <= $end) {
                        $times[] = date('h:i A', $start);
                        $start += $interval_seconds;
                    }

                    return $times;
                }

                $start_time = '09:00 AM';
                $end_time   = '05:00 PM';
                $interval   = 30; 
                $time_slots = generateTimeSlots($start_time, $end_time, $interval);
                ?>

                <select name="tour_time" id="tour_time" class="" required>
                    <option value="" selected disabled>Select Time</option>
                    <?php foreach ($time_slots as $index => $time): ?>
                        <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="error text-danger" id="error-time"></div>
            </div>
            <br>

            <button type="submit">Book Now</button>
        </form>

        <script>
        document.getElementById("tourForm").addEventListener("submit", function(e) {
            let hasError = false;

            // reset old errors
            document.querySelectorAll(".error").forEach(el => el.innerHTML = "");

            let tourDate   = document.getElementById("tour_date").value.trim();
            let travelers  = document.getElementById("traveler_selection").value.trim();
            let tourTime   = document.getElementById("tour_time").value.trim();

            if (!tourDate) {
                document.getElementById("error-date").innerHTML = "Please select a tour date.";
                hasError = true;
            }
            if (!travelers) {
                document.getElementById("error-travelers").innerHTML = "Please select number of travelers.";
                hasError = true;
            }
            if (!tourTime) {
                document.getElementById("error-time").innerHTML = "Please select a tour time.";
                hasError = true;
            }

            if (hasError) {
                e.preventDefault(); // stop form submission
            }
        });
        </script>

<?php get_footer(); ?>
