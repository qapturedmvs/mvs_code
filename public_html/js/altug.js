
function select_movie(m){
	
	var _this = $(m).parents('[mvs-id]'), mvs = _this.attr('mvs-id');
	
	console.log(mvs);
	
}

// Movie Detail Seen In User's Network
if( exist($('.pageMovie')) )
	getAjx({ controller: 'mdUserNetworkSeen', uri: 'ajx/movie_actions_ajx/myn_seen_users/'+mvs_id }, function(){});
	

// User Finder Page
if( $('.pageUserFinder').length > 0 && typeof keyword != 'undefined' )
	getAjx({ controller: 'UserSearchController', uri: "ajx/search_ajx/get_users/suggest?u="+keyword }, function(){
		
		setTimeout(function(){ lazyLoadActive(); }, 1);
		
	});

// User Search Suggest
if( $('#user_keyword').length > 0 )
	$('#user_keyword').qapturedComplete({
		source: function( request, response ) {
			
			getAjax( { uri: site_url + "ajx/search_ajx/get_users/suggest?u=" + request.term, param: null }, function( d ){
				
				if( d.result == 'OK' )
			  	response( prepareData(d.data) );
					
		    });
			
		  },
		  minLength: 2
	});
	
	function prepareData( data ){
	
	var obj = [];
	
	if( data.length > 0 ){
		for( var i = 0; i < data.length; ++i )
			data[i]['category'] = 'users';
		
		obj = obj.concat( data );	
	}
	
	if( obj.length > 0 ) return obj;
	else return [{ 'category': 'noResult' }];
	
}