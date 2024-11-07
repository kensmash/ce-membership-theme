<?php
/**
 * Template part for displaying course bundle info
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Comics_Experience_2022
 */


$date_now = date('Y-m-d H:i:s');
//seem to need to do this or WP goes by date only
$time_now = strtotime($date_now);
$time_one_day = strtotime('-4 hours', $time_now);

$bundled_active = get_field('bundled');

if( $bundled_active ): ?>

<?php $bundled_courses = get_field('bundled_courses'); ?>

<?php foreach( $bundled_courses as $course ): // variable must NOT be called $post (IMPORTANT) 

$permalink = get_permalink( $course->ID ); 
$title = get_the_title( $course->ID );
$bundle_start = get_field('start_date', $course->ID);
$bundle_start_time = strtotime($bundle_start);
                
if ($bundle_start_time > $time_one_day) { ?>
<div class="course-bundle container border-0">
    <div class="row g-0">
        <div class="col-2">
            <figure class="figure">
                <a href="<?php echo esc_url( $permalink ); ?>"><img src="<?php echo get_the_post_thumbnail_url($course->ID); ?>" class="figure-img img-fluid" alt="<?php echo esc_html( $title ); ?>" title="<?php echo esc_html( $title ); ?>" /></a>
            </figure>
        </div>
        <div class="col-10 px-4">
            <div class="card-body p-0">
                <h4 class="card-title">Bundle and save!</h4>
                <p class="card-text"> <?php echo get_field('bundle_offer_description');  ?></p>
                <?php echo do_shortcode('[add_to_cart show_price="false" style="border: 0px;" id="' . $course->ID . '"]'); ?>
            </div>
        </div>
    </div>
</div>

<?php } endforeach; ?>

<?php endif; ?>