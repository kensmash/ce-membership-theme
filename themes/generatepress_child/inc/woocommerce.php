<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Comics_Experience_2022
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */

/**
 * WooCommerce customizations
 */
 
//remove product image zoom and lightbox
// https://generatepress.com/forums/topic/disable-lightbox-image-zoom-woocommerce/
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

add_filter('woocommerce_single_product_image_thumbnail_html','wc_remove_link_on_thumbnails' );
 
function wc_remove_link_on_thumbnails( $html ) {
     return strip_tags( $html,'<img>' );
}

//remove sku text
add_filter( 'wc_product_sku_enabled', '__return_false' );

/* remove categories text */
remove_action( 'woocommerce_single_product_summary',
'woocommerce_template_single_meta', 40 );

//remove breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

//remove showing x results text
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

//remove tab titles in tab content area
add_filter( 'woocommerce_product_description_heading', '__return_null' );


/*--------------------------------------------------------------
# WooCommerce Single Product Pages
--------------------------------------------------------------*/

//https://stackoverflow.com/questions/54702486/append-a-text-string-to-woocommerce-product-title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

function woocommerce_template_single_title_custom(){

	$bundle_button = NULL;
	$bundled_course = get_field('bundle', get_the_ID());

	if( $bundled_course ):
		//we are allowing a maximum of one in ACF, so this loop will return one result
		foreach( $bundled_course as $course ): 
			$product = wc_get_product($course->ID);
			 // Check if the product is published and visible
    		$is_published = $product->get_status() === 'publish';
    		$is_visible = $product->get_catalog_visibility() !== 'hidden';

			if ($is_published && $is_visible) {
				$bundle_permalink = get_permalink( $course->ID );
				$bundle_title = get_the_title( $course->ID );
				$bundle_button = '<div><a href="' . $bundle_permalink . '">Also available as part of: ' . $bundle_title . '</a></div>';
			}
			
		endforeach; 
	endif;

    the_title( '<h1 class="product_title entry-title">', '</h1>' . $bundle_button );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title_custom', 5);



/*--------------------------------------------------------------
# WooCommerce Archive Pages
--------------------------------------------------------------*/


/*--------------------------------------------------------------
# WooCommerce My Account Menu
--------------------------------------------------------------*/

// https://wpsimplehacks.com/how-to-merge-learndash-and-woocommerce/
// Add new tab to My Account menu

add_filter ( 'woocommerce_account_menu_items', 'wpsh_custom_endpoint', 40 );
function wpsh_custom_endpoint( $menu_links ){
 
	$menu_links = array_slice( $menu_links, 0, 5, true ) 
		// Add your own slug (support, for example) and tab title here below
	+ array( 'my-courses' => 'My Courses', 'my-membership' => 'My Memberships') 
	+ array_slice( $menu_links, 5, NULL, true );
 
	return $menu_links;
 
}
// Let’s register this new endpoint permalink

add_action( 'init', 'wpsh_new_endpoint' );
function wpsh_new_endpoint() {
	add_rewrite_endpoint( 'my-courses', EP_PAGES ); 
	add_rewrite_endpoint( 'my-membership', EP_PAGES );
}

// Now let’s add some content inside your endpoint

add_action( 'woocommerce_account_my-courses_endpoint', 'wpsh_endpoint_content' ); // If you change your slug above then don’t forget to change it also inside this function
function wpsh_endpoint_content() {
	echo do_shortcode('[ld_profile show_header="no" show_search="no"]');
}

add_action( 'woocommerce_account_my-membership_endpoint', 'wpmember_endpoint_content' ); // If you change your slug above then don’t forget to change it also inside this function
function wpmember_endpoint_content() {
 
	$pmp_member = pmpro_getMembershipLevelForUser(get_current_user_id());

	if ($pmp_member) {
		// At the moment I will add Learndash profile with the shordcode
		 echo ('<h3>My Membership: ');
		echo do_shortcode('[pmpro_member field="membership_name"]');
		echo ('</h3>');
		echo ('<p><a href="/membership-account/membership-cancel/">Cancel Membership</a></p>'); 
		//echo ('<p><a href="/membership-account/">Billing Details</a> | <a href="/membership-account/membership-levels/">Change Membership</a> | <a href="/membership-account/membership-cancel/">Cancel Membership</a></p>'); 

		//echo do_shortcode('[pmpro_account sections="membership" title="My Membership"]');

		echo (
			'<div class="my-memberships-section-container">
			<h4>Connect with our Discord Community</h4>
			<p>Please note you <b>must have a Discord account and be logged in</b> prior to connecting to our Community. If you do not have a Discord account, <a href="https://discord.com" target="_blank">sign up here.</a> If you have any questions, please email us at <a href="mailto:info@comicsexperience.com">info@comicsexperience.com.</a></p>'
			);
		echo do_shortcode('[discord_connect_button]');
		echo '</div>';
		echo '<hr>';
	
		echo do_shortcode('[pmpro_account sections="invoices"]');
		
		
		//echo ('<h4>My Avatar</h4>');
		//echo do_shortcode('[basic-user-avatars]');
	
		 if ($pmp_member->name == 'Community Pro'):
			echo (
				'<div class="my-memberships-section-container">
				<h4>Exclusive Member Download</h4>
				<p><a href="https://drive.google.com/file/d/1d8LKGidRS8UbZLNAJ563BcnBjtnQxdZ3/view" target="_blank">The Business of Independent Comic Book Publishing</a></p>
				</div>'
				);
		endif; 
		
		echo ('</p>');
	} else {
		echo ('<h3>You do not currently have a Community Membership.</h3>');
		echo ('<p><b><a href="/community/">Purchase Membership</a></b></p>');
	}
	
}

// Change Woocommerce endpoint order

add_filter ( 'woocommerce_account_menu_items', 'wpsh_custom_endpoint_order' );
function wpsh_custom_endpoint_order() {
 $myorder = array(
        'dashboard'          => __( 'Dashboard', 'woocommerce' ),
	 	'my-courses'    	 => __( 'Your courses', 'woocommerce' ), // Don’t forget to change the slug and title here
		'my-membership'    	 => __( 'Your membership', 'woocommerce' ), // Don’t forget to change the slug and title here
        'orders'             => __( 'Your orders', 'woocommerce' ), 
        'edit-account'       => __( 'Account details', 'woocommerce' ),
	 	'edit-address'       => __( 'Edit address', 'woocommerce' ),
        'customer-logout'    => __( 'Log out', 'woocommerce' ),
    );
    return $myorder;
}

/* remove more products tab added by Dokan */
/* https://wordpress.org/support/topic/how-to-remove-more-products-tab-and-seller-info-tab-in-dokan-plugin/ */
 add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_more_seller_product_tab', 98 );
    function wcs_woo_remove_more_seller_product_tab($tabs) {
    unset($tabs['more_seller_product']);
    return $tabs;
}

// https://wordpress.org/support/topic/remove-vendor-in-order-email/
remove_action( 'woocommerce_order_item_meta_start', 'dokan_attach_vendor_name', 10, 2 );

/* https://wordpress.org/support/topic/change-checkout-login-message-and-class/ */
add_filter( 'woocommerce_checkout_login_message', 'mycheckoutmessage_return_customer_message' );
function mycheckoutmessage_return_customer_message() {
	return '<span class="login-message">Returning customer or member?</span>';
}


//add purchased products column to column list
// https://rudrastyh.com/woocommerce/columns.html#purchased_products_column

// legacy – for CPT-based orders
add_filter( 'manage_edit-shop_order_columns', 'misha_order_items_column' );
// for HPOS-based orders
add_filter( 'manage_woocommerce_page_wc-orders_columns', 'misha_order_items_column' );

function misha_order_items_column( $columns ) {

	// let's add our column before "Total"
	$columns = array_slice( $columns, 0, 4, true ) // 4 columns before
	+ array( 'order_products' => 'Purchased products' ) // our column is going to be 5th
	+ array_slice( $columns, 4, NULL, true );

	return $columns;

}

// legacy – for CPT-based orders
add_action( 'manage_shop_order_posts_custom_column', 'misha_populate_order_items_column', 25, 2 );
// for HPOS-based orders
add_action( 'manage_woocommerce_page_wc-orders_custom_column', 'misha_populate_order_items_column', 25, 2 );
function misha_populate_order_items_column( $column_name, $order_or_order_id ) {

	// legacy CPT-based order compatibility
	$order = $order_or_order_id instanceof WC_Order ? $order_or_order_id : wc_get_order( $order_or_order_id );

	if( 'order_products' === $column_name ) {

		$items = $order->get_items();
		if( ! is_wp_error( $items ) ) {
			foreach( $items as $item ) {
 				echo $item[ 'quantity' ] .' × <a href="' . get_edit_post_link( $item[ 'product_id' ] ) . '">'. $item[ 'name' ] .'</a><br />';
				// you can also use $order_item->variation_id parameter
				// by the way, $item[ 'name' ] will display variation name too
			}
		}

	}

}



  