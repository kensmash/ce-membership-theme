<?php
/**
 * CE Courses Block template.
 *
 * @param array $block The block settings and attributes.
 */

$sale_courses_only = get_field('show_only_courses_on_sale');
$courses_type = get_field('courses_type');
$courses = [];
$tax_query = array(
    array(
        'taxonomy' => 'product_cat',
        'field' => 'slug', 
        'terms' => array( 'courses' ),
    ),
);

//only display courses from a certain category if courses_type ACF field is selected
if ($courses_type) {
    if (!is_array($courses_type)) {
        $courses_type = array($courses_type);
    }
    $tax_query = array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug', 
            'terms' => array( 'courses' ),
        ),
        array(
            'taxonomy' => 'product_tag',
            'terms' => $courses_type,
        ),
    );
}


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

    <?php 
        //create filtering buttons to filter by custom taxonomy
        $all_categories = get_terms( array( 
        'taxonomy' => 'courses-category',
        'hide_empty' => true,
    ) );

    if ($all_categories): ?>

        <div>
            <button type="button" data-filter="all">All Courses</button>
            <?php
                foreach($all_categories as $category): ?>
            
                <button type="button" data-filter=".<?php echo $category->slug; ?>"><?php echo $category->name; ?></button>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

    <div class="row g-0">

        <?php 
        //get courses that are on sale, we need to show them first
        //https://www.godaddy.com/resources/skills/get-a-list-of-woocommerce-sale-products
        $query = new WP_Query(array(
            'post_type'         => 'product',
            'post_status'       => 'publish',
            'posts_per_page'    => -1,
            'tax_query'         => $tax_query,
            'meta_query'        => WC()->query->get_meta_query(),
            'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
            'orderby'           => 'menu_order',
            'order'             => 'ASC', 
        ));


        if ( $query->have_posts() ) {

            while ( $query->have_posts() ) {

                $query->the_post();
                //https://www.kunkalabs.com/tutorials/integrating-mixitup-into-your-project/
                $categories = get_the_terms( get_the_ID(), 'course-category' );
                $slugs = wp_list_pluck($categories, 'slug');
                $class_names = join(' ', $slugs);

                //show bundle tag if course is part of a bundle
                $bundled = false;
                $bundled_course = get_field('bundle', get_the_ID());
                if( $bundled_course ):
                    //we are allowing a maximum of one in ACF, so this loop will return one result
                    foreach( $bundled_course as $course ): 
                        $bundled = true;
                        $bundle_permalink = get_permalink( $course->ID );
                        $bundle_title = get_the_title( $course->ID );
                    endforeach; 
                endif;

                $button_text = "Learn More";
                $product_link = get_the_permalink();
                $image = get_field('card_image', get_the_ID());
                $course_type = get_field('course_type', get_the_ID());
                $course_duration = get_field('course_duration', get_the_ID());
                $price = get_post_meta( get_the_ID(), '_price', true );
                $regular_price = get_post_meta( get_the_ID(), '_regular_price', true );
		        $sale_price    = get_post_meta( get_the_ID(), '_sale_price', true );

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
                    'id'				    => get_the_ID(),
                    'title' 			    => get_the_title(),
                    'excerpt'               => get_the_excerpt(),
                    'class_names'           => $class_names,
                    'link' 		            => $product_link,
                    'button_text' 		    => $button_text,
                    'image'                 => $image,
                    'type'                  => $course_type,
                    'duration'              => $course_duration,
                    'onsale'                => true,
                    'price'                 => $price,
                    'regular_price'         => $regular_price,
                    'sale_price'            => $sale_price,
                    'bundled'               => $bundled,
                    'bundle_permalink'      => $bundle_permalink,
                    'bundle_title'          => $bundle_title,
                );

        }
                
        }

        wp_reset_postdata(); 

    if (!$sale_courses_only): 

        //get courses that are NOT on sale
        $query = new WP_Query(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query'         => $tax_query,
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
                //https://www.kunkalabs.com/tutorials/integrating-mixitup-into-your-project/
                $categories = get_the_terms( get_the_ID(), 'courses-category' );
                $slugs = wp_list_pluck($categories, 'slug');
                $class_names = join(' ', $slugs);

                //show bundle tag if course is part of a bundle
                $bundled_course = get_field('bundle', get_the_ID());
                $bundled = false;
                if( $bundled_course ):
                    //we are allowing a maximum of one in ACF, so this loop will return one result
                    foreach( $bundled_course as $course ): 
                        //echo var_dump($course);
                        $bundled = true;
                        $bundle_permalink = get_permalink( $course->ID );
                        $bundle_title = get_the_title( $course->ID );
                    endforeach; 
                endif;

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
                    'id'				    => get_the_ID(),
                    'title' 			    => get_the_title(),
                    'excerpt'               => get_the_excerpt(),
                    'class_names'           => $class_names,
                    'link' 		            => $product_link,
                    'button_text' 		    => $button_text,
                    'image'                 => $image,
                    'type'                  => $course_type,
                    'duration'              => $course_duration,
                    'onsale'                => false,
                    'bundled'               => $bundled,
                    'bundle_permalink'      => $bundle_permalink,
                    'bundle_title'          => $bundle_title,
                );

           }
                
        }

        wp_reset_postdata(); 

        endif; //end getting courses that are not on sale 

        //now loop through the courses array and output courses
        foreach( $courses as $course ): ?>

            <div class="woocommerce item-listing col-md-6 col-lg-4 p-2 my-1 mix<?php if ($course['class_names']) { echo ' ' . $course['class_names']; } ?>">

                <div class="card h-100">
                    <?php 
                    if( !empty( $course['image'] ) ) { ?>
                        <a href="<?php echo $course['link']; ?> "><img src="<?php echo esc_url($course['image']['url']); ?>" class="card-img-top" alt="<?php echo esc_attr($course['image']['alt']); ?>" /></a>
                        <?php } else { ?>
                            <a href="<?php echo $course['link']; ?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/thumbnail-scifi.jpg" class="card-img-top" alt="Science Fiction Illustration"></a>
                        <?php } ?>
                        <div class="card-body">
                            <?php if ( $course['onsale'] ) { echo '<p class="h5 mb-2"><span class="badge rounded-pill bg-success">On Sale</span></p>';} ?>
                            <?php if ( $course['bundled'] ) { echo '<div class="mb-3"><a class="btn btn-info btn-sm" href="' . $course['bundle_permalink'] . '" role="button"> Bundled Course</a></div>'; } ?>
                            <h5 class="card-title"><a href="<?php echo $course['link']; ?>"><?php echo $course['title']; ?></a></h5>
                            <p class="card-text"><small class="text-muted"><?php ce_courseloop_instructors($course['id']); ?></small></p>
                            <p class="card_course_start">
                                <?php if ( $course['type'] == "Live Course" ) { echo '<small class="text-muted">' . $course['duration'] . 's </small><span class="badge bg-secondary ms-2 mt-1">Live</span>'; } ?>
                            </p>
                            <?php if ( $course['onsale'] && $sale_courses_only ): echo '<p>Regular Price: <del>' . wc_price( $course['regular_price'] ) . '</del><br>Sale Price: ' . wc_price( $course['sale_price'] ) . '</p>'; endif; ?>
                            <p><?php echo $course['excerpt']; ?></p>
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

<script>
    //https://www.kunkalabs.com/mixitup/docs/mixitup-factory/
    var containerEl = document.querySelector('.ce-courses');

    var mixer = mixitup(containerEl, {
        animation: {
            effects: 'fade scale(0.25)'
        }
    });
</script>