<script src="https://apis.google.com/js/client:platform.js" async defer></script>
<div class="loginbox">
  <div id="fb-root"></div>
<?php echo form_open('', array('class' => 'form-signin', 'role' => 'form')); ?>
	<div class="error"><?php if(isset($login_error)) echo $login_error; ?></div>
	<input name="lgn_email" id="lgn_email" type="email" class="form-control rc" placeholder="Email address" required autofocus>
	<input name="lgn_password" id="lgn_password" type="password" class="form-control rc" placeholder="Password" required>
  <div class="loginboxBottom qFixer">
    <input name="lgn_token" id="lgn_token" type="checkbox" class="form-control" /><label for="lgn_token">Stay signed in</label>
    <a class="lnkDefault lnkForgetPassword" href="<?php echo $site_url.'user/password/forget'; ?>">Forgot your password?</a>
  </div>
  <input name="lgn_ref" id="lgn_ref" type="hidden" class="form-control" value="<?php echo $referer_url; ?>" />
	<button class="btnLogin rc" name="lgn_submit" id="lgn_submit" type="submit">LOG IN</button>                     
<?php echo form_close(); ?>
  <div class="socials">
  <ul>
    <li>
      <a class="fbLogin rc" href="javascript:void(0);">SIGN IN WITH FACEBOOK</a>
    </li>
    <li>
      <a class="rc" href="javascript:void(0);" id="signinButton">SIGN IN WITH GOOGLE+</a>
    </li>
  </ul>
  </div>
  <div class="loginToSignup">Not a member yet? <a class="lnkDefault lnkSignup" href="javascript:void(0);">Sign up</a></div>
</div>
<script src="<?php echo site_url('js/social.js'); ?>"></script>