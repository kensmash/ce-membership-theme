<?php
/**
 * ACF Countdown Clock Template.
 *
 * @package acf_umc_fields
 */
?>

<?php wp_foundation_six_dev_helper( pathinfo( __FILE__, PATHINFO_FILENAME ) ); ?>

<?php
// Create id attribute allowing for custom "anchor" value.
$umc_id = 'umc-inner-header-' . $block['id'];

if ( ! empty( $block['anchor'] ) ) {
	$umc_id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$umc_class_name = 'umc-inner-header';

if ( ! empty( $block['className'] ) ) {
	$umc_class_name .= ' ' . $block['className'];
}

if ( ! empty( $block['align'] ) ) {
	$umc_class_name .= ' align' . $block['align'];
}

//$umc_title_override         = get_field( 'umc_inner_header_title_override' );
//$umc_hide_title             = get_field( 'hide_title', get_the_ID() );

wp_enqueue_style( 'block-acf-umc-countdown-clocks-style' );
wp_enqueue_script( 'block-acf-umc-countdown-clocks-script' );

?>

<div
	id="<?php echo esc_attr( $umc_id ); ?>"
	class="<?php echo esc_attr( $umc_class_name ); ?>"
>

	<?php
		$background_image = get_field('background_image');
		$webp_image_path  = get_attached_file( $background_image['id'], true ) . '.webp';
		$webp_image_url = '';
		if ( file_exists( $webp_image_path ) ) {
			$webp_image_url = $background_image['url'] . '.webp';
		}
	?>


	<div class="umc-countdown-clock" style="<?php echo !empty( $webp_image_url ) ? 'background-image: linear-gradient(rgba( 0, 0, 0, 0.5), rgba( 0, 0, 0, 0.5)), url(\'' . $webp_image_url . '\');' : 'background-image: linear-gradient(rgba( 0, 0, 0, 0.5), rgba( 0, 0, 0, 0.5)), url(\'' . $background_image['url'] . '\');' ?>">
		<div class="umc-countdown-clock__content">
			<?php the_field('content'); ?>
		</div>

		<?php
			$time = strtotime(get_field('countdown_date'));
			$now = time();
			if ($time > $now) {
		?>
			<div class="umc-countdown-clock__timer" data-countdowndate="<?php the_field('countdown_date'); ?>">
				<div id="days"></div>
				<div id="hours"></div>
				<div id="minutes"></div>
				<div id="seconds"></div>
			</div>
		<?php }?>

		<div class="umc-countdown-clock__button">
			<a class="button secondary" href="<?php the_field('button_link'); ?>"><?php echo esc_html( get_field('button_text') ); ?></a>
		</div>
	</div>

</div>