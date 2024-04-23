<?php global $current_user;
wp_get_current_user(); ?>

<h1>Welcome, <?php echo $current_user->user_firstname; ?>!</h1>

<p>Member messsage here. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<div class="d-grid gap-2 pt-3">
  <?php if (learndash_user_get_enrolled_courses(get_current_user_id())): ?>
    <a class="btn btn-primary" href="<?php echo site_url('my-account/my-courses'); ?>">Go to Your Courses</a>
  <?php endif; ?>
    <a class="btn btn-success" href="<?php echo site_url('community'); ?>">Get Free Trial</a>
</div>