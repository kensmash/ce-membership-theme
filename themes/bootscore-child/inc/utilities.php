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