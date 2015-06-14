
//Facebook Connect
  function statusChangeCallback(){
		
		FB.getLoginStatus(function(response) {

			if(response.status === 'connected'){

				fb_auth();
				
			}else if(response.status === 'not_authorized') {
	
				console.log('not authorized');
				
			}else{
	
				console.log('not connected');
			}
			
    });

  }

  window.fbAsyncInit = function() {
    
    FB.init({
      appId      : '1563041457302963',
      cookie     : true,
      xfbml      : true, 
      version    : 'v2.3' 
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

  function fb_auth() {
    FB.api('/me', function(response) {

      getAjax( { uri: site_url+'ajx/auth_ajx/fb_auth/', param:response }, function( e ){
        
        if(e['result'] == 'OK')
          window.location.reload();
          
			});

    });
  }
	
	$('.fbLogin').click(function(){  

		FB.login(function(response){

			statusChangeCallback();
			
		}, {scope: 'public_profile,email'});
    
  });
	
	
	
	function signinCallback(authResult) {
		console.log(authResult);
		if (authResult['status']['signed_in']) {
			// Update the app to reflect a signed in user
			// Hide the sign-in button now that the user is authorized, for example:
			//document.getElementById('signinButton').setAttribute('style', 'display: none');
			
			//gapi.client.load('plus','v1', function(){
			//	var request = gapi.client.plus.people.get({
			//		'userId': 'me'
			//	});
			//	request.execute(function(resp) {
			//		console.log(resp);
			//	});
			// });
			
		} else {
			// Update the app to reflect a signed out user
			// Possible error values:
			//   "user_signed_out" - User is signed-out
			//   "access_denied" - User denied access to your app
			//   "immediate_failed" - Could not automatically log in the user
			console.log('Sign-in state: ' + authResult['error']);
		}
	}
	
	

