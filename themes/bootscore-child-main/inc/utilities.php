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