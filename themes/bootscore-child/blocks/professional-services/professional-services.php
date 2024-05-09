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

    <div class="row">

        <?php if( have_rows('professional_services') ): ?>
            
            <?php while( have_rows('professional_services') ): the_row(); $link = get_sub_field('service_link'); ?>
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <h5 class="card-header py-4"><?php echo acf_esc_html( get_sub_field('service_name') ); ?></h5>
                        <div class="card-body">
                            <p class="card-text"><?php echo get_sub_field('service_description') ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-0 py-4">
                            <div class="d-grid">
                                <a href="<?php echo esc_url( $link ); ?>" class="btn btn-primary px-md-5">Learn More</a>
                            </div>
                        </div>
                    </div><!-- card -->
                </div> <!-- col -->
            <?php endwhile; ?>
        
        <?php endif; ?>

    </div> <!-- row -->

</div><!-- .container -->