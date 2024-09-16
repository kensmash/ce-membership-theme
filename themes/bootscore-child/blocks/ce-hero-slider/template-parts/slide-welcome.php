<div class="container-fluid hero-block-content-container" style="background-image: url(<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/hero-area-block-bg-alt.jpg);">

    <div class="container">

       <div class="row justify-content-lg-between row-cols-1 row-cols-sm-1 row-cols-md-2">
                
            <div class="col">
            </div>

            <div class="col col-xl-4 col-xxl-5 hero-block-content-container pt-4">

                <?php if ( is_user_logged_in() ) {
                //there is a user, is user a member?
                //if not a member, get regular content
                $pmp_member = pmpro_getMembershipLevelForUser(get_current_user_id());
                //echo "member level: " . var_dump($pmp_member);
                if( !$pmp_member ) { 
                    require get_stylesheet_directory() . '/blocks/ce-hero-slider/template-parts/content-user.php';
                } else { 
                    //we have a logged in member, show them custom content
                    require get_stylesheet_directory() . '/blocks/ce-hero-slider/template-parts/content-member.php';
                }
                } else { 
                    //no logged in user
                    require get_stylesheet_directory() . '/blocks/ce-hero-slider/template-parts/content-nouser.php';
                } 
                ?>
                
            </div> <!-- .col -->
            
        </div> <!-- row -->

    </div><!-- container -->

</div><!-- container-fluid -->