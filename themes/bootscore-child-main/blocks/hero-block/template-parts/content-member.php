<?php global $current_user;
wp_get_current_user(); ?>

<h1>Welcome, <?php echo $current_user->display_name; ?></h1>