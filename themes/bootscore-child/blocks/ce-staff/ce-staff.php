<?php
/**
 * CE Staff Block template.
 *
 * @param array $block The block settings and attributes.
 */

 $staff_members = get_field('staff_members');
 $columns = get_field('columns');

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

$column_class = "col-md-4";

switch ($columns) {
    case 2:
        $column_class = "col-md-6";
        break;
    case 3:
        $column_class = "col-lg-4";
        break;
}

?>


<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

    <div class="row g-sm-0 g-md-3">

        <?php 
            if( $staff_members ):
            foreach( $staff_members as $staff ): 
                $permalink = get_permalink( $staff->ID );
                $title = get_the_title( $staff->ID );
                $image = get_the_post_thumbnail( $staff->ID, 'full', array( 'class' => 'rounded-top' ) );  
                //$content = get_post_field('post_content', $service->ID); 
                $content = get_the_excerpt($staff->ID); 
            ?>

            <div class="col-sm-6 <?php echo $column_class; ?> mb-3 ">
                <div class="card h-100">
                    
                    <a href="<?php echo esc_url( $permalink ); ?>">
                        <?php if ( $image ) { 
                                echo $image;
                            } else { ?>
                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/ce-bio-placeholder-1000x750.png" class="rounded-top" alt="Generic Staff Thumbnail">
                        <?php } ?>
                    </a>
            
                
                    <div class="card-body">
                        <h5 class="card-title mb-2"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h5>
                        <small class="card-text staff-meta text-muted"><?php echo $content; ?></small>
                    </div>
                        
                </div><!-- card -->
            </div> <!-- col -->

        <?php 
            endforeach;
            endif; 
        ?>

    </div> <!-- row -->

</div><!-- .container -->