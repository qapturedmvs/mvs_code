<script type="text/javascript">
	var commentPage = true;
</script>
<div class="commentbox">
	<div ng-controller='commentRepeaterController' class="commentboxHolder">
		<div class="commentsTabs">
		<h4>Comments</h4>
			<ul>
				<li><a href="javascript:void(0);">Top Rated</a></li>
				<li><a href="javascript:void(0);">Newest First</a></li>
				<?php if($logged_in): ?>
				<li><a href="javascript:void(0);">My Network</a></li>
				<?php endif; ?>
			</ul>
			<hr class="qFixer" />
		</div>
		<div class="commentsContent">
			<div act-id="{{item.act_id}}" act-ref-id="{{item.act_ref_id}}" class="commentItem" ng-repeat='item in items'>
				<span class='user'><a href="<?php echo $site_url.'user/movies/lists/'; ?>{{item.usr_nick}}"><b>{{item.usr_name}}</b></a></span>
				<a class="btnShowReplies" onclick="showMore(this)" href="javascript:void(0);">
					<span class='text'>{{item.act_text}}</span> 
					<span class='time'>{{item.act_time}}</span>
				</a>
				<?php if($logged_in): ?>
				<span ng-if="item.act_ref_id==0" class="btnHolder">
						<a onclick="moveReplyFrom(this)" href="javascript:void(0);" class="btnReply">Reply</a>
				</span>
				<?php endif; ?>
				<hr class="qFixer" />
				<div class="commentReplies">
					<div act-ref-id="{{item.act_id}}" class="commentItem subComment" ng-repeat='reply in item.reply'>
						<span class='user'><b>{{reply.usr_name}}</b></span>
						<span class='text'>{{reply.act_text}}</span> 
						<span class='time'>{{reply.act_time}}</span>
						<hr class="qFixer" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if($logged_in): ?>
	<div class="commentForm">
		<textarea name="comment_text" id="comment_text" required></textarea>
		<a href="javascript:void(0);" class="btnDefault btnComment rc">Comment</a>
		<hr class="qFixer" />
		<div class="comment_result"></div>
	</div>
	<div class="replyHolder none">
		<div class="replyForm" id="replyForm">
			<textarea name="reply_text" id="reply_text" required></textarea>
			<a href="javascript:void(0);" class="btnDefault btnReply rc">Reply</a>
			<hr class="qFixer" />
			<div class="reply_result"></div>
		</div>
	</div>
	<?php endif; ?>
</div>



