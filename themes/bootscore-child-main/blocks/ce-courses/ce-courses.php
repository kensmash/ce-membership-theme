<?php
/**
 * CE Courses Block template.
 *
 * @param array $block The block settings and attributes.
 */


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

    <div class="row">

        <?php 
        $query = new WP_Query(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug', 
                    'terms' => array( 'courses' ),
                    'operator' => 'IN'
                )
            )
        ));
        
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

            <div class="woocommerce item-listing col-md-6 col-lg-4 p-2 my-1">

                <div class="card h-100">
                    <?php 
 
                    $image = get_field('card_image', get_the_ID());
                    if( !empty( $image ) ) { ?>
                        <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($image['url']); ?>" class="card-img-top" alt="<?php echo esc_attr($image['alt']); ?>" /></a>
                        <?php } else { ?>
                            <a href="<?php the_permalink();?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/thumbnail-scifi.jpg" class="card-img-top" alt="Science Fiction Illustration"></a>
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
                            <p class="card-text"><small class="text-muted"><?php ce_courseloop_instructors(get_the_ID()); ?></small></p>
                            <p class="card-text card_course_start">
                                <?php if ( get_field('course_type', get_the_ID()) == "Live Course" ) { echo '<small class="text-muted">' . the_field('course_duration', get_the_ID()) . 's </small><span class="badge bg-secondary ms-2 mt-1">Live</span>';} ?>
                            </p>
                            <?php the_excerpt(); ?>

                        </div>
                        <div class="card-footer bg-transparent text-muted border-top-0">
                            <div class="d-grid pt-2">
                                <a href="<?php the_permalink();?>" class="btn btn-primary btn-block border-0 mb-2">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile; endif; ?>
            <?php wp_reset_postdata(); ?>

     </div> <!-- row -->

</div><!-- .container -->