<div id="tour_booking" class="sidebar-widget">
     <?php $tour_price = get_discounted_price($post->ID, false);
     $discounted_price = get_discounted_price($post->ID, false);     
     ?>
     <div class="h4 fw-bold mb-4">From €<?php echo $discounted_price ?><span class="h6"> Per Person</span>
     </div>
     <form class="single_tour_booking" method="GET" action="<?php echo home_url('/booking-details'); ?>">
         <input type="hidden" id="tour_id" name="tour_id" value="<?php echo $post->ID ?>">
         <input type="hidden" id="tour_price" name="tour_price" value="<?php echo $tour_price; ?>">
         <input type="hidden" id="adult_count_input" name="adult_count" value="1">
         <input type="hidden" id="child_count_input" name="child_count" value="0">
         <div class="row">
             <div class="col-12 gap-2 py-2 tour_date">
                 <label for="tour_date" class="form-label mb-0 text-heading">Date</label>
                 <input type="date" id="tour_date" name="tour_date" class="form-control p-0 bg-transparent h-auto"
                     value="<?php echo date('Y-m-d'); ?>" required>



             </div>
             <div class="col-12 gap-2 py-2 tour_times">
                 <label for="tour_time" class="form-label mb-0 text-heading">Start Time</label>
                 <?php             
                        $start_time = '09:30 AM';
                        $end_time = '05:00 PM';
                        $interval = 30; 
                        $time_slots = generateTimeSlots($start_time, $end_time, $interval);
                     ?>
                 <select name="tour_time" id="tour_time" class="py-2 bg-transparent" required>
                     <option value="09:00 AM" selected >09:00 AM</option>
                     <?php foreach ($time_slots as $index => $time): ?>
                     <option value="<?php echo $index + 2; ?>"><?php echo $time; ?></option>
                     <?php endforeach; ?>
                 </select>
             </div>
             <div class="col-12 gap-2 py-2 tour_travelers">
                 <label class="form-label mb-0 text-heading">Travelers</label>
                 <div class="traveler-selection" onclick="openTravelerModal()" required>
                     <span id="traveler-summary">1 Adult, 0 Children</span>
                     <i class="ti ti-chevron-down float-end"></i>
                 </div>
                 
             </div>
             
         </div>
         
         <!-- Car Type Display Section -->
         <div class="row my-2">
             <div class="car-type-info p-3 rounded" style="background-color: #f8f9fa; border: 1px solid #e9ecef;">                 
                 <div id="car-type-display">
                     <p class="mb-1"><i class="ti ti-car"></i> <strong>Sedan (1–3 Persons)</strong></p>                  
                     <p class="mb-1 small"><i class="ti ti-luggage"></i> Luggage: 2 large + 2 small</p>                    
                 </div>
             </div>
         </div>
         
         <div class="row">
             <div class="tour-booking-summary py-2">
                 <ul class="list-unstyled d-flex flex-column gap-2 bg-white p-0">
                     <li class="d-none">
                         <span><strong>Adult (<span id="summary-adult-count">1</span>x):</strong></span>
                         <span id="price-per-adult">€<?php echo $tour_price; ?></span>
                     </li>
                     <li id="child-price-item " class="d-none" style="display: none;">
                         <span><strong>Child (<span id="summary-child-count">0</span>x):</strong></span>
                         <span id="price-per-child">€0.00</span>
                     </li>
                     <li class="">
                         <span><strong>Total:</strong></span>
                         <span id="total_price"><strong>€<?php echo $tour_price * 3; ?></strong></span>
                     </li>
                 </ul>
             </div>
         </div>
         <div class="col-12 mt-4">
             <button type="submit" class="btn btn-success w-100">Check Availability <i
                     class="icon-arrow-right"></i></button>
         </div>
         <div class="col-12 mt-4">
             <ul class="list-unstyled d-flex flex-column gap-2">
                 <li>
                     <i class='ti ti-circle-check-filled'></i> <strong class="text-decoration-underline">Free
                         cancellation</strong> Free
                     cancellation up to 24 hours
                 </li>
                 <li>
                     <i class='ti ti-circle-check-filled'></i><strong class="text-decoration-underline"> Reserve Now and
                         Pay Later </strong> -
                     Secure
                     your spot while staying flexible
                 </li>
             </ul>
         </div>

         <div class="col-12 mt-4 p-2 pb-0 book_ahead">
             <ul class="list-unstyled d-flex flex-column gap-2">
                 <li>
                     <i class="ti ti-flame" style="color: #e25a3a;font-size: 120%;"></i>
                     <strong>Book ahead!</strong><br />
                     On average, this is booked 37 days in advance.
                 </li>
             </ul>
         </div>
     </form>
 </div>


 <!-- Traveler Selection Modal -->
<div class="traveler-modal" id="traveler-modal">
    <div class="traveler-modal-content">
        <h3 class="mb-3">Select Travelers</h3>
        <div class="info-text">
            You can select up to 14 travelers in total.
        </div>
        <div class="age-group">
            <div class="age-title">Adult (Age 13-99)</div>
            <div class="age-range">Minimum: 1, Maximum: 14</div>
            <div class="counter">
                <div class="counter-btn minus-btn" data-group="adult" onclick="updateCounter('adult', -1)">-</div>
                <div class="counter-value" id="adult-count">1</div>
                <div class="counter-btn plus-btn" data-group="adult" onclick="updateCounter('adult', 1)">+</div>
            </div>
        </div>

        <div class="age-group">
            <div class="age-title">Child (Age 0-12)</div>
            <div class="age-range">Minimum: 0, Maximum: 14</div>
            <div class="counter">
                <div class="counter-btn minus-btn" data-group="child" onclick="updateCounter('child', -1)">-</div>
                <div class="counter-value" id="child-count">0</div>
                <div class="counter-btn plus-btn" data-group="child" onclick="updateCounter('child', 1)">+</div>
            </div>
        </div>

        <button class="apply-btn" onclick="applyTravelerSelection()">Apply</button>
    </div>
</div>


 <script>
let adultCount = 1;
let childCount = 0;
const maxTravelers = 14;
const tourPrice = <?php echo $tour_price; ?>;

function openTravelerModal() {
    document.getElementById('traveler-modal').style.display = 'flex';
}

function closeTravelerModal() {
    document.getElementById('traveler-modal').style.display = 'none';
}

function updateCounter(type, change) {
    if (type === 'adult') {
        if (change === 1 && (adultCount + childCount) < maxTravelers) {
            adultCount++;
        } else if (change === -1 && adultCount > 1) {
            adultCount--;
        }
    } else if (type === 'child') {
        if (change === 1 && (adultCount + childCount) < maxTravelers) {
            childCount++;
        } else if (change === -1 && childCount > 0) {
            childCount--;
        }
    }

    document.getElementById('adult-count').textContent = adultCount;
    document.getElementById('child-count').textContent = childCount;

    // Update button states
    document.querySelectorAll('.counter-btn').forEach(btn => {
        const group = btn.getAttribute('data-group');
        const isMinus = btn.classList.contains('minus-btn');

        if (group === 'adult') {
            if (isMinus) {
                btn.disabled = adultCount <= 1;
                btn.style.opacity = adultCount <= 1 ? 0.5 : 1;
            } else {
                btn.disabled = (adultCount + childCount) >= maxTravelers;
                btn.style.opacity = (adultCount + childCount) >= maxTravelers ? 0.5 : 1;
            }
        } else if (group === 'child') {
            if (isMinus) {
                btn.disabled = childCount <= 0;
                btn.style.opacity = childCount <= 0 ? 0.5 : 1;
            } else {
                btn.disabled = (adultCount + childCount) >= maxTravelers;
                btn.style.opacity = (adultCount + childCount) >= maxTravelers ? 0.5 : 1;
            }
        }
    });
}

function applyTravelerSelection() {
    // Update summary text
    const summaryText =
        `${adultCount} Adult${adultCount !== 1 ? 's' : ''}${childCount > 0 ? `, ${childCount} Child${childCount !== 1 ? 'ren' : ''}` : ''}`;
    document.getElementById('traveler-summary').textContent = summaryText;

    // Hidden inputs
    document.getElementById('adult_count_input').value = adultCount;
    document.getElementById('child_count_input').value = childCount;

    // Summary counts
  document.getElementById('summary-adult-count').textContent = adultCount;
 document.getElementById('summary-child-count').textContent = childCount;

    // Helper line
    const totalTravelers = adultCount + childCount;
    

    // Update car type display
    updateCarTypeDisplay(totalTravelers);

    // Prices
    updateTotalPrice();

    // Close modal
    closeTravelerModal();
}

function updateCarTypeDisplay(totalTravelers) {
    const carTypeDisplay = document.getElementById('car-type-display');
    let carTypeHTML = '';
    
    if (totalTravelers <= 3) {
        carTypeHTML = `
            <p class="mb-1"><strong>Sedan (1–3 Persons)</strong></p>          
            <p class="mb-1 small"><i class="ti ti-luggage"></i> Luggage: 2 large + 2 small</p>
         
        `;
    } else if (totalTravelers === 4) {
        carTypeHTML = `
            <p class="mb-1"><strong>MPV (4 Persons)</strong></p>          
            <p class="mb-1 small"><i class="ti ti-luggage"></i> Luggage: 3 large + 3 small</p>
           
        `;
    } else if (totalTravelers >= 5 && totalTravelers <= 7) {
        carTypeHTML = `
            <p class="mb-1"><strong>Van (5–7 Persons)</strong></p>          
            <p class="mb-1 small"><i class="ti ti-luggage"></i> Luggage: 6 large + 6 small</p>
        
        `;
    } else if (totalTravelers >= 8 && totalTravelers <= 10) {
        carTypeHTML = `
            <p class="mb-1"><strong>Sedan + Van (7–10 Persons)</strong></p>           
            <p class="mb-1 small"><i class="ti ti-luggage"></i> Luggage: 8–10 large + 8–10 small</p>
          
        `;
    } else if (totalTravelers >= 11 && totalTravelers <= 14) {
        carTypeHTML = `
            <p class="mb-1"><strong>Two Vans / Sprinter (10–14 Persons)</strong></p>
          
            <p class="mb-1 small"><i class="ti ti-luggage"></i> Luggage: 12–14 large + 12–14 small</p>
           
        `;
    }
    
    carTypeDisplay.innerHTML = carTypeHTML;
}

function updateTotalPrice() {
    const selectedPassengers = adultCount + childCount;
    let billablePassengers;

    if (selectedPassengers <= 3) {
        billablePassengers = 3;
    } else if (selectedPassengers === 4) {
        billablePassengers = 4;
    } else if (selectedPassengers >= 5 && selectedPassengers <= 7) {
        billablePassengers = 5;
    } else if (selectedPassengers >= 8 && selectedPassengers <= 10) {
        billablePassengers = 8;
    } else if (selectedPassengers >= 11 && selectedPassengers <= 14) {
        billablePassengers = 10;
    }

    const totalPrice = billablePassengers * tourPrice;

    // Update total only
    document.getElementById('total_price').innerHTML = '<strong>€' + totalPrice.toFixed(2) + '</strong>';
    document.getElementById('tour_price').value = totalPrice.toFixed(2);
}
// Close modal when clicking outside
document.getElementById('traveler-modal').addEventListener('click', function(e) {
    if (e.target === this) closeTravelerModal();
});

// Initialize button states
document.addEventListener('DOMContentLoaded', function() {
    updateCounter('adult', 0);
    updateCounter('child', 0);
    updateTotalPrice();
});
 </script>