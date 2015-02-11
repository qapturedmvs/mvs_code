var site_url = $('#mvs_site_url').val(), cmtText, mvs_id;

function add_comment(id, type, text){
	
	$.ajax({
		type:'POST',
		url:site_url+'ajx/commentbox_ajx/add_comment',
		data:{id:id, type:type, text:text},
		success:function(result){
			$('.cmtResult').text(result.data['message']);
			$('#cmt_text').val('');
		}
	});
	
}

$('a.btnComment').click(function(){
		cmtText = $('#cmt_text').val();
		mvs_id = $('div.details').attr("rel");
		
		if(cmtText != '')
			add_comment(mvs_id, 2, cmtText);
});