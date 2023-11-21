<?php
/**
 * Comics Experience Services Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$services = [];
$services_funnels = [];

if( have_rows('services') ):

    while( have_rows('services') ) : the_row();

    $services[] = array(
        'name' 				=> get_sub_field('service_name'),
        'thumbnail' 		=> get_sub_field('service_thumbnail_image'),
    );

    if( have_rows('service_funnel') ):
       
        // loop through rows (sub repeater)
        while( have_rows('service_funnel') ): the_row();

            $services_funnels[] = array(
                'title' 			=> get_sub_field('title'),
                'description' 		=> get_sub_field('description'),
                'button_text' 		=> get_sub_field('button_text'),
                'link' 		        => get_sub_field('link'),
            );

        endwhile;
        endif; //if( get_sub_field('service_funnel') ): 

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

                        <div class="card">
                            <div class="services-image-container" style="<?php echo $div_style; ?>"></div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $service['name']; ?></p>
                            </div>
                        </div>
                       
                    </div>

                <?php endforeach; ?>

        </div><!-- .ce-services-cards -->

        <div class="ce-services-descriptions">

            <?php foreach( $services_funnels as $service_funnel ): ?>

                <div class="ce-service-descriptions-slide">
                    <div>
                        <?php echo $service_funnel['description']; ?>
                    </div>
                </div>

            <?php endforeach; ?>

        </div> <!-- .ce-services-descriptions -->
        
    <?php endif; ?>
</div>