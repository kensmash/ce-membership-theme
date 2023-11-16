<?php
/**
 * Comics Experience Services Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$acf_services_values = get_field('services');

$services = array();

if( have_rows($acf_services_values) ):

    while( have_rows($acf_services_values) ) : the_row();

    $services[] = array(
        'name' 				=> get_sub_field('service_name'),
        'thumbnail' 		=> get_sub_field('service_thumbnail_image'),
        'description' 	    => get_sub_field('service_description'),
    );

    // End loop.
    endwhile;
endif;

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="">

    <?php
    
    if( !empty( $services ) ): ?>

        <div class="ce-services-cards">

            <?php foreach( $services as $service ): 

                $service_thumbnail = esc_url($service['thumbnail']['url']);

                $div_style = 'background-image: url(' . esc_url($service_thumbnail) . '); background-size: cover;';

                if (!$service_thumbnail) {
                    $div_style = 'background-image: url(' . get_stylesheet_directory_uri() . '/images/ui/guru-video-thumbnail-default.png); background-size: contain; background-repeat: no-repeat; background-position: center center;';
                }
                
                ?>

                    <div class="ce-service-cards-slide">

                        <div class="card" style="width: 18rem;">
                            <div class="services-image-container" style="<?php echo $div_style; ?>">
                            <div class="card-body">
                                <p class="card-text"><?php echo $service['name']; ?></p>
                            </div>
                        </div>
                       
                    </div>

                <?php endforeach; ?>
                
            <?php endif; ?>

        </div><!-- .ce-services-cards -->

        <div class="ce-services-descriptions">

            <?php foreach( $services as $service ): ?>

                <div class="ce-service-descriptions-slide">
                    <div>
                        <?php echo $service['description']; ?>
                    </div>
                </div>

            <?php endforeach; ?>

        </div> <!-- .ce-services-descriptions -->
        
    <?php endif; ?>
</div>