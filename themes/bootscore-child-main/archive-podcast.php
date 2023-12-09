<?php
/**
 * The template for displaying podcast archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Comics_Experience_2021
 */

get_header();
?>

<main id="main" class="container pt-5">

	<?php if ( have_posts() ) : 
        
		$page = get_query_var('paged'); // get which page number we are on
		$counter = 0;
		$queried_object = get_queried_object();

		set_query_var('podcast', true); 
		$prevText = "Older episodes &raquo;";
		$nextText = "&laquo; Newer episodes"; 
		?>

	<header class="page-header pt-4 pb-3 px-2">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<div class="row pt-2 pb-3">

			<p>The <strong>Comics Connection</strong> podcast provides ~15 minutes of advice per episode on all aspects of creating comics and breaking in to the industry.</p>

			<p>Do you have a question about making comics you'd like to hear discussed on the podcast? Email us at <a href="mailto:info@comicsexperience.com">info@comicsexperience.com.</a></p>

		</div>
	</header><!-- .page-header -->

	<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				$counter++; // add +1 to count for each post
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				if ($counter === 1 AND $paged <= 1) {
					get_template_part( 'template-parts/content', get_post_type() );
				} else {
					get_template_part( 'template-parts/content-excerpt' );
				}

			endwhile;
			?>

	<nav aria-label="Page navigation" class="col-12">
		<div class="row px-4">
			<div class="col-md-6 text-center text-md-start"><?php previous_posts_link( $nextText ); ?></div>
			<div class="col-md-6 text-center text-md-end"><?php next_posts_link( $prevText ); ?></div>
		</div>
	</nav>

	<?php else :

		get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();