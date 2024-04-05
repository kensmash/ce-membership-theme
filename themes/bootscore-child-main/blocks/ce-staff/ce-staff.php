<?php
/**
 * CE Staff Block template.
 *
 * @param array $block The block settings and attributes.
 */

 $staff_members = get_field('staff_members');

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container px-0 ce-staff';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>


<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

    <div class="row">

        <?php 
            if( $staff_members ):
            foreach( $staff_members as $staff ): 
                $permalink = get_permalink( $staff->ID );
                $title = get_the_title( $staff->ID );
                $image = get_the_post_thumbnail( $staff->ID, 'thumbnail', array( 'class' => 'rounded-left' ) );  
                //$content = get_post_field('post_content', $service->ID); 
                $content = get_the_excerpt($staff->ID); 
            ?>

            <div class="col-md-6 col-xl-4">
                <div class="card h-100">
                    
                    <div class="row g-0">
                        <div class="col-4">
                            <?php if ( $image ) { 
                                    echo $image;
                                } else { ?>
                                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/ce-bio-placeholder.png" class="rounded-left" alt="Generic Staff Thumbnail">
                            <?php } ?>
                        </div> <!-- col -->
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title mb-2"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h5>
                                <p class="card-text staff-meta text-muted"><?php echo $content; ?></p>
                            </div>
                        </div> <!-- col -->
                    </div> <!-- row -->

                </div><!-- card -->
            </div> <!-- col -->

        <?php 
            endforeach;
            endif; 
        ?>

    </div> <!-- row -->

</div><!-- .container -->