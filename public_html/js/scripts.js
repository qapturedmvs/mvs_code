
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
	
	$('.controllers .view a').click(function(){
		var view = $(this).attr("class");
		
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
		qObj = qsManager.qto(qs);
		
		for(var e in qObj){
			for(var i in qObj[e]){
				$('.filters ul.multi[rel="'+e+'"] li a[rel="'+qObj[e][i]+'"]').addClass("selected");
			}
		}
	}
	
	$('.filters .submenu a').click(function(){
		fg = $(this).parents('ul.multi').attr("rel"),
		fi = $(this).attr("rel");

		qsManager.mput(fg, fi);
	});
	
}