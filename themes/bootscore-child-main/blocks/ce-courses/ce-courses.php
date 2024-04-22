<?php
/**
 * CE Courses Block template.
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

    <div class="row">

        <div class="col">

        <?php if (learndash_user_get_enrolled_courses(get_current_user_id())): ?>

            <?php
                $tab_type = "nav-pills";
                if ( wp_is_mobile() ) {
                    $tab_type = "nav-pills";
                }
            ?>

            <ul class="nav <?php echo $tab_type; ?> nav-fill flex-column flex-md-row" id="myTab" role="tablist">
                <li class="nav-item flex-sm-fill text-md-center">
                    <a class="nav-link active" id="allcourses-tab" data-bs-toggle="tab" data-bs-target="#allcourses-tab-pane" type="button" role="tab" aria-controls="allcourses-tab-pane" aria-selected="true">All Courses</a>
                </li>
                <li class="nav-item flex-sm-fill text-md-center">
                    <a class="nav-link" id="mycourses-tab" data-bs-toggle="tab" data-bs-target="#mycourses-tab-pane" type="button" role="tab" aria-controls="mycourses-tab-pane" aria-selected="false">My Courses</a>
                </li>
            </ul>

            <div class="tab-content pt-4" id="myTabContent">
                <div class="tab-pane fade p-lg-2 show active" id="allcourses-tab-pane" role="tabpanel" aria-labelledby="allcourses-tab" tabindex="0">
                    <?php require get_stylesheet_directory() . '/blocks/ce-courses/template-parts/content-coursesloop.php'; ?>
                </div>
                <div class="tab-pane fade p-lg-2" id="mycourses-tab-pane" role="tabpanel" aria-labelledby="mycourses-tab" tabindex="0">
                    <?php the_field('my_courses'); ?>
                </div>
            </div>

        <?php else: ?>

            <h2>Courses</h2>

        <?php require get_stylesheet_directory() . '/blocks/ce-courses/template-parts/content-coursesloop.php';

        endif; ?>

        </div> <!-- col -->

     </div> <!-- row -->

</div><!-- .container -->