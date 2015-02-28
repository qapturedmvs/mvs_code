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
			
			getAjax( { uri: site_url + "ajx/search_ajx/lister/" + request.term, param: null }, function( d ){
				
				if( d.result == 'OK' )
			  		response( mergeData( d.data ) );
					
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
		
		lazyLoadActive();
		
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
	infiniteScroll({ 'uri': 'ajx/movie_ajx/lister/', 'listType': 'ml', 'pageSize': 100, 'cstVar': '' });
}

if( $('.pageSearch').length > 0 && typeof keyword != 'undefined' )
	getAjx({ controller: 'searchController', uri: 'ajx/search_ajx/lister?q='+keyword }, function(){});


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


function infiniteScroll( obj ){
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
						
			var sep = (qs === '') ? '?' : '&', url = site_url + obj['uri'] + this.after + qs + sep + 'type=' + obj['listType'] + obj['cstVar'];
			
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
				if( d['data'].length < obj['pageSize'] ){
					this.busy = false;
					this.noResult = true;
				}else{
					this.after++;
					this.busy = false;
					this.items.push( { 'type': 1, 'paging': this.after } );
				}
				
				// TRIGGER LAZYLOAD
				setTimeout(function(){
					lazyLoadActive();
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


//////* MOVIE ACTIONS *//////

// Movie Detail Feeds
if( $('.movieCommentsHolder').length > 0 )
		getAjx({ controller: 'movieCommentController', uri: 'ajx/comments_ajx/movie_detail?type=nwf&mvs_id='+mvs_id }, function(){});

// Movie Detail Seen
$('li.seenMovie a').click(function(){
		var action = $(this).parent('li').attr("rel"),
				id = (action == 'seen') ? mvs_id : $(this).parent('li').attr("seen-id");
		
		getAjax( { uri: site_url+'ajx/list_actions_ajx/seen_unseen_movie/'+action, param: {id:id} }, function( e ){
				
				if(e['result'] == 'OK'){
					if(e['action'] == 'seen')
						$('li.seenMovie').removeAttr("seen-id");
					else{
						$('li.seenMovie').attr("seen-id", e['seen-id']);
					}
						
					$('li.seenMovie').attr("rel", e['action']);
					
				}else
					alert(e['msg']);
					
		});
});

// Movie Detail Seen
$('li.seenMovie a').click(function(){
		var action = $(this).parent('li').attr("rel"),
				id = (action == 'seen') ? mvs_id : $(this).parent('li').attr("seen-id");
		
		getAjax( { uri: site_url+'ajx/list_actions_ajx/seen_unseen_movie/'+action, param: {id:id} }, function( e ){
				
				if(e['result'] == 'OK'){
					if(e['action'] == 'seen')
						$('li.seenMovie').removeAttr("seen-id");
					else{
						$('li.seenMovie').attr("seen-id", e['seen-id']);
					}
						
					$('li.seenMovie').attr("rel", e['action']);
					
				}else
					alert(e['msg']);
					
		});
});

// Movie List Seen
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
		
		getAjax( { uri: site_url+'ajx/list_actions_ajx/mark_all_seen/', param: {ids:seenList} }, function( e ){
				
				alert(e['msg']);
				removeSeen();
				seenList = [];
					
		});
});

function removeSeen(){
	
	for(var i=0, l=seenList.length; i<l; i++)
		$('.movieItemInner[rel="'+seenList[i]+'"] .seen a').remove();
	
}

// Movie Detail Watchlist
$('li.wtc a').click(function(){
		var action = $(this).parent('li').attr("rel"),
				id = (action == 'awtc') ? mvs_id : $(this).parent('li').attr("wtc-id");
		
		
		getAjax( { uri: site_url+'ajx/list_actions_ajx/add_remove_watchlist/'+action, param: {id:id} }, function( e ){
				
				if(e['result'] == 'OK'){
					if(e['action'] == 'awtc')
						$('li.wtc').removeAttr("wtc-id");
					else{
						$('li.wtc').attr("wtc-id", e['wtc-id']);
						if($('li.seenMovie').attr("rel") === 'unseen')
							$('li.seenMovie a').click();
					}
						
					$('li.wtc').attr("rel", e['action']);
					
				}else
					alert(e['msg']);
					
		});
		
});

// Movie Detail Custom List
$('.cnl > a').click(function(){
	$('.listCreate').toggleClass("none");
	$('.listCreate input').val('');	
});

if($('.cLists ul li').length > 0)
	$('.cLists.none').removeClass('none');

// Movie Detail Create New Custom List
$('.listCreate a').click(function(){
		var action = $(this).attr("rel"),
				title = $(this).siblings('input').val();
		
		if(title.length > 255)
			title = title.substring(0, 254);

		
		
		getAjax( { uri: site_url+'ajx/list_actions_ajx/create_new_list/'+action, param: {id:mvs_id,title:title} }, function( e ){
				
				if(e['result'] == 'OK'){
					$('.cnl > a').click();
					$('.cLists ul').append('<li rel="rfcl" list-id="'+e['list-id']+'" ldt-id="'+e['ldt-id']+'"><a href="javascript:void(0);">'+title+'</a></li>');
					$('.cLists.none').removeClass('none');
					
				}else
					alert(e['msg']);
					
		});
		
});

// Movie Detail Add/Remove to/from Custom List
$('.cLists li a').click(function(){
		var action = $(this).parent('li').attr("rel"),
				id = (action == 'atcl') ? $(this).parent('li').attr("list-id") : $(this).parent('li').attr("ldt-id");
		
		getAjax( { uri: site_url+'ajx/list_actions_ajx/add_remove_from_list/'+action, param: {id: id, mvs: mvs_id} }, function( e ){
				
				if(e['result'] == 'OK'){
					if(e['action'] == 'atcl')
						$('.cLists li[ldt-id="'+id+'"]').removeAttr("ldt-id").attr("rel", e['action']);
					else
						$('.cLists li[list-id="'+id+'"]').attr("ldt-id", e['ldt-id']).attr("rel", e['action']);	
				}else
					alert(e['msg']);
					
		});
	
});
function getAjax( obj, callback, error ){
	$.ajax({
		type:'POST',
		url:obj['uri'] || null,
		dataType: obj['dataType'] || null,
		data:obj['param'] || null,
		error: function( e ){ if( error != undefined ) error( e ); },
		success:function( e ){
			if( callback != undefined ) callback( e );
		}
	});
}

//////* USER PAGES *//////

// Custom List Page
if( exist($('.pageCustomList')) )
		getAjx({ controller: 'userCustomList', uri: 'ajx/user_custom_list_ajx/list_lister' }, function(){});
		
if( exist($('.pageCustomListDetail')) ){
	
	if(sessionStorage.viewType == "grid")
    $('.movieListHolder').removeClass("row").addClass(sessionStorage.viewType);
	
	$('.controllers .view a').click(function(){
		var view = $(this).attr("class");
		
		sessionStorage.viewType = view;
		
		$('.movieListHolder').removeClass("row").removeClass("grid").addClass(view);
		
		lazyLoadActive();
		
	});
	
	// infinite-Scroll
	infiniteScroll({ 'uri': 'ajx/movie_ajx/lister/', 'listType': 'ucl', 'pageSize': 30, 'cstVar': '&list='+list_id });
}

// Custom List Detail Remove from Custom List
var clsArr = [];

function removeFromList(obj){
	
	var rel = $(obj).attr("rel"), id = $(obj).attr("ldt-id"), mvs = $(obj).parents(".movieItemInner").attr("rel");
		
	clsArr.push(id);
	
	$(obj).parents('div.movieItem').fadeOut(333, function(){
		$(obj).parents('div.movieItem').remove();
	});

}

$('.editHolder a').click(function(){
	
	if($('.pageDefault').hasClass('edit')){
		edit_custom_list();
		$('.titleCustomList h4').text($('input.listTitle').val());
		$('.pageDefault').removeClass('edit');
	}else{
		$('.pageDefault').addClass('edit');
		$('.titleCustomList input').focus();
	}
	
});

function edit_custom_list(){
	var title = $('input.listTitle').val(), text = $('.titleCustomList h4').text();
		
		if(title !== text){

			getAjax( { uri: site_url+'ajx/user_custom_list_ajx/edit_list_detail', param: {id: list_id, title:title} }, function( e ){
					
					if(e['result'] == 'FALSE')
						alert(e['msg']);
						
			});
		
		}
		
		if(clsArr.length > 0){

			getAjax( { uri: site_url+'ajx/user_custom_list_ajx/cl_remove_multi_item', param: {ids:clsArr} }, function( e ){
					
					if(e['result'] == 'OK')
						clsArr = [];
					else
						alert(e['msg']);
						
			});
		
		}
}


// Seen Page
if( exist($('.pageSeen')) ){
	
	if(sessionStorage.viewType == "grid")
    $('.movieListHolder').removeClass("row").addClass(sessionStorage.viewType);
	
	$('.controllers .view a').click(function(){
		var view = $(this).attr("class");
		
		sessionStorage.viewType = view;
		
		$('.movieListHolder').removeClass("row").removeClass("grid").addClass(view);
		
		lazyLoadActive();
		
	});
	
	// infinite-Scroll
	infiniteScroll({ 'uri': 'ajx/movie_ajx/lister/', 'listType': 'us', 'pageSize': 30, 'cstVar': '&usr='+usr });
}

function unseen(obj){

		var id = $(obj).attr("seen-id");

		getAjax( { uri: site_url+'ajx/list_actions_ajx/seen_unseen_movie/unseen', param: {id:id} }, function( e ){
				
				if(e['result'] == 'OK'){
					$(obj).parents('div.movieItem').fadeOut(333, function(){
						$(obj).parents('div.movieItem').remove();
					});
					
				}else
					alert(e['msg']);
					
		});
	
}

function single_seen(obj){

	var action = $(obj).attr("rel"),
				id = (action == 'seen') ? $(obj).parents('.movieItemInner').attr("mvs-id") : $(obj).attr("seen-id");
				
	getAjax( { uri: site_url+'ajx/list_actions_ajx/seen_unseen_movie/'+action, param: {id:id} }, function( e ){
				
				if(e['result'] == 'OK'){
					if(e['action'] == 'seen')
						$(obj).removeAttr("seen-id");
					else{
						$(obj).attr("seen-id", e['seen-id']);
					}
						
					$(obj).attr("rel", e['action']);
					
				}else
					alert(e['msg']);
					
		});

}

// Watchlist Page
if( exist($('.pageWatchlist')) ){
	
	if(sessionStorage.viewType == "grid")
    $('.movieListHolder').removeClass("row").addClass(sessionStorage.viewType);
	
	$('.controllers .view a').click(function(){
		var view = $(this).attr("class");
		
		sessionStorage.viewType = view;
		
		$('.movieListHolder').removeClass("row").removeClass("grid").addClass(view);
		
		lazyLoadActive();
		
	});
	
	// infinite-Scroll
	infiniteScroll({ 'uri': 'ajx/movie_ajx/lister/', 'listType': 'uwl', 'pageSize': 30, 'cstVar': '&usr='+usr });
}


function lazyLoadActive(){
	if( $("div.lazy").length > 0 )
		$("div.lazy").lazyload({ effect: 'fadeIn', load: function(){ $( this ).removeClass('lazy').parents('.movieItem').addClass('loaded'); } });
}

//////////////////// YOUTUBE
function watch_trailer( t ){
	var _this = $( t );
	if( _this.hasClass('yt') ) return false;
		_this.addClass('yt');

	var movieName = cleanText( _this.siblings('.title').text() ),
		year = cleanText( _this.siblings('.year').text() ),
		uri ='https://gdata.youtube.com/feeds/api/videos/?q={{movieName}}+{{year}}+official+trailer&max-results=1&orderby=relevance&format=5&v=2&alt=jsonc&duration=short';
		uri = uri.replace('{{movieName}}', encodeURIComponent( movieName )).replace('{{year}}', encodeURIComponent( year ));
		
	getAjax({ 'uri': uri, 'dataType': 'JSONP' }, 
	function( d ){
		// success
		var ytID = d['data']['items'][0]['id'], hrf = 'https://www.youtube.com/watch?v=' + ytID;
		_this.attr('href', hrf).addClass('yt').nivoLightbox({ auto: true });
	},
	function(){
		// error
		_this.removeClass('yt');
	});	 
}

function cleanText( k ){
	return k.replace(/(^\s+|\s+$)/g,'');
}