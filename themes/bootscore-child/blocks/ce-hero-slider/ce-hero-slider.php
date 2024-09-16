<?php
/**
 * CEX Hero Slider Block template.
 *
 * @param array $block The block settings and attributes.
 */


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container-fluid px-0';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>


<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

    <div class="hero-block-content-container">

        <div class="hero-slider">

            <?php if( have_rows('slides') ):

                // Loop through rows.
                while( have_rows('slides') ) : the_row();

                    // Load sub field value.
                    $slide_type = get_sub_field('slide_type');
                    
                    switch ($slide_type) {
                        case "welcome":
                            require get_stylesheet_directory() . '/blocks/ce-hero-slider/template-parts/slide-welcome.php';
                            break;
                        case "course":
                            require get_stylesheet_directory() . '/blocks/ce-hero-slider/template-parts/slide-course.php';
                            break;
                        case "post":
                            require get_stylesheet_directory() . '/blocks/ce-hero-slider/template-parts/slide-post.php';
                            break;
                    }
                    
                endwhile;

            endif; ?>    

        </div> <!-- hero-slider -->

    </div><!-- .container -->

</div><!-- .container-fluid -->