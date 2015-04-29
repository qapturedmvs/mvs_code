<script type="text/javascript">
	var commentPage = true;
</script>
<div class="commentbox">
	<?php if($logged_in): ?>
	<div class="commentForm">
		<textarea name="comment_text" id="comment_text" required></textarea>
		<a href="javascript:void(0);" class="btnDefault btnComment rc">Comment</a>
		<div class="spoilerChkHolder">
			<input type="checkbox" name="comment_spl" id="comment_spl" />
			<label for="comment_spl">This review including spoiler</label>
		</div>
		<hr class="qFixer" />
		<div class="comment_result"></div>
	</div>
	<?php $this->load->view('components/_reply_edit_box'); ?>
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
					<div act-id="{{item.feed_id}}" class="feedHolder rv{{item.act_type_id}}">
						<div class="feedContent">
							<div class="userInfo"> <a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
								<hr class="qFixer" />
							</div>
							<div class="feedInfo">
								<div class="textContent">
									<div class="text">{{item.feed_text}}</div>
								</div>
								<div class="time"><span title="{{item.feed_time}}">{{item.feed_ago}}</span></div>
								<hr class="qFixer" />
							</div>
							<hr class="qFixer" />
							<?php if($logged_in): ?>
							<div class="feedControls">
								<div class="generalControls">
									<a onclick="moveReplyFrom(this)" class="btnReply" href="javascript:void(0);">Reply</a>
									<div class="rateHolder feedRate"><a class="rateUp" ng-class="{active:item.usr_rate_value != 1}" href="javascript:void(0);">Up <small>{{item.feed_pos_rate}}</small></a><a class="rateDown" ng-class="{active:item.usr_rate_value != -1}" href="javascript:void(0);">Down <small>{{item.feed_neg_rate}}</small></a></div>
								</div>
								<div class="ownerControls" ng-if="item.owner == 1">
									<a class="btnEdit" href="javascript:void(0);" ng-if="item.feed_ref_count == null">Edit</a>
									<a class="btnRemove" href="javascript:void(0);">Remove</a>
								</div>
							</div>
							<?php endif; ?>
							<hr class="qFixer" />
						</div>
						<div class="refHolder" ng-if="item.feed_ref_count != null">
							<a class="btnShowReplies" href="javascript:void(0);" ng-if="item.feed_ref_count > 2">{{item.feed_ref_count - 2}} more reviews</a>
							<div class="refs">
								<div act-id="{{ref.feed_id}}" class="feedListItem reviewItem refItem" ng-repeat='ref in item.ref'>
									<div class="userInfo"> <a href="<?php echo $site_url; ?>user/wall/actions/{{ref.usr_nick}}" title="{{ref.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{ref.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
										<div class="textContent">
											<div class="text">{{ref.feed_text}}</div>
										</div>
										<div class="time"><span title="{{ref.feed_time}}">{{ref.feed_ago}}</span></div>
										<hr class="qFixer" />
										<?php if($logged_in): ?>
										<div class="feedControls">
											<div class="generalControls">
												<div class="rateHolder feedRate"><a class="rateUp" ng-class="{active:ref.usr_rate_value != 1}" href="javascript:void(0);">Up <small>{{ref.feed_pos_rate}}</small></a><a class="rateDown" ng-class="{ref:item.usr_rate_value != -1}" href="javascript:void(0);">Down <small>{{ref.feed_neg_rate}}</small></a></div>
											</div>
											<div class="ownerControls" ng-if="ref.owner == 1">
												<a class="btnEdit" href="javascript:void(0);">Edit</a>	
												<a class="btnRemove" href="javascript:void(0);">Remove</a>
											</div>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					</li>
				
			</ul>
		</div>
	</div>
</div>