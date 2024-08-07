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
            'button-text'       => get_sub_field('button_text'),
            'button-link'       => get_sub_field('link'),
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
                    $div_style = 'background-image: url(' . get_stylesheet_directory_uri() . '/images/ui/services-thumbnail-default.png); background-size: contain; background-repeat: no-repeat; background-position: center center;';
                }
                
                ?>

        <div class="ce-service-cards-slide px-2 pt-2 pb-5">

            <div class="ce-service-cards-slide-card card d-flex flex-column justify-content-end h-100 border-0 rounded-2" style="<?php echo $div_style; ?>">
                <div class="services-slide-text-container text-center text-light px-3 py-3 rounded-bottom-2">
                    <p class="card-text fw-bold"><?php echo $service['name']; ?></p>
                </div>
            </div>

        </div>

        <?php endforeach; ?>

    </div><!-- .ce-services-cards -->

    <div class="ce-services-descriptions mx-2 px-4 py-3 rounded-2">

        <?php foreach( $services as $service ): ?>

        <div class="ce-service-descriptions-slide">

            <div class="ce-slide-funnels-content-container">
                <?php foreach( $service['service_funnels'] as $service_funnel ): ?>
                <div class="ce-slide-funnels-content">
                    <p class="fw-bold"><?php echo $service_funnel['title']; ?></p>
                    <p><?php echo $service_funnel['description']; ?></p>
                    
                    <a class="btn btn-success mb-4" href="<?php echo esc_url($service_funnel['button-link']['url']); ?>" target="<?php echo $service_funnel['button-link']['target'] ? $service_funnel['button-link']['target'] : '_self'; ?>" role="button"><?php echo $service_funnel['button-text']; ?></a>
                </div>
                <?php endforeach; ?>
            </div>

        </div>

        <?php endforeach; ?>

    </div> <!-- .ce-services-descriptions -->

    <?php endif; ?>
</div>