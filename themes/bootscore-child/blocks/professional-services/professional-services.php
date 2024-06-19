<?php
/**
 * Professional Services Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container px-0 professional-services';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>


<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

    <div class="row g-0 g-md-3">

        <?php if( have_rows('professional_services') ): ?>
            
            <?php while( have_rows('professional_services') ): the_row(); 
                $link = get_sub_field('service_link'); 
                $image = get_sub_field('service_thumbnail'); 

            ?>
                <div class="col-md-6 mb-3">
                    <div class="card h-100" style="min-height: 115px;">
                        <div class="row h-100 g-0">
                            <div class="col-md-4" style="background-image: url(<?php echo esc_url($image['url']); ?>); background-size: cover;">
                                
                            </div>
                            <div class="col-md-8 h-100">
                                <div class="card-body h-100 d-flex align-items-center">
                                    <h5 class="card-title mb-md-2"><a href="<?php echo esc_url( $link ); ?>"><?php echo get_sub_field('service_name') ?></a></h5>    
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
            <?php endwhile; ?>
        
        <?php endif; ?>

    </div> <!-- row -->

</div><!-- .container -->