<?php
// hacks and mods will go here
define ( 'BP_AVATAR_DEFAULT', 'https://comicsexp.wpenginepowered.com/wp-content/uploads/2023/12/default-buddypress-avatar.png' );
define ( 'BP_AVATAR_DEFAULT_THUMB', 'https://comicsexp.wpenginepowered.com/wp-content/uploads/2023/12/default-buddypress-avatar-thumb.png' );

add_filter( 'bp_core_fetch_avatar_no_grav', '__return_true' );

?>