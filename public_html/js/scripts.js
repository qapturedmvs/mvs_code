
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
	});
	
}