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
$class_name = 'container testimonial-slider';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="">
    <?php 
        if( $featured_testimonials ):
        foreach( $featured_testimonials as $testimonial ): 
            $permalink = get_permalink( $testimonial->ID );
            $title = get_the_title( $testimonial->ID );
            $name = get_field( 'name', $testimonial->ID );
            //$content = get_post_field('post_content', $testimonial->ID); 
            $content = get_the_excerpt($testimonial->ID); 
            $credentials = get_field( 'credentials', $testimonial->ID );
        ?>
        <div class="testimonial-slide px-3">
            <div class="card h-100 p-2">
                <div class="card-body">
                    <p class="card-text"><?php echo $content; ?></p>
                </div><!-- .card-body -->
                <div class="card-footer">
                    <strong><?php echo esc_html( $name ); ?></strong>
                    <?php if ($credentials): ?>
                        <span> <i><?php echo esc_html( $credentials ); ?></i></span>
                    <?php endif; ?>
                </div> <!-- .card-footere -->
            </div><!-- .card -->
        </div><!-- .testimonial-slide -->
    <?php 
        endforeach;
        endif; 
    ?>
</div>