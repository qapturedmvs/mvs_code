<?php if(isset($the_user)): ?>
<div class="theUserBox user-box">
	<div class="userAvatar"><img title="<?php echo $the_user->usr_name; ?>" src="<?php echo ($the_user->usr_avatar === '') ? $site_url.'images/user.jpg' : $site_url.$the_user->usr_avatar; ?>" /></div>
	<div class="userName"><a href="<?php echo $site_url.'user/wall/actions/'.$the_user->usr_nick; ?>"><?php echo $the_user->usr_name; ?></a></div>
	<div class="userSlogan"><?php echo $the_user->usr_slogan; ?></div>
	<div class="theUserMenu">
    <ul>
      <li><a href="<?php echo $site_url.'user/movies/lists/'.$the_user->usr_nick; ?>">Movie Lists</a></li>
			<li><a href="<?php echo $site_url.'user/network/followers/'.$the_user->usr_nick; ?>">Network</a></li>
    </ul>
  </div>
	<?php if($logged_in): ?>
	<div class="followHolder">
		<a usr-id="<?php echo $the_user->usr_id; ?>" <?php echo ($the_user->flw_id === NULL) ? 'rel="follow"' :  'rel="unfollow" flw-id="'.$the_user->flw_id.'"'; ?> onclick="follow_unfollow(this)" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>