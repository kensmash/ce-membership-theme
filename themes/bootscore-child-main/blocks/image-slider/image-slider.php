<?php
/**
 * Comics Experience Image Slider Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.


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
    
    if (have_rows('slider_images')) { ?>

        <div class="ce-images-slider-cards">

            <?php while (have_rows('slider_images')) {
        
                the_row();
                $image = get_sub_field('image');
                
            ?>

                <div class="card ce-images-slider-card-slide border-0">
                    <div class="card-body">
                        <div data-bs-toggle="modal" data-bs-target="#creativeServicesImageModal">
                            <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div><!-- ce-images-slider-cards -->

        <!-- Modal -->
        <div class="modal fade" id="creativeServicesImageModal" tabindex="-1" role="dialog" aria-labelledby="creativeServicesImageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Featured Work</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ce-images-slider-card-modal">

                                <?php while (have_rows('slider_images')) { 
                                    the_row();
                                    $image = get_sub_field('image');
                                ?>
                                    <div class="p-3">
                                        <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                                    </div>
                                <?php } ?>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- modal -->

    <?php } ?>

</div>