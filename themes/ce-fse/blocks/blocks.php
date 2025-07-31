<?php
/**
 * Handles registering of the blocks for the theme.
 *
 * @package comics-experience
 */

if ( ! function_exists( 'wpfs_blocks_init' ) ) {
	/**
	 * Initialize function to register the blocks.
	 *
	 * @return void
	 */
	function wpfs_blocks_init() {

		$acf_items = wpfs_get_acf_items();
		$blocks    = array_filter(
			$acf_items,
			function ( $item ) {
				return 'block' === strtolower( $item['type'] );
			}
		);
		if ( 0 < count( $blocks ) ) {
			foreach ( $blocks as $block ) {
				$block_path = get_template_directory() . $block['dir'] . '/' . $block['name'] . '.php';
				if ( file_exists( $block_path ) ) {
					require $block_path;
				}
			}
		}
		// Announce the blocks have been loaded.
		do_action( 'wpfs_blocks_loaded' );
	}
}
add_action( 'init', 'wpfs_blocks_init' );

if ( ! function_exists( 'wpfs_header_block_block_categories' ) ) {
	/**
	 * Adds the theme block categories to the global block categories.
	 *
	 * @param array $block_categories The global block categories.
	 *
	 * @return array An updated array of the theme block categories.
	 */
	function wpfs_header_block_block_categories( $block_categories ) {

		$block_categories = array_merge(
			array(
				array(
					'slug'  => 'comics-experience',
					'title' => __( 'Ardent Health Theme', 'comics-experience' ),
				),
			),
			$block_categories,
		);

		return $block_categories;
	}
}
add_filter( 'block_categories_all', 'wpfs_header_block_block_categories' );
