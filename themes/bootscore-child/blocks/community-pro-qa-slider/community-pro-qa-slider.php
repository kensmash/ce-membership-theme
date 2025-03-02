<?php
/**
 * CE Community Pro Q&A Slider Block template.
 *
 * @param array $block The block settings and attributes.
 */

$qa_headline = get_field('slider_headline');
$qa_link = get_field('category_link');

$posts = array();

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
    'post_type'         => 'qa-session',
    'post_status'       => 'publish',
    'posts_per_page'    => 10,
    'order'             => 'DESC', 
));


if ( $query->have_posts() ) { 

        while ( $query->have_posts() ) {

            $query->the_post();
                    
            $posts[] = array(
                'id'				    => get_the_ID(),
                'title' 			    => get_the_title(),
                'excerpt'               => get_the_excerpt(),
                'link' 		            => get_the_permalink(),
                'button_text' 		    => "See Q&A Session",
            );

        }
            
    }

wp_reset_postdata(); 

//now loop through the posts array and output posts

if ($posts): ?>

    <div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

        <div class="row g-0">

            <div class="col-12 d-flex align-items-center justify-content-between">
                <h2 class="mb-1"><?php echo esc_html( $qa_headline ); ?></h2>
                <a href="<?php echo esc_url( $qa_link ); ?>"><b>See All</b></a>
            </div>

            <div class="col-12">

                <div class="qa-slider">

                    <?php foreach( $posts as $post ): ?>

                        <div class="woocommerce item-listing p-2 my-1">

                            <div class="card h-100">
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

                </div> <!-- qa-slider -->

            </div> <!-- col-12 -->

        </div> <!-- row -->

    </div><!-- .container -->

<?php endif; ?>