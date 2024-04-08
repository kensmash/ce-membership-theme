<?php
/**
 * Template part for displaying courses tabs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Comics_Experience_2022
 */

?>

<!-- the tabs -->

<?php
  $tab_type = "nav-tabs";
  if ( wp_is_mobile() ) {
    $tab_type = "nav-pills";
  }
?>

<div class="page-tabs pt-2">

    <ul class="nav <?php echo $tab_type; ?> nav-fill flex-column flex-xl-row text-md-center" id="myTab" role="tablist">
        <li class="nav-item flex-sm-fill text-md-center">
            <a class="nav-link active" id="details-tab" data-bs-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
        </li>
        <li class="nav-item flex-sm-fill text-md-center">
            <?php $count = count(get_field('instructors')); ?>
            <a class="nav-link" id="instructor-tab" data-bs-toggle="tab" href="#instructor" role="tab" aria-controls="instructor" aria-selected="false">Instructor<?php if ($count > 1) { echo "s";} ?></a>
        </li>
        <?php if( get_field('faqs_tab') ) { ?>
        <li class="nav-item flex-sm-fill text-md-center">
            <a class="nav-link" id="faqs-tab" data-bs-toggle="tab" href="#faqs" role="tab" aria-controls="faqs" aria-selected="false">FAQs</a>
        </li>
        <?php } ?>

        <li class="nav-item flex-sm-fill text-md-center">
            <a class="nav-link" id="requirements-tab" data-bs-toggle="tab" href="#requirements" role="tab" aria-controls="requirements" aria-selected="false">Requirements</a>
        </li>
        <?php 
        
        $postcount = 20;

        // FIND TESTIMONIALS THAT HAVE A RELATIONSHIP TO CURRENT COURSE AND COURSE INSTRUCTOR(S) - dynamically
        // idea from https://support.advancedcustomfields.com/forums/topic/query-multiple-values-in-relationship-field
       
        // GET INSTRUCTORS FOR THE CURRENT COURSE
        $instructors = get_field('instructors');

        // GET AN ARRAY OF INSTRUCTOR ID'S ONLY
        $instructor_ids = array();
        foreach($instructors as $instructor) :
            array_push($instructor_ids, $instructor->ID);
        endforeach;

        //CONSTRUCT AN INSTRUCTORS DYNAMIC META QUERY
        $instructors_dynamic_meta_query = array('relation' => 'OR',);

        foreach($instructor_ids as $instructor_id) {
            array_push($instructors_dynamic_meta_query, array(
                'key' => 'instructor',
                'value' => '"' . $instructor_id . '"',
                'compare' => 'LIKE'
            ));
        }

        //ADD IT TO TESTIMONIALS META QUERY
        $testimonials_dynamic_meta_query = array(
            'post_type' => 'testimonial',
            'order' => 'DESC',
            'posts_per_page' => $postcount, 
            'meta_query'    => array(
                'relation' => 'OR',
                //EITHER LOOK FOR "EVERGREEN" TESTIMONIALS WITH NO INSTRUCTOR
                array('relation' => 'AND', array( 
                    'key' => 'course', // look in course relationship field
                    'value' =>  '"' . get_the_ID() . '"', // for the post ID of this course
                    'compare' => 'LIKE'
                ),
                array( 
                    'key'   => 'mentions_instructor',
                    'value' => '0',
                ),
                ),
                //OR LOOK FOR TESTIMONIALS WHERE THE INSTRUCTOR MENTIONED MATCHES THE CURRENT COURSE INSTRUCTOR
                array('relation' => 'AND',  array( 
                    'key' => 'course', 
                    'value' =>  '"' . get_the_ID() . '"', 
                    'compare' => 'LIKE'
                ),
                array( 
                    'key'   => 'mentions_instructor',
                    'value' => '1',
                ),
                $instructors_dynamic_meta_query
                )
            )
        );

        //PASS DYNAMIC QUERY AS ARGUMENT TO WP_QUERY
        $loop = new WP_Query( $testimonials_dynamic_meta_query  );
        if ( $loop->have_posts() ) : 
        
            echo "<li class='nav-item flex-sm-fill text-md-center'>";
            echo "<a class='nav-link' id='testimonials-tab' data-bs-toggle='tab' href='#testimonials' role='tab' aria-controls='testimonials' aria-selected='false'>Testimonials</a>";
            echo "</li>";
        
        ?>

        <?php endif; ?>
    </ul>


    <!-- the tab content -->

    <div class="tab-content pt-4" id="myTabContent">
        <div class="tab-pane fade show active p-1 py-md-2 px-md-1" id="details" role="tabpanel" aria-labelledby="details-tab">
            <?php the_field('details_tab'); ?>
        </div>

        <div class="instructor tab-pane fade p-1 p-md-3" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
            <?php 

        $posts = get_field('instructors');
        
        if( $posts ): ?>

            <?php 
            $i = 1;
            foreach( $posts as $post): // variable must be called $post (IMPORTANT) 
            setup_postdata($post); 
            $i++;
            echo "<div class='p-1'>";
            the_post_thumbnail( 'medium', ['class' => 'alignright mb-4'] );
            the_content();
            echo "</div>";
            if ($count > 1 && $i == 2){ echo '<hr class="mb-4">'; }
            endforeach; ?>

            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endif; ?>
        </div>
        <?php if( get_field('faqs_tab') ) { ?>
        <div class="tab-pane fade p-1 p-md-3" id="faqs" role="tabpanel" aria-labelledby="faqs-tab"> <?php the_field('faqs_tab'); ?></div>
        <?php } ?>


        <div class="tab-pane fade p-1 p-md-3" id="requirements" role="tabpanel" aria-labelledby="requirements-tab">
            <?php the_field('requirements_tab'); ?>
            <?php 
                if (get_field('course_type') !== "Digital Course"):
                    $endOfDay = strtotime("tomorrow") - 1;
                    $unixtimestamp = strtotime(get_field('start_date')); 
                    if ($unixtimestamp > $endOfDay) { ?>
                        <p><strong>Online registration only:</strong>
                            To attend <?php if (get_field('course_type') == "Master Seminar"){ echo "the "; } ?>
                            <em><?php the_title() ?>,</em> you must register online. Enrollment is limited.*</p>
                        <p class="disclaimer-text"><small>*We do not currently offer refunds after enrollment.</small></p>
            <?php 
                } 
                endif;
            ?>

        </div>

        <?php // Remember we are still using the $loop query object from the Testimonials tab above!
						               
    if ( $loop->have_posts() ) : ?>
        <div class="tab-pane fade p-1 p-md-3" id="testimonials" role="tabpanel" aria-labelledby="testimonials-tab">
            <?php while ( $loop->have_posts() ) : $loop->the_post();?>
            <p class="testimonial-title my-0"><?php the_title();?></p>
            <p class="testimonial-credentials"><?php echo get_field('credentials'); ?></p>
           <?php the_content();?>
            <?php if ($loop->current_post +1 < $loop->post_count) { echo "<hr />"; } ?>

            <?php endwhile; ?>

        </div>
        <?php wp_reset_postdata(); ?>

        <?php else:  ?>

        <?php endif; ?>

    </div>
</div>
<?php get_template_part( 'template-parts/content', 'useragreementmodal' ); ?>
<?php echo '<div class="page-tabs"></div><hr class="mb-4">'; ?>