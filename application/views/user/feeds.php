<div class="pageDefault pageFeeds">
	<?php $this->load->view('components/_the_user'); ?>
	<div class="titleDefault titleFeeds">
		<h1>Feeds</h1>
	</div>
	<div class="replyHolder none">
		<div class="replyForm" id="replyForm">
			<textarea name="reply_text" id="reply_text" required></textarea>
			<a href="javascript:void(0);" class="btnDefault btnReply rc">Reply</a>
			<div class="spoilerChkHolder">
				<input type="checkbox" name="reply_spl" id="reply_spl" />
				<label for="reply_spl">This review including spoiler</label>
			</div>
			<hr class="qFixer" />
			<div class="reply_result"></div>
		</div>
	</div>
	<div class="ReviewListHolder feedsHolder" ng-controller='userFeeds'>
		<div infinite-scroll='reddit.nextPage()' infinite-scroll-disabled='reddit.busy' infinite-scroll-distance='0'>
			<ul>
				<li class="listItem feedsItem" ng-repeat='item in reddit.items' ng-class="{items:item.type == 0, pageSep:item.type == 1, noData:item.type == 2, yearSep:item.type == 3}">
					<div ng-switch="item.type">
						<div ng-switch-when='0'>
							<?php //User review to a movie ?>
							<div act-id="{{item.feed_id}}" class="feedHolder rv2" ng-if="item.feed_type == 'rv' && item.act_type_id == 2" ng-class="{spl:item.act_spl_fl == 1}">
								<div class="feedContent">
									<div class="userInfo">
										<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
										<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
										<div class="textContent">
											<div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
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
											<div class="rateHolder feedRate">
												<a class="rateUp" ng-class="{active:item.usr_rate_value != 1}" href="javascript:void(0);">Up <small ng-if="item.feed_pos_rate != null">{{item.feed_pos_rate}}</small><small ng-if="item.feed_pos_rate == null">0</small></a>
												<a class="rateDown" ng-class="{active:item.usr_rate_value != -1}" href="javascript:void(0);">Down <small ng-if="item.feed_neg_rate != null">{{item.feed_neg_rate}}</small><small ng-if="item.feed_neg_rate == null">0</small></a>
											</div>
										</div>
										<div class="ownerControls" ng-if="item.owner == 1">
											<a class="btnEdit" href="javascript:void(0);" ng-if="item.feed_ref_count == null">Edit</a>
											<a class="btnRemove" href="javascript:void(0);">Remove</a>
										</div>
									</div>
									<?php endif; ?>
								</div>
								<div class="refHolder" ng-if="item.feed_ref_count != null">
									<a class="btnShowReplies" href="javascript:void(0);" ng-if="item.feed_ref_count > 2">{{item.feed_ref_count - 2}} more reviews</a>
									<div class="refs">
										<div act-id="{{ref.feed_id}}" class="listItem wallItem refItem" ng-repeat="ref in item.ref" ng-class="{spl:ref.act_spl_fl == 1}">
											<div class="feedContent">
												<div class="userInfo">
												<a href="<?php echo $site_url; ?>user/wall/actions/{{ref.usr_nick}}" title="{{ref.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{ref.usr_avatar}}"></a>
												<hr class="qFixer" />
												</div>
												<div class="feedInfo">
													<div class="textContent">
														<div class="text">{{ref.feed_text}}</div>
													</div>
													<div class="time"><span title="{{item.feed_time}}">{{ref.feed_ago}}</span></div>
													<hr class="qFixer" />
												</div>
												<?php if($logged_in): ?>
												<div class="feedControls">
													<div class="generalControls">
														<div class="rateHolder feedRate">
															<a class="rateUp" ng-class="{active:ref.usr_rate_value != 1}" href="javascript:void(0);">Up <small ng-if="ref.feed_pos_rate != null">{{ref.feed_pos_rate}}</small><small ng-if="ref.feed_pos_rate == null">0</small></a>
															<a class="rateDown" ng-class="{active:ref.usr_rate_value != -1}" href="javascript:void(0);">Down <small ng-if="ref.feed_neg_rate != null">{{ref.feed_neg_rate}}</small><small ng-if="ref.feed_neg_rate == null">0</small></a>
														</div>
													</div>
													<div class="ownerControls" ng-if="ref.owner == 1">
														<a class="btnEdit" href="javascript:void(0);">Edit</a>	
														<a class="btnRemove" href="javascript:void(0);">Remove</a>
													</div>
												</div>
											<?php endif; ?>
											</div>
											<hr class="qFixer" />
										</div>
									</div>
								</div>
							</div>
							
							<?php //User review to a custom list ?>
							<div act-id="{{item.feed_id}}" class="feedHolder rv4" ng-if="item.feed_type == 'rv' && item.act_type_id == 4" ng-class="{spl:item.act_spl_fl == 1}">
								<div class="feedContent">
									<div class="userInfo">
										<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
									<div class="textContent">
										<div class="title"><a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a></div>
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
											<div class="rateHolder feedRate">
												<a class="rateUp" ng-class="{active:item.usr_rate_value != 1}" href="javascript:void(0);">Up <small ng-if="item.feed_pos_rate != null">{{item.feed_pos_rate}}</small><small ng-if="item.feed_pos_rate == null">0</small></a>
												<a class="rateDown" ng-class="{active:item.usr_rate_value != -1}" href="javascript:void(0);">Down <small ng-if="item.feed_neg_rate != null">{{item.feed_neg_rate}}</small><small ng-if="item.feed_neg_rate == null">0</small></a>
											</div>
										</div>
										<div class="ownerControls" ng-if="item.owner == 1">
											<a class="btnEdit" href="javascript:void(0);" ng-if="item.feed_ref_count == null">Edit</a>
											<a class="btnRemove" href="javascript:void(0);">Remove</a>
										</div>
									</div>
									<?php endif; ?>
								</div>
								<div class="refHolder" ng-if="item.feed_ref_count != null">
									<a class="btnShowReplies" href="javascript:void(0);" ng-if="item.feed_ref_count > 2">{{item.feed_ref_count - 2}} more reviews</a>
									<div class="refs">
										<div act-id="{{ref.feed_id}}" class="listItem wallItem refItem" ng-repeat="ref in item.ref" ng-class="{spl:ref.act_spl_fl == 1}">
											<div class="feedContent">
												<div class="userInfo">
													<a href="<?php echo $site_url; ?>user/wall/actions/{{ref.usr_nick}}" title="{{ref.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{ref.usr_avatar}}"></a>
													<hr class="qFixer" />
												</div>
												<div class="feedInfo">
													<div class="textContent">
														<div class="text">{{ref.feed_text}}</div>
													</div>
													<div class="time"><span title="{{item.feed_time}}">{{ref.feed_ago}}</span></div>
													<hr class="qFixer" />
												</div>
												<hr class="qFixer" />
											</div>
											<?php if($logged_in): ?>
											<div class="feedControls">
												<div class="generalControls">
													<a onclick="moveReplyFrom(this)" class="btnReply" href="javascript:void(0);">Reply</a>
													<div class="rateHolder feedRate">
															<a class="rateUp" ng-class="{active:ref.usr_rate_value != 1}" href="javascript:void(0);">Up <small ng-if="ref.feed_pos_rate != null">{{ref.feed_pos_rate}}</small><small ng-if="ref.feed_pos_rate == null">0</small></a>
															<a class="rateDown" ng-class="{active:ref.usr_rate_value != -1}" href="javascript:void(0);">Down <small ng-if="ref.feed_neg_rate != null">{{ref.feed_neg_rate}}</small><small ng-if="ref.feed_neg_rate == null">0</small></a>
														</div>
												</div>
												<div class="ownerControls" ng-if="ref.owner == 1">
													<a class="btnEdit" href="javascript:void(0);">Edit</a>	
													<a class="btnRemove" href="javascript:void(0);">Remove</a>
												</div>
											</div>
											<?php endif; ?>
										</div>
										<hr class="qFixer" />
									</div>
								</div>
							</div>

							<?php //User's custom list create action ?>
							<div list-id="{{item.feed_id}}" class="feedHolder clist" ng-if="item.feed_type == 'cl'">
								<div class="feedContent">
									<div class="userInfo">
										<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
									<div class="textContent">
										<div class="listCover" ng-if="item.list_data_slugs != null">
											<a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">
											<ul>
												<li ng-repeat="cld in item.cld" class="lazy" data-original="<?php echo $site_url; ?>{{cld.cover}}"></li>
											</ul>
											<hr class="qFixer" />
											</a>
										</div>
										<div class="title"><a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">{{item.list_title}} <small>({{item.list_data_count}})</small></a></div>
										<div class="text">
											<p ng-if="item.list_data_slugs == null">Custom List Created</p>
											<ul class="customList" ng-if="item.list_data_slugs != null">
												<li ng-repeat="cld in item.cld">{{cld.title}}</li>
											</ul>
											<hr class="qFixer" />
											<a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">Show Full List</a>
										</div>
										<hr class="qFixer" />
									</div>
									<div class="time"><span title="{{item.feed_time}}">{{item.feed_ago}}</span></div>
									<hr class="qFixer" />
									</div>
									<hr class="qFixer" />
								</div>
								<?php if($logged_in): ?>
									<div class="feedControls">
									<div class="generalControls">
										<div class="rateHolder feedRate">
												<a class="rateUp" ng-class="{active:item.usr_rate_value != 1}" href="javascript:void(0);">Up <small ng-if="item.feed_pos_rate != null">{{item.feed_pos_rate}}</small><small ng-if="item.feed_pos_rate == null">0</small></a>
												<a class="rateDown" ng-class="{active:item.usr_rate_value != -1}" href="javascript:void(0);">Down <small ng-if="item.feed_neg_rate != null">{{item.feed_neg_rate}}</small><small ng-if="item.feed_neg_rate == null">0</small></a>
											</div>
									</div>
								</div>
								<?php endif; ?>
							</div>
							
							<?php //User's seen action ?>
							<div seen-id="{{item.feed_id}}" class="feedHolder seen" ng-if="item.feed_type == 'sn'">
								<div class="feedContent" ng-if="item.total_seen <= 1">
									<div class="userInfo">
										<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
									<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
									<div class="textContent">
										<div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
										<div class="text">Marked as Seen</div>
									</div>
									<div class="time"><span title="{{item.feed_time}}">{{item.feed_ago}}</span></div>
									<hr class="qFixer" />
									</div>
									<hr class="qFixer" />
								</div>
								<?php //Group seen action ?>
								<div class="feedContent" ng-if="item.total_seen > 1">
									<div class="feedInfo">
									<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
									<div class="textContent">
										<div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
										<div class="text">
											<span class="grp">
												<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a><span ng-repeat="grp in item.grp">, <a href="<?php echo $site_url; ?>user/wall/actions/{{grp.usr_nick}}"><span ng-if="grp.owner == 0">{{grp.usr_name}}</span><span ng-if="grp.owner == 1">You</span></a></span>
												<span ng-if="(item.total_seen - item.seen_count) > 0"> and <a href="javascript:void(0);">{{item.total_seen - item.seen_count}} other</a></span>
											</span>
											Marked as Seen
										</div>
									</div>
									<hr class="qFixer" />
									</div>
									<hr class="qFixer" />
								</div>
		
							</div>
							
							<?php //User's add to watchlist action ?>
							<div wtc-id="{{item.feed_id}}" class="feedHolder wtc" ng-if="item.feed_type == 'wt'">
								<div class="feedContent">
									<div class="userInfo">
										<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
									<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
									<div class="textContent">
										<div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
										<div class="text">Added to Watchlist</div>
									</div>
									<div class="time"><span title="{{item.feed_time}}">{{item.feed_ago}}</span></div>
									<hr class="qFixer" />
									</div>
									<hr class="qFixer" />
								</div>
							</div>
							
							<?php //User earned a badge ?>
							<div bdg-id="{{item.feed_id}}" class="feedHolder bdg" ng-if="item.feed_type == 'bg'">
								<div class="feedContent">
									<div class="userInfo">
										<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
									<div class="textContent">
										<div class="text">You Won a Badge</div>
										<div class="title">{{item.bdg_type_title}}</div>
									</div>
									<div class="time"><span title="{{item.feed_time}}">{{item.feed_ago}}</span></div>
									<hr class="qFixer" />
									</div>
									<hr class="qFixer" />
								</div>
							</div>
					</div>
            <!-- <div ng-switch-when='1'><b>PAGE {{item.paging}}</b></div> -->
            <div ng-switch-when='2'><b>{{item.result}}</b></div>
            <!-- <div ng-switch-when='3'><b>{{item.result}}</b></div> -->
          </div>
				</li>
			</ul>
			<div ng-show='reddit.loading'>Loading data...</div>
      <button ng-show='reddit.btnState' ng-click="reddit.nextPage()">Load More</button>
		</div>
		<hr class="qFixer" />
	</div>
</div>