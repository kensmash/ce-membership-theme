<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Comics_Experience_2021
 */

get_header();
?>

<div id="primary" class="container pt-5">

	<main id="main" class="site-main p-4">

		<?php 

		$args = array( 'post_type' => 'script','orderby'=> 'title', 'order' => 'ASC','posts_per_page' => -1 ); 

		$the_query = new WP_Query( $args );
		
		if( $the_query->have_posts() ): ?>
		

		<header class="page-header">
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' );?>
			<div class="row pt-2 pb-3">

				<p>The <strong>Comic Book Script Archive</strong> was founded by Tim Simmons because he couldn&rsquo;t find an online resource for comic book scripts. Eventually, he decided to make one. Comics Experience is pleased to present Tim&rsquo;s archive as an educational resource for those interested in comic book scripting.</p>

				<p>If you are a pro writer for one of the top comics publishers and you&rsquo;d like to donate a script, or if you have any questions about the material displayed here, please contact Comics Experience at <a href="mailto:info@comicsexperience.com">info@comicsexperience.com.</a></p>

			</div>
		</header><!-- .page-header -->

		<div class="accordion" id="accordionExample">
			<div class="accordion-item">
				<h2 class="accordion-header" id="headingOne">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">
						The Comics Experience Script Template
					</button>
					</h2>
				<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
					<div class="accordion-body scripts">
						<ul>
							<li>
								<a href="<?php bloginfo('template_directory'); ?>/media/Comic-Experience-Script-Template-2021-11-24.doc">
									Suggested script format template from Comics Experience (Word)
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<div class="accordion-item">
				<h2 class="accordion-header" id="heading<?php the_ID(); ?>">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php the_ID(); ?>" aria-expanded="false" aria-controls="collapse<?php the_ID(); ?>">
						<?php the_title(); ?>
					</button>
				</h2>
				<div id="collapse<?php the_ID(); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php the_ID(); ?>" data-bs-parent="#accordionExample">
					<div class="accordion-body scripts">
						<?php remove_filter ('the_content',  'wpautop'); ?>
						<?php the_content();?>
					</div>
				</div>
			</div>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

			<?php else:  ?>
			<p><?php  _e( 'Sorry, no scripts to display.' );  ?></p>
			<?php endif; ?>
			
		</div><!-- accordion -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();