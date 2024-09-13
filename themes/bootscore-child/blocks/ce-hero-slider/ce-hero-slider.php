<?php
/**
 * CEX Hero Slider Block template.
 *
 * @param array $block The block settings and attributes.
 */


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'px-0';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>


<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

    <div class="hero-slider">

        <?php 
        $query = new WP_Query(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key'   => 'home_page_hero_item',
                    'value' => '1',
                )
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug', 
                    'terms' => array( 'comics' ),
                    'operator' => 'IN'
                )
            ),
        ));
        
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); $image = get_field('card_thumbnail', get_the_ID()); ?>

            <div class="">
           
                <div class="hero-slider-card w-100" style="background: url('<?php echo esc_url($image['url']); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
                    <div class="container h-100">
                        <div class="d-flex align-items-end h-100 pb-4">
                            <div class="hero-slider-book-info rounded-1">
                                <h5 class="card-title"><?php the_title();?></h5>
                                <p class="card-text mt-3"><?php echo wp_kses_post( get_field('short_promo_text', get_the_ID())); ?></p>
                                <div class="d-grid pt-2">
                                    <a href="<?php the_permalink();?>" class="btn btn-success border-0 mb-2">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>

            <?php endwhile; endif; ?>
            <?php wp_reset_postdata(); ?>

     </div> <!-- row -->

</div><!-- .container -->