<?php
/* function bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
    return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'bbp_enable_visual_editor' ); */


function bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
    $args['quicktags'] = false;
    return $args;
}
add_filter( 'bbp_before_get_the_content_parse_args', 'bbp_enable_visual_editor' );


function bbp_tinymce_paste_plain_text( $plugins = array() ) {
    $plugins[] = 'paste';
    return $plugins;
}
add_filter( 'bbp_get_tiny_mce_plugins', 'bbp_tinymce_paste_plain_text' );


/* stop bbpress emails from going to noreply@comicsexperience - resulting in those emails getting bounced */
/* https://bbpress.org/forums/topic/remove-noreply-email-from-notification-emails/page/2/ */

function my_bbp_no_reply_email(){
    $email = 'ken@comicsexperience.com'; // any email you want
    return $email;
}

add_filter('bbp_get_do_not_reply_address','my_bbp_no_reply_email');