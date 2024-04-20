<?php
/**
 * Responsive Tabs Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container pt-4';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="">

    <?php
    $tab_type = "nav-tabs";
    if ( wp_is_mobile() ) {
        $tab_type = "nav-pills";
    }
    ?>

    <?php if (have_rows('tabs')) { ?>

    <div class="mt-2 pt-1 pt-lg-2 page-tabs">

    <ul class="nav <?php echo $tab_type; ?> nav-fill flex-column flex-md-row" id="myTab" role="tablist">
        <?php $i=0; while ( have_rows('tabs') ) : the_row(); ?>

        <?php 
                    $id = get_sub_field('tab_id');
                    $title = get_sub_field('tab_title');
                    ?>

        <li class="nav-item flex-sm-fill text-md-center">
        <a class="nav-link <?php if ($i==0) { ?>active<?php } ?>" id="<?php echo $id; ?>-tab" data-bs-toggle="tab" href="#<?php echo $id; ?>" role="tab" aria-controls="<?php echo $id; ?>" aria-selected="true"><?php echo $title; ?></a>
        </li>
        <?php $i++; endwhile; ?>
    </ul>

    <?php reset_rows(); ?>

    <div class="tab-content pt-4" id="myTabContent">

        <?php $i=0; while ( have_rows('tabs') ) : the_row(); ?>

        <?php 
            $tab_id = get_sub_field('tab_id');
            $content = get_sub_field('tab_content');
            // output sub field content
        ?>
        <div class="tab-pane fade p-lg-2 <?php if ($i==0) { ?>show active<?php } ?>" id=<?php echo $tab_id; ?> role="tabpanel" aria-labelledby="<?php echo $tab_id; ?>-tab"><?php echo $content; ?></div>
        <?php $i++; endwhile; ?>
    </div>

</div>

<?php } ?>

</div>