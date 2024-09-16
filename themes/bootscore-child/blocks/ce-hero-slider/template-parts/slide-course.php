<?php
/**
 * Template part for displaying the Home page hero area on tablets/desktops
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Comics_Experience_2019
 */

?>

<?php
$featured_courses = get_sub_field('course');

if( $featured_courses ): ?>

    <div class="container">

    <?php foreach( $featured_courses as $featured_course ): 

        $permalink = get_permalink( $featured_course->ID );
        $title = get_the_title( $featured_course->ID );
        $excerpt = get_the_excerpt( $featured_course->ID );
        $image = get_field( 'hero_image', $featured_course->ID ); ?>

        <div>

        <?php if( !empty( $image ) ) { ?>
                    
                    <img src="<?php echo esc_url($image['url']); ?>" class="card-img" alt="<?php echo esc_attr($image['alt']); ?>" />
                
                <?php } else { ?>
                
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/images/gui/hero-bgs/hero-bg-fantasy.jpg" class="card-img" alt="Fantasy Illustration">
                    
                <?php } ?>
               
                        <h2 class="mt-2"><?php echo $title; ?></h2>
                        <div class="pr-4"><?php echo $excerpt; ?></div>
                    
                        <a href="<?php echo $permalink; ?>"><button type="button" class="btn btn-info mt-lg-3 border-0">View Course</button></a>

        </div>

    <?php endforeach; ?>

    </div> <!-- container -->

<?php endif; ?>




