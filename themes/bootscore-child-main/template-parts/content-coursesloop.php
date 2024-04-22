<?php
/**
 *
 * The loop that displays courses.
 *
 */
  // find date time now
  $date_now = date('Y-m-d H:i:s');
  //seem to need to do this or WP goes by date only
  $time_now = strtotime($date_now);
  $time_one_day = strtotime('-4 hours', $time_now);
  $date_one_day = date('Y-m-d H:i:s', $time_one_day);
?>

<div>
	<div class="alert alert-info" role="alert">
		<span style="font-weight: bold;">Coming soon:</span> re-vamped, re-worked and re-energized courses coming early 2024! Make sure you <a href="<?php echo esc_url( home_url( '/' ) ); ?>#testimonial">sign up for our newsletter</a> so you&rsquo;re sure not to miss our Courses Relaunch!
	</div>
</div>

<ul class="row px-2 course-listing">

	<?php 
  
	$query = new WP_Query(array(
		'post_type' => 'product',
		//'product_tag' => $args['tags'],
		'posts_per_page' => -1,
	    'order' => 'ASC',
		'meta_query' => array(
			array(
				'key' => '_stock_status',
				'value' => 'instock'
			)
	    ),
	));
?>

	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

	<li class="woocommerce item-listing col-md-6 col-lg-4 p-2 my-1">

		<div class="card h-100">
			<?php 
			
            $image = get_field('card_image');
            if( !empty( $image ) ) { ?>
			<a href="<?php the_permalink();?>"><img src="<?php echo esc_url($image['url']); ?>" class="card-img-top" alt="<?php echo esc_attr($image['alt']); ?>" /></a>
			<?php } else { ?>
				<a href="<?php the_permalink();?>"><img src="<?php echo esc_url( get_template_directory_uri() ) ?>/images/gui/frontpage-thumbnails/thumbnail-scifi.jpg" class="card-img-top" alt="Science Fiction Illustration"></a>
			<?php } ?>
			<div class="card-body">
				<h5 class="card-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>

				<p class="card-text"><small class="text-muted"><?php ce_instructors('') ?></small></p>
                <p class="card-text card_course_start">
                    <?php if ( get_field('course_type') == "Live Course" ) { echo '<small class="text-muted">' . the_field('course_duration') . 's </small><span class="badge bg-secondary ms-2 mt-1">Live</span>';} ?>
                </p>
				<?php the_excerpt(); ?>

			</div>
			<div class="card-footer bg-transparent text-muted">
				<a href="<?php the_permalink();?>" class="btn btn-primary btn-block border-0 mb-2">Learn More</a>
			</div>
		</div>
	</li>

	<?php endwhile; endif; ?>
	<?php wp_reset_postdata(); ?>

</ul>