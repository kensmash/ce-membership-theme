<?php
/**
 * Title: Footer links
 * Slug: comics-experience/footer-links
 * Categories: footer
 * Inserter: no
 *
 * @package comics-experience
 * @since 1.0.0
 */

?>
<!-- wp:columns {"align":"full"} -->
<div class="wp-block-columns alignfull">
<!-- wp:column {"width":"33%"} --><div class="wp-block-column" style="flex-basis:33%">
<!-- wp:navigation {"textColor":"off-white","overlayMenu":"never","overlayBackgroundColor":"background","overlayTextColor":"off-white","layout":{"type":"flex","justifyContent":"left","orientation":"horizontal"},"fontSize":"extra-small"} /-->
</div><!-- /wp:column -->
<!-- wp:column {"width":"33%"} --><div class="wp-block-column" style="flex-basis:33%"></div><!-- /wp:column -->
<!-- wp:column {"width":"33%"} --><div class="wp-block-column" style="flex-basis:33%">
<!-- wp:social-links {"iconColor":"primary","iconColorValue":"var(--wp--preset--color--off-white)","className":"is-style-logos-only","layout":{"type":"flex","justifyContent":"right"}} -->
<ul class="wp-block-social-links has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"https://wordpress.org","service":"wordpress"} /--></ul>
<!-- /wp:social-links -->
</div><!-- /wp:column -->
</div>
<!-- /wp:columns -->
<!-- wp:group {"align":"full","layout":{"type":"flex","allowOrientation":false,"justifyContent":"center"}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"layout":{"type":"flex","allowOrientation":false},"style":{"spacing":{"blockGap":".5rem"}}} --><div class="wp-block-group">
<!-- wp:paragraph {"color":"off-white","fontSize":"extra-small"} --><p class="has-extra-small-font-size has-text-color has-off-white-color"><?php echo __( '&copy;', 'comics-experience' ) . ' ' . date_i18n( _x( 'Y', 'copyright date format', 'comics-experience' ) ); ?></p><!-- /wp:paragraph -->
<!-- wp:site-title {"color":"off-white","level":0, "fontSize":"extra-small","style":{"elements":{"link":{"color":{"text":"var:preset|color|off-white"}}}}} /--><?php echo comics-experience_privacy(); ?>
</div><!-- /wp:group -->
</div><!-- /wp:group -->
