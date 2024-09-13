<?php

/* change default email from name in WordPress */
/* https://www.wpbeginner.com/plugins/how-to-change-sender-name-in-outgoing-wordpress-email/ */

// Please edit the address and name below.
// Change the From address.
add_filter( 'wp_mail_from', function ( $original_email_address ) {
    return 'info@comicsexperience.com';
} );
 
// Change the From name.
add_filter( 'wp_mail_from_name', function ( $original_email_from ) {
    return 'Comics Experience';
} );

//change excerpt length
function custom_excerpt_length( $length ) {
    return 255;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//argh, disable horrible idea to redirect user on woocommerce login fail
function child_remove_parent_function() {
    remove_action('woocommerce_login_failed', 'bootscore_redirect_on_login_failed', 10, 0);
}
add_action( 'wp_loaded', 'child_remove_parent_function' );

//hopefully update podcast feed
//https://wordpress.org/support/topic/updating-apple-podcast-feed/
add_action('rss2_head', function(){
	echo '<itunes:new-feed-url>https://comicsexperience.com/feed/podcast/make-comics/</itunes:new-feed-url>';
});

//fix issue with posts page menu item receiving current page partent styling when any custom post type archive page was selected
//https://stackoverflow.com/questions/3269878/wordpress-custom-post-type-hierarchy-and-menu-highlighting-current-page-parent
function dtbaker_wp_nav_menu_objects($sorted_menu_items, $args){
    // this is the code from nav-menu-template.php that we want to stop running
    // so we try our best to "reverse" this code wp code in this filter.
    /* if ( ! empty( $home_page_id ) && 'post_type' == $menu_item->type && empty( $wp_query->is_page ) && $home_page_id == $menu_item->object_id )
            $classes[] = 'current_page_parent'; */

    // check if the current page is really a blog post.
    //print_r($wp_query);exit;
    global $wp_query;
    if(!empty($wp_query->queried_object_id)){
        $current_page = get_post($wp_query->queried_object_id);
        if($current_page && $current_page->post_type=='post'){
            //yes!
        }else{
            $current_page = false;
        }
    }else{
        $current_page = false;
    }


    $home_page_id = (int) get_option( 'page_for_posts' );
    foreach($sorted_menu_items as $id => $menu_item){
        if ( ! empty( $home_page_id ) && 'post_type' == $menu_item->type && empty( $wp_query->is_page ) && $home_page_id == $menu_item->object_id ){
            if(!$current_page){
                foreach($sorted_menu_items[$id]->classes as $classid=>$classname){
                    if($classname=='current_page_parent'){
                        unset($sorted_menu_items[$id]->classes[$classid]);
                    }
                }
            }
        }
    }
    return $sorted_menu_items;
}
add_filter('wp_nav_menu_objects','dtbaker_wp_nav_menu_objects',10,2);


/**
 * Enable cart page
 */
add_filter('bootscore/skip_cart', '__return_false');