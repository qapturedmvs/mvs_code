
var siteUrl = $('#hdnSiteUrl').val();

// Obj Exist
function exist(obj){
	if(obj.html() != undefined) 
		return true; 
	else 
		return false;
}


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

//Movies Detail
if(exist($('.pageMovie'))){
	
	var coverPage = 1;
	
	function get_covers(p){
		
		var covers, title = $('#mvs_title').val()+' film '+$('#mvs_year').val();
		
		$.post(site_url+'admin/admin_ajx/get_movie_cover/'+p+'?q='+title, function(data){
				if(data['responseStatus'] == 200){
					covers = data['responseData']['results'];
	
					for(var i=0; i<covers.length; i++){
						$('.covers ul').append('<li><a href="javascript:void(0);" rel="'+covers[i]['url']+'"><img src="'+covers[i]['tbUrl']+'" title="'+covers[i]['title']+'" /><span>'+covers[i]['width']+'x'+covers[i]['height']+'</span></a></li>');
					}
					
					$('.covers').addClass('called');
					$('.btnCovers').hide();
					
					bind_cover_img();
					
				}
		});
		
	}
	
	$('.btnCovers').click(function(){
		
		get_covers(coverPage);
	
	});
	
	$('.btnMore').click(function(){
		
		coverPage++;
		get_covers(coverPage);
	
	});
	
	function bind_cover_img(){
		
		$('.covers li a').click(function(e){
			
			e.preventDefault;
			var path = $(this).attr("rel"), slug = $('#mvs_slug').val();
			
			$('body').addClass('process');
			
			$.post(site_url+'admin/admin_ajx/get_cover_image/'+slug+'?img='+path, function(data){
				
				if(data['result'] == 'OK'){
					
					$('body').removeClass('process');
					
				}
				
			});
			
		});

	}

	
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