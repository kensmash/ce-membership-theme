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

    <?php foreach( $featured_courses as $featured_course ): 

        $product = new WC_Product($featured_course->ID);
        $permalink = get_permalink( $featured_course->ID );
        $title = get_the_title( $featured_course->ID );
        $excerpt = get_the_excerpt( $featured_course->ID );
        $start_date = get_field( 'start_date', $featured_course->ID );
        $background_image = get_sub_field( 'course_background_image'); 
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

                <?php if ( $product->is_on_sale() )  {    
                    echo '<p class="h4 mb-3"><span class="badge rounded-pill bg-success">Now On Sale!</span></p>';
                } ?>
               
                <?php if ($start_date): ?>
                    <strong class="d-inline-block mb-3 <?php echo ($product->is_on_sale()) ? "mts-4" : "ms-0" ?>">Starts <?php echo date('F j, Y', strtotime($start_date)); ?></strong>
                <?php endif; ?>

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




