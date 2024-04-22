<?php global $current_user;
wp_get_current_user(); ?>

<h1>Welcome, <?php echo $current_user->display_name; ?></h1>

<p>Text here</p>

<div class="d-grid gap-2">
  <button class="btn btn-primary" type="button">Button</button>
  <button class="btn btn-primary" type="button">Button</button>
</div>