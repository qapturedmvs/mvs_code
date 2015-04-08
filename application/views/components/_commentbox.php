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
				<?php if($logged_in): ?>
				<li><a href="javascript:void(0);">My Network</a></li>
				<?php endif; ?>
			</ul>
			<hr class="qFixer" />
		</div>
		<div class="commentsContent">
			<ul>
				
				<li class="feedListItem reviewItem" ng-repeat='item in items'>
					<div act-id="{{item.act_id}}" class="feedHolder rv2 mov">
						<div class="feedContent">
							<div class="userInfo"> <a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
								<hr class="qFixer" />
							</div>
							<div class="feedInfo">
								<div class="textContent">
									<div class="text">{{item.act_text}}</div>
								</div>
								<div class="time">{{item.act_time}}</div>
								<hr class="qFixer" />
							</div>
							<hr class="qFixer" />
							<?php if($logged_in): ?>
							<div class="feedControls">
								<a onclick="moveReplyFrom(this)" class="btnReply" href="javascript:void(0);">Reply</a>
								<div class="feedOwnerControls" ng-if="item.owner == 1">
									<a class="btnEdit" href="javascript:void(0);">Edit</a>
									<a class="btnRemove" href="javascript:void(0);">Remove</a>
								</div>
							</div>
							<div class="feedRate"><a class="rateUp" href="javascript:void(0);">Up <small>{{item.feed_rates_pos}}</small></a><a class="rateDown" href="javascript:void(0);">Down <small>{{item.feed_rates_neg}}</small></a></div>
							<?php endif; ?>
							<a class="btnShowReplies" href="javascript:void(0);">X more reviews</a>
							<hr class="qFixer" />
						</div>
						<div class="refs">
							<div act-id="{{ref.act_id}}" class="feedListItem reviewItem refItem" ng-repeat='ref in item.ref'>
								<div class="userInfo"> <a href="<?php echo $site_url; ?>user/wall/actions/{{ref.usr_nick}}" title="{{ref.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{ref.usr_avatar}}"></a>
									<hr class="qFixer" />
								</div>
								<div class="feedInfo">
									<div class="textContent">
										<div class="text">{{ref.act_text}}</div>
									</div>
									<div class="time">{{ref.act_time}}</div>
									<hr class="qFixer" />
									<?php if($logged_in): ?>
									<div class="feedControls" ng-if="ref.owner == 1"> <a class="btnEdit" href="javascript:void(0);">Edit</a> <a class="btnRemove" href="javascript:void(0);">Remove</a> </div>
									<div class="feedRate"><a class="rateUp" href="javascript:void(0);">Up <small>{{ref.feed_rates_pos}}</small></a><a class="rateDown" href="javascript:void(0);">Down <small>{{ref.feed_rates_neg}}</small></a></div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					</li>
				
			</ul>
		</div>
	</div>
</div>