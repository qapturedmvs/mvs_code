<?php if(isset($the_user)): ?>
<div class="theUserBox user-box" usr-id="<?php echo $the_user['usr_id']; ?>">
	<div class="userAvatar"><img title="<?php echo $the_user['usr_name']; ?>" src="<?php echo $site_url.get_user_avatar($the_user['usr_avatar']); ?>" /></div>
	<div class="userName"><a href="<?php echo $site_url.'user/wall/actions/'.$the_user['usr_nick']; ?>"><?php echo $the_user['usr_name']; ?></a></div>
	<div class="userSlogan"><?php echo $the_user['usr_slogan']; ?></div>
	<div class="userSummary">
		<ul>
			<li class="seenCount"><a href="<?php echo $site_url.'user/movies/seen/'.$the_user['usr_nick']; ?>"><span><?php echo $the_user['seen_count']; ?></span><small>SEEN</small></a></li>
			<li class="flwrCount"><a href="<?php echo $site_url.'user/network/followers/'.$the_user['usr_nick']; ?>"><span><?php echo $the_user['followers_count']; ?></span><small>FOLLOWERS</small></a></li>
			<li class="flwgCount"><a href="<?php echo $site_url.'user/network/followings/'.$the_user['usr_nick']; ?>"><span><?php echo $the_user['followings_count']; ?></span><small>FOLLOWINGS</small></a></li>
		</ul>
		<hr class="qFixer" />
	</div>
	<?php if($logged_in && $the_user['owner_fl'] === 0): ?>
	<div class="followHolder">
		<a <?php echo 'data-itm-id="'.$the_user['lgn_flwr'].'"'; ?> onclick="follow_user(this)" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>