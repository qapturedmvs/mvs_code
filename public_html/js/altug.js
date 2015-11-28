
// Star Filmography Tabs

if( detectEl( $('.pageStar') ) ){
  
  //Page Load Selections
  $('.tabFilmography li:first').addClass('selected');
  $('.tabContent ul:first').addClass('active');
  
  //Filmography Tabs
  $('.tabFilmography button').click(function(){
    
    var _this = $(this), _parent = _this.parent('li');
    
    if(!_parent.hasClass('selected')){
    
      var type = _this.attr('rel');
      
      $('.tabContent ul.active').removeClass('active');
      $('.tabContent ul.'+type).addClass('active');
      $('.tabFilmography li.selected').removeClass('selected');
      _parent.addClass('selected');
      
    }
    
      
  });

}


//Deafult Dropdown
$('.drpButton').click(function(){
  $(this).parent('.drpDefault').toggleClass('opened');
});

// Loginbox / Signupbox
$('.loginbox .lnkSignup').click(function(){
  $('.userboxes.login').removeClass('login').addClass('signup');  
});

$('.signupbox .sgnSwitch').click(function(){
  $('.userboxes.signup').removeClass('signup').addClass('login');  
});



// Custom List Edit
$('.editHolder button').click(function(){
  
  if($('.pageDefault[rel="edit"]').length == 0){
    
    $('.pageDefault').attr("rel", "edit");
    
  }
    
});

/// SEARCHBOX
$('#search_keyword').focus(function(){
  $(this).parents('.searchbox').addClass('focus');  
}).blur(function(){
  $(this).parents('.searchbox').removeClass('focus');
});


// Profile Page Check User Nick
var stm = null, minLength = 4;
if( $('#prf_nick').length > 0 )
	$('#prf_nick')
	.bind('keyup', function(){
		var _this = $( this ), val = _this.val();
		_this.val( string_to_slug( val ) );
		if( _this.val().length >= minLength ){
			clearTm();
			stm = setTimeout(function(){ checkNick( _this ); }, 800);
		}else{
			 clearTm();
			 $('#prf_nick').parent('li').removeClass('loading').addClass('unavailable');
		}
	});
  
function clearTm(){  
  clearTimeout(stm);
}  

function checkNick( _this ){
	var val = _this.val(), rel = _this.attr('rel'); 
	if(val !== rel){
		_this.parent('li').addClass('loading');
		getAjax( { uri: site_url+'ajx/user_ajx/check_nick/'+val }, function( e ){			
				if(e['result'] == 'OK'){
					if(e['status'] == 'DONE'){
						$('#prf_nick').parent('li').removeClass('loading unavailable').addClass('available');
						$('#prf_nick').val(e['nick']);
					}else{
						$('#prf_nick').parent('li').removeClass('loading available').addClass('unavailable');
					}
					
				}else
					alert(e['msg']);
		});
	}
}
function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();
  
  // remove accents, swap ñ for n, etc
  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to   = "aaaaeeeeiiiioooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
}


///////////////////////////////////////////////////////////////////////////////////

//////* MOVIE ACTIONS *//////
	
//function get_obj_detail(obj, pre){
//	
//	return {id:$(obj).parents('*[data-'+pre+'-id]').attr('data-'+pre+'-id'), itm:$(obj).attr('data-itm-id')};
//
//}	

//// Single Seen
//function s_seen(obj){
//
//	getAjax( { uri: site_url+'ajx/movie_actions_ajx/s_seen/', param: get_obj_detail(obj, 'mvs') }, function( e ){
//				
//				if(e['result'] == 'OK'){
//					if(e['itm-id'] != 0)
//						$('.addtoWtc a').attr("data-itm-id", "0");
//
//					$(obj).attr("data-itm-id", e['itm-id']);
//					
//				}else
//					alert(e['msg']);
//					
//		});
//
//}

//// Seen Page Unseen
//function unseen(obj){
//
//		var id = $(obj).attr("seen-id");
//
//		getAjax( { uri: site_url+'ajx/movie_actions_ajx/seen_unseen_movie/unseen', param: {id:id} }, function( e ){
//				
//				if(e['result'] == 'OK'){
//					$(obj).parents('div.movieItem').fadeOut(333, function(){
//						$(obj).parents('div.movieItem').remove();
//					});
//					
//				}else
//					alert(e['msg']);
//					
//		});
//	
//}

// Single Applaud
//function s_applaud(obj){
//				
//	getAjax( { uri: site_url+'ajx/movie_actions_ajx/s_applaud/', param: get_obj_detail(obj, 'mvs') }, function( e ){
//				
//				if(e['result'] == 'OK')
//					$(obj).attr("data-itm-id", e['itm-id']);
//				else
//					alert(e['msg']);
//					
//		});
//
//}
//
//// Single Watchlist
//function s_watchlist(obj){
//			
//		getAjax( { uri: site_url+'ajx/movie_actions_ajx/s_watchlist/', param: get_obj_detail(obj, 'mvs') }, function( e ){
//				
//				if(e['result'] == 'OK'){
//					if(e['itm-id'] != 0)
//						$('.seenMovie a').attr("data-itm-id", "0");
//					
//					$(obj).attr("data-itm-id", e['itm-id']);
//					
//				}else
//					alert(e['msg']);
//					
//		});
//}
//
//
//// Single Custom List
//function s_customlist(obj){
//		
//		var params = get_obj_detail(obj, 'mvs');
//				params['list'] = $(obj).attr("data-prn-id");
//		
//		getAjax( { uri: site_url+'ajx/movie_actions_ajx/s_customlist/', param: params }, function( e ){
//				
//				if(e['result'] == 'OK')
//					$(obj).attr("data-itm-id", e['itm-id']);
//				else
//					alert(e['msg']);
//					
//		});
//}


// Follow User
//function follow_user(obj){
//
//	getAjax( { uri: site_url+'ajx/user_ajx/follow_user/', param: get_obj_detail(obj, 'usr') }, function( e ){
//				
//				if(e['result'] == 'OK')						
//					$(obj).attr("data-itm-id", e['itm-id']);	
//				else
//					alert(e['msg']);
//					
//		});
//
//}

if( detectEl( $('.pageUserFinder') ) && keyword != '' )
  $('#user_keyword').val(keyword);

// Movie List Seen
var seenList = [];
function select_seen(obj){
	
	var rel = $(obj).attr("rel"), id = $(obj).parents(".movieItemInner").attr("mvs-id");
	
	if(rel == 0){
		
		seenList.push(id);
		$(obj).attr("rel", 1);
		
	}else{
		
		seenList.splice(seenList.indexOf(id), 1);
		$(obj).attr("rel", 0);
		
	}

}

$('.btnMultiSeen').click(function(){
		
		getAjax( { uri: site_url+'ajx/movie_actions_ajx/mark_all_seen/', param: {ids:seenList} }, function( e ){
				
				alert(e['msg']);
				removeSeen();
				seenList = [];
					
		});
});

function removeSeen(){
	
	for(var i=0, l=seenList.length; i<l; i++)
		$('.movieItemInner[mvs-id="'+seenList[i]+'"] .seen a').remove();
	
}




