<div class="container home">
<?php echo form_open('', array('class' => 'form-signin', 'role' => 'form')); ?>
	<h2 class="form-signin-heading">Please sign in</h2>
	<div class="error"><?php echo validation_errors(); ?></div>
	<input name="email" id="email" type="email" class="form-control" placeholder="Email address" required autofocus>
	<input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>                     
<?php echo form_close(); ?>
</div>
