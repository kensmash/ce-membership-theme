<?php
/**
 * Video Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$headline          = !empty(get_field( 'block_headline' )) ? get_field( 'block_headline' ) : 'Your headline here...';
$subhead           = get_field( 'subhead' );
$background_image  = get_field( 'background_image' );
$background_color  = get_field( 'background_color' ); // ACF's color picker.
$text_color        = get_field( 'text_color' ); // ACF's color picker.

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'hero-block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
if ( $background_color || $text_color ) {
    $class_name .= ' has-custom-acf-color';
}

// Build a valid style attribute for background and text colors.
$styles = array( 'background-color: ' . $background_color, 'color: ' . $text_color );
$style  = implode( '; ', $styles );
?>

<div <?php echo esc_attr( $anchor ); ?>class="container-fluid <?php echo esc_attr( $class_name );?> mt-lg-5" style="<?php echo esc_attr( $style ); ?>">
    <div class="container">
        <div class="row">

            <div class="col">
                <h1><?php echo esc_html($headline); ?></h1>
                <p><?php echo esc_html($subhead); ?></p>
                <?php
                    if( have_rows('buttons') ): ?>

                    <div>

                        <?php while( have_rows('buttons') ) : the_row();

                            $button_text = get_sub_field('button_text'); 
                            $button_link = get_sub_field('button_link'); 
                            $button_class = get_sub_field('button_color'); 
                            ?>

                            <a class="btn <?php echo esc_attr($button_class); ?>" href="<?php echo esc_attr( $button_link); ?>" role="button"><?php echo esc_html($button_text); ?></a>

                            <?php 

                        endwhile; ?>

                    </div>

                    <?php endif; ?>
                
            </div> <!-- .col -->
            
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .container-fluid -->