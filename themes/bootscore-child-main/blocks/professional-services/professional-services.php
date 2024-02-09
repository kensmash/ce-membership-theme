<?php
/**
 * Professional Services Block template.
 *
 * @param array $block The block settings and attributes.
 */

 $featured_services = get_field('professional_services');

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container professional-services';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>


<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

    <?php 
        if( $featured_services ):
        foreach( $featured_services as $service ): 
            $permalink = get_permalink( $service->ID );
            $title = get_the_title( $service->ID );
            $content = get_post_field('post_content', $service->ID); 
            //$content = get_the_excerpt($testimonial->ID); 
        ?>

        <div class="professional-service px-3">
            <div class="card h-100 p-2">
                <div class="card-body">
                    <p class="card-text"><?php echo $content; ?></p>
                </div><!-- .card-body -->
                <div class="card-footer">
                    <strong><?php echo esc_html( $title ); ?></strong>
                    <span><?php echo esc_html( $credentials ); ?></span>
                </div> <!-- .card-footere -->
            </div><!-- .card -->
        </div><!-- .professional-service -->

    <?php 
        endforeach;
        endif; 
    ?>

</div><!-- .container -->