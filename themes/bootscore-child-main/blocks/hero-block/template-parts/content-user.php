<?php global $current_user;
wp_get_current_user(); ?>

<h1>Welcome, <?php echo $current_user->user_firstname; ?></h1>

<p>Text here</p>

<div class="d-grid gap-2">
  <?php if (learndash_user_get_enrolled_courses(get_current_user_id())): ?>
    <a class="btn btn-primary" href="<?php echo site_url('my-account/my-courses'); ?>">Go to Your Courses</a>
  <?php endif; ?>
    <a class="btn btn-success" href="<?php echo site_url('community'); ?>">Get Free Trial</a>
</div>