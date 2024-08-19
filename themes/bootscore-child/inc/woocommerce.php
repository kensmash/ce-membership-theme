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
function comics_experience_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 500,
			'single_image_width'    => 800,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'comics_experience_woocommerce_setup' );


/**
 * WooCommerce customizations
 */
 
//remove product image zoom and lightbox
add_action( 'after_setup_theme', 'remove_ce_theme_support', 100 );
function remove_ce_theme_support() { 
remove_theme_support( 'wc-product-gallery-zoom' );
remove_theme_support( 'wc-product-gallery-lightbox' );
}

//remove sku text
add_filter( 'wc_product_sku_enabled', '__return_false' );

/* remove categories text */
remove_action( 'woocommerce_single_product_summary',
'woocommerce_template_single_meta', 40 );

//remove breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

//remove product sort drop down
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

//remove showing x results text
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

//remove related products
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * Move coupon message to bottom of form
 * https://jilt.com/blog/move-the-woocommerce-coupon-field/
 */

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

add_action( 'woocommerce_after_checkout_form', 'woocommerce_checkout_coupon_form' );

//add_action( 'woocommerce_after_add_to_cart_button', 'add_content_after_addtocart_button_func' );

/*--------------------------------------------------------------
# WooCommerce Single Product  Pages
--------------------------------------------------------------*/
/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
	global $product;
	  
	  $args['posts_per_page'] = 6;
	  return $args;
  }

  add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
	function jk_related_products_args( $args ) {
	  $args['posts_per_page'] = 4; // 4 related products
	  $args['columns'] = 4; // arranged in 2 columns
	  return $args;
  }

/**
 * Remove related products output
*/
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

 /**
 * Add course meta info before title
 * *https://wordpress.org/support/topic/add-content-under-single-product-title/
 */ 

 /* add_action( 'woocommerce_before_single_product', 'display_courses_meta', 5 );
 function display_courses_meta(){
	 $content = "";
 
	if ( is_product() && has_term( 'courses', 'product_cat' ) ) {
	 $content = get_template_part( 'template-parts/content', 'coursesmeta' );
 } 
 
	return $content;
 } */
 

/**
  * Remove default product page tabs
  */
 add_filter( 'woocommerce_product_tabs', 'my_remove_all_product_tabs', 98 );
  
 function my_remove_all_product_tabs( $tabs ) {
   unset( $tabs['description'] );        // Remove the description tab
   unset( $tabs['reviews'] );       // Remove the reviews tab
   unset( $tabs['additional_information'] );    // Remove the additional information tab
   return $tabs;
 }
 
/**
 * Add in custom tabs based on category
 */ 
add_action( 'woocommerce_after_single_product_summary', 'product_custom_content', 10);

function product_custom_content() {
	/* https://docs.woocommerce.com/document/remov-product-content-based-on-category */
	//is it a course?
	if ( is_product() && has_term( 'courses', 'product_cat' ) ) {
			/* $content = get_template_part( 'template-parts/content', 'coursebundle' ) . get_template_part( 'template-parts/tabs/tabs', 'courses' ); */
			$content = get_template_part( 'template-parts/tabs/tabs', 'courses' );	
	} else {
		//else get page tabs
		$content = get_template_part( 'template-parts/tabs/tabs', 'products' );
	}
    
    return $content;
    
}

/*
 * Woocommerce swap short product description and full description
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'the_content', 20 );

/*--------------------------------------------------------------
# WooCommerce Archive Pages
--------------------------------------------------------------*/

/*
* add product short description on archive pages
* https://code.tutsplus.com/tutorials/woocommerce-adding-the-product-short-description-to-archive-pages--cms-25435
*/
function woo_excerpt_in_product_archives() {
      
	//echo wp_trim_words( get_the_excerpt(), 55 );
	/*if ( has_term( 'courses', 'product_cat' ) ) {
		echo '<p class="archive-description">' . get_the_excerpt() . '</p>';
	}*/
	echo '<p class="wooarchive-description">' . get_the_excerpt() . '</p>';
      
}

add_action( 'woocommerce_after_shop_loop_item_title', 'woo_excerpt_in_product_archives', 40 );

 
//https://stackoverflow.com/questions/50562595/remove-woocommerce-cart-quantity-selector-from-cart-page
add_filter( 'woocommerce_cart_item_quantity', 'wc_cart_item_quantity', 10, 3 );
function wc_cart_item_quantity( $product_quantity, $cart_item_key, $cart_item ){
if( is_cart() ){
$product_quantity = sprintf( '%2$s <input type="hidden" name="cart[%1$s][qty]" value="%2$s" />', $cart_item_key, $cart_item['quantity'] );
}
return $product_quantity;
}


// Disable AJAX Cart, at least until TutorLMS issue is fixed
/* function register_ajax_cart() {
}
add_action('after_setup_theme', 'register_ajax_cart'); */

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
		/* echo ('<h3>My Membership: ');
		echo do_shortcode('[pmpro_member field="membership_name"]');
		echo ('</h3>');
		echo ('<p><a href="/membership-account/">Billing Details</a> | <a href="/membership-account/membership-levels/">Change Membership</a> | <a href="/membership-account/membership-cancel/">Cancel Membership</a></p>'); */

		echo do_shortcode('[pmpro_account sections="membership" title="My Membership"]');

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

/* add_filter( 'woocommerce_login_redirect', 'learndash_login_redirect', 9999, 2 );
function learndash_login_redirect( $redirect, $user ) {
    if ( wc_user_has_role( $user, 'customer' ) ) {
       $redirect = '/my-account/my-courses/'; // custom URL same site
    } 
    return $redirect;
} */

// Edit profile link under the Learndash profile avatar and clicking on that link opens up WordPress backend profile.
// change link to go to My Account page
if( !is_admin() ) {
	add_filter( 'get_edit_user_link', function( $link, $user_id ) {
		$link = "/my-account/edit-account/"; // HERE GOES THE EDIT ACCOUNT ENDPOINT URL
		return $link;
	}, 30, 2 );
}

//https://stackoverflow.com/questions/54975625/exclude-a-product-category-from-woocommerce-related-products
add_filter( 'woocommerce_related_products', 'exclude_product_category_from_related_products', 10, 3 );
function exclude_product_category_from_related_products( $related_posts, $product_id, $args ){

// Get the product ids in the defined product category
$exclude_ids = wc_get_products( array(
	'status' => 'publish',
	'limit' => -1,
	'category' => array('professional-service', 'community'),
	'return' => 'ids',
) );

return array_diff( $related_posts, $exclude_ids );
}

/* remove more products tab added by Dokan */
/* https://wordpress.org/support/topic/how-to-remove-more-products-tab-and-seller-info-tab-in-dokan-plugin/ */
 add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_more_seller_product_tab', 98 );
    function wcs_woo_remove_more_seller_product_tab($tabs) {
    unset($tabs['more_seller_product']);
    return $tabs;
}

/*
 * get instructors
 */

function ce_courseloop_instructors($postId){
	$instructorNumber = count(get_field('instructors', $postId)); //get the total number of instructors from our Instructor field
	$cohost = get_field('co-host', $postId); 
			
	if ($instructorNumber == 1) { //just one instructor
			$instructor = get_field('instructors', $postId);
			foreach ($instructor as $post_id) {
				$the_post = get_post($post_id);
				$the_permalink = get_permalink($post_id);
				echo "Instructor: ". $the_post->post_title;
			} 
	} else { //two instructors
			echo "Instructors: ";
			$instructor = get_field('instructors', $postId);
			$i = 0;
			foreach ($instructor as $post_id) {
				$i++;
				$the_post = get_post($post_id);
				$the_permalink = get_permalink($post_id);
				echo "$the_post->post_title";
				if ($i != $instructorNumber) echo' and '; // add and
		}
	}
 }

 function ce_instructors($outputString){	
	$instructorNumber = count(get_field('instructors')); //get the total number of instructors from our Instructor field
	$cohost = get_field('co-host'); 
	$leftText = "Instructor";
	//if we pass an argument to the function, that argument will be the left text
	if ($outputString !== '') {
		$leftText = $outputString;
	}
					
		if ($instructorNumber == 1) { //just one instructor
				$instructor = get_field('instructors');
				foreach ($instructor as $post_id) {
					$the_post = get_post($post_id);
					$the_permalink = get_permalink($post_id);
					echo "$leftText";
					if ($outputString == '') {
						echo ": ";
					}
					echo "$the_post->post_title";
				} 
		} else { //two instructors
				echo "$leftText";
				if ($outputString == '') {
					echo "s: ";
				}
				$instructor = get_field('instructors');
				$i = 0;
				foreach ($instructor as $post_id) {
					$i++;
					$the_post = get_post($post_id);
					$the_permalink = get_permalink($post_id);
					echo "$the_post->post_title";
					if ($i != $instructorNumber) echo' and '; // add and
			}
		}
				
	if (isset($cohost)){
		foreach ($cohost as $post_id) { 
		    	$the_post = get_post($post_id);
		    	$the_permalink = get_permalink($post_id);
		    	echo "</span> | <span> Co-Host: $the_post->post_title</span>";
		    		
		   }
	 }
}

// https://wordpress.org/support/topic/remove-vendor-in-order-email/
remove_action( 'woocommerce_order_item_meta_start', 'dokan_attach_vendor_name', 10, 2 );

/* https://wordpress.org/support/topic/change-checkout-login-message-and-class/ */
add_filter( 'woocommerce_checkout_login_message', 'mycheckoutmessage_return_customer_message' );
function mycheckoutmessage_return_customer_message() {
	return '<span class="login-message">Returning customer or member?</span>';
}

/* https://stackoverflow.com/questions/66987369/hide-product-from-woocommerce-shop-page-if-it-has-already-been-purchased */
add_action( 'pre_get_posts', 'hide_product_from_shop_page_if_user_already_purchased', 20 );

function hide_product_from_shop_page_if_user_already_purchased( $query ) {
   
    if ( ! $query->is_main_query() ) return;
   
    if ( ! is_admin() && is_shop() ) {

        $current_user = wp_get_current_user();
        if ( 0 == $current_user->ID ) return;
       
        $customer_orders = get_posts( array(
            'numberposts' => -1,
            'meta_key'    => '_customer_user',
            'meta_value'  => $current_user->ID,
            'post_type'   => 'shop_order',
            'post_status' => array( 'wc-processing', 'wc-completed' ),
        ) );
       
        if ( ! $customer_orders ) return;
        
        $product_ids = array();
        
        foreach ( $customer_orders as $customer_order ) {
            $order = wc_get_order( $customer_order->ID );
            if( $order ){
                $items = $order->get_items();
                foreach ( $items as $item ) {
                    $product_id    = $item->get_product_id();
                    $product_ids[] = $product_id;
                }
            }
        }

        $product_ids = array_unique( $product_ids );

        $query->set( 'post__not_in', $product_ids );
    }

}

/* change add to cart buttons in related products output */
/* https://stackoverflow.com/questions/77461593/change-woocommerce-product-loop-add-to-cart-button-to-a-view-more-linked-to-th */
/* add_filter( 'woocommerce_loop_add_to_cart_link', 'replace_external_product_loop_add_to_cart_link', 100, 3 );
function replace_external_product_loop_add_to_cart_link( $button, $product, $args ) {
    return sprintf( '<a href="%s" class="%s" %s>%s</a>',
        esc_url( $product->get_permalink() ),
        esc_attr( 'product_type_simple add_to_cart_button ajax_add_to_cart btn btn-primary w-100 mt-auto' ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        esc_html__( 'Learn More' )
    );
} */


/**
 * @snippet       Custom Redirect for Logins @ WooCommerce My Account
 * @compatible    WooCommerce 6
 */
 
 /* add_filter( 'woocommerce_login_redirect', 'ce_customer_login_redirect', 9999 );
 
 function ce_customer_login_redirect( $redirect_url ) {
	 $redirect_url = home_url('/my-account/');
	 return $redirect_url;
 } */



/* https://www.wpfloor.com/hide-price-range-for-woocommerce-variable-products/ */
//Hide Price Range for WooCommerce Variable Products
/* 
add_filter( 'woocommerce_variable_sale_price_html', 
'lw_variable_product_price', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 
'lw_variable_product_price', 10, 2 );

function lw_variable_product_price( $v_price, $v_product ) {

// Product Price
$prod_prices = array( $v_product->get_variation_price( 'min', true ), 
                            $v_product->get_variation_price( 'max', true ) );
$prod_price = $prod_prices[0]!==$prod_prices[1] ? sprintf(__('From %1$s', 'woocommerce'), 
                       wc_price( $prod_prices[0] ) ) : wc_price( $prod_prices[0] );

// Regular Price
$regular_prices = array( $v_product->get_variation_regular_price( 'min', true ), 
                          $v_product->get_variation_regular_price( 'max', true ) );
sort( $regular_prices );
$regular_price = $regular_prices[0]!==$regular_prices[1] ? sprintf(__('From %1$s','woocommerce')
                      , wc_price( $regular_prices[0] ) ) : wc_price( $regular_prices[0] );

if ( $prod_price !== $regular_price ) {
$prod_price = '<del>'.$regular_price.$v_product->get_price_suffix() . '</del> <ins>' . 
                       $prod_price . $v_product->get_price_suffix() . '</ins>';
}
return $prod_price;
}
*/

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

  