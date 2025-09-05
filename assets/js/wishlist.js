jQuery(document).ready(function($) {

    // ------------------------
    // Toggle Wishlist on Click
    // ------------------------
    $(document).on('click', '.wishlist_btn', function(e) {
        e.preventDefault();

        var $btn = $(this);
        var tourId = $btn.data('tour-id');
        var $icon = $btn.find('i');

        var wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        if (wishlist.includes(tourId)) {
            // remove
            wishlist = wishlist.filter(id => id !== tourId);
            $btn.removeClass('added');
            $icon.removeClass('active');
        } else {
            // add
            wishlist.push(tourId);
            $btn.addClass('added');
            $icon.addClass('active');
        }

        localStorage.setItem('wishlist', JSON.stringify(wishlist));
    });

    // ------------------------
    // Restore State on Page Load
    // ------------------------
    $('.wishlist_btn').each(function() {
        var $btn = $(this);
        var tourId = $btn.data('tour-id');
        var wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

        if (wishlist.includes(tourId)) {
            $btn.addClass('added');
            $btn.find('i').addClass('active');
        }
    });

    // ------------------------
    // Remove from Wishlist (on wishlist page)
    // ------------------------
    $(document).on('click', '.remove-wishlist', function() {
        var id = $(this).data('id');
        var wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        wishlist = wishlist.filter(i => i != id);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        $(this).closest('li').remove();

        // if empty, show message
        if ($('#wishlist-list li').length === 0) {
            $('#wishlist-items').html('<p>Your wishlist is empty.</p>');
        }
    });

    // ------------------------
    // Display Wishlist Items
    // ------------------------
    function displayWishlist() {
        var wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        var $wishlistItems = $('#wishlist-items');

        if (wishlist.length === 0) {
            $wishlistItems.html('<p>Your wishlist is empty.</p>');
            return;
        }

        $wishlistItems.html('<ul id="wishlist-list"></ul>');

        wishlist.forEach(function(tourId) {
            $.ajax({
                   url: '/wp-admin/admin-ajax.php', 
                type: 'GET',
                dataType: 'json', // auto-parses JSON
                data: {
                    action: 'get_tour_details',
                    tour_id: tourId
                },
                success: function(data) {
                    $('#wishlist-list').append(
                        '<li>' +
                            '<a href="' + data.permalink + '">' + data.title + '</a>' +
                            ' <button class="remove-wishlist" data-id="' + tourId + '">Remove</button>' +
                        '</li>'
                    );
                },
                error: function() {
                    $('#wishlist-list').append('<li>Error loading tour.</li>');
                }
            });
        });
    }

    // Only run display on wishlist page
    if ($('#wishlist-items').length) {
        displayWishlist();
    }

});
