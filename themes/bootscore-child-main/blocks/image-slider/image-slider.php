<?php
/**
 * Comics Experience Image Slider Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="">

    <?php
    
    if (have_rows('slider_images')) { ?>

        <div class="ce-images-slider-cards">

        <?php while (have_rows('slider_images')) {
        
            the_row();
            $image = get_sub_field('image');
            
            ?>

                <div class="card ce-images-slider-card-slide">
                 <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                </div>

            <?php } ?>

        </div><!-- ce-images-slider-cards -->

    <?php } ?>

</div>