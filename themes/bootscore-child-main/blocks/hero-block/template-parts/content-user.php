<?php global $current_user;
wp_get_current_user(); ?>

<h1>Welcome, <?php echo $current_user->user_firstname; ?>!</h1>

<?php echo wp_kses_post ( get_field('user_message') ); ?>

<div class="d-grid gap-2 pt-3">
  <?php if (learndash_user_get_enrolled_courses(get_current_user_id())): ?>
    <a class="btn btn-primary" href="<?php echo site_url('my-courses'); ?>">Go to Your Courses</a>
  <?php endif; ?>
    <a class="btn btn-success" href="<?php echo site_url('community'); ?>">Get Free Trial</a>
</div>