<?php if(isset($the_user)): ?>
<div class="theUserBox user-box" usr-id="<?php echo $the_user->usr_id; ?>">
	<div class="userName"><a href="<?php echo $site_url.'user/profile/'.$the_user->usr_nick; ?>"><?php echo $the_user->usr_name; ?></a></div>
	<div class="userSlogan"><?php echo $the_user->usr_slogan; ?></div>
	<?php if($logged_in): ?>
	<div class="followHolder">
		<a <?php echo ($the_user->flw_id === NULL) ? 'rel="follow"' :  'rel="unfollow" flw-id="'.$the_user->flw_id.'"'; ?> onclick="follow_unfollow(this)" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>