<?php
/**
 * CE Community Pro Post Slider Block template.
 *
 * @param array $block The block settings and attributes.
 */

$arc_headline = get_field('slider_headline');
$arc_category = get_field('slider_category');
$arc_link = get_field('category_link');
$post_order = get_field('post_order');

$posts = array();
$tax_query = array();

//only display posts from a certain category
if ($arc_category) {
    if (!is_array($arc_category)) {
        $arc_category = array($arc_category);
    }
    $tax_query = array(
        array(
            'taxonomy' => 'arc-category',
            'terms' => $arc_category,
        ),
    );
}


// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container px-0 community-pro-post-slider-container';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>

<?php $query = new WP_Query(array(
    'post_type'         => 'resource',
    'post_status'       => 'publish',
    'posts_per_page'    => 10,
    'tax_query'         => $tax_query,
    'order'             => $post_order ? $post_order : 'ASC', 
));


if ( $query->have_posts() ) { 

        while ( $query->have_posts() ) {

            $query->the_post();
                    
            $posts[] = array(
                'id'				    => get_the_ID(),
                'title' 			    => get_the_title(),
                'excerpt'               => get_the_excerpt(),
                'link' 		            => get_the_permalink(),
                'image' 		        => wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ),
                'button_text' 		    => "Read More",
            );

        }
            
    }

wp_reset_postdata(); 

//now loop through the posts array and output posts

if ($posts): ?>

    <div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

        <div class="row g-0">

            <div class="col-12 d-flex align-items-center justify-content-between">
                <h2 class="mb-1"><?php echo esc_html( $arc_headline ); ?></h2>
                <a href="<?php echo esc_url( $arc_link ); ?>"><b>See All</b></a>
            </div> <!-- col-12 -->

            <div class="col-12">

                <div class="arc-slider">

                    <?php foreach( $posts as $post ): ?>

                        <div class="woocommerce item-listing p-2 my-1">

                            <div class="card h-100">
                            <?php if( !empty( $post['image'] ) ) { ?>
                                <a href="<?php echo $post['link']; ?>"><img src="<?php echo $post['image'][0]; ?>" class="card-img-top" alt="<?php echo $post['title']; ?>" /></a>
                                <?php } ?>
                                <div class="card-body">
                                    <h5 class="card-title fs-6"><a href="<?php echo $post['link']; ?>"><?php echo $post['title']; ?></a></h5>
                                    <p class="lh-sm"><small><?php echo $post['excerpt']; ?></small></p>
                                </div><!-- card-body -->
                                <div class="card-footer bg-transparent text-muted border-top-0">
                                    <div class="d-grid pt-2">
                                        <a href="<?php echo $post['link']; ?>" class="btn btn-primary btn-block border-0 mb-2"><?php echo $post['button_text']; ?></a>
                                    </div>
                                </div><!-- card-footer -->
                            </div><!-- card -->

                        </div> <!-- item-listing -->

                    <?php endforeach; ?>

                </div> <!-- arc-slider -->

            </div> <!-- col-12 -->

        </div> <!-- row -->

    </div><!-- .container -->

<?php endif; ?>