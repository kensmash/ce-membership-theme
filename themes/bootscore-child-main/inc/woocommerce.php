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
		$content = get_template_part( 'template-parts/tabs/tabs', 'page' );
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


/* display sale badge in custom loop */
/* https://www.skyverge.com/blog/get-a-list-of-woocommerce-sale-products/ */
/* https://stackoverflow.com/questions/57193661/woocommerce-how-display-discount-in-custom-loop */
function display_sale_badge() {
	global $product;
	if ( $product->is_on_sale() ) {
		echo '<span class="onsale">Sale!</span>'; 
	}
 }


 // Disable AJAX Cart
 function register_ajax_cart() {
}
add_action('after_setup_theme', 'register_ajax_cart'); 












  