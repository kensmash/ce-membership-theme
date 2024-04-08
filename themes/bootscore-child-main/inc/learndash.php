<?php

add_filter( 'learndash_course_grid_custom_button_text', function( $button_text = '', $post_id = 0 ) {
    // Example 1
    // Change button label to something custom
    $button_text = "Learn More";
     
    // Example 2
    // Change button label to something custom for specific $post_id
    /* if ( in_array( $post_id, array( 2424, 12, 34, 56, 78) ) ) {
        $button_text = "Alt Custom Button Label";
    } */
     
    // Always return $button_text
    return $button_text;
}, 10, 2 );