
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
	
	
	//Google+ Connect
	function signinCallback(authResult){

		if(authResult["status"]["method"] == "PROMPT" && authResult['status']['signed_in']){
			
			gapi.client.load('plus','v1', function(){
				
				var request = gapi.client.plus.people.get({
					'userId': 'me'
				});

				request.execute(function(response){
					
					getAjax( { uri: site_url+'ajx/auth_ajx/gp_auth/', param:response }, function( e ){
        
						if(e['result'] == 'OK')
							window.location.reload();
							
					});
					
				});
				
			 });
			
		}else if(!authResult['status']['signed_in']){
			// Update the app to reflect a signed out user
			// Possible error values:
			//   "user_signed_out" - User is signed-out
			//   "access_denied" - User denied access to your app
			//   "immediate_failed" - Could not automatically log in the user
			console.log('Sign-in state: ' + authResult['error']);
		}
	}
	
	function googlePlusLogin(){
		
		gapi.auth.signIn({ 
			'callback': signinCallback, 
			'clientid': '823545813703-bc6go0nl8n5636jd1ojg1up9lja2luoe.apps.googleusercontent.com', 
			'cookiepolicy': 'single_host_origin', 
			//'requestvisibleactions': 'http://schemas.google.com/AddActivity',
			'scope': 'profile'
		});
	}
	
	$('#signinButton').click(googlePlusLogin);
	
	

