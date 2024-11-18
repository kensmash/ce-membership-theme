<?php

/**
 * Temporary fix for form error message issue
 */

add_action( 'wp_loaded', function() {
    $pmpro_login_page_id = get_option( "pmpro_login_page_id");
    $pmpro_login_page = get_post( $pmpro_login_page_id );
    
    if ( strpos( sanitize_text_field( $_SERVER['REQUEST_URI'] ), $pmpro_login_page->post_name ) ) {
        remove_filter( 'login_form_top', 'learndash_add_login_field_top' );
    }
} );
