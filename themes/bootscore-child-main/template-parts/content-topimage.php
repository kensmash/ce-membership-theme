<?php
/**
 * Template part for displaying top images in pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Comics_Experience_2022
 */

?>

<?php
if( get_field('show_header_image') || is_archive('scripts')) { ?>

<?php
	// load random photo from header-images folder
	// http://zzamboni.org/new/brt/2008/11/03/how-to-display-random-header-images-in-a-wordpress-theme/index.html
	$curdir=getcwd(); chdir(get_template_directory() . "/images/subpage_images/");
	$files=glob("*.{gif,png,jpg}", GLOB_BRACE);
	chdir($curdir);
	$file=$files[array_rand($files)];
?>
<img src=" <?php echo(get_bloginfo('template_url')."/images/subpage_images/$file"); ?>" class="img-fluid" alt="Comic Art" />

<?php } ?>