<?php
/**
 *
 *
 * @package comics-experience
 */

if ( ! function_exists( 'wpfs_acf_init' ) ) {
	/**
	 * Adds hooks to manage ACF field groups for the theme
	 */
	function wpfs_acf_init() {

		// Hook into the filters for ACF field groups.
		add_action( 'acf/update_field_group', 'wpfs_acf_update_field_group' );
		add_action( 'acf/untrash_field_group', 'wpfs_acf_update_field_group' );
		add_filter( 'acf/json/save_file_name', 'wpfs_save_field_group', 10 );

		add_action( 'acf/trash_field_group', 'wpfs_acf_delete_field_group' );
		add_action( 'acf/delete_field_group', 'wpfs_acf_delete_field_group' );
	}
}
add_action( 'init', 'wpfs_acf_init' );

if ( ! function_exists( 'wpfs_get_acf_items' ) ) {
	/**
	 * Gets a list of items that use ACF.
	 *
	 * @return array
	 */
	function wpfs_get_acf_items() {
		$blocks     = array();
		$block_dirs = array_map( 'dirname', wpfs_dir_rsearch( get_template_directory() . '/blocks/', '/.*\/block\.json/' ) );
		foreach ( $block_dirs as $dir ) {
			$block_name   = basename( $dir );
			$field_groups = array();
			$group_files  = array_map( 'basename', glob( $dir . '/acf/group_*.php' ) );
			$file_path    = $dir . '/acf';
			foreach ( $group_files as $file ) {
				$group          = pathinfo( $file, PATHINFO_FILENAME );
				$field_groups[] = array(
					'file' => $file,
					'key'  => $group,
					'path' => str_replace( get_template_directory(), '', $file_path ),
				);
			}
			$blocks[] = array(
				'name'   => $block_name,
				'dir'    => str_replace( get_template_directory(), '', $dir ),
				'type'   => 'block',
				'groups' => $field_groups,
			);
		}

		$theme_options_dir = get_template_directory() . '/inc';
		$field_groups      = array();
		$group_files       = array_map( 'basename', glob( $theme_options_dir . '/acf/group_*.php' ) );
		$file_path         = $theme_options_dir . '/acf';
		foreach ( $group_files as $file ) {
			$group          = pathinfo( $file, PATHINFO_FILENAME );
			$field_groups[] = array(
				'file' => $file,
				'key'  => $group,
				'path' => str_replace( get_template_directory(), '', $file_path ),
			);
		}

		$theme_options = array(
			array(
				'name'   => 'theme_settings',
				'type'   => 'theme',
				'groups' => $field_groups,
			),
		);
		asort( $blocks );

		return array_merge( $blocks, $theme_options );
	}
}

if ( ! function_exists( 'wpfs_acf_update_field_group' ) ) {
	/**
	 * Function to handle updating the field group files.
	 *
	 * @param array $field_group The field group to possibly save.
	 */
	function wpfs_acf_update_field_group( $field_group ) {
		$key           = $field_group['key'];
		$group_setting = false;
		$acf_items     = wpfs_get_acf_items();

		$group_item = array_reduce(
			$acf_items,
			function ( $carry, $item ) use ( $key ) {
				return false === $carry && in_array( $key, array_column( $item['groups'], 'key' ), true ) ? $item : $carry;
			},
			false
		);

		if ( false !== $group_item ) {
			$group_index = array_search( $key, array_column( $group_item['groups'], 'key' ), true );
			if ( false !== $group_index ) {
				$group_setting = $group_item['groups'][ $group_index ];
			}
		}

		if ( $group_setting ) {
			// Save File.
			wpfs_acf_save_file( $field_group['key'], $group_setting, $field_group );

		}
	}
}

if ( ! function_exists( 'wpfs_acf_delete_field_group' ) ) {
	/**
	 * Function to handle deleting the ACF field group if it is deleted from the admin UI.
	 *
	 * @param array $field_group The field group to attempt to delete.
	 *
	 * @return void
	 */
	function wpfs_acf_delete_field_group( $field_group ) {
		// WP appends '__trashed' to end of 'key' (post_name).
		$key           = str_replace( '__trashed', '', $field_group['key'] );
		$group_setting = false;
		$acf_items     = wpfs_get_acf_items();

		$group_item = array_reduce(
			$acf_items,
			function ( $carry, $item ) use ( $key ) {
				return false === $carry && in_array( $key, array_column( $item['groups'], 'key' ), true ) ? $item : $carry;
			},
			false
		);

		if ( false !== $group_item ) {
			$group_index = array_search( $key, array_column( $group_item['groups'], 'key' ), true );
			if ( false !== $group_index ) {
				$group_setting = $group_item['groups'][ $group_index ];
			}
		}

		if ( false !== $group_setting ) {
			// Delete file.
			wpfs_acf_delete_file( $key, $group_setting );
		}
	}
}

if ( ! function_exists( 'wpfs_acf_save_file' ) ) {
	/**
	 * Function that actually saves the field group information back to a PHP file.
	 *
	 * @param string $key           The field group key.
	 * @param array  $group_setting The field group settings that contains the path to the file.
	 * @param array  $field_group   The field group data from the admin UI.
	 *
	 * @return bool
	 */
	function wpfs_acf_save_file( $key, $group_setting, $field_group ) {
		if ( isset( $group_setting ) && isset( $group_setting['file'] ) && isset( $group_setting['path'] ) ) {
			global $wp_filesystem;

			$file = $group_setting['file'];
			$path = get_template_directory() . $group_setting['path'];

			if ( ! is_writable( $path ) ) {
				return false;
			}

			// Translation.
			$l10n            = acf_get_setting( 'l10n' );
			$l10n_textdomain = acf_get_setting( 'l10n_textdomain' );

			if ( ! $l10n || ! $l10n_textdomain ) {
				$field_group['fields'] = acf_get_fields( $field_group );
			} else {
				acf_update_setting( 'l10n_var_export', true );

				$field_group = acf_translate_field_group( $field_group );

				// Reset store to allow fields translation.
				$store = acf_get_store( 'fields' );
				$store->reset();

				$field_group['fields'] = acf_get_fields( $field_group );

				acf_update_setting( 'l10n_var_export', false );

			}

			// prepare for export.
			$id          = acf_extract_var( $field_group, 'ID' );
			$field_group = acf_prepare_field_group_for_export( $field_group );

			// add modified time.
			$field_group['modified'] = get_post_modified_time( 'U', true, $id, true );

			// Prepare.
			$str_replace = array(
				'  '         => "\t",
				"'!!__(!!\'" => "__('",
				"!!\', !!\'" => "', '",
				"!!\')!!'"   => "')",
				'array ('    => 'array(',
			);

			$preg_replace = array(
				'/([\t\r\n]+?)array/' => 'array',
				'/[0-9]+ => array/'   => 'array',
			);

			$file_contents  = '<?php ' . PHP_EOL . PHP_EOL;
			$file_contents .= 'if ( function_exists( \'acf_add_local_field_group\' ) ) :' . PHP_EOL . PHP_EOL;

			// code.
			$code = var_export( $field_group, true );

			// change double spaces to tabs.
			$code = str_replace( array_keys( $str_replace ), array_values( $str_replace ), $code );

			// correctly formats "=> array(".
			$code = preg_replace( array_keys( $preg_replace ), array_values( $preg_replace ), $code );

			// echo.
			$file_contents .= sprintf( "acf_add_local_field_group(\n\t%s\n);", $code ) . PHP_EOL . PHP_EOL;

			$file_contents .= 'endif;';

			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();

			// Save and return true if bytes were written.
			$result = $wp_filesystem->put_contents( $path . '/' . $file, $file_contents, 0644 );

			return is_int( $result );
		}

		return false;
	}
}

if ( ! function_exists( 'wpfs_acf_delete_file' ) ) {
	/**
	 * Delete the field group file.
	 *
	 * @param string $key           The field group key.
	 * @param array  $group_setting The settings for the field group.
	 *
	 * @return bool
	 */
	function wpfs_acf_delete_file( $key, $group_setting ) {
		if ( isset( $group_setting ) && isset( $group_setting['file'] ) && isset( $group_setting['path'] ) ) {
			$file = $group_setting['file'];
			$path = get_template_directory() . $group_setting['path'];

			if ( is_readable( $file ) ) {
				unlink( $file );
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'wpfs_acf_setup_php' ) ) {
	/**
	 * Load the ACF Field Groups for the blocks.
	 *
	 * @return void
	 */
	function wpfs_acf_setup_php() {
		$acf_items = wpfs_get_acf_items();

		$bypass_admin = wpfs_is_acf_admin( 'production' );
		// Do not include PHP files in ACF Admin.
		if ( $bypass_admin ) {
			return;
		}

		foreach ( $acf_items as $item ) {
			$field_groups = $item['groups'];
			foreach ( $field_groups as $group ) {
				$group_file = get_template_directory() . $group['path'] . '/' . $group['file'];
				if ( file_exists( $group_file ) ) {
					require_once $group_file;
				}
				if ( ( function_exists( 'wp_get_environment_type' ) && 'production' !== wp_get_environment_type() ) ) {
					$option_sync = get_option( 'sync_' . $group['key'] );
					if ( ! isset( $option_sync ) || 'synched' !== $option_sync ) {
						$field_group = acf_get_field_group( $group['key'] );
						if ( is_array( $field_group ) && array_key_exists( 'key', $field_group ) ) {
							// load fields.
							$field_group['fields']     = acf_get_fields( $field_group );
							$field_group['local']      = 'json';
							$field_group['local_file'] = str_replace( 'php', 'json', $group_file );

							// prepare for export.
							$field_group = acf_prepare_field_group_for_export( $field_group );

							$field_group_post = acf_get_field_group_post( $field_group['key'] );

							if ( $field_group_post ) {
								if ( $field_group_post instanceof \WP_Post ) {
									$field_group['ID'] = $field_group_post->ID;
								} elseif ( is_array( $field_group_post ) ) {
									$field_group['ID'] = $field_group_post['ID'];
								}
							}

							// Import field group.
							$field_group = acf_import_field_group( $field_group );
							update_option( 'sync_' . $group['key'], 'synched' );
						}
					}
				}
			}
		}
	}
}
add_action( 'acf/init', 'wpfs_acf_setup_php', 100 );

if ( ! function_exists( 'wpfs_save_field_group' ) ) {
	/**
	 * Function that checks the proposed ACF field group on whether we want to allow
	 * for it to be saved as a json file.
	 *
	 * @param string $filename The default filename.
	 *
	 * @return string|bool
	 */
	function wpfs_save_field_group( $filename ) {
		$key       = str_replace( '.json', '', $filename );
		$acf_items = wpfs_get_acf_items();

		$group_item = array_reduce(
			$acf_items,
			function ( $carry, $item ) use ( $key ) {
				return false === $carry && in_array( $key, array_column( $item['groups'], 'key' ), true ) ? $item : $carry;
			},
			false
		);

		if ( false !== $group_item ) {
			return false;
		}

		return $filename;
	}
}

if ( ! function_exists( 'wpfs_is_acf_admin' ) ) {
	/**
	 * Checks whether the current page request is the admin for ACF.
	 *
	 * @param string $environment The environment to check if available.
	 *
	 * @return bool
	 */
	function wpfs_is_acf_admin( $environment = '' ) {
		global $pagenow;

		$environment_pass = true;
		if ( ! empty( $environment ) ) {
			$environment_pass = ( function_exists( 'wp_get_environment_type' ) && wp_get_environment_type() === $environment );
		}

		if ( ( ( 'edit.php' === $pagenow && 'acf-field-group' === acf_maybe_get_GET( 'post_type' ) && ! acf_maybe_get_GET( 'page' ) ) || ( 'post.php' === $pagenow && 'acf-field-group' === get_post_type( acf_maybe_get_GET( 'post' ) ) ) ) && $environment_pass ) {
			return true;
		}

		return false;
	}
}
