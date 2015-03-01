<?php if(isset($the_user['view_user']->usr_name)): ?>
<div class="theUserBox">
	<div class="userName"><a href="<?php echo $site_url.'user/profile/'.$the_user['view_user']->usr_nick; ?>"><?php echo $the_user['view_user']->usr_name; ?></a></div>
	<?php if($logged_in && $the_user['view_user']->usr_id !== $the_user['login_user']): ?>
	<div class="followHolder">
		<?php if($the_user['view_user']->flw_id === NULL): ?>
		<a rel="follow" usr-id="<?php echo $the_user['view_user']->usr_id; ?>" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
		<?php else: ?>
		<a rel="unfollow" flw-id="<?php echo $the_user['view_user']->flw_id; ?>" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>