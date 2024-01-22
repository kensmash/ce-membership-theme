<?php
/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function ce_register_acf_blocks() {
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    register_block_type( __DIR__ . '/../blocks/ce-services' );
    register_block_type( __DIR__ . '/../blocks/testimonial-slider' );
    register_block_type( __DIR__ . '/../blocks/community-spotlight' );
    register_block_type( __DIR__ . '/../blocks/community-pricing' );
    register_block_type( __DIR__ . '/../blocks/responsive-tabs' );
}

// Here we call our ce_register_acf_block() function on init.
add_action( 'init', 'ce_register_acf_blocks' );