<?php
$bg = isset($args['bg']) ? esc_url($args['bg']) : get_template_directory_uri() . '/assets/img/bg-img/97.jpg';
?>

<!-- Breadcrumb Section -->
<div class="breadcrumb-section bg-img jarallax" data-jarallax data-speed="0.6"
    style="background-image: url('<?php echo $bg; ?>');">
    <div class="container">
        <!-- Breadcrumb Content -->
        <div class="breadcrumb-content">
            <div class="divider"></div>
            <h1><?php the_title()?></h1>
           
        </div>
    </div>
    <!-- Divider -->
    <div class="divider"></div>
</div>