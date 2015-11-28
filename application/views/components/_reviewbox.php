<?php
	$ajxUrl = (isset($movie)) ? '/ajx/reviews_ajx/movie?mvs_id='.$movie['mvs_id'] : '/ajx/reviews_ajx/list_id='.$list['list_id'];
?>
<script type="text/javascript">
	var review = true;
</script>
<div class="reviewbox">
	<?php if($logged_in): ?>
	<script src="<?php echo site_url('js/ckeditor/ckeditor.js'); ?>"></script>
	<div class="revFormHolder qFixer">
		<a href="<?php echo '/user/wall/actions/'.$user['usr_nick']; ?>" class="usrAvatar lazy" data-original="<?php echo get_user_avatar($user['usr_avatar']); ?>"></a>
		<div class="revForm qFixer">
			<textarea name="rev_text" id="rev_text" placeholder="Write a review..."></textarea>
			<div class="controls qFixer">
				<span class="splChk qFixer">
					<button class="chkDefault chkRevSpl">This review include spoiler</button>
				</span>
				<button class="btnDefaultSmall btnPostReview rc" onclick="qptAction.addReview(this);">Post</button>
			</div>
			<div class="sys-msg-default sys--default small spriteBefore"></div>
		</div>
	</div>
	<?php $this->load->view('components/_reply_edit_box'); ?>
	<?php endif; ?>
	<div ng-controller="revRpt" class="revboxHolder">
		<div class="revHolder" rel="{{items.length}}" ng-class="{block:items.length > 0}">
			<div class="tabDefault tabReview">
				<ul class="qFixer">
					<li class="selected" rel="topReviews"><button data-uri="<?php echo $ajxUrl; ?>&type=nwf" ng-click="clicked($event);">Top reviews</button></li>
					<?php if($logged_in): ?>
					<li rel="myNetwork"><button data-uri="<?php echo $ajxUrl; ?>&type=myn" ng-click="clicked($event);">My network</button></li>
					<?php endif; ?>
					<li rel="allReviews"><button data-uri="<?php echo $ajxUrl; ?>&type=all" ng-click="clicked($event);">All reviews</button></li>
				</ul>
			</div>
			<div class="revItemHolder" ng-if="items.length > 0">
				<article class="listItem revItem qFixer rv{{item.act_type_id}}" ng-repeat="item in items" data-itm-id="{{item.feed_id}}" ng-class="{spl:item.act_spl_fl == 1}">
					<div class="revL left"><a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a></div>
					<div class="revR">
						<div class="revInfo">
							<a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a>
							<small>{{item.feed_ago}}</small>
						</div>
						<div class="revContent">
							<div class="text" ng-if="item.text_char <= 500" ng-bind-html="item.feed_text | unsafe"></div>
							<div class="text" ng-if="item.text_char > 500" ng-bind-html="item.text_start | unsafe">
								<span class="dots">... </span>
								<a class="readMore" onclick="readMore(this);">see more</a>
							</div>
						</div>
						<?php if($logged_in): ?>
						<div class="revControls qFixer">
							<div class="general qFixer">
								<span class="rateHolder feedRate">
									<button class="rateUp spriteAfter" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != 1}">{{item.feed_pos_rate}}</button>
									<b></b>
									<button class="rateDown spriteBefore" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != -1}">{{item.feed_neg_rate}}</button>
								</span>
								<button onclick="qptAction.moveReviewBox(this);" class="lnkDefault lnkReply">Reply</button>
							</div>
							<div class="owner qFixer" ng-if="item.owner == 1">
								<button class="lnkDefault lnkEdit" onclick="qptAction.editReview(this);" ng-if="item.feed_ref_count == null">Edit</button>
								<button class="lnkDefault lnkRemove" type="rev" onclick="qptAction.confirmation(this);">Remove</button>
							</div>
						</div>
						<?php endif; ?>
						<div ng-if="item.act_spl_fl == 1" class="spoilerControls"><span class="spriteBefore">Spoiler Alert</span><button onclick="showSpoiler(this);">Reveal</button></div>
						<div class="revReply" ng-if="item.feed_ref_count != null">
							<div class="repListTop"><button class="lnkDefault lnkMore" ng-if="item.feed_ref_count > 2">{{item.feed_ref_count - 2}} more reviews</button></div>
							<div class="replies">
								<article class="listItem revItem qFixer rv{{rep.act_type_id}}" ng-repeat="rep in item.ref" data-itm-id="{{rep.feed_id}}" ng-class="{spl:rep.act_spl_fl == 1}">
									<div class="revL left"><a href="/user/wall/actions/{{rep.usr_nick}}" title="{{rep.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{rep.usr_avatar}}"></a></div>
									<div class="revR">
										<div class="revInfo">
											<a href="/user/wall/actions/{{rep.usr_nick}}">{{rep.usr_name}}</a>
											<small>{{rep.feed_ago}}</small>
										</div>
										<div class="revContent">
											<div class="text" ng-if="rep.text_char <= 500" ng-bind-html="rep.feed_text | unsafe"></div>
											<div class="text" ng-if="rep.text_char > 500" ng-bind-html="rep.text_start | unsafe">
												<span class="dots">... </span>
												<a class="readMore" onclick="readMore(this);">see more</a>
											</div>
										</div>
										<?php if($logged_in): ?>
										<div class="revControls qFixer">
											<div class="general qFixer">
												<span class="rateHolder feedRate">
													<button class="rateUp spriteAfter" onclick="rateButton(this);" ng-class="{active:rep.usr_rate_value != 1}">{{rep.feed_pos_rate}}</button>
													<b></b>
													<button class="rateDown spriteBefore" onclick="rateButton(this);" ng-class="{active:rep.usr_rate_value != -1}">
{{rep.feed_neg_rate}}</button>
												</span>
											</div>
											<div class="owner qFixer" ng-if="rep.owner == 1">
												<button class="lnkDefault lnkEdit" onclick="qptAction.editReview(this);">Edit</button>
												<button class="lnkDefault lnkRemove" type="rev" onclick="qptAction.confirmation(this);">Remove</button>
											</div>
										</div>
										<?php endif; ?>
										<div ng-if="rep.act_spl_fl == 1" class="spoilerControls"><span class="spriteBefore">Spoiler Alert</span><a onclick="showSpoiler(this);">Reveal</a></div>
									</div>
								</article>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>