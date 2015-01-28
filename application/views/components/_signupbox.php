<div class="signupbox">
<?php echo form_open('user/sign/up', array('class' => 'form-signup', 'role' => 'form')); ?>
	<h2 class="form-signin-heading">Please sign up</h2>
	<div class="error"><?php echo validation_errors(); ?></div>
  <input name="name" id="name" type="text" class="form-control" placeholder="Full Name" required>
	<input name="email" id="email" type="email" class="form-control" placeholder="Email address" required>
	<input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>                     
<?php echo form_close(); ?>
</div>