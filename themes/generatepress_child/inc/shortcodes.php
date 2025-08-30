<?php
/**
 * Comics Experience 2022 shortcodes - mostly for tabs pages
 *
 * @package Comics_Experience_2022
 */

 /**
 * Mentors page, list Mentors
 * Usage [mentors-mentors]
 */

function mentors_tab_mentors() {
    global $post;
    // Define output var
	$output = '';
         
    $args = array(
        'post_type' => 'staff',
        'posts_per_page' => 5,
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key'   => 'mentor',
                'value' => '1',
            ),
            /* array(
                'key'   => 'active',
                'value' => '1',
            ) */
        )
        );

    $query = new WP_Query( $args );

	// Add content if we found posts via our query
	if ( $query->have_posts() ) {

		// Open div wrapper around loop
		$output .= '<div>';

		// Loop through posts
		while ( $query->have_posts() ) {

			// Sets up post data so you can use functions like get_the_title(), get_permalink(), etc
			$query->the_post();

            // This is the output for your entry so what you want to do for each post.
            $output .= '<div class="card mb-3 border-0">';
            $output .= '<div class="row g-0">';
            $output .= '<div class="col-md-3 justify-content-center align-content-center">';
            $output .= '<div class="pe-2">';
            $output .= get_the_post_thumbnail($post->ID, 'medium', array( 'class' => 'img-fluid rounded mx-auto d-block' ));
            $output .= '</div></div>';
            $output .= '<div class="col-md-9">';
            $output .= '<div class="card-body">';
            $output .= '<h4 class="testimonial-title">' . get_the_title() . '</h4>';
            $output .= get_field('mentor_description');
            $output .= '</div></div></div></div>';
            if ($query->current_post +1 < $query->post_count) { $output .= "<hr />"; }
 
		}

		// Close div wrapper around loop
		$output .= '</div>';

		// Restore data
		wp_reset_postdata();

	}

	// Return your shortcode output
    return  $output;
}

add_shortcode( 'mentors-mentors', 'mentors_tab_mentors' );

/**
 * Pro Script Critique page, list Reviewers
 * Usage [critique-reviewers]
 */

function reviewers_tab_reviewers() {
    global $post;
    // Define output var
	$output = '';
         
    $args = array(
        'post_type' => 'staff',
        'posts_per_page' => 8,
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key'   => 'reviewer',
                'value' => '1',
            ),
            /* array(
                'key'   => 'active',
                'value' => '1',
            ) */
        )
        );

    $query = new WP_Query( $args );

	// Add content if we found posts via our query
	if ( $query->have_posts() ) {

		// Open div wrapper around loop
		$output .= '<div>';

		// Loop through posts
		while ( $query->have_posts() ) {

			// Sets up post data so you can use functions like get_the_title(), get_permalink(), etc
			$query->the_post();

            // This is the output for your entry so what you want to do for each post.
            $output .= '<div class="card mb-3 border-0">';
            $output .= '<div class="row g-0">';
            $output .= '<div class="col-md-3">';
            $output .= get_the_post_thumbnail($post->ID, 'medium', array( 'class' => 'img-fluid rounded mx-auto d-block' ));
            $output .= '</div>';
            $output .= '<div class="col-md-9">';
            $output .= '<div class="card-body">';
            $output .= '<h4 class="testimonial-title">' . get_the_title() . '</h4>';
            $output .= get_field('reviewer_description');
            $output .= '</div></div></div></div>';
            if ($query->current_post +1 < $query->post_count) { $output .= "<hr />"; }
 
		}

		// Close div wrapper around loop
		$output .= '</div>';

		// Restore data
		wp_reset_postdata();

	}

	// Return your shortcode output
    return  $output;
}

add_shortcode( 'critique-reviewers', 'reviewers_tab_reviewers' );

/**
 * Workshop page, list Staff
 * Usage [workshop-staff workshop_role="Staff" label="Staff"]
 */
function workshop_tab_staff($atts) {
    global $post;
    /* https://wpexplorer-themes.com/total/snippets/simple-custom-shortcode-displaying-posts/ */
  
    $atts = shortcode_atts( array(
        'workshop_role' => 'Staff',
        'label' => 'Staff',
	), $atts, 'workshop_tab_staff' );

	// Extract shortcode atributes
    extract( $atts );
    
    // Define output var
	$output = '';
         
    $args = array(
        'post_type' => 'people',
        'posts_per_page' => 15,
        'order' => 'ASC',
        'workshop_role' => $workshop_role,
        'meta_query' => array(
            array(
                'key'   => 'active',
                'value' => '1',
            )
        )
        );

    $query = new WP_Query( $args );

	// Add content if we found posts via our query
	if ( $query->have_posts() ) {

		// Open div wrapper around loop
	
  
        $output .= '<p class="testimonial-title my-2">' . $label . '</p>';
        $output .= '<div class="row">';
		// Loop through posts
		while ( $query->have_posts() ) {

			// Sets up post data so you can use functions like get_the_title(), get_permalink(), etc
			$query->the_post();

            // This is the output for your entry so what you want to do for each post.
                       
            $output .= '<div class="col-xl-6 my-2">';
            $output .= '<div class="card h-100">';
            $output .= '<div class="row g-0">';
            $output .= '<div class="col-4 col-md-3">';
            $output .= get_the_post_thumbnail($post->ID, 'thumbnail', array( 'class' => 'rounded-left' ));
            $output .= '</div">';
            $output .= '</div>';
            $output .= '<div class="col-8 col-md-9">';
            $output .= '<div class="card-body">';
            $output .= '<h5 class="card-title"><a href="'. get_the_permalink() .'">' . get_the_title() . '</a></h5>';
            if ( get_field('workshop_credentials') ) { 
                $output .= '<p class="card-text staff-meta text-muted">' . get_field('workshop_credentials') . '</p>'; 
            } else { 
                $output .= '<p class="card-text staff-meta text-muted">' . get_field('credentials') . '</p>'; 
            };
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
		}

        // Close div wrapper around loop
        $output .= '</div>';
   

		// Restore data
		wp_reset_postdata();

	}

	// Return your shortcode output
    return $output;
}

add_shortcode( 'workshop-staff', 'workshop_tab_staff' );


/**
 * Generic Testimonials shortcode for page tabs
 * Usage [testimonials category="mentoring"]
 */
function tab_testimonials($atts) {
   
    /* https://wpexplorer-themes.com/total/snippets/simple-custom-shortcode-displaying-posts/ */
  
    $atts = shortcode_atts( array('category' => 'mentoring'), $atts, 'tab_testimonials' );

	// Extract shortcode atributes
    extract( $atts );
    
    // Define output var
	$output = '';
         
    $args = array(
        'post_type' => 'testimonial',
        'posts_per_page' => 10,
        'order' => 'DESC',
        'testimonial-category' => $category
        );

    $query = new WP_Query( $args );

	// Add content if we found posts via our query
	if ( $query->have_posts() ) {

		// Open div wrapper around loop
		$output .= '<div class="px-1">';

		// Loop through posts
		while ( $query->have_posts() ) {

			// Sets up post data so you can use functions like get_the_title(), get_permalink(), etc
			$query->the_post();

            if ( get_field('name', get_the_ID())) {
                $output .= '<h4 class="testimonial-title my-0">' .  esc_html(get_field('name', get_the_ID())) . '</h4>';
            } else {
                $output .= '<h4 class="testimonial-title my-0">' . get_the_title() . '</h4>';
            }
            
            if( get_field('credentials', get_the_ID()) ): 
                $output .= '<p class="testimonial-credentials">' .  get_field('credentials', get_the_ID()) . '</p>';
            endif;
            $posts = get_field('project', get_the_ID());
            if( $posts ): 
                 foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) 
                    $output .= '<p class="testimonial-credentials">' .  get_the_title( $p->ID ) . '<sup>&copy;</sup></p>';
                endforeach; 
            endif; 
            $output .= '<p>' . get_the_excerpt() . '</p>';
            if ($query->current_post +1 < $query->post_count) { $output .= "<hr />"; }

		}

		// Close div wrapper around loop
		$output .= '</div>';

		// Restore data
		wp_reset_postdata();

	}

	// Return your shortcode output
    return  $output;
}

add_shortcode( 'testimonials', 'tab_testimonials' );


/**
 * Generic Projects shortcode for page tabs
 * Usage [projects type="publishing"]
 */
function tab_projects($atts) {
    global $post;
    /* https://wpexplorer-themes.com/total/snippets/simple-custom-shortcode-displaying-posts/ */
  
    $atts = shortcode_atts( array('type' => 'publishing'), $atts, 'tab_projects' );

	// Extract shortcode atributes
    extract( $atts );
    
    // Define output var
	$output = '';
         
    $args = array(
        'post_type' => 'projects',
        'orderby'  => 'menu_order',
        'posts_per_page' => 20,
        'order' => 'ASC',
        'project_types' => $type
        );

    $query = new WP_Query( $args );

	// Add content if we found posts via our query
	if ( $query->have_posts() ) {

        // Open div wrapper around loop
        $output .= '<div class="container">';
		$output .= '<div class="row">';

		// Loop through posts
		while ( $query->have_posts() ) {

			// Sets up post data so you can use functions like get_the_title(), get_permalink(), etc
			$query->the_post();

			if ($type == "publishing") {
                // This is the output for publishing projects
                $output .= '<div class="card mb-md-4 projects-card">';
                $output .= '<div class="card-body pt-3 pl-0 pl-md-4">';
                $output .= get_the_post_thumbnail($post->ID, 'project-thumb', array( 'class' => 'alignleft border shadow mb-3 mb-md-0' ));
                $output .= '<p class="h4 my-1">' . get_the_title() . '</p>';
                $output .= '<p class="project-credentials">' .  get_field('credentials') . '</p>';
                $output .= '<p>' . get_the_content() . '</p>';
                $output .= '</div>';
                $output .= '</div>';
    
            } else {
              // This is the output for creative services projects
               $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                $output .= '<div class="col-md-6 py-lg-2 px-lg-4 mb-3">';
                $output .= '<p class="h4">' . get_the_title() . '</p>';
                $output .= '<p class="project-credentials"><sup>&copy;</sup>' .  get_field('credentials') . '</p>';
                $output .= '<a href="'.esc_url($featured_img_url).'" rel="lightbox">'; 
                $output .= get_the_post_thumbnail($post->ID, 'project-thumb', array( 'class' => 'card-img border rounded-0 shadow' ));
                $output .= '</a>';
                $output .= '</div>';            
            }
		}

		// Close div wrapper around loop
        $output .= '</div>';
        $output .= '</div>';

		// Restore data
		wp_reset_postdata();

	}

    // Return your shortcode output
    // also, if simple lightbox plugin is activated, show images in lightbox
    // https://wordpress.org/support/topic/can-i-add-a-classname-to-link-or-image-to-trigger-lightbox/
    if ( function_exists('slb_activate') ) {
        $output = slb_activate($output);
    }
    return  $output;
}

add_shortcode( 'projects', 'tab_projects' );


/**
 * Courses product page, list Instructor - name must be exact match
 * Usage [instructor name="Andy Schmidt"]
 */
function get_instructor($atts) {
    global $post;
    /* https://wpexplorer-themes.com/total/snippets/simple-custom-shortcode-displaying-posts/ */
  
    $atts = shortcode_atts( array(
        'name' => 'Instructor',
	), $atts, 'get_instructor' );

	// Extract shortcode atributes
    extract( $atts );
    
    // Define output var
	$output = '';
         
    $args = array(
        'post_type' => 'staff',
        'posts_per_page' => 1,
        'name' => $name,
        );

    $query = new WP_Query( $args );

	// Add content if we found posts via our query
	if ( $query->have_posts() ) {

		// Open div wrapper around loop
	
  
        $output .= '<div class="clearfix">';
		// Loop through posts
		while ( $query->have_posts() ) {

			// Sets up post data so you can use functions like get_the_title(), get_permalink(), etc
			$query->the_post();

            // This is the output for your entry so what you want to do for each post.
                                
            //$output .= get_the_post_thumbnail($post->ID, 'medium', array( 'class' => 'alignleft' ));
            $content= get_the_content();
            $output .= apply_filters( 'the_content', $content );
         
		}

        // Close div wrapper around loop
        $output .= '</div>';
   

		// Restore data
		wp_reset_postdata();

	}

	// Return your shortcode output
    return $output;
}

add_shortcode( 'instructor', 'get_instructor' );


/**
 * Courses product page, show course requirements
 * Usage [requirements type="Zoom"]
 */

 //TODO: add other online meeting URLs

function course_requirements($atts) {

    $atts = shortcode_atts( array(
        'type' => 'Zoom',
    ), $atts, 'course_requirements' );
    
    // Extract shortcode atributes
    extract( $atts );

    // Define output var
	$output = '';

    if ( $type == "Digital" ) { 
        $output .= '<p><strong>To enroll in a Comics Experience digital course, you will need:</strong></p>';
        $output .= '<ul>';
        $output .= '<li>High-speed Internet access.</li>';
        $output .= '<li>A mind like a sponge!</li>';
        $output .= '</ul>';
    } else {
        $output .= '<p><strong>To participate in our live online sessions you will need:</strong></p>';
        $output .= '<ul>';
        
            $output .= '<li>A computer or mobile device that meets <a href="https://support.zoom.us/hc/en-us/categories/200101697" title="Zoom minimum requirements" target="_blank">Zoom&rsquo;s minimum requirements</a></li>';
      
        $output .= '<li>High-speed Internet access</li>';
        $output .= '<li>Headphones/ear buds with microphone (optional, but strongly suggested)</li>';
        $output .= '<li>A mind like a sponge!</li>';
        $output .= '</ul>';
    
        $output .= '<p>What if I need to cancel my enrollment?</p>';
        $output .= '<p>Unfortunately, Comics Experience cannot provide a full refund for course enrollment once the course is purchased.</p>';
        $output .= '<ul>';
        $output .= '<li>From the time of purchase until twenty-one (21) days before the class start date, 50% of the course fee can be refunded.</li>';
        $output .= '<li>Between twenty (20) and seven (7) days prior to the class start date, 25% of the course fee can be refunded.</li>';
        $output .= '<li>Six (6) days or fewer before the course start date, no refund will be issued.</li>';
    
        $output .= '<p>We appreciate your understanding and compliance to help us keep costs down and to continue offering high quality courses.</p>';
        $output .= '</ul>'; 
    }
        
	// Return your shortcode output
    return  $output;
}

add_shortcode( 'requirements', 'course_requirements' );



/**
 * Output the user agreement
 * Usage [user-agreement]
 */

 function user_agreement($atts) {
    /* https://wordpress.stackexchange.com/questions/213705/combining-shortcode-and-get-template-part */
    ob_start();
    get_template_part('template-parts/content', 'useragreement' );
    return ob_get_clean();
}

add_shortcode( 'user-agreement', 'user_agreement' );


/**
 * Bundled Courses Shortcode for WooCommerce
 * Usage [bundled_courses tag="bundle-intro-to-coloring"]
 */
function get_bundled_courses($atts) {
    global $post;
    /* https://wpexplorer-themes.com/total/snippets/simple-custom-shortcode-displaying-posts/ */
  
    $atts = shortcode_atts( array('tag' => 'bundle-intro-to-coloring'), $atts, 'get_bundled_courses' );

	// Extract shortcode atributes
    extract( $atts );
    
    // Define output var
	$output = '';
         
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        'post_status'  => 'publish',
        'orderby'           => 'menu_order',
        'order'             => 'ASC', 
        'tax_query'           => array(
            // Product tag filter
            array(
                'taxonomy' => 'product_tag',
                'terms'    => array($tag),
                'field'    => 'slug',
            ),
        ),
    );

    $query = new WP_Query( $args );

    // Add content if we found posts via our query
    if ( $query->have_posts() ) {

        // Open div wrapper around loop
    
        $output .= '<div class="container p-0 mb-3">';
        $output .= '<div class="row">';

        // Loop through posts
        while ( $query->have_posts() ) {

            // Sets up post data so you can use functions like get_the_title(), get_permalink(), etc
            $query->the_post();
  
            $output .= '<div class="col-12 mt-21 mb-3">';
            $output .= get_the_post_thumbnail($post->ID, 'thumbnail', array( 'class' => 'rounded' ));
            $output .= '<h5 class="card-title"><a href="'. get_the_permalink() .'">' . get_the_title() . '</a></h5>';
            $output .= '<p class="text-secondary bundle-course-excerpt">' . get_the_excerpt() . '</p>';
            $output .= '</div> <!-- col -->';
            $output .= '<hr>';
        }

        // Close div wrapper around loop
        $output .= '</div> <!-- row -->';
        $output .= '</div> <!-- container -->';
       
        // Restore data
        wp_reset_postdata();

    }

    // Return your shortcode output
    return $output;
    
}

add_shortcode( 'bundled_courses', 'get_bundled_courses' );


/**
 * Courses Tag Shortcode for WooCommerce
 * Usage [courses_grid tag="bundle"]
 */
function get_courses_by_tag($atts) {
    global $post;
    /* https://wpexplorer-themes.com/total/snippets/simple-custom-shortcode-displaying-posts/ */
  
    $atts = shortcode_atts( array('tag' => 'bundle'), $atts, 'get_courses_by_tag' );

	// Extract shortcode atributes
    extract( $atts );
    
    // Define output var
	$output = '';
         
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 20,
        'post_status'  => 'publish',
        'orderby'           => 'menu_order',
        'order'             => 'ASC', 
        'tax_query'           => array(
            // Product tag filter
            array(
                'taxonomy' => 'product_tag',
                'terms'    => array($tag),
                'field'    => 'slug',
            ),
        ),
    );

    ob_start();
    get_template_part('template-parts/content', 'coursesloop', $args);
    return ob_get_clean();
    
}

add_shortcode( 'courses_grid', 'get_courses_by_tag' );