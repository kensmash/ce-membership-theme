<?php
/**
 * Template part for displaying the Home page hero area on tablets/desktops
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Comics_Experience_2019
 */

?>
<div class="container">

    <div class="woocommerce card bg-dark text-white rounded-1 border-0">

    <?php 
    $image = get_field('hero_image');
    if( !empty( $image ) ) { ?>
            
            <img src="<?php echo esc_url($image['url']); ?>" class="card-img" alt="<?php echo esc_attr($image['alt']); ?>" />
        
        <?php } else { ?>
        
            <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/images/gui/hero-bgs/hero-bg-fantasy.jpg" class="card-img" alt="Fantasy Illustration">
            
        <?php } ?>

        <div class="card-img-overlay">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <h2 class="mt-2"><?php the_title(); ?></h2>
                <div class="pr-4"><?php the_excerpt(); ?></div>
            
                <a href="<?php the_permalink();?>"><button type="button" class="btn btn-info mt-lg-3 border-0">View Course</button></a>
            </div>
        </div>
    </div>

</div>