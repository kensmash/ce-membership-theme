<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$featured_testimonials = get_field('testimonials');

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'testimonial-slider';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="">
    <?php if( $featured_testimonials ): ?>
        <div>
        <?php foreach( $featured_testimonials as $testimonial ): 
            $permalink = get_permalink( $testimonial->ID );
            $title = get_the_title( $testimonial->ID );
            $content = get_post_field('post_content', $testimonial->ID); 
            $credentials = get_field( 'credentials', $testimonial->ID );
            ?>
            <div>
                <?php echo esc_html( $title ); ?>
                <span><?php echo esc_html( $credentials ); ?></span>
                <?php echo $content; ?>
            </div>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>