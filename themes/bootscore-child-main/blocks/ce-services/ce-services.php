<?php
/**
 * Comics Experience Services Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$services = [];

/* inspiration https://support.advancedcustomfields.com/forums/topic/saving-repeater-nested-repeater-values-to-an-associative-array/ */
if (have_rows('services')) {
    while (have_rows('services')) {
      the_row();
      $name = get_sub_field('service_name');
      $thumbnail = get_sub_field('service_thumbnail_image');
      $service_funnels = array();
      if (have_rows('service_funnel')) {
        while (have_rows('service_funnel')) {
          the_row();
          $service_funnels[] = array(
            'title' 			=> get_sub_field('title'),
            'description' 		=> get_sub_field('description'),
        );
        } // end while service_funnels
        $services[] = array(
          'name'            => $name,
          'thumbnail'       => $thumbnail,
          'service_funnels' => $service_funnels
        );
      } // end if service_funnels
    } // end while services
  } // end if services

  //echo var_dump($services);

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

            <?php foreach( $services as $service ): ?>

                <div class="ce-service-descriptions-slide">
                 
                    <?php foreach( $service['service_funnels'] as $service_funnel ): ?>
                        <div>
                            <?php echo $service_funnel['title']; ?>
                            <?php echo $service_funnel['description']; ?>
                        </div>
                    <?php endforeach; ?>
                    
                </div>

            <?php endforeach; ?>

        </div> <!-- .ce-services-descriptions -->
        
    <?php endif; ?>
</div>