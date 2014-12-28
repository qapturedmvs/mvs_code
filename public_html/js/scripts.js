
var siteUrl = $('#hdnSiteUrl').val();

// Obj Exist
function exist(obj){
	if(obj.html() != undefined) 
		return true; 
	else 
		return false;
}


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
	
	var qs = window.location.search, fg, fi;
	
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
		
		qsManager.remove(temp);
	});
	
	$('.choices a').click(function(){
		id = $(this).attr("rel"),
		grp = $(this).attr("grp");

		qsManager.mput(grp, id);
	});
	
	$('.filters .submenu a').click(function(){
		fg = $(this).parents('ul.multi').attr("rel"),
		fi = $(this).attr("rel");

		qsManager.mput(fg, fi);
	});
	
}