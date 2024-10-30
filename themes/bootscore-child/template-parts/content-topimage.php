<?php
/**
 * Template part for displaying top images in pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* @package Bootscore
 * @version 6.0.0
 */

?>

<?php
if( get_field('show_header_image') || is_archive('script') || is_single('post') ) { 

	$image = get_field('custom_header_image');
	if( !empty( $image ) ): ?>

		<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid header-image" />

	<?php else:
	// load random photo from header-images folder
	// http://zzamboni.org/new/brt/2008/11/03/how-to-display-random-header-images-in-a-wordpress-theme/index.html
	$curdir=getcwd(); chdir(get_stylesheet_directory() . "/assets/images/subpage_images/");
	$files=glob("*.{gif,png,jpg}", GLOB_BRACE);
	chdir($curdir);
	$file=$files[array_rand($files)];
	?>
	<img src=" <?php echo(get_stylesheet_directory_uri() . "/assets/images/subpage_images/$file"); ?>" class="img-fluid header-image" alt="Comic Art" />

	<?php endif; ?>

<?php } ?>