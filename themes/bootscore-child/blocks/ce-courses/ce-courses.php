<?php
/**
 * CE Courses Block template.
 *
 * @param array $block The block settings and attributes.
 */

$courses = [];

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
        //https://www.godaddy.com/resources/skills/get-a-list-of-woocommerce-sale-products
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
            'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
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
                        
                $courses[] = array(
                    'id'				=> get_the_ID(),
                    'title' 			=> get_the_title(),
                    'excerpt'           => get_the_excerpt(),
                    'link' 		        => $product_link,
                    'button_text' 		=> $button_text,
                    'image'             => $image,
                    'type'              => $course_type,
                    'duration'          => $course_duration,
                    'onsale'            => true,
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
            'meta_query'     => array(
                array(
                    'key'     => '_sale_price',
                    'compare' => 'NOT EXISTS',
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
                        
                $courses[] = array(
                    'id'				=> get_the_ID(),
                    'title' 			=> get_the_title(),
                    'excerpt'           => get_the_excerpt(),
                    'link' 		        => $product_link,
                    'button_text' 		=> $button_text,
                    'image'             => $image,
                    'type'              => $course_type,
                    'duration'          => $course_duration,
                    'onsale'            => false,
                );

           }
                
        }

         wp_reset_postdata(); 

         foreach( $courses as $course ): ?>

            <div class="woocommerce item-listing col-md-6 col-lg-4 p-2 my-1">

                <div class="card h-100">
                    <?php 
                    if( !empty( $course['image'] ) ) { ?>
                        <a href="<?php echo $course['link']; ?> "><img src="<?php echo esc_url($course['image']['url']); ?>" class="card-img-top" alt="<?php echo esc_attr($course['image']['alt']); ?>" /></a>
                        <?php } else { ?>
                            <a href="<?php echo $course['link']; ?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/thumbnail-scifi.jpg" class="card-img-top" alt="Science Fiction Illustration"></a>
                        <?php } ?>
                        <div class="card-body">
                            <?php if ( $course['onsale'] ) { echo '<p class="h5 mb-2"><span class="badge rounded-pill bg-success">On Sale</span></p>';} ?>
                            <h5 class="card-title"><a href="<?php echo $course['link']; ?>"><?php echo $course['title']; ?></a></h5>
                            <p class="card-text"><small class="text-muted"><?php ce_courseloop_instructors($course['id']); ?></small></p>
                            <p class="card_course_start">
                                <?php if ( $course['type'] == "Live Course" ) { echo '<small class="text-muted">' . $course['duration'] . 's </small><span class="badge bg-secondary ms-2 mt-1">Live</span>';} ?>
                            </p>
                            <?php echo $course['excerpt']; ?>
                        </div><!-- card-body -->
                        <div class="card-footer bg-transparent text-muted border-top-0">
                            <div class="d-grid pt-2">
                                <a href="<?php echo $course['link']; ?>" class="btn btn-primary btn-block border-0 mb-2"><?php echo $course['button_text']; ?></a>
                            </div>
                        </div><!-- card-footer -->
                </div><!-- card -->

            </div> <!-- item-listing -->

        <?php endforeach; ?>

     </div> <!-- row -->

</div><!-- .container -->