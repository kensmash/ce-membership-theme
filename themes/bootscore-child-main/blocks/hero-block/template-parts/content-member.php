<?php 
  global $current_user;
  wp_get_current_user(); 
  $pmp_member = pmpro_getMembershipLevelForUser(get_current_user_id());
?>

<h1>Welcome, <?php echo $current_user->user_firstname; ?>!</h1>

<p>Member message here. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<div class="d-grid gap-2 pt-3">
  <?php if ($pmp_member->name == 'Community Pro'): ?>
    <a class="btn btn-primary" href="<?php echo site_url('forums'); ?>">Go to Forums</a>
  <?php else: ?>
    <button class="btn btn-primary" type="button">Button</button>
  <?php endif; ?>
  <a class="btn btn-success" href="<?php echo site_url('my-account/my-courses'); ?>">Go to Your Courses</a>
</div>