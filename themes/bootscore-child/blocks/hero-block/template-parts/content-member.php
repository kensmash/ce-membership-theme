<?php 
  global $current_user;
  wp_get_current_user(); 
  $pmp_member = pmpro_getMembershipLevelForUser(get_current_user_id());
?>

<h1>Welcome, <?php echo $current_user->user_firstname ? $current_user->user_firstname : $current_user->display_name; ?>!</h1>

<p>We&rsquo;re glad to have you back.</p>

<?php 
  if ($pmp_member->name == 'Community' && learndash_user_get_enrolled_courses(get_current_user_id())): ?>
    <a class="btn btn-success" href="<?php echo site_url('my-courses'); ?>">Go to Your Courses</a>
<?php 
  endif; 

  if ($pmp_member->name == 'Community Pro'): ?>
    <div class="d-grid gap-2 pt-2">
      <a class="btn btn-success" href="<?php echo site_url('my-courses'); ?>">Go to Your Courses</a>
    </div>

    <p class="mt-4 ms-2"><strong>Member Events</strong></p>
    <?php echo do_shortcode('[tribe_this_week]'); 
  endif; 

?>

