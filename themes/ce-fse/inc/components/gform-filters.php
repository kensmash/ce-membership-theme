<?php
/**
 * Gravity Form Filters
 *
 * @package comics-experience
 */

if ( ! function_exists( 'comics-experience_gform_init_scripts' ) ) {
	/**
	 * Forces gravity forms scritps to load in the footer
	 *
	 * This filter is executed during form load. When set to true,
	 * the form init scripts are loaded in the footer of the site,
	 * instead of the default location of which is in the page body
	 * immediately after the form.
	 *
	 * @link https://www.gravityhelp.com/documentation/article/gform_init_scripts_footer/
	 *
	 * @method comics-experience_gform_init_scripts
	 * @return bool - If true load scripts in the footer
	 */
	function comics-experience_gform_init_scripts() {
		return true;
	}
}
add_filter( 'gform_init_scripts_footer', 'comics-experience_gform_init_scripts' );


if ( ! function_exists( 'comics-experience_gform_anchor' ) ) {
	/**
	 * Use this filter to enable or disable the confirmation anchor
	 * functionality that will automatically scroll the page. This can be used
	 * on specific forms as well, read documentation:
	 *
	 * @link https://docs.gravityforms.com/gform_confirmation_anchor/
	 *
	 * @method comics-experience_gform_anchor
	 * @return string - __return_false or __return_true
	 */
	function comics-experience_gform_anchor() {
		return '__return_true';
	}
}
add_filter( 'gform_confirmation_anchor', 'comics-experience_gform_anchor' );
