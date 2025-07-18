jQuery(document).ready(function($){
    $('#contactForm').on('submit', function(e){
        e.preventDefault();

        var formData = {
            action: 'submit_contact_form',
            security: ajaxContact.nonce,
            name: $('#name').val(),
            email: $('#email').val(),
            subject: $('#subject').val(),
            message: $('#message').val()
        };

        $.ajax({
            url: ajaxContact.ajaxurl,
            type: 'POST',
            data: formData,
            beforeSend: function(){
                $('#formResponse').html('<p>Sending...</p>');
            },
            success: function(response){
                if(response.success){
                    $('#formResponse').html('<p style="color:green;">'+response.data+'</p>');
                    $('#contactForm')[0].reset();
                } else {
                    $('#formResponse').html('<p style="color:red;">'+response.data+'</p>');
                }
            }
        });
    });
});
