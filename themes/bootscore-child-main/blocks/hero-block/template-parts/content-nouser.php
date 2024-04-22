<h1 class="text-center"><?php echo esc_html($headline); ?></h1>
<p class="text-center"><?php echo esc_html($subhead); ?></p>
<?php
    if( have_rows('buttons') ): ?>

    <div class="d-grid gap-2">

        <?php while( have_rows('buttons') ) : the_row();

            $button_text = get_sub_field('button_text'); 
            $button_link = get_sub_field('button_link'); 
            $button_class = get_sub_field('button_color'); 
            ?>

            <a class="anchorlink btn <?php echo esc_attr($button_class); ?>" href="<?php echo esc_attr( $button_link); ?>" role="button"><?php echo esc_html($button_text); ?></a>

            <?php 

        endwhile; ?>

    </div> <!-- d-grid -->

    <?php endif; ?>