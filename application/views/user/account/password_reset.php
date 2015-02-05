<div class="pageDefault pageProfile">
	<div class="profileForm">
	<?php echo form_open('', array('class' => 'form-password-reset', 'role' => 'form')); ?>
		<h2 class="form-signin-heading">Password Reset</h2>
		<div class="error"><?php if(isset($password_reset_error)) echo $password_reset_error; ?></div>
		<input name="pwr_password" id="pwr_password" type="password" class="form-control" placeholder="Password">
		<input name="repassword" id="repassword" type="password" class="form-control" placeholder="Re-enter Password">
		<button class="btn btn-lg btn-primary btn-block" name="pwr_submit" id="pwr_submit" type="submit">Save</button>
	<?php echo form_close(); ?>
	</div>
</div>