jQuery(document).ready(function($) {
    // Handle checkbox change event
    $('.tour-filter-button').on('click', function(e) {
         e.preventDefault();
        const termId = $(this).val(); // get value of button (term_id)

        $('.tour-filter-button').removeClass('active');
            $(this).addClass('active');

            $.ajax({
                url: tourFilter.ajax_url,
                type: 'POST',
                data: {
                    action: 'filter_tours',         
                    termId: termId,
                //  properties: properties,
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