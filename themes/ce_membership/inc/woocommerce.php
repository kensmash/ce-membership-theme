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
function comics_experience_2022_woocommerce_setup() {
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
add_action( 'after_setup_theme', 'comics_experience_2022_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
/*function comics_experience_2022_woocommerce_scripts() {
	wp_enqueue_style( 'comics-experience-2022-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'comics-experience-2022-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'comics_experience_2022_woocommerce_scripts' );*/

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 * *
 * I disabled this because without default Woo styles, things look gross
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
*/

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function comics_experience_2022_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'comics_experience_2022_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function comics_experience_2022_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'comics_experience_2022_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'comics_experience_2022_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function comics_experience_2022_woocommerce_wrapper_before() {
		?>
<main id="primary" class="site-main container p-4 bg-white shadow-sm clearfix">
	<?php
	}
}
add_action( 'woocommerce_before_main_content', 'comics_experience_2022_woocommerce_wrapper_before' );

if ( ! function_exists( 'comics_experience_2022_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function comics_experience_2022_woocommerce_wrapper_after() {
		?>
</main><!-- #main -->
<?php
	}
}
add_action( 'woocommerce_after_main_content', 'comics_experience_2022_woocommerce_wrapper_after' );


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

add_action( 'woocommerce_before_single_product', 'display_courses_meta', 5 );
function display_courses_meta(){
	$content = "";

   if ( is_product() && has_term( 'courses', 'product_cat' ) ) {
	$content = get_template_part( 'template-parts/content', 'coursesmeta' );
} 

   return $content;
}


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
		global $product;
		//check for sale, if on sale get bundle template and course tabs
		if ( $product->is_on_sale() ) {
			/* well crap, this apparently has stopped working for Woo Discount Rules ? */
			$content = get_template_part( 'template-parts/content', 'coursebundle' ) . get_template_part( 'template-parts/tabs/tabs', 'courses' );
		} else {
			//else just get course tabs
			$content = get_template_part( 'template-parts/content', 'coursebundle' ) . get_template_part( 'template-parts/tabs/tabs', 'courses' );
			/* $content = get_template_part( 'template-parts/tabs/tabs', 'courses' ); */
		}	
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
* add course length above course thumbnail on archive pages
* https://code.tutsplus.com/tutorials/woocommerce-adding-the-product-short-description-to-archive-pages--cms-25435
*/
/*function woo_course_archive_showlength() {
      
    if ( has_term( 'courses', 'product_cat' ) ) {
		$content = get_template_part( 'template-parts/productsarchive/courses', 'length' );
	} 
    
    return $content;
      
}

add_action( 'woocommerce_before_shop_loop_item', 'woo_course_archive_showlength', 40 );*/


/*
* add course meta above course on archive pages
* https://www.businessbloomer.com/woocommerce-visual-hook-guide-archiveshopcat-page/
*/
function woo_course_archive_showmeta() {
      
    if ( has_term( 'courses', 'product_cat' ) ) {
		$content = get_template_part( 'template-parts/productsarchive/courses', 'meta' );
	} 
    
    return $content;
      
}

add_action( 'woocommerce_after_shop_loop_item_title', 'woo_course_archive_showmeta', 20 );

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












  