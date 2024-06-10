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

    <div class="accordion" id="accordion<?php echo esc_attr( $anchor ); ?>">

        <?php 
            if( $staff_members ):
            foreach( $staff_members as $staff ): 
                $permalink = get_permalink( $staff->ID );
                $title = get_the_title( $staff->ID );
                $image = get_the_post_thumbnail( $staff->ID, 'thumbnail', array( 'class' => 'rounded-circle' ) );  
                //$content = get_post_field('post_content', $service->ID); 
                $content = get_the_excerpt($staff->ID); 
            ?>

            <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?php echo $staff->ID . esc_html( get_field('block_id') ); ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $staff->ID . esc_html( get_field('block_id') ); ?>" aria-expanded="false" aria-controls="collapse<?php echo $staff->ID . esc_html( get_field('block_id') ); ?>">
                        <?php echo esc_html( $title ); ?>
                    </button>
                </h2>
                <div id="collapse<?php echo $staff->ID . esc_html( get_field('block_id') ); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php the_ID(); ?>" data-bs-parent="#accordion<?php echo $staff->ID . esc_html( get_field('block_id') ); ?>">
                    <div class="accordion-body">
                       <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-2 text-center">
                                <a href="<?php echo esc_url( $permalink ); ?>">
                                    <?php if ( $image ) { 
                                            echo $image;
                                        } else { ?>
                                            <img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/ce-bio-placeholder-1000x750.png" class="rounded-top" alt="Generic Staff Thumbnail">
                                    <?php } ?>
                                </a>
                                </div><!-- col -->
                                <div class="col-12 col-md-10 pt-3 pt-md-0">
                                    <h5 class="card-title mb-2"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h5>
                                    <small class="card-text staff-meta text-muted"><?php echo $content; ?></small>
                                </div><!-- col -->
                            </div><!-- row -->
                        </div><!-- container -->
                    </div>
                </div>
            </div>

        <?php 
            endforeach;
            endif; 
        ?>

    </div> <!-- row -->

</div><!-- .container -->