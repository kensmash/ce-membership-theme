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

    <div class="hero-slider">

            <div class="row">
           
                <div class="col">
                </div>

                <div class="col hero-block-content-container col-xl-4 col-xxl-5 pt-4 pt-lg-0">

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
               
         </div> <!-- row -->

     </div> <!-- hero-slider -->

</div><!-- .container -->