<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .header {
        background-color: #28a745;
        color: white;
        padding: 20px;
        text-align: center;
    }

    .content {
        padding: 20px;
        border: 1px solid #ddd;
    }

    .footer {
        margin-top: 20px;
        text-align: center;
        font-size: 12px;
        color: #777;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Booking Confirmed!</h1>
        </div>

        <div class="content">
            <p>Hello,</p>
            <p>Thank you for your booking. Here are your details:</p>

            <h3>Booking Information</h3>
            <p><strong>Booking ID:</strong> <?php echo get_the_title($booking_id); ?></p>
            <p><strong>Tour:</strong> <?php echo get_the_title(get_post_meta($booking_id, 'tour_id', true)); ?></p>
            <p><strong>Amount Paid:</strong> €<?php echo get_post_meta($booking_id, 'amount', true); ?></p>

            <p>We look forward to seeing you!</p>
        </div>

        <div class="footer">
            <p>If you have any questions, please contact us at support@yoursite.com</p>
        </div>
    </div>
</body>

</html>