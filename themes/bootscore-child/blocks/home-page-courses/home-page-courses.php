<?php
/**
 * CE Home Page Courses Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$featured_courses = get_field('courses');

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container courses-slider';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="">
    <?php 
        if( $featured_courses ):
        foreach( $featured_courses as $course ): 
            $permalink = get_permalink( $course->ID );
            $title = get_the_title( $course->ID );
            //$content = get_post_field('post_content', $course->ID); 
            $content = get_the_excerpt( $course->ID ); 

            $button_text = "Learn More";
            $product_link = get_the_permalink();
           
            
            if ( is_user_logged_in() ) {
                //if there is a logged in user, get the product's related learndash courses
                //note this returns a multidimensional array
                $related_courses = get_post_meta($course->ID, '_related_course');
                //echo $related_courses[0][0];
                //echo var_dump($related_courses);
                if ($related_courses) {
                    //get what courses the user in enrolled in, if any
                    $user_courses = learndash_user_get_enrolled_courses(get_current_user_id());
                    //see how many related courses there are for this product (more than one is a bundle)
                    //note this returns a single dimensional array
                    $related_courses_count = count($related_courses[0]);
                    //if there's only one related course, check to see if user is enrolled in it
                    if ($related_courses_count == 1 && in_array($related_courses[0][0], $user_courses)) {
                        //change $permalink to go to course instead of product
                        $button_text = "Continue Study";
                        $permalink = learndash_get_course_url($related_courses[0][0]);
                    } 
                }  
            } 
        ?>
        <div class="woocommerce item-listing col-md-6 col-lg-4 p-2 my-1">

            <div class="card h-100">
                <?php 

                $image = get_field('card_image', $course->ID);
                if( !empty( $image ) ) { ?>
                    <a href="<?php echo $permalink;?>"><img src="<?php echo esc_url($image['url']); ?>" class="card-img-top" alt="<?php echo esc_attr($image['alt']); ?>" /></a>
                    <?php } else { ?>
                        <a href="<?php echo $permalink;?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/thumbnail-scifi.jpg" class="card-img-top" alt="Science Fiction Illustration"></a>
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title"><a href="<?php echo $permalink;?>"><?php echo $title; ?></a></h5>
                        <p class="card-text"><small class="text-muted"><?php ce_courseloop_instructors($course->ID); ?></small></p>
                        <p class="card-text card_course_start">
                            <?php if ( get_field('course_type', $course->ID) == "Live Course" ) { echo '<small class="text-muted">' . the_field('course_duration', $course->ID) . 's </small><span class="badge bg-secondary ms-2 mt-1">Live</span>';} ?>
                        </p>
                        <?php echo $content; ?>

                    </div>
                    <div class="card-footer bg-transparent text-muted border-top-0">
                        <div class="d-grid pt-2">
                            <a href="<?php echo $permalink;?>" class="btn btn-primary btn-block border-0 mb-2"><?php echo $button_text; ?></a>
                        </div>
                    </div>
                </div>
            </div>
    <?php 
        endforeach;
        endif; 
    ?>
</div>