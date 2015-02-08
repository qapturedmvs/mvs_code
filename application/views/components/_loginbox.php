<div class="loginbox">
<?php echo form_open('', array('class' => 'form-signin', 'role' => 'form')); ?>
	<h2 class="form-signin-heading">Please sign in</h2>
	<div class="error"><?php if(isset($login_error)) echo $login_error; ?></div>
	<input name="lgn_email" id="lgn_email" type="email" class="form-control" placeholder="Email address" required autofocus>
	<input name="lgn_password" id="lgn_password" type="password" class="form-control" placeholder="Password" required>
	<button class="btn btn-lg btn-primary btn-block" name="lgn_submit" id="lgn_submit" type="submit">Sign in</button>                     
<?php echo form_close(); ?>
<div class="lnkDefault lnkForgetPassword"><a href="<?php echo $site_url.'user/password/forget'; ?>">Forget Password?</a></div>
</div>