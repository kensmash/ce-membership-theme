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

// Add support for responsive embedded content (YouTube, Vimeo, etc.).
add_theme_support( 'responsive-embeds' );

/* 
remove archive from title on archive pages
solution from https://developer.wordpress.org/reference/functions/get_the_archive_title/
*/

function my_theme_archive_title( $title ) {
    if ( is_category() ) {
      $title = single_cat_title( 'Category: ', false );
    } elseif ( is_post_type_archive('podcast') ) {
      $title = "Podcast Episodes";
    } elseif ( is_post_type_archive('scripts') ) {
      $title = "Scripts";
    } elseif ( is_tag() ) {
      $title = single_tag_title( 'Posts Tagged: ', false );
    } elseif ( is_author() ) {
      $title = 'Posts by <span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
      $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
      $title = single_term_title( '', false );
    }
    
    return $title;
  }
    
  add_filter( 'get_the_archive_title', 'my_theme_archive_title' );