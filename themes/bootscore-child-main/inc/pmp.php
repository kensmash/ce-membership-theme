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

/* https://www.paidmembershipspro.com/redirect-members/ */
/* https://wordpress.stackexchange.com/questions/325574/how-to-use-login-redirect-with-a-user-capability */
/* function my_login_redirect( $redirect_to, $request, $user ) {

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

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 ); */

/* https://www.paidmembershipspro.com/limit-user-active-sessions/ */
function my_wp_bouncer_number_simultaneous_logins($num) {
	return 3;
}
add_filter('wp_bouncer_number_simultaneous_logins', 'my_wp_bouncer_number_simultaneous_logins');