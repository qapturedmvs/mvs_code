var site_url = $('#site_url').val(), cmtText, comm, commId;

switch(commentPage){
	
	case 'movie-detail':
		commId = mvs_id;
		
		// Movie Detail Feeds
		getAjx({ controller: 'commentRepeaterController', uri: 'ajx/comments_ajx/movie_detail?type=nwf&mvs_id='+commId }, function(){});
		
	break;

	case 'custom':
		commId = list_id;
		
		// Custom List Feeds
		getAjx({ controller: 'commentRepeaterController', uri: 'ajx/comments_ajx/custom_list?type=nwf&list_id='+commId }, function(){});
		
	break;
	
	
}
		

function add_comment(id, type, text, ref_id){
	
	commentType = (ref_id == 0) ? 'comment' : 'reply';
	
	$.ajax({
		type:'POST',
		url:site_url+'ajx/comments_ajx/add_comment',
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
			add_comment(commId, 2, cmtText, 0);
});


function moveReplyFrom(obj){
		comm = $(obj).parents('.commentItem');
		var ref = comm.attr("act-id");

		$("#replyForm").appendTo(comm);
		
		$('a.btnReply').click(function(){
			cmtText = $('#reply_text').val();
			
			if(cmtText != '')
				add_comment(commId, 2, cmtText, ref);
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



