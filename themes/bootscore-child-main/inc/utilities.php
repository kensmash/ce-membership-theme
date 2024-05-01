<?php
/* 
add ipad to wp_is_mobile 
https://stackoverflow.com/questions/77563654/how-to-add-ipad-in-wp-is-mobile
*/
function include_ipad_in_mobile_view( $is_mobile ) {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_mobile = true;
    }
    return $is_mobile;
}
add_filter( 'wp_is_mobile', 'include_ipad_in_mobile_view' );

/* change default email from name in WordPress */
/* https://www.wpbeginner.com/plugins/how-to-change-sender-name-in-outgoing-wordpress-email/ */

// Please edit the address and name below.
// Change the From address.
add_filter( 'wp_mail_from', function ( $original_email_address ) {
    return 'info.comicsexperience.com';
} );
 
// Change the From name.
add_filter( 'wp_mail_from_name', function ( $original_email_from ) {
    return 'Comics Experience';
} );