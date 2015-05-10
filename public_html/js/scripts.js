// GLOBAL VARIABLE

var /*site_url = $('#site_url').val(),*/ qs = window.location.search, feed_year = 0;

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
			if ( item.result_type != currentCategory ){
				
				ul.append('<li class="ui-autocomplete-category '+ item.result_type +'"><h2>' + item.result_type + '</h2></li>' );
				currentCategory = item.result_type;
			}
			
			li = that._renderItemData( ul, item );
			
			if( item.result_type == 'movie' ){
				li.html('<div class="row"><span class="poster"><a href="/mvs_code/public_html/movie/'+ item.result_slug + '"><div class="posterImg" src=""></div></a></span><span class="title"><a href="/mvs_code/public_html/movie/'+ item.result_slug + '">'+ item.result_title + ' ('+ item.result_year +')</a></span><hr class="qFixer" /></div>');
			}else if( item.result_type == 'star' ){
				li.html('<div class="row"><span class="title"><a href="/mvs_code/public_html/actor/'+ item.result_slug + '">'+ item.result_title +'</a></span><hr class="qFixer" /></div>');
			}else if( item.result_type == 'users' ){
				li.html('<div class="row"><span class="title"><a href="/user/wall/actions/'+ item.usr_nick + '">'+ item.usr_name +'</a></span><hr class="qFixer" /></div>');
			}else if( item.result_type == 'noResult' ){
				li.html('<div class="row">No Result</div>');
			}
			
		});
		
	}
});


//function mergeData( data ){
//	
//	var obj = [], m = data['movies'] , s = data['stars'];
//	
//	if( m.length > 0 ){
//		for( var i = 0; i < m.length; ++i )
//			m[i]['category'] = 'movies';
//		
//		obj = obj.concat( m );	
//	}
//	
//	if( s.length > 0 ){
//		for( var j = 0; j < s.length; ++j )
//			s[j]['category'] = 'stars';	
//		
//		obj = obj.concat( s );	
//	}
//	
//	if( obj.length > 0 ) return obj 
//	else return [{ 'category': 'noResult' }];
//	
//}

if( $('#search_keyword').length > 0 )
	$('#search_keyword').qapturedComplete({
		source: function( request, response ) {
			
			getAjax( { uri: site_url + "ajx/search_ajx/suggest/" + request.term, param: null }, function( d ){
				
				if( d.result == 'OK' )
			  		//response( mergeData( d.data ) );
						response( d.data );
					
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
	
	  var defs = [], vals = [], fg;
  
  function set_slider_vals(obj, min, max){
    $('span.min', obj).text(min);
    $('span.max', obj).text(max);
  }
  
  $('.sliderHolder').each(function(){
    fg = $(this).attr("rel");
    defs[fg] = [];
    defs[fg][0] = parseFloat($('.slider', this).attr("min"));
    defs[fg][1] = parseFloat($('.slider', this).attr("max"));
    
    if(qs.indexOf(fg+'=') != -1){
      vals[fg] = qsManager.get(fg).split(',');
      set_slider_vals(this, vals[fg][0], vals[fg][1]);
    }else{
      vals[fg] = [defs[fg][0],defs[fg][1]];
      set_slider_vals(this, defs[fg][0], defs[fg][1]);
    }
    
    $('.slider', this).slider({max:defs[fg][1], min:defs[fg][0], range:true, values:vals[fg], change:function(event, ui){
      fg = $(this).parents('.sliderHolder').attr("rel");
      
      
      if(ui.values[0] != vals[fg][0] || ui.values[1] != vals[fg][1]){
        if(ui.values[0] == defs[fg][0] && ui.values[1] == defs[fg][1])
          qsManager.remove(fg);
        else
          qsManager.put(fg, ui.values[0]+','+ui.values[1], false);
      }
    },
    slide:function(event, ui){
      var obj = $(this).parents('.sliderHolder');
      set_slider_vals(obj, ui.values[0], ui.values[1]);
    }
    });
  });
	
	$('li.filter.network select').change(function(){
		var fVal = $('option:selected', this).val();
		
		if(fVal != 0)
			qsManager.put('mfn', fVal);
		else
			qsManager.remove('mfn');
		
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
			
			if(e == 'mfn')
				$('li.filter.network select option[value="'+qObj[e][0]+'"]').attr("selected", "setected");
			
		}
	}
	
	$('.clrChoices').click(function(){
		
		window.location.href = current_url;
		
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
	var s = qs != '' ?  '&' + qs.substr( 1, qs.length ) : '';
	infiniteScroll({ controller: 'infiniteScrollController', uri: 'ajx/movie_ajx/lister/{{page}}?type=ml' + s, 'pageSize': 100, 'type': 0 });
}

if( $('.pageSearch').length > 0 && typeof keyword != 'undefined' )
	getAjx({ controller: 'searchController', uri: 'ajx/search_ajx/lister/'+keyword }, function(){});


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


// Infinite
// type => 0 scrolling, type => 1 load more
function infiniteScroll( obj, callback ){
		
		qapturedApp.controller(obj['controller'], function( $scope, Reddit ){ $scope.reddit = new Reddit(); });
		
		qapturedApp.factory('Reddit', function( $http ){
		  
		  var Reddit = function() {
			this.items = [];
			this.busy = false;
			this.btnState = obj['type'] == 1 ? true : false;
			this.loading = false;
			this.after = 1;
		  };
		  
		  Reddit.prototype.nextPage = function(){ 
			
			if( this.loading ) return;
					
			this.loading = true;
			
			var url = site_url + obj['uri'].replace(/{{page}}/g, this.after);

			$http.get( url ).success(function( d ){
		
			  if( d['result'] == 'OK' ){
				
				if( this.after > 1 ) this.items.push( { 'type': 1, 'paging': this.after } );
				
				for(var i = 0; i < d['data'].length; ++i){
					var items = d['data'][ i ];
						items['type'] = 0;
						if( items['mvs_genre'] )	items['mvs_genre'] = items['mvs_genre'].toString();
						if( items['mvs_country'] ) items['mvs_country'] = items['mvs_country'].toString();					
						if( items['mvs_poster'] == null )
							items['mvs_poster'] = 'images/placeHolder.jpg';
						if( items['feed_year'] ){
							if( feed_year != items['feed_year'] ){
								feed_year = items['feed_year'];
								this.items.push({ 'type': 3, 'result': feed_year });
							}
						}
					this.items.push( items );
				}
				
				if( d['data'].length < obj['pageSize'] ){
					this.busy = true;
					this.btnState = false;
				}else{
					this.after++;
					this.busy = false;	
				}
				
				if( obj['type'] == 1 ) this.busy = true;
				
				this.loading = false;

				// TRIGGER LAZYLOAD
				setTimeout(function(){ lazyLoadActive(); }, 1);
				
			  }else{
				this.loading = false;
				this.busy = true;
				this.btnState = false;
				if( this.items.length == 0 )
				    this.items.push( { 'type': 2, 'result': 'No Result' } );
			  }
			  
			  // CALLBACK
			  if( callback != undefined ) setTimeout(callback, 1);
			  
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
		
// Seen Action (Detail & List)
function single_seen(obj){

	var action = $(obj).attr("rel"),
				id = (action == 'seen') ? $(obj).parents('*[mvs-id]').attr("mvs-id") : $(obj).attr("seen-id");
				
	getAjax( { uri: site_url+'ajx/movie_actions_ajx/seen_unseen_movie/'+action, param: {id:id} }, function( e ){
				
				if(e['result'] == 'OK'){
					if(e['action'] == 'seen')
						$(obj).removeAttr("seen-id");
					else{
						$(obj).attr("seen-id", e['seen-id']);
						$('a[rel="rwtc"]').attr("rel", "awtc").removeAttr("wtc-id");	
					}
						
					$(obj).attr("rel", e['action']);
					
				}else
					alert(e['msg']);
					
		});

}

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

$('a.btnMultiSeen').click(function(){
		
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

// Movie Detail Watchlist
function add_remove_wtc(obj){
		var action = $(obj).attr("rel"),
				id = (action == 'awtc') ? mvs_id : $(obj).attr("wtc-id");
			
		getAjax( { uri: site_url+'ajx/movie_actions_ajx/add_remove_watchlist/'+action, param: {id:id} }, function( e ){
				
				if(e['result'] == 'OK'){
					if(e['action'] == 'awtc')
						$(obj).removeAttr("wtc-id");
					else{
						$(obj).attr("wtc-id", e['wtc-id']);
						$('a[rel="unseen"]').attr("rel", "seen").removeAttr("seen-id");
					}
						
					$(obj).attr("rel", e['action']);
					
				}else
					alert(e['msg']);
					
		});
}

// Movie Detail Custom List
$('.cnl > a').click(function(){
	$('.listCreate').toggleClass("none");
	$('.listCreate input').val('');	
});

if($('.cLists ul li').length > 0)
	$('.cLists.none').removeClass('none');

// Movie Detail Create New Custom List
$('.listCreate a').click(function(){
		var title = $(this).siblings('input').val();
		
		if(title.length > 255)
			title = title.substring(0, 254);
	
		getAjax( { uri: site_url+'ajx/user_customlist_ajx/create_new_list/', param: {id:mvs_id,title:title} }, function( e ){
				
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
		
		getAjax( { uri: site_url+'ajx/user_customlist_ajx/add_remove_from_list/'+action, param: {id: id, mvs: mvs_id} }, function( e ){
				
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
	getAjx({ controller: 'userCustomList', uri: 'ajx/user_customlist_ajx/list_lister?usr='+usr }, function(){});
		
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
	infiniteScroll({ controller: 'infiniteScrollController', uri: 'ajx/movie_ajx/lister/{{page}}?type=ucl&list='+list_id, 'pageSize': 100, 'type': 0 }, function(){
		if( $('.pageCustomListDetail').hasClass('edit') ){
			checkSortable('destroy');
			checkSortable('add');
		}
	});
}

function deleteCustomList(obj){
	
	var list = $(obj).attr("list-id");
			
		getAjax( { uri: site_url+'ajx/user_customlist_ajx/delete_custom_list/', param: {list:list} }, function( e ){
				
				if(e['result'] == 'OK'){
					
					$(obj).parents('.listItem').fadeOut(333, function(){
						$(obj).parents('.listItem').remove();
					});
					
				}else
					alert(e['msg']);
					
		});
	
}

// SORTABLE
function checkSortable( k ){
	var el = $( ".movieListHolder" );
	if( el.length > 0 )
		if( k == 'add' ){
			if( el.hasClass('ui-sortable') ) el.sortable( 'destroy' );
			el.sortable({ items: '.movieItem' });
		}else{
			el.sortable( 'destroy' );
		}
}
function searchList(){
	var arr = [];
	$("[ldt-id]").each(function( i, k ) {
    	arr[ i ] =  $(this).attr('ldt-id');
    });
	return arr;
}

// Custom List Detail Remove from Custom List
var clsArr = [];

function removeFromList(obj){
	
	var id = $(obj).attr("ldt-id");
		
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
		checkSortable('destroy');
	}else{
		$('.pageDefault').addClass('edit');
		$('.titleCustomList input').focus();
		checkSortable('add');
	}
});


function edit_custom_list(){
	var title = $('input.listTitle').val(), postParams = {title:title}, ids = searchList();
		
		if(ids.length > 0)
			postParams.order = ids.toString();;
			
		if(clsArr.length > 0)
			postParams.del = clsArr.toString();
		
		getAjax( { uri: site_url+'ajx/user_customlist_ajx/edit_list_detail/'+list_id, param:postParams }, function( e ){
				
				if(e['result'] == 'OK')
						clsArr = [];
					else
						alert(e['msg']);
					
		});
		
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
	//--> infiniteScroll({ 'uri': 'ajx/movie_ajx/lister/', 'listType': 'us', 'pageSize': 30, 'cstVar': '&usr='+usr, 'type': 0 });
	infiniteScroll({ controller: 'infiniteScrollController', uri: 'ajx/movie_ajx/lister/{{page}}?type=us&usr='+usr, 'pageSize': 30, 'type': 0 });
}

// Seen Page Unseen
function unseen(obj){

		var id = $(obj).attr("seen-id");

		getAjax( { uri: site_url+'ajx/movie_actions_ajx/seen_unseen_movie/unseen', param: {id:id} }, function( e ){
				
				if(e['result'] == 'OK'){
					$(obj).parents('div.movieItem').fadeOut(333, function(){
						$(obj).parents('div.movieItem').remove();
					});
					
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
	//-- infiniteScroll({ 'uri': 'ajx/movie_ajx/lister/', 'listType': 'uwl', 'pageSize': 30, 'cstVar': '&usr='+usr, 'type': 0 });
	infiniteScroll({ controller: 'infiniteScrollController', uri: 'ajx/movie_ajx/lister/{{page}}?type=uwl&usr='+usr, 'pageSize': 30, 'type': 0 });
}

// Follow Unfollow
function follow_unfollow(obj){

	var action = $(obj).attr("rel"),
				id = (action == 'follow') ? $(obj).attr("usr-id") : $(obj).attr("flw-id");
				
	getAjax( { uri: site_url+'ajx/follow_actions_ajx/follow_unfollow_user/'+action, param: {id:id} }, function( e ){
				
				if(e['result'] == 'OK'){
					if(e['action'] == 'follow')
						$(obj).removeAttr("flw-id");
					else{
						$(obj).attr("flw-id", e['flw-id']);
					}
						
					$(obj).attr("rel", e['action']);
					
				}else
					alert(e['msg']);
					
		});

}

// Profile Page Check User Nick
var stm = null, minLength = 4;
if( $('#prf_nick').length > 0 )
	$('#prf_nick')
	.bind('keyup', function(){
		var _this = $( this ), val = _this.val();
		_this.val( string_to_slug( val ) );
		if( _this.val().length >= minLength ){
			clearTm();
			stm = setTimeout(function(){ checkNick( _this ); }, 333);
		}else{
			 clearTm();
			 $('#prf_nick').parent('li').removeClass('loading').addClass('unavailable');
		}
	});
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
// Followers
if( exist($('.pageNetwork')) ){
	var action = $('.pageNetwork').attr('rel'), page = 1;
	
	getAjx({ controller: 'userNetwork', uri: 'ajx/user_ajx/get_ff_list/'+page+'?act='+action+'&nick='+nick }, function(){
		
		setTimeout(lazyLoadActive, 1);
	
	});
}

function lazyLoadActive(){
	if( $(".lazy").length > 0 )
		$(".lazy").lazyload({ effect: 'fadeIn', load: function(){ $( this ).removeClass('lazy').parents('.movieItem').addClass('loaded'); } });
}

function rateButton( t ){
	var _this = $( t ), type = _this.hasClass('rateUp') ? 'up' : 'down', prts, id, uri;
	
	if( _this.hasClass('active') ){		
		
		if( _this.parents('[act-id]').length > 0 ){
			prts = _this.parents('[act-id]');
			id = prts.attr('act-id');
			uri = 'ajx/feed_ajx/rate_review/' + id + '?val=' + ( type == 'up' ? 1 : -1 );
		}else{
			prts = _this.parents('[list-id]');
			id = prts.attr('list-id');
			uri = 'ajx/user_customlist_ajx/rate_customlist/' + id + '?val=' + ( type == 'up' ? 1 : -1 );
		}
		
		getAjax({ 'uri': site_url + uri }, function( e ){

			if (e['result'] == 'OK') {
				
				var i, rateUp = type == 'up' ? _this : _this.siblings('a') , rateDown = type == 'down' ? _this : _this.siblings('a'), obj = { 'down': rateDown.hasClass('active') ? 1 : 0, 'up': rateUp.hasClass('active') ? 1 : 0 };

				if( type == 'up' ){
					i = parseFloat( $('small', rateUp).text() ) + 1;
					$('small', rateUp).html( i );
					rateUp.removeClass('active');
					if( obj['down'] == 0 ){ 
						rateDown.addClass('active');
						i = parseFloat( $('small', rateDown).text() ) - 1;
						$('small', rateDown).html( i );
					}
				}else{
					i = parseFloat( $('small', rateDown).text() ) + 1;
					$('small', rateDown).html( i );
					rateDown.removeClass('active');
					if( obj['up'] == 0 ){ 
						rateUp.addClass('active');
						i = parseFloat( $('small', rateUp).text() ) - 1;
						$('small', rateUp).html( i );
					}
				}
			
			}

		});
		
	}
}


// Wall
if( exist($('.pageWall')) ){
	var page = 1;
	infiniteScroll({ controller: 'userWall', uri: 'ajx/feed_ajx/wall/{{page}}?&nick='+nick, 'pageSize': 5, 'type': 0 });
}

// Feeds
if( exist($('.pageFeeds')) ){
	var page = 1;
	infiniteScroll({ controller: 'userFeeds', uri: 'ajx/feed_ajx/feeds/{{page}}', 'pageSize': 5, 'type': 0 });
}



// YOUTUBE TRAILER
function watch_trailer( t ){
	var _this = $( t );
	if( _this.hasClass('yt') ) return false;
		_this.addClass('yt');

	var movieName = cleanText( $('h1').attr('title') ),
 		year = cleanText( $('h1 small').text() ),
		uri= 'https://www.googleapis.com/youtube/v3/search?part=snippet&q={{movieName}}+{{year}}+official+trailer&type=video&key=AIzaSyBeMIeBXRtdxvziJl7KPd-enpbLoNjl7YE&maxResults=1&videoDuration=short'
		//uri ='https://gdata.youtube.com/feeds/api/videos/?q={{movieName}}+{{year}}+official+trailer&max-results=1&orderby=relevance&format=5&v=2&alt=jsonc&duration=short';
		uri = uri.replace('{{movieName}}', encodeURIComponent( movieName )).replace('{{year}}', encodeURIComponent( year ));
		
	getAjax({ 'uri': uri, 'dataType': 'JSONP' }, 
	function( d ){ 
		// success

		var ytID = d['items'][0]['id']['videoId'], hrf = 'https://www.youtube.com/watch?v=' + ytID;		
		_this
		.attr('href', hrf)
		.addClass('yt')
		.nivoLightbox({ auto: true,  
						afterShowLightbox: function(){
							var src = $('.nivo-lightbox-content > iframe').attr('src');
							$('.nivo-lightbox-content > iframe').attr('src', src + '?autoplay=1&rel=0&showinfo=0');
    					} 
		});
	},
	function(){
		// error
		_this.removeClass('yt');
	});	 
}


function select_movie(m){
	
	var _this = $(m).parents('[mvs-id]'), mvs = _this.attr('mvs-id');
	
	console.log(mvs);
	
}

// Movie Detail Seen In User's Network
if( exist($('.pageMovie')) )
	getAjx({ controller: 'mdUserNetworkSeen', uri: 'ajx/movie_actions_ajx/myn_seen_users/'+mvs_id }, function(){});
	

// Movie Detail Related Custom Lists
if( exist($('.pageMovie')) )
	getAjx({ controller: 'mdUserCustomlists', uri: 'ajx/movie_actions_ajx/movie_customlists/'+mvs_id }, function(){ setTimeout(lazyLoadActive, 1); });
	

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


function cleanText( k ){
	return k.replace(/(^\s+|\s+$)/g,'');
}


// COMMENT ACTIONS
if( typeof commentPage !== 'undefined' ){

	var cmtText, comm, commId, commType, spl;
	
	if( page === 'cld' ){
		// Custom List Feeds
		commType = 4;
		commId = list_id;	
		getAjx({ controller: 'commentRepeaterController', uri: 'ajx/comments_ajx/custom_list?type=nwf&list_id='+commId }, function(){
			setTimeout(lazyLoadActive, 1);	
		});
	}else if( page === 'movie-detail' ){
		// Movie Detail Feeds
		commType = 2;
		commId = mvs_id;			
		getAjx({ controller: 'commentRepeaterController', uri: 'ajx/comments_ajx/movie?type=nwf&mvs_id='+commId }, function(){
			setTimeout(lazyLoadActive, 1);	
		});
	}
			
	$('a.btnComment').click(function(){
			cmtText = $('#comment_text').val(),
			spl = ($('#comment_spl').is(":checked")) ? 1 : 0;
			
			if(cmtText != '')
				add_comment(0, cmtText, spl, commType, commId);
	});

}

	function add_comment(ref_id, text, spl, type, id){
		
		var postObj;
		
		if(ref_id == 0){
			holder = 'comment';
			postObj = {id:id, type:type, text:text, spl:spl};
		}else{
			holder = 'reply';
			postObj = {ref:ref_id, text:text, spl:spl};
		}

		$.ajax({
			type:'POST',
			url:site_url+'ajx/comments_ajx/add_comment',
			data:postObj,
			success:function(result){
				$('.'+holder+'_result').text(result.data['message']);
				$('#'+holder+'_text').val('');
				$('[act-id]').removeClass('editing reply');
			}
		});
		
	}

	function moveReplyFrom(obj){
			comm = $(obj).parents('*[act-id]');
			var ref = comm.attr("act-id");
	
			$('[act-id]').removeClass('editing reply');
			comm.addClass('reply');
			
			$("#replyForm").appendTo(comm);
			
			$('a.btnReply').unbind('click').click(function(){
				cmtText = $('#reply_text').val(),
				spl = ($('#reply_spl').is(":checked")) ? 1 : 0;
				
				if(cmtText != '')
					add_comment(ref, cmtText, spl);
		});
			
	}
	
	//function showMore(obj){
	//	
	//	comm = $(obj).parents('.commentItem');
	//	var rep = $(obj).siblings('.commentReplies').children('.subComment').length;
	//	
	//	if(rep > 0){
	//
	//		if(!comm.hasClass("more")){
	//			comm.addClass("more");
	//		}else{
	//			comm.removeClass("more");
	//		}
	//		setTimeout(lazyLoadActive, 1);	
	//	}
	//}
	
	// Actor Detail
	$('.tabFilmography a').click(function(){
		var item = $(this).attr("rel");
		
		if(!$(this).parent('li').hasClass("selected")){
			$('.tabContent li').hide();
			$('.tabContent li.'+item).show();
			$('.tabFilmography a').parent('li.selected').removeClass("selected");
			$(this).parent('li').addClass("selected");
		}
	});
	
////////////////////////////////////////////////////////////////////////////////////////////////////// SHOW REPLIES
function ShowReplies( t ){
	var _this = $( t ), prts = _this.parents('[act-id]');
	if( prts.length > 0 ){
		getAjax( { uri: site_url+'ajx/feed_ajx/get_more_replies/'+prts.attr('act-id') }, function( e ){	
			var sib = _this.siblings('.refs');
			if( sib.length > 0 ){
				sib.html( e );
				prts.addClass('showReplies');
				setTimeout(lazyLoadActive, 1);
			}
		});
	}
}	

// EDIT REVIEW
function editReview( _t ){
	var _this = $( _t ), prts = _this.parents('[act-id]:eq(0)');

	if( prts.length > 0 ){
		$('[act-id]').removeClass('editing reply');
		prts.addClass('editing');
		var c = $('> .feedContent .textContent', prts);
		$("#replyForm").appendTo( c );
		$('#reply_text').val( $('.text', c).text() );
		$('a.btnReply').unbind('click').bind('click', function(){
			var val = $('#reply_text').val(), spl = ($('#reply_spl').is(":checked")) ? 1 : 0;
			
			getAjax( { uri: site_url+'ajx/comments_ajx/edit_comment/' + prts.attr('act-id'), param: { text: val, spl: spl } }, function(){
				$('[act-id]').removeClass('editing reply');
			});
			
			$('.text', c).text( $('#reply_text').val() );
			$('#reply_text').val('');
			$('#reply_spl').removeAttr('checked');
			
		});
	}
}

// DELETE REVIEW
function deleteReview( _t ){
	var _this = $( _t ), prts = _this.parents('[act-id]:eq(0)');
	
	if( prts.length > 0 ){
		
		getAjax( { uri: site_url+'ajx/comments_ajx/delete_comment/' + prts.attr('act-id')}, function(e){
			
			if(e['result'] == 'OK'){
				prts.fadeOut(333, function(){
					prts.remove();
				});
			}else{
				alert(e['data']['message']);
			}

		});
		
	}
	
}


// READ MORE
function readMore( _t ){
	
	var _this = $( _t ), prts = _this.parents('div.text:eq(0)');
	
	prts.toggleClass('more');
	
}


function confirmation( _t ){
	var _this = $( _t ), type = _this.attr('type');
	$( ".msgboxDelConfirm" ).addClass(type).dialog({
      resizable: false,
      height:140,
      modal: true,
      buttons: {
        "Yes": function() {
        
				  $( this ).removeClass(type).dialog( "close" );
					
					if( type == 'rev' )
						deleteReview( _this );
					else if( type == 'cl' )
						deleteCustomList( _this );
        
				},
        "No": function() {
        
				  $( this ).removeClass(type).dialog( "close" );
        
				}
      }
    });
}

// REVEALING A SPOILER
function showSpoiler( _t ){
	var _this = $( _t ), prts = _this.parents('div.spl:eq(0)');
	
	prts.removeClass('spl');
}

