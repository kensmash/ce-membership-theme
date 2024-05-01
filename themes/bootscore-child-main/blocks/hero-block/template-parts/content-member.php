<?php 
  global $current_user;
  wp_get_current_user(); 
  $pmp_member = pmpro_getMembershipLevelForUser(get_current_user_id());
?>

<h1>Welcome, <?php echo $current_user->user_firstname; ?>!</h1>

<?php echo do_shortcode('[tribe_this_week]'); ?>

<div class="d-grid gap-2 pt-3">
  <?php if ($pmp_member->name == 'Community Pro'): ?>
    <a class="btn btn-primary" href="<?php echo site_url('forums'); ?>">Go to Forums</a>
  <?php else: ?>
    <button class="btn btn-primary" type="button">Button</button>
  <?php endif; ?>
  <a class="btn btn-success" href="<?php echo site_url('my-account/my-courses'); ?>">Go to Your Courses</a>
</div>