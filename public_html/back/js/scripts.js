
// Obj Exist
function exist(obj){
	if(obj.html() != undefined) 
		return true; 
	else 
		return false;
}


// Movies Sort
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