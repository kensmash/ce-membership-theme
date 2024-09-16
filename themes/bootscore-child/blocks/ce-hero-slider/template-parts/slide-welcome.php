<div class="container-fluid">

    <div class="container">

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