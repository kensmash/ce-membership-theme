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
$class_name = 'container px-0 mt-4 professional-services';
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
            if( $featured_services ):
            foreach( $featured_services as $service ): 
                $permalink = get_permalink( $service->ID );
                $title = get_the_title( $service->ID );
                $content = get_post_field('post_content', $service->ID); 
                //$content = get_the_excerpt($testimonial->ID); 
            ?>

            <div class="col">
                <div class="card h-100">
                    <h5 class="card-header"><?php echo esc_html( $title ); ?></h5>
                    <div class="card-body">
                        <?php echo $content; ?>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="<?php echo esc_url( $permalink ); ?>" class="btn btn-primary">Learn More</a>
                    </div>
                </div><!-- card -->
            </div> <!-- col -->

        <?php 
            endforeach;
            endif; 
        ?>

    </div> <!-- row -->

</div><!-- .container -->