
var siteUrl = $('#hdnSiteUrl').val();

// Obj Exist
function exist(obj){
	if(obj.html() != undefined) 
		return true; 
	else 
		return false;
}


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
			
			if ( item._type != currentCategory ){
				ul.append('<li class="ui-autocomplete-category '+ item._type +'"><h2>' + item._type + '</h2></li>' );
				currentCategory = item._type;
			}
			
			li = that._renderItemData( ul, item );
			
			if( item._type == 'movie' ){
				item['_source'].mvs_poster = (item['_source'].mvs_poster == 1) ? site_url+'data/movies/thumbs/'+item['_source'].mvs_slug+'_150X222_.jpg' : site_url+'images/noPoster.jpg';
				li.html('<div class="row row-movie"><a class="qFixer" href="/admin/movie/detail/'+ item['_source'].mvs_id + '"><figure class="posterImg rowLeft left" style="background-image:url('+ item['_source'].mvs_poster +');"></figure><div class="rowRight left"><span class="title">'+ item['_source'].mvs_title + ' ('+ item['_source'].mvs_year +')</span><small>'+ item['_source'].stars +'</small></div></a></div>');
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


if(exist($('#search_movie')))
	$('#search_movie').qapturedComplete({
		source: function( request, response ) {
			
			getAjax( { uri: site_url + "ajx/search_ajx/suggest?t=movie&q=" + request.term, param: null }, function( d ){
				
				if( d.result == 'OK' )
						response( d.data );
					
		    });
			
		  },
		  minLength: 2,
			appendTo:'.movie-search'
	});


// Movies List
if(exist($('.pgaeMovies'))){
	
	var orderBy = minusLoc.get('?', 'orderBy'), orderRule = minusLoc.get('?', 'orderRule');
	
	if(orderRule == 'DESC')
		$('.table-movies th a[rel="'+orderBy+'"]').addClass("desc").removeClass("asc");
	else
		$('.table-movies th a[rel="'+orderBy+'"]').removeClass("desc").addClass("asc");
	
	$('.table-movies th a').click(function(){
		
		orderBy = $(this).attr("rel");
		
		if($(this).hasClass('asc'))
			orderRule = 'DESC';
		else
			orderRule = 'ASC';
		
		minusLoc.put('?',orderBy+'|'+orderRule , 'orderBy|orderRule');

	});
	
}


// Actor Detail
if(exist($('.pageActors'))){
	
	
	function get_photos(){
		
		var photos, name = encodeURIComponent($('.sub-header').text());
		
		$.post(site_url+'admin/admin_ajx/get_actor_photo/?q='+name, function(data){
			
			if(data){
        
				photos = data['d']['results'];
				
				for(var i=0; i<photos.length; i++){
					if(photos[i]['MediaUrl'].indexOf('.jpg') != -1 || photos[i]['MediaUrl'].indexOf('.png') != -1 || photos[i]['MediaUrl'].indexOf('.jpeg') != -1)
						$('.photos ul').append('<li><a rel="'+photos[i]['MediaUrl']+'" style="background-image:url('+photos[i]['Thumbnail']['MediaUrl']+');"><span>'+photos[i]['Width']+'x'+photos[i]['Height']+'</span></a></li>');
				}
				
				$('.btnPhotos').hide();
				$('.photos ul li a').click(function(){
					choose_photo($(this));	
				});
				
      }
			
		});
		
	}
	
	$('.btnPhotos').click(get_photos);
	
	function choose_photo(_t){

		var url = _t.attr('rel'), slug = $('#str_slug').val();
		
		$('.topLeft a').addClass('proc');
		
		$.post(site_url+'admin/admin_ajx/choose_actor_photo/'+slug+'?i='+url, function(data){
		
			$('.topLeft a img').attr('src', $('.topLeft a img').attr('rel')+'?upd='+Date.now());
			$('.topLeft a').removeClass('proc');
			
		});
		
	}
	
}




//Movies Detail
if(exist($('.pageMovie'))){
	
	var coverPage = 1;
	
	function get_covers(p){
		
		var covers, title = encodeURIComponent($('#mvs_title').val()+' movie '+$('#mvs_year').val());
		
		$.post(site_url+'admin/admin_ajx/get_movie_cover/'+p+'?q='+title, function(data){
				if(data['responseStatus'] == 200){
					covers = data['responseData']['results'];
	
					for(var i=0; i<covers.length; i++){
						if(covers[i]['url'].indexOf('.jpg') != -1 || covers[i]['url'].indexOf('.png') != -1 || covers[i]['url'].indexOf('.jpeg') != -1)
							$('.covers ul').append('<li><a data-size="1600,'+Math.round(covers[i]['height']*1600/covers[i]['width'])+'" rel="'+covers[i]['url']+'"><img src="'+covers[i]['tbUrl']+'" title="'+covers[i]['title']+'" /><span>'+covers[i]['width']+'x'+covers[i]['height']+'</span></a></li>');
					}
					
					$('.covers').addClass('called');
					$('.btnCovers').hide();
					
					bind_cover_img();
					
				}
		});
		
	}
	
	$('.btnCovers').click(function(){
		
		get_covers(coverPage);
		coverPage++;
		get_covers(coverPage);
	
	});
	
	$('.btnMore').click(function(){
		
		coverPage++;
		get_covers(coverPage);
		coverPage++;
		get_covers(coverPage);
	
	});
	
	function bind_cover_img(){
		
		$('.covers li').mouseenter(function(){
			
			var rel = $('a', this).attr("rel");
			if($('.coverHover', this).length == 0){
        
				$(this).addClass("hover").append('<div class="coverHover"><div class="dims">New Dimensions: '+$('a', this).attr('data-size').replace(',', 'X')+'</div><div class="btn-group" role="group"><button type="button" class="btn btn-default" rel="top">TOP</button><button type="button" class="btn btn-default" rel="middle">MIDDLE</button><button type="button" class="btn btn-default" rel="bottom">BOTTOM</button></div><div><img src="'+rel+'" /></div></div>');
			
			}
			
			$('.coverHover button', this).unbind("click").bind("click", function(e){
			
				e.preventDefault;
				var path = $(this).parents('li').children('a').attr("rel"), slug = $('#mvs_slug').val(), crp = $(this).attr("rel");
				
				$('body').addClass('process');
				
				$.post(site_url+'admin/admin_ajx/get_cover_image/'+slug+'?img='+path+'&crp='+crp, function(data){
					
					if(data['result'] == 'OK'){
						
						$('body').removeClass('process');
						$('#mvs_cover').val(site_url+'data/covers/'+slug+'.jpg');
						$('#mvs_cover').next().html('<a href="'+site_url+'data/covers/'+slug+'.jpg" target="_blank">Show Cover</a>');
						
					}
					
				});
				
			});	
		}).mouseleave(function(){
			
			$('.coverHover', this).remove();
			$(this).removeClass("hover");
				
		});
		
		

	}
	
	
$('.mnCover button').click(function(){
			
	var path = $('.mnCover input').val(), slug = $('#mvs_slug').val(), crp = $(this).attr("rel");
	
	if(path != ''){
		
		$('body').addClass('process');
		
		$.post(site_url+'admin/admin_ajx/get_cover_image/'+slug+'?img='+path+'&crp='+crp, function(data){
			
			if(data['result'] == 'OK'){
				
				$('body').removeClass('process');
				$('#mvs_cover').val(site_url+'data/covers/'+slug+'.jpg');
				$('#mvs_cover').next().html('<a href="'+site_url+'data/covers/'+slug+'.jpg" target="_blank">Show Cover</a>');
				
			}
			
		});
	
	}
				
});	

	
	// Multiselect actions
	var sel;
	
	function getSelections(sel){
		$('.groupMulti[rel="'+sel+'"] .selections').html('');
		$('.groupMulti[rel="'+sel+'"] select option:selected').each(function(){
			$('.groupMulti[rel="'+sel+'"] .selections').append('<small rel="'+$(this).val()+'">'+$(this).text()+'</small>');
		});
	}
	
	$('.groupMulti').each(function(){
		sel = $(this).attr('rel');
		getSelections(sel);
	});
	
	
	$('.groupMulti select').change(function(){
		sel = $(this).parent('.groupMulti').attr('rel');
		getSelections(sel);
	});
	
	// Poster Action
	$('.posterHolder img').click(function(){
		$(this).toggleClass('big');
	});
	
}

//Settings (Image Generate)
if(exist($('.pageSettings'))){
	
	var size, path, url = $('#hdnSiteUrl').val()+"admin/settings/thumbs";
	
	$('a.btnGen').click(function(){
		if(!exist($('.generating'))){
			size = $(this).parents('.input-group-addon').siblings('input').val(),
			path = $('#mvs_img_path').val();
			size = size.toLowerCase().split("x");
			
			$(".settingsHolder").addClass("generating");
			$(this).parents('.input-group-addon').append('<img src="../back/images/ajax-loader.gif" class="genAct" />');
			
			$.post(url+"?path="+path+"&width="+size[0]+"&height="+size[1], function(result){
				
				if(result){
					$(".settingsHolder").removeClass("generating");
					$(this).siblings('.genAct').remove();
				}
				
			});
		}
	});
	

}

//Settings (Slug Generate)
if(exist($('.pgaeSlugs'))){
	
	var rel;
	
	$('span.badge').click(function(){
		if(!exist($('.generating'))){
			rel = $(this).attr("rel");
			$(this).parent(".list-group-item").addClass("generating");
			
			$.post(rel, function(result){
				
				if(parseFloat(result) > 0)
					$(this).text(result);
				else
					$(this).remove();
				
				$(this).parent(".list-group-item").removeClass("generating");
				
			});
		}
	});
	

}

//Settings (Rate Movies)
if(exist($('.pageRate'))){
	
	var rel;
	
	$('span.badge').click(function(){
		if(!exist($('.generating'))){
			rel = $(this).attr("rel");
			$(this).parent(".list-group-item").addClass("generating");
			
			$.post(rel, function(result){
				
				if(parseFloat(result) > 0)
					$(this).text(result);
				else
					$(this).remove();
				
				$(this).parent(".list-group-item").removeClass("generating");
				
			});
		}
	});
	

}




