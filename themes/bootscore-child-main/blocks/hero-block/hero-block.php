<?php
/**
 * Hero Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$headline          = !empty(get_field( 'block_headline' )) ? get_field( 'block_headline' ) : 'Your headline here...';
$subhead           = get_field( 'subhead' );
$background_image  = 'url(' . get_field( 'background_image' ) . '); background-repeat: no-repeat; background-size: cover';
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
//$styles = array( 'background-color: ' . $background_color, 'background-image: ' . $background_image, 'color: ' . $text_color );
$styles = array( 'background-color: ' . $background_color, wp_is_mobile() ? '' : 'background-image: ' . $background_image, '; color: ' . $text_color );
$style  = implode( '; ', $styles );
?>

<div <?php echo esc_attr( $anchor ); ?>class="container-fluid <?php echo esc_attr( $class_name );?> pt-4 pt-lg-5" style="<?php echo esc_attr( $style ); ?>">
    <div class="container hero-block-container">
        <div class="row justify-content-lg-between row-cols-1 row-cols-sm-1 row-cols-md-2">
           
            <div class="col">
            </div>

            <div class="col col-xl-4 col-xxl-5">

            <?php if ( is_user_logged_in() ) {
              //there is a user, is user a member?
              //if not a member, get regular content
              $pmp_member = pmpro_getMembershipLevelForUser(get_current_user_id());
              //echo "member level: " . var_dump($pmp_member);
              if( !$pmp_member ) { 
                require get_stylesheet_directory() . '/blocks/hero-block/template-parts/content-user.php';
              } else { 
                 //we have a logged in member, show them custom content
                 require get_stylesheet_directory() . '/blocks/hero-block/template-parts/content-member.php';
               }
            } else { 
                //no logged in user
                require get_stylesheet_directory() . '/blocks/hero-block/template-parts/content-nouser.php';
            } 
            ?>
                
            </div> <!-- .col -->
            
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .container-fluid -->