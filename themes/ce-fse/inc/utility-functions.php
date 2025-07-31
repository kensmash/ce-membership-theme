<?php
/**
 * WP Foundation Six utility functions
 *
 * @package comics-experience
 */

if ( ! function_exists( 'comics-experience_dev_helper' ) ) {
	/**
	 * Used to help identify template file.
	 *
	 * @method comics-experience_dev_helper
	 * @param  [string] $file - Takes in the file name.
	 */
	function comics-experience_dev_helper( $file ) {
		if ( is_super_admin() && ( defined( 'WPFS_INLINE_DEBUG' ) && WPFS_INLINE_DEBUG ) ) {
			echo '<div class="placeHolderPosition" style="top: 0; background: rgb(236, 234, 234); color: rgba(0, 0, 0, 0.4); font-size: 12px; padding: 5px 25px; display: none;">' . esc_html( $file ) . '.php</div>';
		}
	}
}

if ( ! function_exists( 'wpfs_cache_bust' ) ) {
	/**
	 * Gets the time when the content of the file was changed.
	 *
	 * @method wpfs_cache_bust
	 * @param  string $src Path to files to get time last changed.
	 * @return string      Returns the time when the data blocks of a file were being written to, that is, the time when the content of the file was changed.
	 */
	function wpfs_cache_bust( $src ) {
		$cache_bust = filemtime( realpath( '.' . wp_parse_url( $src, PHP_URL_PATH ) ) );

		return $cache_bust;
	}
}

if ( ! function_exists( 'wpfs_print_pre' ) ) {
	/**
	 * Outputs array in HTML pre tags
	 *
	 * @method wpfs_print_pre
	 * @param  [array] $data - Array to be displayed in pre tags.
	 */
	function wpfs_print_pre( $data ) {
		echo '<pre>';
			print_r( $data ); // phpcs:ignore
		echo '</pre>';
	}
}

if ( ! function_exists( 'wpfs_theme_error_log' ) ) {
	/**
	 * Custom theme error logging
	 *
	 * @method wpfs_theme_error_log
	 * @param  string $message Message to pass to error log.
	 */
	function wpfs_theme_error_log( $message ) {
		$time_stamp = new DateTime( 'NOW' );
		$time_stamp->setTimezone( new DateTimeZone( 'America/Chicago' ) );
		$error_time  = $time_stamp->format( 'F j, Y @ G:i:s' );
		$dir         = get_template_directory();
		$message_log = "<-------->\n" . $error_time . "\n" . $message . "\n\n";

		error_log( $message_log, 3, $dir . '/theme-error.log'); // phpcs:ignore
	}
}

if ( ! function_exists( 'comics-experience_privacy' ) ) {
	/**
	 * Display a link to the privacy policy page, if one is published.
	 *
	 * @since 1.0.0
	 *
	 * @return string Link to the privacy policy page, if one is published.
	 */
	function comics-experience_privacy() {
		if ( get_the_privacy_policy_link() ) {
			return '<!-- wp:paragraph {"color":"foreground","fontSize":"extra-small","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}}}} --><p class="has-extra-small-font-size has-text-color has-foreground-color has-link-color">' . get_the_privacy_policy_link() . '</p><!-- /wp:paragraph -->';
		}
	}
}

if ( ! function_exists( 'wpfs_dir_rsearch' ) ) {
	/**
	 * Iterates over a folder looking for a specific pattern.
	 *
	 * @param string $folder  The folder to do the search in.
	 * @param string $pattern The regex patter to use in the check.
	 *
	 * @return array An empty array or an array of directories that have files matching the regex.
	 */
	function wpfs_dir_rsearch( $folder, $pattern ) {
		$dir   = new \RecursiveDirectoryIterator( $folder );
		$ite   = new \RecursiveIteratorIterator( $dir );
		$files = new \RegexIterator( $ite, $pattern, \RegexIterator::GET_MATCH );

		$file_list = array();
		foreach ( $files as $file ) {
			$file_list = array_merge( $file_list, $file );
		}
		return $file_list;
	}
}

if ( ! function_exists( 'wpfs_get_post_id_from_url' ) ) {
	/**
	 * Locates the post ID from the current url.
	 *
	 * @param string $post_type When doing a lookup, the post type is needed when not a page.
	 *
	 * @return null|WP_Post
	 */
	function wpfs_get_post_id_from_url( $post_type = 'page' ) {
		if ( array_key_exists( 'REQUEST_URI', $_SERVER ) ) {
			$_url = rtrim( strtok( esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ), '?' ), '/' );
			if ( 'page' !== $post_type ) {
				$string_count = strlen( '/' . $post_type );
				$_url         = substr( $_url, $string_count );
			}
			$_post_id = get_page_by_path( $_url, 'OBJECT', $post_type );
			$_post    = get_post( $_post_id );
			return $_post;
		} else {
			return null;
		}
	}
}

if ( ! function_exists( 'wpfs_url_exists' ) ) {
	/**
	 * Checks to see if the given url returns a success.
	 *
	 * @param string $url The url in which to check.
	 *
	 * @return bool Whether or not the url returns a http status of 200.
	 */
	function wpfs_url_exists( $url ) {
		$headers = get_headers( $url );
		return stripos( $headers[0], '200 OK' ) ? true : false;
	}
}

if ( ! function_exists( 'wpfs_get_kses_extended_ruleset' ) ) {
	/**
	 * Returns an array of allowed html elements including SVG.
	 *
	 * @return array
	 */
	function wpfs_get_kses_extended_ruleset() {
		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg_args = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
		);
		return array_merge( $kses_defaults, $svg_args );
	}
}

if ( ! function_exists( 'wpfs_is_editor_mode' ) ) {
	/**
	 * Checks to see if we are in FSE mode.
	 *
	 * @return boolean
	 */
	function wpfs_is_editor_mode() {
		global $pagenow;
		if ( ( ( 'site-editor.php' === $pagenow && acf_maybe_get_GET( 'post_type' ) === 'wp_template' && ! acf_maybe_get_GET( 'page' ) ) || ( 'post.php' === $pagenow && acf_maybe_get_GET( 'action' ) === 'edit' ) || ( 'admin-ajax.php' === $pagenow ) ) ) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'wpfs_is_positive_integer' ) ) {
	/**
	 * Check if expression is positive integer
	 *
	 * @param mixed $str The string to check.
	 * @return bool
	 */
	function wpfs_is_positive_integer( $str ) {
		return ( is_numeric( $str ) && intval( $str ) > 0 );
	}
}
