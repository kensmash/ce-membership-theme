<?php
/**
 * Move required asterisk on PMPro checkout page from after the field to inside the field label
 *
 * You can add this recipe to your site by creating a custom plugin
 * or using the Code Snippets plugin available for free in the WordPress repository.
 * Read this companion article for step-by-step directions on either method.
 * https://www.paidmembershipspro.com/create-a-plugin-for-pmpro-customizations/
 */

function my_pmpro_move_required_asterisk_span() {
	global $pmpro_pages;

	$shipping_asterisk = false;
	if ( defined( 'PMPRO_SHIPPING_VERSION' ) && defined( 'PMPRO_SHIPPING_SHOW_REQUIRED' ) && PMPRO_SHIPPING_SHOW_REQUIRED ) {
		$shipping_asterisk = true;
	}

	if ( is_page( $pmpro_pages['checkout'] ) || is_page( $pmpro_pages['billing'] ) || is_page( $pmpro_pages['member_profile_edit'] ) ) {
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				// HTML for required asterisk
				var asteriskHtml = '<span class="pmpro_asterisk"> <abbr title="Required Field">*</abbr> </span>';

				// Remove asterisks
				jQuery('.pmpro_checkout-field-required .pmpro_asterisk').remove();
				jQuery('.pmpro_required').next('.pmpro_asterisk').remove();
				<?php
				if ( $shipping_asterisk ) {
					?>
					jQuery('#pmpro_shipping_address_fields .pmpro_checkout-fields #shipping-fields .pmpro_asterisk').remove();
					<?php
				}
				?>

				// Add asterisk inside label for all User fields. For backward compatibility exclude deprecated Register Helper grouped input fields.
				jQuery('div.pmpro_checkout-field-required label').not('.pmprorh_checkbox_label').not('.pmprorh_radio_label').append(asteriskHtml);

				// Array of required by default fields
				var otherFields = ['username','password','password2','bemail','bconfirmemail','first_name','last_name','bfirstname','blastname','baddress1','bcity','bstate','bzipcode','bcountry','bphone'];

				<?php
				if ( $shipping_asterisk ) {
					?>
					var shippingFields = ['sfirstname','slastname','saddress1','scity','sstate','szipcode','scountry','sphone'];

					// add shipping fields to otherFields array
					otherFields = otherFields.concat(shippingFields);
					<?php
				}
				?>

				// Add asterisk for fields in otherFields array.
				jQuery.each(otherFields, function (i, value){
					jQuery('[name="' + value + '"]').next('.pmpro_asterisk').remove();
					jQuery('[name="' + value + '"]').prev('label').append(asteriskHtml);
					jQuery('[name="pmpro_' + value + '"]').prev('label').append(asteriskHtml);
				});


			});
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'my_pmpro_move_required_asterisk_span', 20 );

/**
 * Add strike through pricing if the membership pricing is available for currrent user viewing Woo store.
 * 
 * title: Strike through pricing WooCommerce
 * layout: snippet
 * collection: add-ons, pmpro-woocommerce
 * category: woocommerce, pricing, UI
 * 
 * You can add this recipe to your site by creating a custom plugin
 * or using the Code Snippets plugin available for free in the WordPress repository.
 * Read this companion article for step-by-step directions on either method.
 * https://www.paidmembershipspro.com/create-a-plugin-for-pmpro-customizations/
 */
 
 function my_pmprowoo_strike_prices( $price, $product ) {
	global $pmprowoo_member_discounts, $current_user;
 
	// Let's not do this in the admin area, if PMPro is not active, or if the user does not have a membership level.
	if ( is_admin() || ! function_exists( 'pmpro_hasMembershipLevel' ) || ! pmpro_hasMembershipLevel() ) {
		return $price;
	}
 
	$formatted_price = ''; // Define the new variable.
	$level_id = $current_user->membership_level->id;
 
	// get pricing for simple product
	if ( $product->is_type( 'simple' ) || $product->is_type( 'virtual' ) || $product->is_type( 'course' ) ) {
		// get normal non-member price.
		$regular_price = get_post_meta( $product->get_id(), '_regular_price', true );
		$sale_price    = get_post_meta( $product->get_id(), '_sale_price', true );
 
		// Get the membership price, this checks if the product has level pricing etc.
		if ( ! empty( $sale_price ) ) {
			$regular_price = $sale_price;
			$price         = pmprowoo_get_membership_price( $regular_price, $product );
		} else {
			$price = pmprowoo_get_membership_price( $regular_price, $product );
		}
 
		// only show this to members and if the price isn't already the same as regular price.
		if ( isset( $level_id ) && floatval($price) !== floatval($regular_price) ) {
			$formatted_price = '<del>' . wc_price( $regular_price ) . '</del> ';
		}
 
		$formatted_price .= wc_price( $price );
		// update price variable so we can return it later.
		$price = $formatted_price;
	}
 
	// get pricing for variable products.
	if ( $product->is_type( 'variable' ) ) {
		$prices        = $product->get_variation_prices( true );
		$min_price     = current( $prices['price'] );
		$max_price     = end( $prices['price'] );
		$regular_range = wc_format_price_range( $min_price, $max_price );
		if ( isset( $level_id ) && ! empty( $pmprowoo_member_discounts ) && ! empty( $pmprowoo_member_discounts[ $level_id ] ) ) {
			$formatted_price = '<del>' . $regular_range . '</del> ';
		}
		$formatted_price .= $price;
		$price            = $formatted_price;
	}
 
	return $price;
}
add_filter( 'woocommerce_get_price_html', 'my_pmprowoo_strike_prices', 10, 2 );

/* https://www.paidmembershipspro.com/redirect-members/ */
/* https://wordpress.stackexchange.com/questions/325574/how-to-use-login-redirect-with-a-user-capability */
function my_login_redirect( $redirect_to, $request, $user ) {

    if ( is_a ( $user , 'WP_User' ) && $user->exists() ) {

        if ( pmpro_getMembershipLevelForUser($user->ID) ) {
			//send them to buddypress activity page
            //$redirect_to = home_url('/activity/');
			$redirect_to = home_url('/my-account/');
        } else {
			//not a member, send them to Woo dashboard
			$redirect_to = home_url('/my-account/');
	
		}

    }

    return $redirect_to;
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

/* https://www.paidmembershipspro.com/limit-user-active-sessions/ */
function my_wp_bouncer_number_simultaneous_logins($num) {
	return 3;
}
add_filter('wp_bouncer_number_simultaneous_logins', 'my_wp_bouncer_number_simultaneous_logins');


