/////////////////////////////////////////////////////////////////////////////////////////////////////// GLOBAL VARIABLE
var win = $( window ), doc = $( document ), bdy = $('body'), wt,  ht, wst, sRatio = 0, qs = window.location.search, feed_year = 0, qapturedApp, controllers = {};


/////////////////////////////////////////////////////////////////////////////////////////////////////// ANGULAR INIT
qapturedApp = angular.module('qapturedApp', ['infinite-scroll', 'brantwills.paging']);
qapturedApp.config(['$httpProvider', function( $httpProvider ){ $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest'; }]);
qapturedApp.filter('unsafe', function( $sce ){ return function( val ){ return $sce.trustAsHtml( val ); };});


/////////////////////////////////////////////////////////////////////////////////////////////////////// AUTOCOMPLETE

$.widget('custom.qptComplete', $.ui.autocomplete, {
	
	_create: function() {
		this._super();
		this.widget().menu( 'option', 'items', '> :not(.ui-autocomplete-category)' );
	},
	
	_renderMenu: function( ul, items ){	
		var that = this, currentCategory = '';
			
		$.each( items, function( index, item ){
			var li;
			
			if ( item._type != currentCategory ){
				ul.append('<li class="ui-autocomplete-category '+ item._type +'"><h2>' + item._type + '</h2></li>' );
				currentCategory = item._type;
			}
			
			li = that._renderItemData( ul, item );
			
			if( item._type == 'movie' ){
				item['_source'].mvs_poster = (item['_source'].mvs_poster == 1) ? site_url+'data/movies/thumbs/'+item['_source'].mvs_slug+'_150X222_.jpg' : site_url+'images/noPoster.jpg';
				li.html('<div class="row row-movie"><a class="qFixer" href="/movie/'+ item['_source'].mvs_slug + '"><figure class="posterImg rowLeft left" style="background-image:url('+ item['_source'].mvs_poster +');"></figure><div class="rowRight left"><span class="title">'+ item['_source'].mvs_title + ' ('+ item['_source'].mvs_year +')</span><small>'+ item['_source'].stars +'</small></div></a></div>');
			}else if( item._type == 'star' ){
				item['_source'].str_poster = (item['_source'].str_poster == 1) ? site_url+'data/stars/'+item['_source'].str_slug+'.jpg' : site_url+'images/noAvatar.jpg'
				li.html('<div class="row row-star qFixer"><a href="/actor/'+ item['_source'].str_slug + '"><figure class="rowLeft left" style="background-image:url('+ item['_source'].str_poster +');"></figure><div class="rowRight left"><span class="title">'+ item['_source'].str_name +'</span></div></a></div>');
			}else if( item._type == 'user' )
				li.html('<div class="row row-user"><a class="qFixer" href="/user/wall/actions/'+ item.usr_nick + '"><figure class="rowLeft left" style="background-image:url('+ site_url + item.usr_avatar +');"></figure><div class="rowRight left"><span class="title">'+ item.usr_name +'</span></div></a></div>');
				
			else if( item._type == 'starCompare' ){
				item.result_poster = (item.result_poster == 1) ? site_url+'data/stars/'+item.result_slug+'.jpg' : site_url+'images/noAvatar.jpg'
				li.html('<div class="row row-star row-comp"><button class="qFixer" onclick="paperscript.getData(\''+ item.result_slug + '\', false);"><figure class="rowLeft left" style="background-image:url('+ item.result_poster +');"></figure><div class="rowRight left"><span class="title">'+ item.result_title +'</span></div></button></div>');
			}else if( item.result_type == 'location' )
				li.html('<div class="row row-city"><a><span class="title">'+ item.city_name + ', <b>' + item.cnt_name +'</b></span></a></div>');
				
			else if( item.result_type == 'noResult' )
				li.html('<div class="row">No Result</div>');
			
		});
		
	}
});

var suggestDelay = 800;

if( detectEl( $('#search_keyword') ) )
	$('#search_keyword').qptComplete({
		source: function( request, response ){
			getAjax({ uri: site_url + "ajx/search_ajx/suggest?t=all&q=" + request.term, param: null }, function( d ){
				if( d.result == 'OK' )
				{
					console.log(d);
					response( d.data );
				}
					
		    });
		},
		minLength: 2,
		appendTo:'.mainSearchHolder .suggestions',
		delay:suggestDelay
	});

	

if( detectEl( $('#user_keyword') ) )
	$('#user_keyword').qptComplete({
		source: function( request, response ){
			getAjax({ uri: site_url + "ajx/search_ajx/get_users?q=" + request.term, param: null }, function( d ){
				if( d.result == 'OK' )
			  		response( d.data );	
		    });
		},
		minLength: 2,
		appendTo:'.userSearchHolder .suggestions',
		delay:suggestDelay
	});



// STAR DETAIL COMPARE SUGGEST
if( detectEl( $('#star_keyword') ) ){
	$('#star_keyword').qptComplete({
		source: function( request, response ){
			getAjax({ uri: site_url + "ajx/search_ajx/suggest?t=star&ref="+str_id+"&q=" + request.term, param: null }, function( d ){
				if( d.result == 'OK' ){
        var data = d.data;
        
          $.each(data, function(i, k){
            k['result_type'] = 'starCompare';  
          });

          response( data );
        
        }
		    });
		},
		minLength: 2,
		appendTo:'.starCompare .suggestions',
		delay:suggestDelay
	});
	
}

// USER LOCATION SUGGEST
if( detectEl( $('#prf_location') ) )
	$('#prf_location').qptComplete({
		source: function( request, response ){
			getAjax({ uri: site_url + "ajx/search_ajx/get_cities?q=" + request.term, param: null }, function( d ){
				if( d.result == 'OK' ){
          			$.each(d.data, function( i, k ){
						k['_type'] = 'City';
					});
					response( d.data );
		  
				}
        
		    });
		},
		minLength: 4,
		appendTo:'.userLoc .suggestions',
		delay:suggestDelay,
		select: function(event, ui){
			$('#city_id').val(ui.item['city_id']);
			$('#prf_location').val(ui.item['city_name']+', '+ui.item['cnt_name']);
			return false;
		},
		focus: function( event, ui ) {
			$('#city_id').val(ui.item['city_id']);
			$( "#prf_location" ).val(ui.item['city_name']+', '+ui.item['cnt_name']);
			return false;
		}
		
	});


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// FILTER
	 
///////////////////////////////////////////// SLIDER
var slider = {
	el: '.rating .slider, .year .slider',
	control:  function( k ){
		var o = null;
		if( qs.indexOf( k['rel'] + '=' ) != -1 ){
			var d = qsManager.get( k['rel'] ).split(','), _min = d[ 0 ] || k['min'], _max = d[ 1 ]  || k['max'];
			if( _min < k['min'] && _min > k['max'] ) _min = k['min'];
			if( _max < k['min'] && _max > k['max'] ) _max = k['max'];
			o = { min: _min, max: _max };
		}
		return o;
	},
	getValue: function(){
		var _t = this, el = $( _t.el ), o = {};
		if( el.length > 0 ){
			el.each(function( i, k ){
				var _this = $( this ), rel = _this.attr('rel'), defMin = _this.attr('min'), defMax = _this.attr('max'), _min = Math.round( _this.rangeSlider('min') ), _max = Math.round( _this.rangeSlider('max') );
				
				if( _min == defMin && _max == defMax ) return; 
				else
					o[ rel ] = [ _min, _max ];
			});
		}else
			o = null;
		
		return o;	
	},
	Refresh: function(){
		var _t = this, el = $( _t.el );
		if( el.length > 0 )
			el.each(function( i, k ){
				$( this ).rangeSlider('resize');
			});
	},
	init: function(){		
		var _t = this, el = $( _t.el );
		if( el.length > 0 ){
			el.each(function(i, k) {
				var _this = $( this ), _min = parseFloat( _this.attr('min') ), _max = parseFloat( _this.attr('max') ), defMin = _min, defMax = _max, rel = _this.attr('rel'), d = _t.control( { min: _min, max: _max, rel: rel } );
				if( d != null ){
					defMin = d['min'];
					defMax = d['max'];
				}		
				_this
				.rangeSlider({ bounds:{ min: _min, max: _max }, defaultValues:{ min: defMin, max: defMax, step: 1 } });
			});
		}
	}
};

slider.init();

///////////////////////////////////////////// TAG MANAGER
/* https://github.com/aehlke/tag-it */
var tagManager = {
	el: 'input#country_suggest',
	filterType: 'mfc',
	data: null,
	tags: function(){
		var _t = this, data = _t.data, arr = [];
		$.each(data, function( i, k ){
			arr.push( k );
		});
		return arr;
		
	},
	detect: function(){
		 var _t = this, data = _t.data, el = $( _t.el ), f = qsManager.get( _t.filterType ).split(','), arr = [];
		 if( el.length > 0 ){
				for( var i = 0; i < f.length; ++i ){
					var k = f[ i ], d = data[ k ];
					if( d ) arr.push( d );
				}
			if( arr.length > 0 )
				el.val( arr.toString() );		
		 }  
	},
	control: function( n ){
		var _t = this, data = _t.data, b = true;
		$.each(data, function( i, k ){
			if( k == n ) b = false;
		});
		return b;
	},
	getKeys: function( n ){
		var _t = this, data = _t.data, el = $( _t.el );
		if( el.length > 0 ){
			var a = [];
			$.each(data, function( i, k ){ 
				if( n.indexOf( k ) != -1 ) a.push( i );
			});
			return a;		
		}
	},
	getValue: function(){
		var _t = this, el = $( _t.el );
		if( el.length > 0 ){
			var a = _t.getKeys( el.tagit("assignedTags") ), o = {};
				if( a.length > 0 )
					o[ _t.filterType ] = a;
				else
					o = null;	
			return o;
		}
	},
	init: function(){
		var _t = this, el = $( _t.el );
		if( el.length > 0 ){
			if( typeof cntryData != undefined )
			_t.data = cntryData;
			_t.detect();
			el.tagit({
				availableTags:  _t.tags(),
				autocomplete: {appendTo:'.filter.country .suggestions'},
				beforeTagAdded: function( event, ui ){
					if( _t.control( ui.tagLabel ) ){
						$('.country-tag').val('');
						return false;
					}
				}
			})
			.data("ui-tagit")
			.tagInput
			.addClass("country-tag");
		}
	}
};

tagManager.init();

///////////////////////////////////////////// MULTIPLE
var multipleSelect = {
	el: '.genre .multi li button',
	filterType: 'mfg',
	control: function(){
		var _t = this, el = $( _t.el ), f = qsManager.get( _t.filterType ).split(',');
		for( var i = 0; i < f.length; ++i ){
			var k = f[ i ];
			$( _t.el + '[rel="'+ k +'"]' ).addClass('selected');
		}
	},
	getValue: function(){
		var _t = this, el = $( _t.el + '.selected' ), o = {};
		if( el.length > 0 ){
			var a = [];
			$.each(el, function( i, k ){ 
				a.push( $( this ).attr('rel') );
			});
			o[ _t.filterType ] = a;
		}else
			o = null;
		
		return o;
	},
	init: function(){
		var _t = this, el = $( _t.el );
		if( el.length > 0 ){
			_t.control();
			el.bind('click', function(){
				$( this ).toggleClass('selected');
			});
		} 
	}
};

multipleSelect.init();

///////////////////////////////////////////// APPLY FILTER
var applyFilter = {
	el: '.btnApplyFilter',
	init: function(){
		var _t = this, el = $( _t.el ), arr = [tagManager, multipleSelect, slider];
		if( el.length > 0 ){
			el.bind('click', function(){
				var uri = '', counter = 0, le = arr.length;					
				for( var i = 0; i < le; ++i){
					var a = arr[ i ].getValue();
					if( a != null && a != undefined ){
						$.each(a, function( j, k ){
							uri += ( counter == 0 ? '?' : '&' );
							uri += ( j + '=' + k.toString() );
							counter++;
						});
					}
				}

				if( uri == '' ) 
					window.location.href = window.location.pathname
				else
					window.location.href = uri;
				
			});
		}
	}
};

applyFilter.init();

///////////////////////////////////////////// FILTER BTN

var filterBtn = {
	btn: '.lnkFilters',
	closeBtn: '.vail.vailFilter, .lnkFilterClose',
	destroy: function(){
		bdy.removeClass('filterMenuReady filterMenuOpened');
	},
	opened: function(){
		cssClass({ 'ID': 'body', 'delay': 100, 'type': 'add', 'cls':['filterMenuReady', 'filterMenuOpened'] });
		filters.adjust();
		slider.Refresh();
	},
	closed: function(){
		cssClass({ 'ID': 'body', 'delay': 444, 'type': 'remove', 'cls':['filterMenuOpened', 'filterMenuReady'] });
	},
	init: function(){
		var _t = this, btn = $( _t.btn ), closeBtn = $( _t.closeBtn );
		if( detectEl( btn ) ){
			btn.unbind('click').bind('click', function(){
				if( bdy.hasClass('filterMenuReady') )
					_t.closed();
				else
					_t.opened();	
			});
		}
		
		if( detectEl( closeBtn ) ){
			closeBtn.unbind('click').bind('click', function(){
				_t.closed();
			});
		}
	}
};

filterBtn.init();


///////////////////////////////////////////// HERO BACKGROUND MOTION

scr_val = null;

function animateHeroBackground(){
	
	if( scr_val != null && $(window).scrollTop() > scr_val && $(window).scrollTop() > 65 )
	{
		$("#qHeader").attr("class", "fixed");
	}
	else
	{
		$("#qHeader").removeClass("fixed");
	}
	scr_val = $(window).scrollTop();
	
	
	if( detectEl( $(".qHero") ) )
	{
		var _this = $(".qHero"), scrt = $(window).scrollTop();
		
		if( scrt < _this.height() + _this.position().top )
		{
			var scrl_pct = scrt / ( _this.height() + _this.position().top );
			
			$(".qHero").css("background-position", "50% -"+ (0 + _this.height() * scrl_pct * .3) +"px");
		}
	}
}


///////////////////////////////////////////// FILTER

var filters = {
	wrp: '.filterbox',
	el: '.filterbox .boxBody',
	scroller: null,
	padding: 240,
	scrVal: 0,
	maxVal: 65,
	Refresh: function(){
		var _t = this, s = _t.scroller;
		if( s != null )
			setTimeout(function(){ s.refresh(); }, 0);
	},
	init: function(){
		if( !isMobile ){
			var _t = this, el = $( _t.el );
			if( detectEl( el ) )
				_t.scroller = new IScroll( el[ 0 ], { scrollbars: true, mouseWheel: true, interactiveScrollbars: true, shrinkScrollbars: 'clip', preventDefault: false });		
		}
	},
	onResize: function(){
		var _t = this, el = $( _t.el ), wrp = $( _t.wrp );
		if( detectEl( el ) ){ 
			el.height( ht - ( _t.padding - _t.scrVal ) );
			wrp.css({ 'padding-top': _t.maxVal - _t.scrVal });
			_t.Refresh();
		}
	},
	onScroll: function(){
		var _t = this;
			_t.scrVal = wst >= _t.maxVal ? _t.maxVal : wst;
			_t.onResize();
			
			animateHeroBackground();
				
	},
	adjust: function(){
		var _t = this;
			_t.onResize();
	}
};

filters.init();

/////////////////////////////////////////////////////////////////////////////////////////////////////// PAGING

var paging = {
	controller: 'pagingController',
	targetController: 'movRpt',
	targetEl: '.movieListHolder',
	uri: 'ajx/movie_ajx/lister/{{page}}?type=ml',
	getUrl: function( page ){
		var _t = this, uri = _t.uri, s = qs != '' ?  '&' + qs.substr( 1, qs.length ) : '';	
		return site_url + uri.replace(/{{page}}/g, page) + s;
	},
	data: function( d ){
		for( var i = 0; i < d.length; ++i )
			d[ i ]['type'] = 0;
		return d;	
	},
	plugin: function(){
		var _t = this, targetEl = $( _t.targetEl );
		if( detectEl( targetEl ) ){
			setTimeout(function(){
				pageScroll( 0, function(){
						lazyLoad( targetEl );
				});
				var e = $('.movieActions');
				if( detectEl ( e ) )
					e.each(function(){
                    	var ths = $( this );
							ths.qptDropDown( { type: 'click', customClass: 'opened', clicked: '.btnAddToList', parents: '.movieItem' } );    
                    });
				
				bulkAction.init();
					
			}, 10);
		}
	},
	loading: function( type ){
		var _t = this, targetEl = $( _t.targetEl );
		if( type == 'add' ) targetEl.addClass('ajxLoading');
		else targetEl.removeClass('ajxLoading');
	},
	set: function( o ){
		var _t = this;
			_t.targetController = o['controller'];
			_t.targetEl = o['element'];
			_t.uri = o['uri'];
			_t.init();
	},
	init: function(){
		var _t = this;
		qapturedApp.controller(_t.targetController, function( $scope, $http ){
			$scope.request = function( page ){
				_t.loading('add');
				$http.get( _t.getUrl( page ) ).success(function( d ){
					if( d['result'] == 'OK' ){
						$scope.items = _t.data( d['data'] );
						_t.plugin();
						_t.loading('remove');
					}
				});
			}
		});
		qapturedApp.controller(_t.controller, function( $scope ){
			$scope.pagingClick = function(page, pageSize, total){
			   $scope.$parent.request( page );
			};
			$scope.$parent.request( 1 );
		});
	}
};

/////////////////////////////////////////////////////////////////////////////////////////////////////// TAB PANEL
var tabPanel = {
	el: null,
	controller: null,
	uri: null,
	set: function( o ){
		var _t = this;
			_t.el = o['element'];
			_t.controller = o['controller'];
			_t.uri = o['uri'];
			_t.init();
	},
	plugin: function(){
		var _t = this, el = $( _t.el );
		if( detectEl( el ) )
			setTimeout(function(){
				lazyLoad( el );
			}, 1);
	},
	loading: function( k ){
		var _t = this, el = $( _t.el );
		if( k == 'add' ) el.addClass('ajxLoading');
		else el.removeClass('ajxLoading');
	},
	btnSelected: function( e ){
		var prt = e.parent('li'), sib = prt.siblings('li');
		sib.removeClass('selected');
		prt.addClass('selected');
	},
	init: function(){
		var _t = this, el = $( _t.el ), clicklable = true;
		if( detectEl( el ) )
			qapturedApp.controller(_t.controller, function( $scope, $http ){
				$scope.clicked = function( $event ){ 
					if( clicklable ){
						var e = $( $event.currentTarget ), uri = e.data('uri');
						if( uri != undefined && uri != null && uri != '' ){
							clicklable = false;
							_t.btnSelected( e );
							this.request( uri );
						}
					}
				};
				$scope.request = function( uri ){
					_t.loading('add');
					$http
					.get( site_url + uri )
					.success(function( d ){
						if( d['result'] == 'OK' ){ 
							$scope.items = d['data'];
							_t.plugin();	
						}
						_t.loading('remove');
						
						setTimeout(function(){ reviews.lastMessage(); }, 1);
						
						clicklable = true;
					})
					.error(function(){ clicklable = true; });
				};
				
				$scope.request( _t.uri );
			});
	}
};

/////////////////////////////////////////////////////////////////////////////////////////////////////// QPTDROPDOWN
var qptDrp = {
	
	arr: [
		{ el: '.revFormHolder', opt: { type: 'click', customClass: 'focus', clicked: '.revForm', toggle: false  } },
		{ el: '.pageMovie .addToList', opt: { type: 'click', customClass: 'opened', clicked: '> button', overlay: true  } },
		{ el: '.pageMovies .cntrlLinks .multiActions', opt: { type: 'click', customClass: 'opened', clicked: '> .lnkMultiAct'  } },
		{ el: '.userbox', opt: { customClass: 'opened', openedDelay: 222 } }
	],
	init: function(){
		var _t = this, arr = _t.arr;
		for( var i = 0; i < arr.length; ++i ){
			var o = arr[ i ], e = $( o['el'] );
			if ( detectEl( e ) ) e.qptDropDown( o['opt'] );
		}
	}
};

qptDrp.init();

/////////////////////////////////////////////////////////////////////////////////////////////////////// ANGULAR AJX

var angAjx = {
	arr: [
		{ el: '.pageUserFinder', controller: 'usrRpt', uri: 'ajx/search_ajx/get_users/{{page}}?q={{keyword}}', variable: ['keyword'], type: 'infScroll', btnType: 1, pageSize: 50},
		{ el: '.searchAll', controller: 'searchRpt', uri: 'ajx/search_ajx/lister/?q={{keyword}}', variable: ['keyword']},
		{ el: '.pageSearchDetail', controller: 'searchRpt', uri: 'ajx/search_ajx/lister/{{page}}?q={{keyword}}&type={{sType}}', variable: ['keyword', 'sType'], type: 'infScroll', btnType: 1, pageSize: 50 },
		{ el: '.pageCustomLists', controller: 'clRpt', uri: 'ajx/user_customlist_ajx/list_lister?usr={{usr}}', variable: ['usr'] },
		{ el: '.userNetworkSeen', controller: 'pmdUsrNetSn', uri: 'ajx/movie_actions_ajx/md_myn_sn_usrs/{{mvs_id}}', variable: ['mvs_id'] },
		{ el: '.rlClMovie', controller: 'mdUserCustomlists', uri: 'ajx/movie_actions_ajx/md_rlt_cls/{{mvs_id}}', variable: ['mvs_id'] },
		{ el: '.pageCustomList', controller: 'revRpt', uri: 'ajx/reviews_ajx/custom_list?type=nwf&list_id={{list_id}}', variable: ['list_id'] },
		{ el: '.pageCustomList', controller: 'movRpt', uri: 'ajx/movie_ajx/lister/{{page}}?type=cl&list={{list_id}}', variable: ['list_id'], type: 'infScroll', btnType: 1, pageSize: 100 },
		{ el: '.pageFeeds', controller: 'userFeeds', uri: 'ajx/feed_ajx/feeds/{{page}}', type: 'infScroll', btnType: 0, pageSize: 5 },
		{ el: '.pageNetwork', controller: 'usrRpt', uri: 'ajx/user_ajx/get_ff_list/{{page}}?type={{action}}&nick={{nick}}', variable: ['action', 'nick'], type: 'infScroll', btnType: 0, pageSize: 100 },
		{ el: '.pageWall', controller: 'userWall', uri: 'ajx/feed_ajx/wall/{{page}}?&nick={{nick}}', variable: ['nick'], type: 'infScroll', btnType: 0, pageSize: 5 },
		{ el: '.pageMovies', controller: 'movRpt', uri: 'ajx/movie_ajx/lister/{{page}}?type=ml', type: 'paging' },
		{ el: '.pageApplaud', controller: 'movRpt', uri: 'ajx/movie_ajx/lister/{{page}}?type=al&usr={{usr}}', variable: ['usr'], type: 'paging' },
		{ el: '.pageWatchlist', controller: 'movRpt', uri: 'ajx/movie_ajx/lister/{{page}}?type=wl&usr={{usr}}', variable: ['usr'], type: 'paging' },
		{ el: '.pageSeen', controller: 'movRpt', uri: 'ajx/movie_ajx/lister/{{page}}?type=sl&usr={{usr}}', variable: ['usr'], type: 'paging' },
		
		{ el: '.revMovie', controller: 'revRpt', uri: 'ajx/reviews_ajx/movie?type=nwf&mvs_id={{mvs_id}}', variable: ['mvs_id'], type:'tabbed' }
	],
	plugin: function( ID ){
		setTimeout(function(){
			lazyLoad( ID );
		}, 1);
	},
	searchArr: function( k ){
		var _t = this, arr = _t.arr, el = $( k['el'] );
		if( detectEl( el ) )
			for( var i = 0; i < arr.length; ++i ){
				var o = arr[ i ];
				if( k['el'] == o['el'] && k['controller'] == o['controller'] ){
					_t.ajx( o );
					break;
				}
			}
	},
	ajx: function( o ){
		var _t = this, el = $( o['el'] );	
		if( detectEl( el ) ){
			var uri = o['uri'], variable = o['variable'] || null, type = o['type'] || '';
			if( variable != null ){
				for( var j = 0; j < variable.length; ++j ){
					var v = variable[ j ];
					uri = uri.replace('{{'+ v +'}}', eval( v ) );
				}
			}
			if( type == 'infScroll' )
				infiniteScroll({ controller: o['controller'], uri: uri, element: el, pageSize: o['pageSize'] || 50, btnType: o['btnType'] || 0 });
			else if( type == 'paging' )
				paging.set({ controller: o['controller'], uri: uri, element: o['el'] });
			else if( type == 'tabbed' )
				tabPanel.set({ controller: o['controller'], uri: uri, element: o['el'] });		
			else
				getAjx({ controller: o['controller'], uri: uri, element: el });
		}
	},
	
	init: function(){
		var _t = this, arr = _t.arr;
		for( var i = 0; i < arr.length; ++i ){
			var o = arr[ i ];
			_t.ajx( o );
		}
	}
};

angAjx.init();

/////////////////////////////////////////////////////////////////////////////////////////////////////// YOUTUBE PLAYER
function watch_trailer( t ){
	var _this = $( t );
	if( _this.hasClass('yt') ) return false;
		_this.addClass('yt');
		
	var movieName = cleanText( $('.title h1').text() ),
 		year = cleanText( $('.title h1 small').text() ),
		uri= 'https://www.googleapis.com/youtube/v3/search?part=snippet&q={{movieName}}+{{year}}+official+trailer&type=video&key=AIzaSyBeMIeBXRtdxvziJl7KPd-enpbLoNjl7YE&maxResults=1&videoDuration=short';
		uri = uri.replace('{{movieName}}', encodeURIComponent( movieName )).replace('{{year}}', encodeURIComponent( year ));
		
	getAjax({ 'uri': uri, 'dataType': 'JSONP' }, 
	function( d ){ 
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
		_this.removeClass('yt');
	});	 
}

/////////////////////////////////////////////////////////////////////////////////////////////////////// VIEW TYPE
var viewType = {
	el: 'section.view > button',
	cls: 'selected',
	begin: 1,
	target: '.movieListHolder',
	plugin: function( ID ){
		lazyLoad( ID );
	},
	init: function(){
		var _t = this, el = $( _t.el ), target = $( _t.target );
		if( detectEl( el ) && detectEl( target ) ){	
			el
			.unbind('click').bind('click', function(){
				var _this = $( this ), r = _this.attr('rel');
				_this.addClass( _t.cls ).siblings('button').removeClass( _t.cls );
				target.attr('rel', r)
				sessionStorage.setItem('viewType', r);
				_t.plugin( target );
			});
			
			var s = sessionStorage.getItem('viewType');
			if( s )
				$( _t.el + '[rel="'+ s +'"]' ).click();
			else
				el.eq( _t.begin ).click();
		} 
	}
};

viewType.init();

/////////////////////////////////////////////////////////////////////////////////////////////////////// BODY CLICKED
var bodyClicked = {
	init: function(){
		$('body, html').bind('click touchstart', function( e ){
			var m = $('.filterbox'); 
			if( !m.is( e.target ) && m.has( e.target ).length === 0 && bdy.hasClass('filterMenuOpened') ){
				filterBtn.closed();
			}
		});
	}
};
bodyClicked.init();

/////////////////////////////////////////////////////////////////////////////////////////////////////// PLUGINS
var Plugins = {
	
	addToList: function(){
		var e = $('.addToList');
		if( detectEl ( e ) )
			e.each(function(){
				var ths = $( this );
					ths.qptDropDown( { type: 'click', customClass: 'opened', clicked: '.btnAddToList' } );    
			});
	},
	
	init: function(){
		var _t = this;
		setTimeout(function(){
			_t.addToList();
		}, 1);
	}
	
};


/////////////////////////////////////////////////////////////////////////////////////////////////////// HEADER ANIMATE

//;( function( $, window, document, undefined )
//{
//	'use strict';
//
//	var elSelector		= '#qHeader',
//		elClassHidden	= 'header--hidden',
//		throttleTimeout	= 500,
//		$element		= $( elSelector );
//
//	if( !$element.length ) return true;
//
//	var $window			= $( window ),
//		wHeight			= 0,
//		wScrollCurrent	= 0,
//		wScrollBefore	= 0,
//		wScrollDiff		= 0,
//		$document		= $( document ),
//		dHeight			= 0,
//
//		throttle = function( delay, fn )
//		{
//			var last, deferTimer;
//			return function()
//			{
//				var context = this, args = arguments, now = +new Date;
//				if( last && now < last + delay )
//				{
//					clearTimeout( deferTimer );
//					deferTimer = setTimeout( function(){ last = now; fn.apply( context, args ); }, delay );
//				}
//				else
//				{
//					last = now;
//					fn.apply( context, args );
//				}
//			};
//		};
//
//	$window.on( 'scroll', throttle( throttleTimeout, function()
//	{
//		dHeight			= $document.height();
//		wHeight			= $window.height();
//		wScrollCurrent	= $window.scrollTop();
//		wScrollDiff		= wScrollBefore - wScrollCurrent;
//
//		if( wScrollCurrent <= 0 ) // scrolled to the very top; element sticks to the top
//			$element.removeClass( elClassHidden );
//
//		else if( wScrollDiff > 0 && $element.hasClass( elClassHidden ) ) // scrolled up; element slides in
//			$element.removeClass( elClassHidden );
//
//		else if( wScrollDiff < 0 ) // scrolled down
//		{
//			if( wScrollCurrent + wHeight >= dHeight && $element.hasClass( elClassHidden ) ) // scrolled to the very bottom; element slides in
//				$element.removeClass( elClassHidden );
//
//			else // scrolled down; element slides out
//				$element.addClass( elClassHidden );
//		}
//
//		wScrollBefore = wScrollCurrent;
//	}));
//
//})( jQuery, window, document );

//////////////////////////////////////////////////////////////////////////////////////////////////////// MOVIE DETAIL
if( detectEl( $('.pageMovie') ) ){
	
	var mpCheck = $('.poster').attr("rel"), mPoster = $('.poster').attr("data-thumb");
	
	if(mpCheck == 1){
		
		var color = {
			get: function(a, b, c) {
		
					var res = 10;
		
					var e = new Image;
					e.onerror = function() {
							alert("error on load!")
					};
					e.onload = function() {
							var a = document.createElement("canvas");
					a.width = e.width;
							a.height = e.height;
							a = a.getContext("2d");
							a.drawImage(e, 0, 0, e.width, e.height, 0, 0, res, res);
							
			var s = 0, data = [0, 0, 0];
			
			for(var i=0; i< Math.pow(res, 2); ++i)
			{
		if( i % res == 0 && i > 0 ) s++;
		
		var	point = a.getImageData(s, i-(s*res), this.width, this.height).data
		data[0] += point[0];
		data[1] += point[1];
		data[2] += point[2];
			}
			
			data[0] = Math.round( data[0] * Math.pow(res, -2) );
			data[1] = Math.round( data[1] * Math.pow(res, -2) );
			data[2] = Math.round( data[2] * Math.pow(res, -2) );
			
			a = data;
			
							a = color.rgbToHex(a[0], a[1], a[2]);
							a = color.shade("#" + a, -8);
							b((!1 == c ? "" : "#") + a);
					};
					e.src = a
			},
			rgbToHex: function(a, b, c) {
					return color.toHex(a) + color.toHex(b) + color.toHex(c)
			},
			toHex: function(a) {
					a = parseInt(a, 10);
					if (isNaN(a)) return "00";
					a = Math.max(0, Math.min(a,
							255));
					return "0123456789ABCDEF".charAt((a - a % 16) / 16) + "0123456789ABCDEF".charAt(a % 16)
			},
			shade: function(a, b) {
					var c = parseInt(a.slice(1), 16),
							e = Math.round(2.55 * b),
							h = (c >> 16) + e,
							g = (c >> 8 & 255) + e,
							c = (c & 255) + e;
					return (16777216 + 65536 * (255 > h ? 1 > h ? 0 : h : 255) + 256 * (255 > g ? 1 > g ? 0 : g : 255) + (255 > c ? 1 > c ? 0 : c : 255)).toString(16).slice(1)
			}
		};
	
	 color.get(mPoster, function( k ) {
			$('.pageMovie .qHero').css("background-color", k);  
	  });
	 
	}

}

/////////////////////////////////////////////////////////////////////////////////////////////////////// QPTACTION
var qptAction = {
	share: function( k ){ socialAction.share( k ); },
	message: function( k ){
		alert( k );
	},
	get_obj_detail: function( obj, pre ){
		var el = $( obj );
		return{ id: el.parents('*[data-'+ pre +'-id]').attr('data-' + pre + '-id'), itm: el.attr('data-itm-id') };
	},
	seen: function( obj ){
		var _t = this, el = $( obj );
		getAjax({ uri: site_url + 'ajx/movie_actions_ajx/s_seen/', param: _t.get_obj_detail( obj, 'mvs' ) }, function( e, t ){
				if(e['result'] == 'OK'){
					if(e['itm-id'] != 0)
						$('div[data-mvs-id="'+t['param']['id']+'"] .chkWtc').attr("data-itm-id", "0");
						$( obj ).attr("data-itm-id", e['itm-id']);
					
					checkController('pmdUsrNetSn');
					
				}else
					_t.message( e['msg'] );		
		});
	},
	//unseen: function( obj ){
	//	var _t = this, el = $( obj ), id = el.attr("seen-id");
	//	getAjax({ uri: site_url + 'ajx/movie_actions_ajx/seen_unseen_movie/unseen', param: { id: id } }, function( e ){
	//			if(e['result'] == 'OK'){
	//				el.parents('div.movieItem').fadeOut(333, function(){
	//					el.parents('div.movieItem').remove();
	//				});
	//			}else
	//				_t.message( e['msg'] );	
	//				
	//	});
	//},
	applaud: function( obj ){
		var _t = this;
		getAjax({ uri: site_url + 'ajx/movie_actions_ajx/s_applaud/', param: _t.get_obj_detail( obj, 'mvs' ) }, function( e ){
					if(e['result'] == 'OK')
						$(obj).attr("data-itm-id", e['itm-id']);
					else
						_t.message( e['msg'] );
			});
	},
	watchlist: function( obj ){
		var _t = this;	
		getAjax({ uri: site_url + 'ajx/movie_actions_ajx/s_watchlist/', param: _t.get_obj_detail( obj, 'mvs' ) }, function( e, t ){
				if(e['result'] == 'OK'){
					if(e['itm-id'] != 0)
						$('div[data-mvs-id="'+t['param']['id']+'"] .btnSeen').attr("data-itm-id", "0");
						$( obj ).attr("data-itm-id", e['itm-id']);
				}else
					_t.message( e['msg'] );
					
		});
	},
	customlist: function( obj ){
		var _t = this, el = $( obj );
		getAjax({ uri: site_url + 'ajx/movie_actions_ajx/s_customlist/'+el.attr("data-prn-id"), param: _t.get_obj_detail( obj, 'mvs' ) }, function( e ){
				if(e['result'] == 'OK'){
					el.attr("data-itm-id", e['itm-id']);
					$('body').click();// addtoList kapanması için
				}
				else
					_t.message( e['msg'] );
		});
	},
	removeFromList: function( k ){
		sortableCustomList.remove( k );
	},
	deleteCustomList: function( k ){
		sortableCustomList.deleteList( k );
	},
	
	follow_user: function( obj ){
		var _t = this;
		getAjax({ uri: site_url + 'ajx/user_ajx/follow_user/', param: _t.get_obj_detail( obj, 'usr' ) }, function( e ){
				if(e['result'] == 'OK')						
					$(obj).attr("data-itm-id", e['itm-id']);	
				else
					_t.message( e['msg'] );
		});

	},
	addToList: function( obj ){
		var _t = this, el = $( obj ).parents('.addToList'), cList = el.find('.cLists'), o = _t.get_obj_detail( obj, 'mvs' );
		if( el.hasClass('ajxLoaded') ) return false;
		getAjax({ uri: site_url + 'ajx/movie_actions_ajx/get_add_cls_menu/' + o['id'] }, function( d ){
				if( detectEl( cList ) ){
          			cList.html( d );
					el.addClass('ajxLoaded');
					searchInput.init( $('.clSearch input', el) );
				}
		});
	},
	addReview:function( obj ){ reviews.add( obj ); },
	editReview:function( obj ){ reviews.edit( obj ); },
	moveReviewBox:function( obj ){ reviews.move( obj ); },
	replyReview:function( obj ){ reviews.reply( obj ); },
	confirmEl: '.msgboxDelConfirm',
	confirmation: function( obj ){
		var _t = this, el = $( obj ), type = el.attr('type') || '', confirmEl = $( _t.confirmEl );
		if( detectEl( confirmEl ) )
			confirmEl.addClass( type ).dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					'Yes': function(){
						$( this ).removeClass( type ).dialog( 'close' );
						if( type == 'rev' )
							reviews.deleteReview( el );
						else if( type == 'cl' )
							_t.deleteCustomList( el );
					},
					'No': function(){ $( this ).removeClass( type ).dialog( 'close' ); }
				}
			});
	},
	rateButton: function( k ){
		var _this = $( k ), type = _this.hasClass('rateUp') ? 'up' : 'down', prts, id, uri;
	
		if( _this.hasClass('active') ){		
			
			if( _this.parents('[data-itm-id]').length > 0 ){
				prts = _this.parents('[data-itm-id]');
				id = prts.attr('data-itm-id');
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
};

/////////////////////////////////////////////////////////////////////////////////////////////////////// SOCIAL SHARE 
var appId = 232323232;//geçici facebook için app tanımlanmalı

var socialAction = {
	appID: appId,
	url: 'http://qaptured.com/',
	template:{
		'facebook': 'http://www.facebook.com/dialog/feed?app_id={{appID}}&link={{url}}&picture={{media}}&name={{name}}&caption={{caption}}&description={{description}}&redirect_uri={{url}}&href={{source}}&display=popup',
		'facebookVideo': 'http://www.facebook.com/dialog/share?app_id={{appID}}&redirect_uri={{url}}&href={{source}}&display=popup',
		'twitter': 'http://twitter.com/share?&url={{url}}&via={{name}}&text={{description}} {{source}}',
		'pinterest': 'https://pinterest.com/pin/create/button/?description={{title}}&url={{url}}&media={{media}}',
		'googlePlus': 'https://plus.google.com/share?url={{url}}'
	},
	openWinPp: function( k ){
		var nw = window.open(k, 'qaptured', 'height=300,width=400');
		if( window.focus ) nw.focus();
		return false;
	},
	share: function( k ){
		var _t = this, 
			el = $( k ), 
			lnk = '', 
			tmp = '', 
			loc = window.location, 
			hrf = loc.href,
			media = el.attr('data-media') || '',
			name = el.attr('data-name') || '',
			caption = el.attr('data-caption') || '',
			description = el.attr('data-description') || '',
			source = el.attr('data-video') || '',
			typ = el.attr('data-type') || '',
			redirect_uri = hrf;
		
		if( media != '' )
			media = 'http://' + loc.host + media;	
	
		if( typ == 'facebook' && source != '' )
			typ = 'facebookVideo';

		lnk = _t.template[ typ ]; 	
		lnk = lnk.replace(/{{appID}}/g, _t.appID).replace(/{{url}}/g, _t.url).replace(/{{media}}/g, media).replace(/{{name}}/g, name).replace(/{{caption}}/g, caption).replace(/{{description}}/g, description).replace(/{{source}}/g, source).replace(/{{redirect_uri}}/g, redirect_uri);
		
		_t.openWinPp( lnk );
	}
	
};


/////////////////////////////////////////////////////////////////////////////////////////////////////// REVIEW
var reviews = {
	comm: '',
	commId: '',
	commType: '',
	spl: '',
	ref: '',
	plugin: function(){
		setTimeout(function(){
			//lazyLoad( );
		}, 1);
	},
	msgID: null,
	lastMessage: function(){
		var _t = this, d = _t.msgID;
		if( d != null ){
		    d = $('[data-itm-id="'+ d +'"]', '.revItemHolder');
			if( detectEl( d ) ){
				$('[data-itm-id]', '.revItemHolder').removeClass('lastMessage');
				d.addClass('lastMessage');
				setTimeout(function(){ 
					d.removeClass('lastMessage');
					_t.msgID = null; 
				}, 333);
			}
		}
		
	},
	add_comment: function( ref_id, text, spl, type, id ){
		var _t = this, postObj, holder;
		
		if( ref_id == 0 ){
			holder = 'rev';
			postObj = { id:id, type:type, text:text, spl:spl };
		}else{
			holder = 'reply';
			postObj = { ref:ref_id, text:text, spl:spl };
		}
		
		getAjax({ uri: site_url + 'ajx/reviews_ajx/add_comment', param: postObj }, function( result ){
				$('.'+holder+'Form .sys-msg-default').text(result.data['message']);
				$('#'+holder+'_text').val('');
				$('[data-itm-id]').removeClass('editing reply');
				_t.msgID = result.data['post'];
				
				// movie detail
				if( detectEl( $('[rel="topReviews"] button') ) )
					$('[rel="topReviews"] button').click();
		});
	},
	add: function( obj ){
		var _t = this, cmtText = CKEDITOR.instances.rev_text.getData(),	spl = $('#comment_spl').is(":checked") ? 1 : 0; 
			if( cmtText != '' )
				_t.add_comment(0, cmtText, spl, _t.commType, _t.commId);
	},
	reply: function( obj ){
		var _t = this, cmtText = CKEDITOR.instances.reply_text.getData(),	spl = $('#comment_spl').is(":checked") ? 1 : 0;
			if( cmtText != '' )
				_t.add_comment(_t.ref, cmtText, spl);
	},
	move: function( obj ){
		var _t = this, comm = $( obj ).parents('*[data-itm-id]'), ref = comm.attr("data-itm-id");
			_t.ref = ref;
		$('[data-itm-id]').removeClass('editing reply');
		comm.addClass('reply');	
		$("#replyForm").appendTo( comm );
	},
	deleteReview: function( k ){
		var _this = $( k ), prts = _this.parents('[data-itm-id]:eq(0)');
	
		if( detectEl( prts ) ){
			getAjax( { uri: site_url + 'ajx/comments_ajx/delete_comment/' + prts.attr('data-itm-id') }, function( e ){
				if( e['result'] == 'OK' )
					prts.fadeOut(333, function(){ prts.remove(); });
				else
					alert( e['data']['message'] );
			});
		}
	},
	edit: function( k ){
		var _this = $( k ), prts = _this.parents('[data-itm-id]:eq(0)');

		if( prts.length > 0 ){
			$('[data-itm-id]').removeClass('editing reply');
			prts.addClass('editing');
			var c = $('> .feedContent .textContent', prts);
			$("#replyForm").appendTo( c );
			$('#reply_text').val( $('.text', c).text() );
			$('a.btnReply').unbind('click').bind('click', function(){
				var val = $('#reply_text').val(), spl = ($('#reply_spl').is(":checked")) ? 1 : 0;
				
				getAjax( { uri: site_url+'ajx/comments_ajx/edit_comment/' + prts.attr('data-itm-id'), param: { text: val, spl: spl } }, function(){
					$('[data-itm-id]').removeClass('editing reply');
				});
				
				$('.text', c).text( $('#reply_text').val() );
				$('#reply_text').val('');
				$('#reply_spl').removeAttr('checked');
				
			});
		}
	},
	editor: function(){
		if( $('#rev_text').length > 0 )
			CKEDITOR.inline( 'rev_text', {allowedContent:'br'});
		
		if( $('#reply_text').length > 0 )
			CKEDITOR.inline( 'reply_text', {allowedContent:'br'});
	},
	init: function(){
		var _t = this;
		if( typeof review !== 'undefined' ){
			if( page === 'cld' ){
					// Custom List Feeds
					_t.commType = 4;
					_t.commId = list_id;	
					getAjx({ controller: 'commentRepeaterController', uri: 'ajx/reviews_ajx/custom_list?type=nwf&list_id=' + _t.commId }, function(){
						_t.plugin();	
					});
				}else if( page === 'movie-detail' ){
					// Movie Detail Feeds
					_t.commType = 2;
					_t.commId = mvs_id;			
					getAjx({ controller: 'commentRepeaterController', uri: 'ajx/reviews_ajx/movie?type=nwf&mvs_id=' + _t.commId }, function(){
						_t.plugin();
					});
				}
				
				_t.editor();
			}
	}	

};

reviews.init();


/////////////////////////////////////////////////////////////////////////////////////////////////////// 
var movieDetailPage = {
	init: function(){
		var btn = $('.revCount'), target = $('.reviewbox');
		if( detectEl( btn ) && detectEl( target ) ){
			btn
			.bind('click', function(){				
				pageScroll( target.offset().top, function(){
					//target.click();
				});
			});
			
		}
		
		if(detectEl($('.scrolledPage'))){
			bdy.addClass('pageLoaded');
			setTimeout(function(){ window.scrollTo( 0, 300 ); }, 10);
		}
	}
};

movieDetailPage.init();

/////////////////////////////////////////////////////////////////////////////////////////////////////// 
var sortableCustomList = {
	wrp: '.pageCustomList',
	el: '.movieListHolder',
	items: '.movieItem',
	btn: '.editHolder a',
	clsArr: [],
	searchList: function(){
		var arr = [];
		$("[data-mvs-id]").each(function( i, k ){ arr[ i ] =  $(this).attr('data-mvs-id'); });
		return arr;
	},
	activeted: function(){
		var _t = this, wrp = $( _t.wrp );
		if( detectEl( wrp ) ){
			if( wrp.hasClass( _t.cls ) ){
				_t.sortable('destroy');
				_t.sortable('add');
			}
		}
	},
	deleteList: function(){
		var el = $( k ), list = el.attr('list-id');
		getAjax( { uri: site_url + 'ajx/user_customlist_ajx/delete_custom_list/', param: { list: list } }, function( e ){
				if( e['result'] == 'OK' )
					el.parents('.listItem').fadeOut(333, function(){ el.parents('.listItem').remove(); });
				else
					alert(e['msg']);
		});
	},
	remove: function( k ){
		var _t = this, el = $( k ), id = el.attr("ldt-id");
		_t.clsArr.push( id );
		el.parents('div.movieItem').fadeOut(333, function(){
			el.parents('div.movieItem').remove();
		});
	},
	edit: function(){
		
		var _t = this, title = $('input.clTitleInput').val(), postParams = { title: title }, ids = _t.searchList();
		
		if( detectEl( ids ) ){
			postParams.oc = ids.length;
			postParams.order = ids.toString();
		}
		
		if( detectEl( _t.clsArr ) ){
			postParams.dc = clsArr.length;
			postParams.del = clsArr.toString();
		}
		
		getAjax( { uri: site_url + '/ajx/user_customlist_ajx/edit_list_detail/' + list_id, param: postParams }, function( e ){
				if(e['result'] == 'OK')
						_t.clsArr = [];
					else
						alert(e['msg']);		
		});
	},
	sortable: function( k ){
		var _t = this, el = $( _t.el );
		if( detectEl( el ) )
			if( k == 'add' ){
				if( el.hasClass('ui-sortable') ) el.sortable( 'destroy' );
				el.sortable({ items: _t.items });
			}else
				el.sortable( 'destroy' );
	},
	cls: 'edit',
	addEvent: function(){
		var _t = this, wrp = $( _t.wrp ), btn = $( _t.btn );
		if( detectEl( btn ) )
			btn.bind('click', function(){
				if( wrp.hasClass( _t.cls ) ){
					_t.edit();
					$('.titleCustomList h4').text($('input.listTitle').val());
					wrp.removeClass( _t.cls );
					_t.sortable('destroy');
				}else{
					wrp.addClass( _t.cls );
					$('.titleCustomList input').focus();
					_t.sortable('add');
				}
			});
	},
	init: function(){
		var _t = this, wrp = $( _t.wrp );
		if( detectEl( wrp ) )
			_t.addEvent();
	}
};
sortableCustomList.init();

/////////////////////////////////////////////////////////////////////////////////////////////////////// SEARCH
var searchInput = {
	main: '.listSelection',
	el: '.clSearch input',
	target: '.cLists  button',
	cleanText: function( k ){
		return k.replace(/(^\s+|\s+$)/g, '');
	},
	init: function( k ){
		var _t = this, el = $( k );
		if( detectEl( el ) )
			el
			.bind('keyup', function(){
				var ths = $( this ), prts = ths.parents( _t.main ), val = _t.cleanText( ths.val() ), count = 0;
				if( val.length > 0 ){
					$(_t.target, prts).each(function(){
						var ts = $( this ), contents = ts.text();
						if( contents.search( new RegExp( val, 'i' ) ) < 0 )
	              		  	ts.addClass('none');
			            else{
			                ts.removeClass('none');
							count++;
						}
					});
					if( count == 0 ) prts.addClass('noResult');
					else prts.removeClass('noResult')	;	
				}else{
					prts.removeClass('noResult');
					$(_t.target, prts).removeClass('none');
				}
			});
			
	}
};



/////////////////////////////////////////////////////////////////////////////////////////////////////// BULK ACTION
var bulkAction = {
	wrp: '.pageMovies ',
	obj: {},
	cls: 'selected',
	set: function( k ){
		var _t = this, el = $( k ), prt = el.parents('[data-mvs-id]'), mvs = prt.attr('data-mvs-id') || '';
		if( mvs == '' ) return false;
		if( prt.hasClass( _t.cls ) ){
			prt.removeClass( _t.cls );
			delete _t.obj[ mvs ];
		}else{
			prt.addClass( _t.cls );
			_t.obj[ mvs ] = 'OK';
		}
	},
	setSelected: function(){
		var _t = this;
		$.each(_t.obj, function( i, k ){
			var e = $('[data-mvs-id="'+ i +'"]');
			if( e.length > 0 )
				e.addClass( _t.cls );
		});
	},
	getSelected: function(){
		var _t = this, arr = [];
		$.each(_t.obj, function( i, k ){
			arr.push( i );
		});
		return arr;
	},
	uri: 'ajx/movie_actions_ajx/bulk_action/{{typ}}/',
	getUri: function( typ ){
		var _t = this, uri = _t.uri;
		return uri.replace(/{{typ}}/g, typ);
	},
	addEvent: function(){
		var _t = this, wrp = $( _t.wrp );
		
		$('.multiActions button').unbind('click').bind('click', function( e ){
			e.preventDefault();
			_t.set( $( this ) );
		});
		
		$('.lnkBulkAct').unbind('click').bind('click', function( e ){ wrp.toggleClass('bulkAction'); });
		$('.drpBulkAction ul button').unbind('click').bind('click', function( e ){
			var ths = $( this ), rel = ths.attr('rel'), arr = _t.getSelected(); console.log( { ids: arr.toString(), mc: arr.length });
			getAjax({ uri: site_url + _t.getUri( rel ), param: { ids: arr.toString(), mc: arr.length } }, function( d ){
				if( d.result == 'OK' )
					alert('OK');
			});
		});
	},
	init: function(){
		var _t = this, wrp = $( _t.wrp );
		if( detectEl( wrp ) ){
			_t.setSelected();
			_t.addEvent();
		}
	}
};


/////////////////////////////////////////////////////////////////////////////////////////////////////// GLOBAL FUNC

function infiniteScroll( obj, callback ){
		qapturedApp.controller(obj['controller'], function( $scope, Reddit ){ $scope.reddit = new Reddit(); });
		qapturedApp.factory('Reddit', function( $http ){
		  var Reddit = function() {
				this.items = [];
				this.busy = false;
				this.btnState = obj['btnType'] == 1 ? true : false;
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
						//if( items['mvs_poster'] == null )
						//	items['mvs_poster'] = 'images/placeHolder.jpg';
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
				if( obj['btnType'] == 1 ) this.busy = true;
				this.loading = false;

				// TRIGGER LAZYLOAD
				setTimeout(function(){ lazyLoad( obj['element'] ); }, 1);
			  }else{
				this.loading = false;
				this.busy = true;
				this.btnState = false;
				if( this.items.length == 0 )
				    this.items.push( { 'type': 2, 'result': 'No Result' } );
			  }
			 
			  // CALLBACK
			  Plugins.init();
			  sortableCustomList.activeted();
			  if( callback != undefined ) setTimeout(callback, 1); 
			
			}.bind( this ));
		  };
		  return Reddit;
		});
}

function getAjx( obj, callback ){
	var url = site_url + obj['uri'], element = obj['element'] || null;
	qapturedApp.controller(obj['controller'], function( $scope,  $http ){ 
	
		controllers[ obj['controller'] ] = $scope;
		
		$scope.request = function(){	
			$http.get( url ).success(function( d ){ console.log(d);
				if( d['result'] == 'OK' ){
					$scope.items = d['data'];
					if( callback != undefined ) callback();
					if( element != null ) angAjx.plugin( element );
				}
			});
		};
		
		$scope.request();
	});
}

function getAjax( obj, callback, error ){
	$.ajax({
		type:'POST',
		url:obj['uri'] || null,
		dataType: obj['dataType'] || null,
		data:obj['param'] || null,
		error: function( e ){ 
			if( error != undefined ) 
				error( e ); 	
		},
		success:function( e ){
			if( callback != undefined ) 
				callback( e, obj );
		}
	});
}

function detectEl( ID ){ return ID.length > 0 ? true : false; }

function cssClass( o, callback ){
	var ID = $( o['ID'] ), k = o['delay'], type = o['type'], cls;
	if( detectEl( ID ) ){
		if( type == 'add' ){
			cls = o['cls'] || ['ready', 'animate'];
			ID.addClass( cls[ 0 ] ).delay( k ).queue('fx', function(){ $( this ).dequeue().addClass( cls[ 1 ] ); if( callback != undefined ) callback(); });
		}else{
			cls = o['cls'] || ['animate', 'ready'];
			ID.removeClass( cls[ 0 ] ).delay( k ).queue('fx', function(){ $( this ).dequeue().removeClass( cls[ 1 ] ); if( callback != undefined ) callback(); });
		}
	}
}

function checkController( k ){
	if( controllers[ k ] != undefined && controllers[ k ] != null )
		controllers[ k ].request();
}

function pageScroll( t, callback ){
	$('html, body').stop().animate({ scrollTop: t }, 888, 'easeInOutExpo', function(){ if( callback != undefined ) callback();  });
}

function cleanText( k ){
	return k.replace(/\s+/g, '');
}

function lazyLoad( ID ){
	if( detectEl( $('.lazy', ID) ) )
		$('.lazy', ID).lazyload({ effect: 'fadeIn', load: function(){ 
			$( this )
			.removeClass('lazy')
			.parents('.movieItem')
			.addClass('loaded'); 
		}});
}

lazyLoad( $('body') );

/////////////////////////////////////////////////////////////////////////////////////////////////////// GLOBAL EVENTS
var events =
{
	
	init: function(){
		/*
		if( detectEl( $(".qHero") ))
		{
			window.scrollTo(0, 300);
			setTimeout(function(){ $("#qHeader").removeClass("fixed"); }, 100);
		}
		*/
		
		bdy.addClass('winLoaded');
	},
	
	onResize: function(){
		wt = parseFloat( win.width() );
		ht = parseFloat( win.height() );
		filters.adjust();
	},
	
	onScroll: function(){
		wst = parseFloat( win.scrollTop() );
		sRatio = wst / ( doc.height() - ht );
		filters.onScroll();
		
	}
	
};

win.load( events.init );
win.resize( events.onResize ).resize();
win.scroll( events.onScroll ).scroll();


/// TEMPORARY

//console.log( detectEl( $(".qHero") ));

