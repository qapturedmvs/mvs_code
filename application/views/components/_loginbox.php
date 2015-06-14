<script src="https://apis.google.com/js/client:platform.js" async defer></script>
<div class="loginbox">
  <div id="fb-root"></div>
<?php echo form_open('', array('class' => 'form-signin', 'role' => 'form')); ?>
	<h2 class="form-signin-heading">Please sign in</h2>
	<div class="error"><?php if(isset($login_error)) echo $login_error; ?></div>
	<input name="lgn_email" id="lgn_email" type="email" class="form-control" placeholder="Email address" required autofocus>
	<input name="lgn_password" id="lgn_password" type="password" class="form-control" placeholder="Password" required>
    <input name="lgn_token" id="lgn_token" type="checkbox" class="form-control" /><label for="lgn_token">Keep me signed in</label>
  <input name="lgn_ref" id="lgn_ref" type="hidden" class="form-control" value="<?php echo $referer_url; ?>" />
	<button class="btn btn-lg btn-primary btn-block" name="lgn_submit" id="lgn_submit" type="submit">Sign in</button>                     
<?php echo form_close(); ?>
<div class="lnkDefault lnkForgetPassword"><a href="<?php echo $site_url.'user/password/forget'; ?>">Forget Password?</a></div>
  <div class="socials">

    <a class="fbLogin" href="javascript:void(0);">FACEBOOK CONNECT</a>
    
    <a href="javascript:void(0);" id="signinButton">
      <span
        class="g-signin"
        data-callback="signinCallback"
        data-clientid="823545813703-bc6go0nl8n5636jd1ojg1up9lja2luoe.apps.googleusercontent.com"
        data-cookiepolicy="single_host_origin"
        data-scope="profile">GOOGLE+ CONNECT
      </span>
    </a>

  
  </div>
</div>
<script src="<?php echo site_url('js/social.js'); ?>"></script>