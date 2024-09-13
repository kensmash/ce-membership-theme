<?php
/**
 * CE Courses Block template.
 *
 * @param array $block The block settings and attributes.
 */

$courses_array = [];

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container px-0 ce-courses';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>


<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

    <div class="row g-0">

        <?php 
        //get courses that are on sale, we need to show them first
        $query = new WP_Query(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query'           => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug', 
                    'terms' => array( 'courses' ),
                    'operator' => 'IN'
                ),
            ),
            'meta_query'        => WC()->query->get_meta_query(),
            'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
            'orderby'        => 'menu_order',
            'order' => 'ASC', 
        ));


        if ( $query->have_posts() ) {

            while ( $query->have_posts() ) {

                $query->the_post();

                $button_text = "Learn More";
                $product_link = get_the_permalink();
                $image = get_field('card_image', get_the_ID());
                $course_type = get_field('course_type', get_the_ID());
                $course_duration = get_field('course_duration', get_the_ID());

                if ( is_user_logged_in() ) {
                    //if there is a logged in user, get the product's related learndash courses
                    //note this returns a multidimensional array
                    $related_courses = get_post_meta(get_the_ID(), '_related_course');
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
                            //change $product_link to go to course instead of product
                            $button_text = "Continue Study";
                            $product_link = learndash_get_course_url($related_courses[0][0]);
                        } 
                    }  
                } 
                        
                $courses_array[] = array(
                    'id'				=> get_the_ID();
                    'title' 			=> get_the_permalink();
                    'excerpt'           => get_the_excerpt();
                    'product_link' 		=> $product_link;
                    'button_text' 		=> $button_text;  
                    'image'             => $image; 
                    'course_type'       => $course_type; 
                    'course_duration'   => $course_duration; 
                );

        }
                
        }

        wp_reset_postdata(); 


        //now get courses that are NOT on sale
        $query = new WP_Query(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query'           => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug', 
                    'terms' => array( 'courses' ),
                    'operator' => 'IN'
                ),
            ),
            'orderby'        => 'menu_order',
            'order' => 'ASC', 
        ));

       
        if ( $query->have_posts() ) {
        
            while ( $query->have_posts() ) {
        
                $query->the_post();

                $button_text = "Learn More";
                $product_link = get_the_permalink();
                $image = get_field('card_image', get_the_ID());
                $course_type = get_field('course_type', get_the_ID());
                $course_duration = get_field('course_duration', get_the_ID());
        
                if ( is_user_logged_in() ) {
                    //if there is a logged in user, get the product's related learndash courses
                    //note this returns a multidimensional array
                    $related_courses = get_post_meta(get_the_ID(), '_related_course');
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
                            //change $product_link to go to course instead of product
                            $button_text = "Continue Study";
                            $product_link = learndash_get_course_url($related_courses[0][0]);
                        } 
                    }  
                } 
                        
                $courses_array[] = array(
                    'id'				=> get_the_ID();
                    'title' 			=> get_the_permalink();
                    'excerpt'           => get_the_excerpt();
                    'product_link' 		=> $product_link;
                    'button_text' 		=> $button_text;  
                    'image'             => $image; 
                    'course_type'       => $course_type; 
                    'course_duration'   => $course_duration; 
                );

           }
                
        }

         wp_reset_postdata(); ?>

     </div> <!-- row -->

</div><!-- .container -->