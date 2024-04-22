<?php
/**
 * CE Home Page Courses template.
 *
 * @param array $block The block settings and attributes.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container px-0 ce-courses';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

?>



<div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>" style="">

    <?php if (learndash_user_get_enrolled_courses(get_current_user_id())): ?>

        <div class="row">

            <div class="col pt-4 pt-xl-5 pb-3">

                <?php the_field('homepage_courses'); ?>

            </div> <!-- col -->

        </div> <!-- row -->

    <?php endif; ?>

</div><!-- container -->
