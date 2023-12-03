<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container community-price';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="">

    <?php if( have_rows('levels') ): ?>

            <div class="row mb-2 px-1 text-center">

                <?php 
                    while( have_rows('levels') ) : the_row(); 
                    $link = get_sub_field('level_link');
                ?>

                <div class="col my-2">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal"><?php echo get_sub_field('level_title'); ?></h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title"><?php echo get_sub_field('level_price'); ?> <small class="text-muted">/ mo</small></h1>
                            <div><?php echo get_sub_field('level_description'); ?></div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" href="<?php echo esc_url( $link['url'] ); ?>">Choose Tier</a>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->

            <?php endwhile; ?>
        
        <div><!-- .row -->

    <?php endif; ?>

</div><!-- .container -->