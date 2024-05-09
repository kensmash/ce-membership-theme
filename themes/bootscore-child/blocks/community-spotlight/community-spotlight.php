<?php
/**
 * Community Spotlight Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$spotlight_books = get_field('spotlight_books');

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container spotlight-slider pt-4';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="">
    <?php 
        if( $spotlight_books ):
        foreach( $spotlight_books as $book ): 
            $permalink = get_permalink( $book->ID );
            $image = get_the_post_thumbnail( $book->ID );   
            $title = get_the_title( $book->ID );
            //$content = get_post_field('post_content', $testimonial->ID); 
            $content = get_the_excerpt($book->ID); 
            $creator_names = get_field( 'creator_names', $book->ID );
        ?>
        <div class="spotlight-slide px-2">
            <div class="card spotlight-card h-100">
                <div class="card-body">
                    <div><a href="<?php echo esc_url( $permalink ); ?>"><?php echo $image; ?></a></div>
                    <div class="pt-5 text-white">
                        <h3 class="mb-1"><?php echo esc_html( $title ); ?></h3>
                        <p><?php echo esc_html( $creator_names ); ?></p>
                        <p class="card-text"><?php echo $content; ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php 
        endforeach;
        endif; 
    ?>
</div>