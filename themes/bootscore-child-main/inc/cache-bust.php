<?php
if ( ! function_exists( 'ce_cache_bust' ) ) {
	/**
	 * Gets the time when the content of the file was changed.
	 *
	 * @method ce_cache_bust
	 * @param  string $src Path to files to get time last changed.
	 * @return string      Returns the time when the data blocks of a file were being written to, that is, the time when the content of the file was changed.
	 */
	function ce_cache_bust( $src ) {
		$cache_bust = filemtime( realpath( '.' . wp_parse_url( $src, PHP_URL_PATH ) ) );

		return $cache_bust;
	}
}