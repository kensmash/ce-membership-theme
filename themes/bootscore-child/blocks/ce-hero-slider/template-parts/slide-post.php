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
$featured_posts = get_sub_field('post');

if( $featured_posts ): ?>

    <?php foreach( $featured_posts as $featured_post ): 

        $permalink = get_permalink( $featured_post->ID );
        $title = get_the_title( $featured_post->ID );
        $excerpt = get_the_excerpt( $featured_post->ID );
        $background_image = get_sub_field( 'post_background_image'); 
        if (!$background_image) {
            $background_image = get_stylesheet_directory_uri() . '/assets/images/hero-area-block-bg-alt.jpg';
        }
        ?>

    <div class="container-fluid hero-block-content-container" style="background-image: url(<?php echo esc_url($background_image); ?>)">

    <div class="container">

        <div class="row justify-content-lg-between row-cols-1 row-cols-sm-1 row-cols-md-2">
                
            <div class="col">
            </div>

            <div class="col col-xl-4 col-xxl-5 hero-block-content-container pt-4">

                <h1><?php echo $title; ?></h1>

                <?php echo $excerpt; ?>

                <div class="d-grid gap-2 pt-4">
                    <a class="btn btn-success" href="<?php echo esc_url($permalink); ?>">Learn More</a>
                </div>
                
            </div> <!-- .col -->
            
        </div> <!-- row -->

    </div><!-- container -->
       
    <?php 
        endforeach; 
        endif; 
    ?>

</div>




