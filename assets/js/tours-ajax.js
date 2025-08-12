jQuery(document).ready(function($) {
    // Handle category filter changes
    $('#category-filter').on('change', '.tour-filter-checkbox', function() {
        filterTours();
    });
    
    function filterTours() {
        // Show loading spinner
        $('#loading-spinner').show();
        
        // Get selected categories
        var selectedCategories = [];
        $('#category-filter input:checked').each(function() {
            selectedCategories.push($(this).val());
        });
        
        // AJAX request
        $.ajax({
              url: tours_ajax.ajaxurl, // Use the localized variable
            type: 'POST',
            data: {
              action: 'filter_tours',
                categories: selectedCategories,
                nonce: tours_ajax_obj.nonce
            },
            success: function(response) {
                $('#tour-results').html(response);
                $('#loading-spinner').hide();
            },
            error: function() {
                $('#tour-results').html('<p>There was an error loading tours. Please try again.</p>');
                $('#loading-spinner').hide();
            }
        });
    }
});