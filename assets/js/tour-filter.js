jQuery(document).ready(function($) {
    // Handle checkbox change event
    $('.tour-filter-checkbox').on('change', function() {
        // Collect selected filters
     
        let durations = [];
        let properties = [];

        // Get selected duration filters
        $('.sidebar-checkbox-list .tour-filter-checkbox:checked').each(function() {
            if ($(this).closest('.sidebar-widget').find('.widget-title').text().includes('Tour Duration')) {
                durations.push($(this).val());
            }
        });

        // Get selected properties filters
        $('.sidebar-checkbox-list .tour-filter-checkbox:checked').each(function() {
            if ($(this).closest('.sidebar-widget').find('.widget-title').text().includes('Properties')) {
                properties.push($(this).val());
            }
        });

        // Send AJAX request
        $.ajax({
            url: tourFilter.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_tours',         
                durations: durations,
                properties: properties,
                nonce: tourFilter.nonce
            },
            beforeSend: function() {
                // Show loading indicator
                $('#tour-results').html('<p>Loading...</p>');
            },
            success: function(response) {
                if (response.success) {
                    $('#tour-results').html(response.data.html);
                } else {
                    $('#tour-results').html('<p>No tours found.</p>');
                }
            },
            error: function() {
                $('#tour-results').html('<p>An error occurred. Please try again.</p>');
            }
        });
    });
});