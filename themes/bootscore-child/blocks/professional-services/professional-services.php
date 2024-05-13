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
            
            <?php while( have_rows('professional_services') ): the_row(); $link = get_sub_field('service_link'); ?>
                <div class="col-md-6 mb-3">
                    <div class="card h-100 px-3">
                        <h4 class="card-header bg-white border-0 px-3 pt-4 pb-2 text-center"><?php echo acf_esc_html( get_sub_field('service_name') ); ?></h4>
                        <div class="card-body">
                            <?php echo get_sub_field('service_description') ?>
                        </div>
                        <div class="card-footer bg-transparent border-0 py-4">
                            <div class="d-grid px-2">
                                <a href="<?php echo esc_url( $link ); ?>" class="btn btn-success px-md-5">Learn More</a>
                            </div>
                        </div>
                    </div><!-- card -->
                </div> <!-- col -->
            <?php endwhile; ?>
        
        <?php endif; ?>

    </div> <!-- row -->

</div><!-- .container -->