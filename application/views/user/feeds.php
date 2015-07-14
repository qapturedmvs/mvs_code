<script src="<?php echo site_url('js/ckeditor/ckeditor.js'); ?>"></script>
<div class="pageDefault pageFeeds">
	<?php $this->load->view('components/_the_user'); ?>
	<div class="titleDefault titleFeeds">
		<h1>Feeds</h1>
	</div>
	<?php $this->load->view('components/_reply_edit_box'); ?>
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
											<div class="text" ng-if="item.text_char <= 500" ng-bind-html="item.feed_text | unsafe"></div>
											<div class="text" ng-if="item.text_char > 500" ng-bind-html="item.text_start | unsafe">
												<span class="dots">...</span>
												<a class="readMore" onclick="readMore(this);" href="javascript:void(0);">Read more</a>
												<span class="textEnd" ng-bind-html="item.text_end | unsafe">
													<a class="hideMore" onclick="readMore(this);" href="javascript:void(0);">Hide more</a>
												</span>
											</div>
											<div ng-if="item.act_spl_fl == 1" class="spoilerControls"><span>Spoiler Alert</span><a onclick="showSpoiler(this);" href="javascript:void(0);">Reveal</a></div>
										</div>
										<div class="time"><span title="{{item.feed_time}}">{{item.feed_ago}}</span></div>
										<hr class="qFixer" />
									</div>
									<hr class="qFixer" />
									<?php if($logged_in): ?>
									<div class="feedControls">
										<div class="generalControls">
											<a onclick="moveReplyFrom(this);" class="btnReply" href="javascript:void(0);">Reply</a>
											<div class="rateHolder feedRate">
												<a class="rateUp" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != 1}" href="javascript:void(0);">Up <small ng-if="item.feed_pos_rate != null">{{item.feed_pos_rate}}</small><small ng-if="item.feed_pos_rate == null">0</small></a>
												<a class="rateDown" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != -1}" href="javascript:void(0);">Down <small ng-if="item.feed_neg_rate != null">{{item.feed_neg_rate}}</small><small ng-if="item.feed_neg_rate == null">0</small></a>
											</div>
										</div>
										<div class="ownerControls" ng-if="item.owner == 1">
											<a class="btnEdit" onclick="editReview(this);" href="javascript:void(0);" ng-if="item.feed_ref_count == null">Edit</a>
											<a class="btnRemove" type="rev" onclick="confirmation(this);" href="javascript:void(0);">Remove</a>
										</div>
									</div>
									<?php endif; ?>
								</div>
								<div class="refHolder" ng-if="item.feed_ref_count != null">
									<a class="btnShowReplies" onclick="ShowReplies(this);" href="javascript:void(0);" ng-if="item.feed_ref_count > 2">{{item.feed_ref_count - 2}} more reviews</a>
									<div class="refs">
										<div act-id="{{ref.feed_id}}" class="listItem refItem" ng-repeat="ref in item.ref" ng-class="{spl:ref.act_spl_fl == 1}">
											<div class="feedContent">
												<div class="userInfo">
												<a href="<?php echo $site_url; ?>user/wall/actions/{{ref.usr_nick}}" title="{{ref.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{ref.usr_avatar}}"></a>
												<hr class="qFixer" />
												</div>
												<div class="feedInfo">
													<div class="textContent">
														<div class="text" ng-if="item.text_char <= 500">{{item.feed_text}}</div>
														<div class="text" ng-if="item.text_char > 500">{{item.text_start}}<span class="dots">...</span> <a class="readMore" onclick="readMore(this);" href="javascript:void(0);">Read more</a><span class="textEnd">{{item.text_end}} <a class="hideMore" onclick="readMore(this);" href="javascript:void(0);">Hide more</a></span></div>
												<div ng-if="ref.act_spl_fl == 1" class="spoilerControls"><span>Spoiler Alert</span><a onclick="showSpoiler(this);" href="javascript:void(0);">Reveal</a></div>
													</div>
													<div class="time"><span title="{{item.feed_time}}">{{ref.feed_ago}}</span></div>
													<hr class="qFixer" />
												</div>
												<?php if($logged_in): ?>
												<div class="feedControls">
													<div class="generalControls">
														<div class="rateHolder feedRate">
															<a class="rateUp" onclick="rateButton(this);" ng-class="{active:ref.usr_rate_value != 1}" href="javascript:void(0);">Up <small ng-if="ref.feed_pos_rate != null">{{ref.feed_pos_rate}}</small><small ng-if="ref.feed_pos_rate == null">0</small></a>
															<a class="rateDown" onclick="rateButton(this);" ng-class="{active:ref.usr_rate_value != -1}" href="javascript:void(0);">Down <small ng-if="ref.feed_neg_rate != null">{{ref.feed_neg_rate}}</small><small ng-if="ref.feed_neg_rate == null">0</small></a>
														</div>
													</div>
													<div class="ownerControls" ng-if="ref.owner == 1">
														<a class="btnEdit" onclick="editReview(this);" href="javascript:void(0);">Edit</a>	
														<a class="btnRemove" type="rev" onclick="confirmation(this);" href="javascript:void(0);">Remove</a>
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
										<div class="text" ng-if="item.text_char <= 500">{{item.feed_text}}</div>
										<div class="text" ng-if="item.text_char > 500">{{item.text_start}}<span class="dots">...</span> <a class="readMore" onclick="readMore(this);" href="javascript:void(0);">Read more</a><span class="textEnd">{{item.text_end}} <a class="hideMore" onclick="readMore(this);" href="javascript:void(0);">Hide more</a></span></div>
									<div ng-if="item.act_spl_fl == 1" class="spoilerControls"><span>Spoiler Alert</span><a onclick="showSpoiler(this);" href="javascript:void(0);">Reveal</a></div>
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
												<a class="rateUp" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != 1}" href="javascript:void(0);">Up <small ng-if="item.feed_pos_rate != null">{{item.feed_pos_rate}}</small><small ng-if="item.feed_pos_rate == null">0</small></a>
												<a class="rateDown" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != -1}" href="javascript:void(0);">Down <small ng-if="item.feed_neg_rate != null">{{item.feed_neg_rate}}</small><small ng-if="item.feed_neg_rate == null">0</small></a>
											</div>
										</div>
										<div class="ownerControls" ng-if="item.owner == 1">
											<a class="btnEdit" onclick="editReview(this);" href="javascript:void(0);" ng-if="item.feed_ref_count == null">Edit</a>
											<a class="btnRemove" type="rev" onclick="confirmation(this);" href="javascript:void(0);">Remove</a>
										</div>
									</div>
									<?php endif; ?>
								</div>
								<div class="refHolder" ng-if="item.feed_ref_count != null">
									<a class="btnShowReplies" onclick="ShowReplies(this);" href="javascript:void(0);" ng-if="item.feed_ref_count > 2">{{item.feed_ref_count - 2}} more reviews</a>
									<div class="refs">
										<div act-id="{{ref.feed_id}}" class="listItem wallItem refItem" ng-repeat="ref in item.ref" ng-class="{spl:ref.act_spl_fl == 1}">
											<div class="feedContent">
												<div class="userInfo">
													<a href="<?php echo $site_url; ?>user/wall/actions/{{ref.usr_nick}}" title="{{ref.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{ref.usr_avatar}}"></a>
													<hr class="qFixer" />
												</div>
												<div class="feedInfo">
													<div class="textContent">
														<div class="text" ng-if="item.text_char <= 500">{{item.feed_text}}</div>
														<div class="text" ng-if="item.text_char > 500">{{item.text_start}}<span class="dots">...</span> <a class="readMore" onclick="readMore(this);" href="javascript:void(0);">Read more</a><span class="textEnd">{{item.text_end}} <a class="hideMore" onclick="readMore(this);" href="javascript:void(0);">Hide more</a></span></div>
												<div ng-if="ref.act_spl_fl == 1" class="spoilerControls"><span>Spoiler Alert</span><a onclick="showSpoiler(this);" href="javascript:void(0);">Reveal</a></div>
													</div>
													<div class="time"><span title="{{item.feed_time}}">{{ref.feed_ago}}</span></div>
													<hr class="qFixer" />
												</div>
												<hr class="qFixer" />
											</div>
											<?php if($logged_in): ?>
											<div class="feedControls">
												<div class="generalControls">
													<div class="rateHolder feedRate">
															<a class="rateUp" onclick="rateButton(this);" ng-class="{active:ref.usr_rate_value != 1}" href="javascript:void(0);">Up <small ng-if="ref.feed_pos_rate != null">{{ref.feed_pos_rate}}</small><small ng-if="ref.feed_pos_rate == null">0</small></a>
															<a class="rateDown" onclick="rateButton(this);" ng-class="{active:ref.usr_rate_value != -1}" href="javascript:void(0);">Down <small ng-if="ref.feed_neg_rate != null">{{ref.feed_neg_rate}}</small><small ng-if="ref.feed_neg_rate == null">0</small></a>
														</div>
												</div>
												<div class="ownerControls" ng-if="ref.owner == 1">
													<a class="btnEdit" onclick="editReview(this);" href="javascript:void(0);">Edit</a>	
													<a class="btnRemove" type="rev" onclick="confirmation(this);" href="javascript:void(0);">Remove</a>
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
							</div>
							
							<?php //User's seen action ?>
							<div seen-id="{{item.feed_id}}" class="feedHolder seen" ng-if="item.feed_type == 'sn'">
								
								<?php //Single seen action ?>
								<div class="feedContent {{item.seen_type}}" ng-if="item.seen_type == 'single_seen'">
									<div class="userInfo">
										<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
									<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
									<div class="textContent">
										<div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
										<div class="text">Marked as Seen</div>
										<div class="movieActions" ng-if="item.owner == 0">
											<ul>
												<li class="seenMovie singleSeen"><a data-itm-id="{{item.usr_seen_fl}}" href="javascript:void(0);" onclick="s_seen(this)">Watched</a></li>
												<li class="addToList"><a href="javascript:void(0);">Add to list</a>
													<div class="listSelection">
														<ul class="cLists">
															<li class="wtc addtoWtc"><a data-itm-id="{{item.usr_wtc_fl}}" onclick="s_watchlist(this)" href="javascript:void(0);">Watchlist</a></li>
														</ul>
														<hr class="qFixer" />
													</div>
												</li>
											</ul>
											<hr class="qFixer" />
										</div>
									</div>
									<div class="time"><span title="{{item.feed_time}}">{{item.feed_ago}}</span></div>
									<hr class="qFixer" />
									</div>
									<hr class="qFixer" />
								</div>
								
								<?php //Movie group seen action ?>
								<div class="feedContent {{item.seen_type}}" ng-if="item.seen_type == 'movie_group_seen'">
									<div class="userInfo">
										<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
										<div class="textContent">
											<div class="text"><a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a> has marked <a class="movieName" href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a>, <a ng-repeat="grp in item.grp" ng-if="$first" class="movieName" href="<?php echo $site_url; ?>movie/{{grp.mvs_slug}}">{{grp.mvs_title}}</a> and <span ng-repeat="grp in item.grp" ng-if="$last">{{$index}}</span> other movies as seen.</div>
										</div>
										<div class="movieGroup">
											<a ng-repeat="grp in item.grp" ng-if="$index >= 1" class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{grp.mvs_poster}}" href="<?php echo $site_url; ?>movie/{{grp.mvs_slug}}" title="{{grp.mvs_title}}"></a>
											<hr class="qFixer" />
										</div>
										<div class="time"><span title="{{item.feed_time}}">{{item.feed_ago}}</span></div>
										<hr class="qFixer" />
									</div>
									<hr class="qFixer" />
								</div>
								
								<?php //User group seen action ?>
								<div class="feedContent {{item.seen_type}}" ng-if="item.seen_type == 'user_group_seen'">
									<div class="feedInfo">
									<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
									<div class="textContent">
										<div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
										<div class="text">

											<span class="grp" ng-if="item.usr_seen_fl == null">
												<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a><span ng-repeat="grp in item.grp">, <a href="<?php echo $site_url; ?>user/wall/actions/{{grp.usr_nick}}">{{grp.usr_name}}</a></span>
												<span ng-if="(item.total_seen - item.seen_count) > 0"> and <a href="javascript:void(0);">{{item.total_seen - item.seen_count}} other</a></span>
											</span>
											
											<span class="grp" ng-if="item.owner == 0 && item.usr_seen_fl != null">
												<a href="<?php echo $site_url.'user/wall/actions/'.$user['usr_nick']; ?>">You</a>, <a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a><span ng-repeat="grp in item.grp">, <a href="<?php echo $site_url; ?>user/wall/actions/{{grp.usr_nick}}">{{grp.usr_name}}</a></span>
												<span ng-if="(item.total_seen - item.seen_count > 0)"> and <a href="javascript:void(0);">{{item.total_seen - item.seen_count}} other</a></span>
											</span>
											
											<span class="grp" ng-if="item.owner == 1">
												<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}">You</a><span ng-repeat="grp in item.grp">, <a href="<?php echo $site_url; ?>user/wall/actions/{{grp.usr_nick}}">{{grp.usr_name}}</a></span>
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
							
							<?php //User's movie applaud action ?>
							<div app-id="{{item.feed_id}}" class="feedHolder app" ng-if="item.feed_type == 'ap'">
								<div class="feedContent">
									<div class="userInfo">
										<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></a>
										<hr class="qFixer" />
									</div>
									<div class="feedInfo">
									<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
									<div class="textContent">
										<div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
										<div class="text">Applaud this movie</div>
									</div>
									<div class="time"><span title="{{item.feed_time}}">{{item.feed_ago}}</span></div>
									<hr class="qFixer" />
									</div>
									<hr class="qFixer" />
								</div>
							</div>
							
							<?php //User's add to watchlist action ?>
							<div mvs-id="{{item.mvs_id}}" class="feedHolder wtc" ng-if="item.feed_type == 'wt'">
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
											<div class="movieActions" ng-if="item.owner == 0">
												<ul>
													<li class="seenMovie singleSeen"><a data-itm-id="{{item.usr_seen_fl}}" href="javascript:void(0);" onclick="s_seen(this)">Watched</a></li>
													<li class="addToList"><a href="javascript:void(0);">Add to list</a>
														<div class="listSelection">
															<ul class="cLists">
																<li class="wtc addtoWtc"><a data-itm-id="{{item.usr_wtc_fl}}" onclick="s_watchlist(this)" href="javascript:void(0);">Watchlist</a></li>
															</ul>
															<hr class="qFixer" />
														</div>
													</li>
												</ul>
												<hr class="qFixer" />
											</div>
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
	<?php $this->load->view('components/_system_messagebox', array('qBox' => 'remove')); ?>
</div>