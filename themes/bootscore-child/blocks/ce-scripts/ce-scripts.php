<?php
/**
 * CE Scripts Block template.
 *
 * @param array $block The block settings and attributes.
 */


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container px-0 ce-scriptss';
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

    $args = array( 'post_type' => 'script','orderby'=> 'title', 'order' => 'ASC','posts_per_page' => -1 ); 

    $the_query = new WP_Query( $args );

    if( $the_query->have_posts() ): ?>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">
                        The Comics Experience Script Template
                    </button>
                    </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body scripts">
                        <ul>
                            <li>
                                <a href="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/media/Comic-Experience-Script-Template-2021-11-24.doc">
                                    Suggested script format template from Comics Experience (Word)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php the_ID(); ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php the_ID(); ?>" aria-expanded="false" aria-controls="collapse<?php the_ID(); ?>">
                            <?php the_title(); ?>
                        </button>
                    </h2>
                    <div id="collapse<?php the_ID(); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php the_ID(); ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body scripts">
                            <?php remove_filter ('the_content',  'wpautop'); ?>
                            <?php the_content();?>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>

            <?php else:  ?>
                <p><?php  _e( 'Sorry, no scripts to display.' );  ?></p>
            <?php endif; ?>
            
        </div><!-- accordion -->

     </div> <!-- row -->

</div><!-- .container -->