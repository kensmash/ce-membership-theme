<?php 
$link = get_sub_field('button_link');
$background_image = get_sub_field('slide_image'); 
if (!$background_image) {
    $background_image = get_stylesheet_directory_uri() . '/assets/images/hero-area-block-bg-alt.jpg';
} 
?>

<div class="container-fluid hero-block-content-container" style="background-image: url(<?php echo esc_url($background_image['url']); ?>); background-repeat: no-repeat; background-size: cover; background-position: center;">

    <div class="container h-100">

       <div class="row h-100 justify-content-lg-between row-cols-1 row-cols-sm-1 row-cols-md-2">
                
            <div class="col">
            </div>

            <div class="col col-lg-6 hero-block-content-container h-100 d-flex align-items-center">
                <div class="hero-slider-announcement rounded-1">
                    <h1 class="text-light"><?php echo esc_html(get_sub_field('headline') ); ?></h1>
                    <p class="text-light"><?php echo esc_html(get_sub_field('description') ); ?></p>
                    <div class="d-grid gap-2 pt-3">
                        <a class="anchorlink btn btn-success" href="<?php echo esc_url( $link ); ?>" role="button"><?php echo esc_html(get_sub_field('button_text') ); ?></a>
                    </div> <!-- d-grid -->
                </div> <!-- hero-slider-book-info -->
            </div> <!-- .col -->
            
        </div> <!-- row -->

    </div><!-- container -->

</div><!-- container-fluid -->