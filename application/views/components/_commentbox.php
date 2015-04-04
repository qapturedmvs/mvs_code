<script type="text/javascript">
	var commentPage = true;
</script>
<div class="commentbox">
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
				<div class="userInfo">
						<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
						<hr class="qFixer" />
					</div>
				<div class="reviewContent">
					<span class='text'>{{item.act_text}}</span> 
					<span class='time'>{{item.act_time}}</span>
				</div>
				<?php if($logged_in): ?>
				<span ng-if="item.act_ref_id==0" class="btnHolder">
						<a onclick="moveReplyFrom(this)" href="javascript:void(0);" class="btnReply">Reply</a>
				</span>
				<?php endif; ?>
				<a class="btnShowReplies" onclick="showMore(this)" href="javascript:void(0);">Show more</a>
				<hr class="qFixer" />
				<div class="commentReplies">
					<div act-ref-id="{{item.act_id}}" class="commentItem subComment" ng-repeat='reply in item.reply'>
						<div class="userInfo">
							<a href="<?php echo $site_url; ?>user/wall/actions/{{reply.usr_nick}}" title="{{reply.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{reply.usr_avatar}}"></a>
							<hr class="qFixer" />
						</div>
						<div class="reviewContent">
							<span class='text'>{{reply.act_text}}</span> 
							<span class='time'>{{reply.act_time}}</span>
						</div>
						<hr class="qFixer" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>