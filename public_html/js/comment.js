var site_url = $('#site_url').val(), cmtText, comm;

function add_comment(id, type, text, ref_id){
	
	if(ref_id == 0)
		commentType = 'comment';
	else
		commentType = 'reply';
	
	$.ajax({
		type:'POST',
		url:site_url+'ajx/commentbox_ajx/add_comment',
		data:{id:id, type:type, text:text, ref:ref_id},
		success:function(result){
			$('.'+commentType+'_result').text(result.data['message']);
			$('#'+commentType+'_text').val('');
		}
	});
	
}

$('a.btnComment').click(function(){
		cmtText = $('#comment_text').val();
		
		if(cmtText != '')
			add_comment(mvs_id, 2, cmtText, 0);
});


function moveReplyFrom(obj){
		comm = $(obj).parents('.commentItem');
		var ref = comm.attr("act-id");

		$("#replyForm").appendTo(comm);
		
		$('a.btnReply').click(function(){
			cmtText = $('#reply_text').val();
			mvs_id = mvs_id;
			
			if(cmtText != '')
				add_comment(mvs_id, 2, cmtText, ref);
	});
		
}

function showMore(obj){
	
	comm = $(obj).parents('.commentItem');
	var rep = $(obj).siblings('.commentReplies').children('.subComment').length;
	
	if(rep > 0){

		if(!comm.hasClass("more")){
			comm.addClass("more");
		}else{
			comm.removeClass("more");
		}
	
	}
}



