<?php global $current_user;
wp_get_current_user(); ?>

<h1>Welcome, <?php echo $current_user->user_firstname; ?>!</h1>

<p>Text here</p>

<div class="d-grid gap-2">
  <button class="btn btn-primary" type="button">Button</button>
  <a class="btn btn-primary" href="<?php echo site_url('my-account/my-courses'); ?>">Go to Your Courses</a>
</div>