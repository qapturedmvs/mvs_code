<script>
//  window.fbAsyncInit = function() {
//    FB.init({
//      appId      : '1563041457302963',
//      xfbml      : true,
//      version    : 'v2.3'
//    });
//  };
//
//  (function(d, s, id){
//     var js, fjs = d.getElementsByTagName(s)[0];
//     if (d.getElementById(id)) {return;}
//     js = d.createElement(s); js.id = id;
//     js.src = "//connect.facebook.net/en_US/sdk.js";
//     fjs.parentNode.insertBefore(js, fjs);
//   }(document, 'script', 'facebook-jssdk'));
//  
//  
//  FB.getLoginStatus(function(response) {
//  if (response.status === 'connected') {
//    console.log('Logged in.');
//  }
//  else {
//    FB.login();
//  }
//});
</script>
<div class="loginbox">
<?php echo form_open('', array('class' => 'form-signin', 'role' => 'form')); ?>
	<h2 class="form-signin-heading">Please sign in</h2>
	<div class="error"><?php if(isset($login_error)) echo $login_error; ?></div>
	<input name="lgn_email" id="lgn_email" type="email" class="form-control" placeholder="Email address" required autofocus>
	<input name="lgn_password" id="lgn_password" type="password" class="form-control" placeholder="Password" required>
    <input name="lgn_cookie" id="lgn_cookie" type="checkbox" class="form-control" /><label for="lgn_cookie">Keep me signed in</label>
  <input name="lgn_ref" id="lgn_ref" type="hidden" class="form-control" value="<?php echo $referer_url; ?>" />
	<button class="btn btn-lg btn-primary btn-block" name="lgn_submit" id="lgn_submit" type="submit">Sign in</button>                     
<?php echo form_close(); ?>
<div class="lnkDefault lnkForgetPassword"><a href="<?php echo $site_url.'user/password/forget'; ?>">Forget Password?</a></div>
  <div class="socials">

  </div>
</div>