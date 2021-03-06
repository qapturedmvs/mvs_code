<div class="pageDefault pageProfile">
	<div class="titleDefault titleProfile">
		<h1>Your Profile</h1>
	</div>
	<div class="userAvatar">
		<a href="<?php echo $site_url.'user/settings/avatar'; ?>"><img src="<?php echo get_user_avatar($user['usr_avatar']); ?>" alt="<?php echo $the_user->usr_name; ?>" title="<?php echo $the_user->usr_name; ?>" /></a>
	</div>
	<div class="profileForm">
	<?php echo form_open('', array('class' => 'form-profile', 'role' => 'form')); ?>
		<div class="error"><?php if(isset($profile_error)) echo $profile_error; ?></div>
		<ul>
			<li>
				<input name="prf_name" id="prf_name" type="text" class="form-control" placeholder="Full Name" value="<?php echo $the_user->usr_name; ?>" required="required" />
			</li>
			<li>
				<input name="prf_email" id="prf_email" type="email" class="form-control" placeholder="Email address" value="<?php echo $the_user->usr_email; ?>" required="required" />
			</li>
			<li>
				<input name="prf_nick" id="prf_nick" type="text" class="form-control" placeholder="Nickname" rel="<?php echo $the_user->usr_nick; ?>" value="<?php echo $the_user->usr_nick; ?>" required="required" />
			</li>
			<li>
				<input name="prf_slogan" id="prf_slogan" type="text" class="form-control" placeholder="Slogan" value="<?php echo $the_user->usr_slogan; ?>" />
			</li>
			<li>
				<input name="prf_password" id="prf_password" type="password" class="form-control" placeholder="Password" />
			</li>
			<li>
				<input name="repassword" id="repassword" type="password" class="form-control" placeholder="Re-enter Password" />
			</li>
		</ul>
		<button class="btn btn-lg btn-primary btn-block" name="prf_submit" id="prf_submit" type="submit">Save</button>
	<?php echo form_close(); ?>
	</div>
</div>
<?php if($modified_data): ?>
<script type="text/javascript">
	profile_save('<?php echo $modified_data; ?>');
</script>
<?php endif; ?>