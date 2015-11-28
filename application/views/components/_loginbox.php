<section class="loginbox <?php echo $sys_msg['status']; ?>">
  <script src="https://apis.google.com/js/client:platform.js" async defer></script>
  <div id="fb-root"></div>
  <div class="qLogin">
    <?php echo form_open('', array('class' => 'form-signin', 'role' => 'form')); ?>
    <input name="lgn_email" id="lgn_email" type="email" class="form-control rc" placeholder="Email address" required autofocus>
    <input name="lgn_password" id="lgn_password" type="password" class="form-control rc" placeholder="Password" required>
    <div class="loginboxBottom qFixer">
      <input name="lgn_token" id="lgn_token" type="checkbox" class="form-control" /><label for="lgn_token">Stay signed in</label>
      <a class="lnkDefault lnkForgetPassword" href="/user/password/forgotten">Forgot your password?</a>
    </div>
    <input name="lgn_ref" id="lgn_ref" type="hidden" class="form-control" value="<?php echo $referer_url; ?>" />
    <button class="btnLogin rc" name="lgn_submit" id="lgn_submit" type="submit">LOG IN</button>
    <?php
      if($sys_msg['type'] == 'login') echo '<div class="sys-msg-default sys-'.$sys_msg['status'].'-default small spriteBefore">'.$sys_msg['text'].'</div>';
      echo form_close();
    ?>
  </div>
  <div class="socials">
  <ul>
    <li>
      <button class="fbLogin rc">SIGN IN WITH FACEBOOK</button>
    </li>
    <li>
      <button class="rc" id="signinButton">SIGN IN WITH GOOGLE+</button>
    </li>
  </ul>
  </div>
  <div class="lgnSwitch">Not a member yet? <button class="lnkDefault lnkSignup">Sign up</button></div>
  <script src="<?php echo $site_url.'js/social.js'; ?>"></script>
</section>
<section class="signupbox <?php echo $sys_msg['status']; ?>">
  <div class="titleDefault titleSignup">Sign Up</div>
  <?php echo form_open('', array('class' => 'form-signup', 'role' => 'form')); ?>
  <input name="sgn_name" id="sgn_name" type="text" class="form-control rc" placeholder="Full name" required>
	<input name="sgn_email" id="sgn_email" type="email" class="form-control rc" placeholder="Email address" required>
	<input name="sgn_password" id="sgn_password" type="password" class="form-control rc" placeholder="Password" required>
  <span class="sgn_info">By clicking Sign Up, you agree to our Terms including our Cookie Use.</span>
	<button class="btnSignup rc" name="sgn_submit" id="sgn_submit" type="submit">SIGN UP</button>
  <?php
    if($sys_msg['type'] == 'signup') echo '<div class="sys-msg-default sys-'.$sys_msg['status'].'-default small spriteBefore">'.$sys_msg['text'].'</div>';
    echo form_close();
  ?>
  <div class="sgnSwitch">Already a member? <button class="lnkDefault lnkLogin">Sign in</button></div>
</section>