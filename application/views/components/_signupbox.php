<div class="signupbox">
<?php echo form_open('', array('class' => 'form-signup', 'role' => 'form')); ?>
	<h2 class="form-signin-heading">Please sign up</h2>
	<div class="error"><?php if(isset($signup_error)) echo $signup_error; ?></div>
  <input name="sgn_name" id="sgn_name" type="text" class="form-control" placeholder="Full Name" required>
	<input name="sgn_email" id="sgn_email" type="email" class="form-control" placeholder="Email address" required>
	<input name="sgn_password" id="sgn_password" type="password" class="form-control" placeholder="Password" required>
	<button class="btn btn-lg btn-primary btn-block" name="sgn_submit" id="sgn_submit" type="submit">Sign Up</button>                     
<?php echo form_close(); ?>
</div>