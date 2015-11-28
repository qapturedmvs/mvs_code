<?php if(isset($the_user)): ?>
<section class="theUserBox qFixer" data-usr-id="<?php echo $the_user['usr_id']; ?>">
	<div class="boxLeft left">
		<figure class="userAvatar lazy" title="<?php echo $the_user['usr_name']; ?>" data-original="<?php echo get_user_avatar($the_user['usr_avatar']); ?>"></figure>
	</div>
	<div class="boxRight left">
		<div class="userName left"><a href="<?php '/user/wall/actions/'.$the_user['usr_nick']; ?>"><?php echo $the_user['usr_name']; ?></a></div>
		<div class="userLocation"><?php echo $the_user['usr_location']; ?></div>
		<?php if($logged_in && $the_user['owner_fl'] == 0): ?>
		<div class="followHolder right">
			<button class="btnDefault btnFollow" <?php echo 'data-itm-id="'.$the_user['lgn_flwr'].'"'; ?> onclick="qptAction.follow_user(this);"><span class="data-itm-0">FOLLOW</span><span class="data-itm-1">UNFOLLOW</span></button>
		</div>
		<?php endif; ?>
		<div class="userBio"><?php echo $the_user['usr_slogan']; ?></div>
		<div class="userSummary">
			<ul class="qFixer">
				<li class="snCnt"><a href="<?php echo '/user/movies/seen/'.$the_user['usr_nick']; ?>"><?php echo $the_user['seen_count']; ?><small>SEEN</small></a></li>
				<li class="flwrCnt"><a href="<?php echo '/user/network/followers/'.$the_user['usr_nick']; ?>"><?php echo $the_user['followers_count']; ?><small>FOLLOWERS</small></a></li>
				<li class="flwgCnt"><a href="<?php echo '/user/network/followings/'.$the_user['usr_nick']; ?>"><?php echo $the_user['followings_count']; ?><small>FOLLOWINGS</small></a></li>
			</ul>
		</div>
	</div>
</section>
<?php endif; ?>