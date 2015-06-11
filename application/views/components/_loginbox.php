<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response, type){
    //console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if(response.status === 'connected'){
      // Logged into your app and Facebook.
      if(type == 'login')
        fb_auth();
      
    }else if(response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      console.log('not authorized');
    }else{
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      console.log('not connected');
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  //function checkLoginState() {
  //  FB.getLoginStatus(function(response) {
  //    statusChangeCallback(response);
  //  });
  //}

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1563041457302963',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.3' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response, 'check');
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function fb_auth() {
    FB.api('/me', function(response) {
      //console.log('Successful login for: ' + response.name);
      //console.log(response);
      getAjax( { uri: site_url+'ajx/auth_ajx/fb_auth/', param:response }, function( e ){
        
        if(e['result'] == 'OK')
          window.location.reload();
          
			});

    });
  }
  
</script>
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
  
  </div>
</div>
<script type="text/javascript">
  
    $('.fbLogin').click(function(){  

      FB.login(function(response){
        // handle the response
        statusChangeCallback(response, 'login');
        
      }, {scope: 'public_profile,email'});
    
    });
  
</script>
