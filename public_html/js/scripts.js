// GLOBAL VARIABLE
var site_url = $('#mvs_site_url').val(), qs = window.location.search;

// GLOBAL ANGULAR MODULE
var qapturedApp = angular.module('qapturedApp', ['infinite-scroll']);
	qapturedApp.config(['$httpProvider', function( $httpProvider ){ $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest'; }]);
	
// Qaptured AutoComplete
$.widget( "custom.qapturedComplete", $.ui.autocomplete, {
	_create: function() {
		this._super();
		this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
	},
	_renderMenu: function( ul, items ) {
			
		var that = this,
			currentCategory = "";
			
		$.each( items, function( index, item ) {
			var li;
			if ( item.category != currentCategory ){
				
				ul.append('<li class="ui-autocomplete-category '+ item.category +'"><h2>' + item.category + '</h2></li>' );
				currentCategory = item.category;
			}
			
			li = that._renderItemData( ul, item );
			
			if( item.category == 'movies' ){
				li.html('<div class="row"><span class="poster"><a href="/mvs_code/public_html/movie/'+ item.mvs_slug + '"><div class="posterImg" src=""></div></a></span><span class="title"><a href="/mvs_code/public_html/movie/'+ item.mvs_slug + '">'+ item.mvs_title + ' ('+ item.mvs_year +')</a></span><hr class="qFixer" /></div>');
			}else if( item.category == 'stars' ){
				li.html('<div class="row"><span class="poster"><a href="/mvs_code/public_html/movie/'+ item.str_slug + '"><div class="posterImg" src=""></div></a></span><span class="title"><a href="/mvs_code/public_html/movie/'+ item.str_slug + '">'+ item.str_name +'</a></span><hr class="qFixer" /></div>');
			}else if( item.category == 'noResult' ){
				li.html('<div class="row">No Result</div>');
			}
			
		});
		
	}
});


function mergeData( data ){
	
	var obj = [], m = data['movies'] , s = data['stars'];
	
	if( m.length > 0 ){
		for( var i = 0; i < m.length; ++i )
			m[i]['category'] = 'movies';
		
		obj = obj.concat( m );	
	}
	
	if( s.length > 0 ){
		for( var j = 0; j < s.length; ++j )
			s[j]['category'] = 'stars';	
		
		obj = obj.concat( s );	
	}
	
	if( obj.length > 0 ) return obj 
	else return [{ 'category': 'noResult' }];
	
}

if( $('#search_keyword').length > 0 )
	$('#search_keyword').qapturedComplete({
		source: function( request, response ) {
			$.ajax({
			  url: site_url + "ajx/search_ajx/lister/" + request.term,
			  success: function( d ) {  
			  	if( d.result == 'OK' )
			  		response( mergeData( d.data ) );
			  }
			});
		  },
		  minLength: 3
	});


// Obj Exist
function exist(obj){
	if(obj.html() != undefined) 
		return true; 
	else 
		return false;
}

// Login Form
if(exist($('.loginHolder'))) $('.loginHolder .loginForm').minusDropDown();

// Movies List
if(exist($('.pageMovies'))){
	
	if(sessionStorage.viewType == "grid")
    $('.movieListHolder').removeClass("row").addClass(sessionStorage.viewType);
	
	$('.controllers .view a').click(function(){
		var view = $(this).attr("class");
		
		sessionStorage.viewType = view;
		
		$('.movieListHolder').removeClass("row").removeClass("grid").addClass(view);
		
		if( $("div.lazy").length > 0 )
				$("div.lazy").lazyload({ effect: 'fadeIn', load: function(){ $( this ).parents('.movieItem').addClass('loaded'); } });
		
	});
	
	$('.filterList > li').mouseenter(function(){
		$(this).addClass("active");
	}).mouseleave(function(){
		$(this).removeClass("active");
	});
	
	var fg, fi;
	
	if(qs != ''){
		var qObj = qsManager.qto(qs), id, grp, temp;
		
		$('.choicesHolder').removeClass('none');
		
		for(var e in qObj){
			for(var i in qObj[e]){
				$('.filters ul.multi[rel="'+e+'"] li a[rel="'+qObj[e][i]+'"]').addClass("selected");
			}
		}
	}
	
	$('.clrChoices').click(function(){
		temp = '';
		$('.choices a').each(function(i){
			grp = $(this).attr("grp");
			if(temp.indexOf(grp) == -1)
				temp += (i == 0) ? grp : '|'+grp;
		});
		
		if(qs.indexOf('mfy') != -1)
			temp += '|mfy';
		
		if(qs.indexOf('mfr') != -1)
			temp += '|mfr';
		
		qsManager.remove(temp);
	});
	
	$('.choices a').click(function(){
		id = $(this).attr("rel"),
		grp = $(this).attr("grp");
		
		if(id != undefined)
			qsManager.mput(grp, id);
		else
			qsManager.remove(grp);
	});
	
	$('.filters .submenu a').click(function(){
		fg = $(this).parents('ul.multi').attr("rel"),
		fi = $(this).attr("rel");

		qsManager.mput(fg, fi);
	});
	
	// infinite-Scroll
	infiniteScroll('ajx/movie_ajx/lister/');
}

if( $('.pageSearch').length > 0 ) getAjx({ controller: 'searchController', uri: 'ajx/search_ajx/lister/muh' }, function(){});

// Movie Detail Feeds
if( $('.movieCommentsHolder').length > 0 ){
		var mvs_id = $('.pageMovie .details').attr("rel");
		getAjx({ controller: 'movieCommentController', uri: 'ajx/comments_ajx/movie_detail?type=myn&mvs_id='+mvs_id }, function(){});
	}


function getAjx( obj, callback ){
	var url = site_url + obj['uri']
	qapturedApp.controller(obj['controller'], function( $scope,  $http ){ 
		$http.get( url ).success(function( d ){
			if( d['result'] == 'OK' ){
				$scope.items = d['data'];
				if( callback != undefined ) callback();
			}
		});
	});
}

function infiniteScroll( uri ){
		qapturedApp.controller('infiniteScrollController', function( $scope, Reddit ){ $scope.reddit = new Reddit(); });
		qapturedApp.factory('Reddit', function( $http ){
		  var Reddit = function() {
			this.items = [];
			this.busy = false;
			this.noResult = false;
			this.after = 1;
		  };
		  Reddit.prototype.nextPage = function() {
			if( this.busy || this.noResult ) return;
				this.busy = true;	
			
			var url = site_url + uri + this.after + qs;
			
			$http.get(url).success(function(d) {
		
			  if( d['result'] == 'OK' ){
				
				//
				for(var i = 0; i < d['data'].length; ++i){
					var items = d['data'][ i ];
						items['type'] = 0;
						items['mvs_genre'] = items['mvs_genre'].toString();
						items['mvs_country'] = items['mvs_country'].toString();					
						if( items['mvs_poster'] == null )
							items['mvs_poster'] = 'images/placeHolder.jpg';
					this.items.push( items );
				}
				
				//
				if( d['data'].length < 100 ){
					this.busy = false;
					this.noResult = true;
				}else{
					this.after++;
					this.busy = false;
					this.items.push( { 'type': 1, 'paging': this.after } );
				}
				
				// TRIGGER LAZYLOAD
				setTimeout(function(){
					if( $("div.lazy").length > 0 )
						$("div.lazy").lazyload({ effect: 'fadeIn', load: function(){ $( this ).removeClass('lazy').parents('.movieItem').addClass('loaded'); } });
				}, 1);
				
			  }else{
				this.busy = false;
				this.noResult = true;
				this.items.push( { 'type': 2, 'result': 'No Result' } );
			  }
			}.bind(this));
		  };
		  return Reddit;
		});
}

/* FORM VALIDATION */
if ($('.form-signin').length > 0) 
	$('.form-signin').validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 6
			}
		},
		messages: {
			email: 'Please enter a valid email address',
			password: {
				required: 'Please provide a password',
				minlength: 'Your password must be at least 6 characters long'
			}
		}
	});
	
	

if ($('.form-signup').length > 0) 
	$('.form-signup').validate({
		rules: {
			name: 'required',
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 6
			}
		},
		messages: {
			name: 'Please name',
			email: 'Please enter a valid email address',
			password: {
				required: 'Please provide a password',
				minlength: 'Your password must be at least 6 characters long'
			}
		}
	});
	
// MOVIE DETAIL ACTIONS

$('li.seenMovie a').click(function(){
		var action = $(this).parent('li').attr("rel");
		
		$.ajax({
			type:'POST',
			url:site_url+'ajx/add_to_list_ajx/seen_unseen_movie/'+action,
			data:{id:mvs_id},
			success:function(result){
				if(result == 'seen' || result == 'unseen')
					$('li.seenMovie').attr("rel", result);
				else
					alert(result);
			}
		});
});

// MOVIE LIST SEEN
var seenList = [];
function select_seen(obj){
	
	var rel = $(obj).attr("rel"), id = $(obj).parents(".movieItemInner").attr("rel");
	
	if(rel == 0){
		
		seenList.push(id);
		$(obj).attr("rel", 1);
		
	}else{
		
		seenList.splice(seenList.indexOf(id), 1);
		$(obj).attr("rel", 0);
		
	}

}

$('a.btnMultiSeen').click(function(){
		
		$.ajax({
			type:'POST',
			url:site_url+'ajx/add_to_list_ajx/mark_all_seen/',
			data:{ids:seenList},
			success:function(result){
				alert(result);
			}
		});
		
});

