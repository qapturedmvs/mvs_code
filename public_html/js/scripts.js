// GLOBAL VARIABLE
var site_url = $('#mvs_site_url').val(), qs = window.location.search;

// GLOBAL ANGULAR MODULE
var qapturedApp = angular.module('qapturedApp', ['infinite-scroll']);
	qapturedApp.config(['$httpProvider', function( $httpProvider ){ $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest'; }]);
	
// AUTOCOMPLETE
if( $('#search_keyword').length > 0 )
	$('#search_keyword').autocomplete({
		  source: function( request, response ) {
			$.ajax({
			  url: "ajx/search_ajx/lister/" + request.term,
			  success: function( d ) {
				if( d.data.movies )
					response( d.data.movies );
			  }
			});
		  },
		  minLength: 3,
		  open: function(event, ui) {
			//$('ul.ui-autocomplete').append('<li class="ui-menu-item tumunuGoster"><a href="javascript:void(0);">Tümünü Göster</a></li>');
		   },
		    focus: function(event, ui) {
				event.preventDefault();
			},
			select: function(event, ui) {
			   event.preventDefault();
				//window.open('/mvs_code/public_html/movie/' + ui.item.mvs_slug);
			}

		}).data('ui-autocomplete')._renderItem = function( ul, item ){
			return $('<li></li>').data('item.autocomplete', item).append('<div class="row"><span class="poster"><a href="/mvs_code/public_html/movie/'+ item.mvs_slug + '"><div class="posterImg" src=""></div></a></span><span class="title"><a href="/mvs_code/public_html/movie/'+ item.mvs_slug + '">'+ item.mvs_title + ' ('+ item.mvs_year +')</a></span><hr class="qFixer" /></div>').appendTo( ul );
			};



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
	
	//-->getAjx({ controller: 'infiniteScrollController', uri: 'ajx/movie_ajx/lister/' });
}


function getAjx( obj ){
	var url = site_url + obj['uri']
	qapturedApp.controller(obj['controller'], function( $scope,  $http ){ 
		$http.get( url ).success(function( d ){
			$scope.items = d['data'];
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

