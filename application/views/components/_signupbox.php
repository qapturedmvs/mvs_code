<section class="signupbox none">
<?php echo form_open('', array('class' => 'form-signup', 'role' => 'form')); ?>
	<div class="error"><?php if(isset($signup_error)) echo $signup_error; ?></div>
  <input name="sgn_name" id="sgn_name" type="text" class="form-control rc" placeholder="Full Name" required>
	<input name="sgn_email" id="sgn_email" type="email" class="form-control rc" placeholder="Email address" required>
	<input name="sgn_password" id="sgn_password" type="password" class="form-control rc" placeholder="Password" required>
	<button class="btnSignup rc" name="sgn_submit" id="sgn_submit" type="submit">Sign Up</button>                     
<?php echo form_close(); ?>
</section>