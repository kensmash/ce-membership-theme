<?php
/**
 * Creative Services Block template.
 *
 * @param array $block The block settings and attributes.
 */

 $featured_services = get_field('creative_services');

 // Support custom "anchor" values.
 $anchor = '';
 if ( ! empty( $block['anchor'] ) ) {
     $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
 }
 
 // Create class attribute allowing for custom "className" and "align" values.
 $class_name = 'container px-0 creative-services';
 if ( ! empty( $block['className'] ) ) {
     $class_name .= ' ' . $block['className'];
 }
 if ( ! empty( $block['align'] ) ) {
     $class_name .= ' align' . $block['align'];
 }
 ?>
 
 
 <div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">
 
     <div class="row g-0 g-md-3">
 
         <?php 
             if( $featured_services ):
             foreach( $featured_services as $service ): 
                 $permalink = get_permalink( $service->ID );
                 $image = get_the_post_thumbnail( $staff->ID, 'full', array( 'class' => 'rounded-top' ) );  
                 $title = get_the_title( $service->ID );
                 //$content = get_post_field('post_content', $service->ID); 
                 $content = get_the_excerpt($service->ID); 
             ?>
 
            <div class="col-sm-6 col-lg-4 mb-3 ">
                <div class="card h-100">
                    
                    <a href="<?php echo esc_url( $permalink ); ?>">
                        <?php if ( $image ) { 
                                echo $image;
                            } else { ?>
                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/thumbnail-scifi.jpg" class="rounded-top" alt="Generic Staff Thumbnail">
                        <?php } ?>
                    </a>
            
                    <div class="card-body">
                        <h5 class="card-title mb-2"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a></h5>
                        <small class="card-text staff-meta text-muted"><?php echo $content; ?></small>
                     </div>
                     <div class="card-footer bg-transparent border-0 py-4">
                         <div class="d-grid">
                             <a href="<?php echo esc_url( $permalink ); ?>" class="btn btn-success px-md-5">Learn More</a>
                         </div>
                     </div>
                        
                </div><!-- card -->
            </div> <!-- col -->
 
         <?php 
             endforeach;
             endif; 
         ?>
 
     </div> <!-- row -->
 
 </div><!-- .container -->