<div class="pageDefault pageProfile">
	<div class="profileForm">
	<?php echo form_open('', array('class' => 'form-profile', 'role' => 'form')); ?>
		<h2 class="form-signin-heading">Your Profile</h2>
		<p>Last Login: <?php echo gmdate("Y-m-d H:i:s", $user_data->usr_last_login); ?></p>
		<div class="error"><?php if(isset($profile_error)) echo $profile_error; ?></div>
		<input name="prf_name" id="prf_name" type="text" class="form-control" placeholder="Full Name" value="<?php echo $user_data->usr_name; ?>" required>
		<input name="prf_email" id="prf_email" type="email" class="form-control" placeholder="Email address" value="<?php echo $user_data->usr_email; ?>" required>
		<input name="prf_password" id="prf_password" type="password" class="form-control" placeholder="Password">
		<input name="repassword" id="repassword" type="password" class="form-control" placeholder="Re-enter Password">
		<button class="btn btn-lg btn-primary btn-block" name="prf_submit" id="prf_submit" type="submit">Save</button>
	<?php echo form_close(); ?>

	</div>
</div>