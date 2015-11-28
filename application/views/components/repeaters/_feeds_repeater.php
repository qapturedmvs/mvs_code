<section class="ReviewListHolder feedsHolder" ng-controller="userFeeds" infinite-scroll="reddit.nextPage()" infinite-scroll-disabled="reddit.busy" infinite-scroll-distance="0">
  <article class="listItem feedItem" ng-repeat="item in reddit.items" ng-switch="item.type" ng-class="{pageSep:item.type == 1, noResult:item.type == 2, yearSep:item.type == 3}">
    <div class="feed" ng-switch-when="0">
      
      <?php //User's review to a movie ?>
			<div data-itm-id="{{item.feed_id}}" class="feedInner rv2" ng-if="item.feed_type == 'rv' && item.act_type_id == 2" ng-class="{spl:item.act_spl_fl == 1}">
        <div class="feedBody">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info"><a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a> on <a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></span>
              <span class="time" title="{{item.feed_time}}">{{item.feed_ago}}</span>
            </div>
            <div class="content movie posterM">
              <div class="contentLeft">
                <a class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}" href="/movie/{{item.mvs_slug}}"></a>
              </div>
              <div class="contentRight">
                <div class="text" ng-if="item.text_char <= 500" ng-bind-html="item.feed_text | unsafe"></div>
                <div class="text" ng-if="item.text_char > 500" ng-bind-html="item.text_start | unsafe">
                  <span class="dots">... </span>
                  <a class="readMore" onclick="readMore(this);">see more</a>
                </div>
                <?php if($logged_in): ?>
								<div class="revControls qFixer">
                  <div class="general qFixer">
                    <span class="rateHolder feedRate" ng-attr-data-itm-id="{{item.usr_rate_value && item.usr_rate_value || 0}}">
                      <button class="rateUp spriteAfter" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != 1}">{{item.feed_pos_rate}}</button>
                      <b></b>
                      <button class="rateDown spriteBefore" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != -1}">{{item.feed_neg_rate}}</button>
                    </span>
                    <button onclick="qptAction.moveReviewBox(this);" class="lnkDefault lnkReply">Reply</button>
                  </div>
                  <div class="owner qFixer" ng-if="item.owner == 1">
                    <button class="lnkDefault lnkEdit" onclick="editReview(this);" ng-if="item.feed_ref_count == null">Edit</button>
                    <button class="lnkDefault lnkRemove" type="rev" onclick="confirmation(this);">Remove</button>
                  </div>
                </div>
                <?php endif; ?>
                <div ng-if="item.act_spl_fl == 1" class="spoilerControls"><span class="spriteBefore">Spoiler Alert</span><button onclick="showSpoiler(this);">Reveal</button></div>
                
                <div class="repHolder" ng-if="item.feed_ref_count != null">
									<button class="lnkDefault lnkMoreReps" onclick="ShowReplies(this);" ng-if="item.feed_ref_count > 2">View all {{item.feed_ref_count}} replies</button>
									<div class="reps">
										<div data-itm-id="{{rep.feed_id}}" class="listItem repItem" ng-repeat="rep in item.ref" ng-class="{spl:rep.act_spl_fl == 1}">
                      <div class="contentLeft">
                        <a href="/user/wall/actions/{{rep.usr_nick}}" title="{{rep.usr_name}}" class="usrAvatar lazy" data-original="{{rep.usr_avatar}}"></a>
                      </div>
                      <div class="contentRight">
                        <div class="feedHead">
                          <span class="info"><a href="/user/wall/actions/{{rep.usr_nick}}">{{rep.usr_name}}</a></span>
                          <span class="time" title="{{rep.feed_time}}">{{rep.feed_ago}}</span>
                        </div>
                        <div class="text" ng-if="rep.text_char <= 500" ng-bind-html="rep.feed_text | unsafe"></div>
												<div class="text" ng-if="rep.text_char > 500" ng-bind-html="rep.text_start | unsafe">
                          <span class="dots">... </span>
                          <button class="readMore" onclick="readMore(this);">see more</button>
                        </div>
                        <?php if($logged_in): ?>
                        <div class="revControls qFixer">
                          <div class="general qFixer">
                            <span class="rateHolder feedRate" ng-attr-data-itm-id="{{rep.usr_rate_value && rep.usr_rate_value || 0}}">
                              <button class="rateUp spriteAfter" onclick="rateButton(this);" ng-class="{active:rep.usr_rate_value != 1}">{{rep.feed_pos_rate}}</button>
                              <b></b>
                              <button class="rateDown spriteBefore" onclick="rateButton(this);" ng-class="{active:rep.usr_rate_value != -1}">
{{rep.feed_neg_rate}}</button>
                            </span>
                          </div>
                          <div class="owner qFixer" ng-if="rep.owner == 1">
                            <button class="lnkDefault lnkEdit" onclick="editReview(this);">Edit</button>
                            <button class="lnkDefault lnkRemove" type="rev" onclick="confirmation(this);">Remove</button>
                          </div>
                        </div>
                        <?php endif; ?>
												<div ng-if="rep.act_spl_fl == 1" class="spoilerControls"><span class="spriteBefore">Spoiler Alert</span><button onclick="showSpoiler(this);">Reveal</button></div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php //User review to a custom list ?>
			<div act-id="{{item.feed_id}}" class="feedInner cList rv4" ng-if="item.feed_type == 'rv' && item.act_type_id == 4" ng-class="{spl:item.act_spl_fl == 1}">
        <div class="feedBody">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info"><a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a> on <a href="/user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a></span>
              <span class="time" title="{{item.feed_time}}">{{item.feed_ago}}</span>
            </div>
            <div class="content posterS">
              <div class="contentLeft qFixer">
                <a href="/user/movies/detail/{{item.list_slug}}">
                  <figure ng-repeat="cld in item.cld" class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{cld.cover}}"></figure>
                </a>
              </div>
              <div class="contentRight">
                <div class="text" ng-if="item.text_char <= 500" ng-bind-html="item.feed_text | unsafe"></div>
                <div class="text" ng-if="item.text_char > 500" ng-bind-html="item.text_start | unsafe">
                  <span class="dots">... </span>
                  <button class="readMore" onclick="readMore(this);">see more</button>
                </div>
                <?php if($logged_in): ?>
								<div class="revControls qFixer">
                  <div class="general qFixer">
                    <span class="rateHolder feedRate" ng-attr-data-itm-id="{{item.usr_rate_value && item.usr_rate_value || 0}}">
                      <button class="rateUp spriteAfter" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != 1}">{{item.feed_pos_rate}}</button>
                      <b></b>
                      <button class="rateDown spriteBefore" onclick="rateButton(this);" ng-class="{active:item.usr_rate_value != -1}">{{item.feed_neg_rate}}</button>
                    </span>
                    <button onclick="qptAction.moveReviewBox(this);" class="lnkDefault lnkReply">Reply</button>
                  </div>
                  <div class="owner qFixer" ng-if="item.owner == 1">
                    <button class="lnkDefault lnkEdit" onclick="editReview(this);" ng-if="item.feed_ref_count == null">Edit</button>
                    <button class="lnkDefault lnkRemove" type="rev" onclick="confirmation(this);">Remove</button>
                  </div>
                </div>
                <?php endif; ?>
                <div ng-if="item.act_spl_fl == 1" class="spoilerControls"><span class="spriteBefore">Spoiler Alert</span><button onclick="showSpoiler(this);">Reveal</button></div>
                
                <div class="repHolder" ng-if="item.feed_ref_count != null">
									<button class="lnkDefault lnkMoreReps" onclick="ShowReplies(this);" ng-if="item.feed_ref_count > 2">View all {{item.feed_ref_count}} replies</button>
									<div class="reps">
										<div data-itm-id="{{rep.feed_id}}" class="listItem repItem" ng-repeat="rep in item.ref" ng-class="{spl:rep.act_spl_fl == 1}">
                      <div class="contentLeft">
                        <a href="/user/wall/actions/{{rep.usr_nick}}" title="{{rep.usr_name}}" class="usrAvatar lazy" data-original="{{rep.usr_avatar}}"></a>
                      </div>
                      <div class="contentRight">
                        <div class="feedHead">
                          <span class="info"><a href="/user/wall/actions/{{rep.usr_nick}}">{{rep.usr_name}}</a></span>
                          <span class="time" title="{{rep.feed_time}}">{{rep.feed_ago}}</span>
                        </div>
                        <div class="text" ng-if="rep.text_char <= 500" ng-bind-html="rep.feed_text | unsafe"></div>
												<div class="text" ng-if="rep.text_char > 500" ng-bind-html="rep.text_start | unsafe">
                          <span class="dots">... </span>
                          <button class="readMore" onclick="readMore(this);">see more</button>
                        </div>
                        <?php if($logged_in): ?>
                        <div class="revControls qFixer">
                          <div class="general qFixer">
                            <span class="rateHolder feedRate" ng-attr-data-itm-id="{{rep.usr_rate_value && rep.usr_rate_value || 0}}">
                              <button class="rateUp spriteAfter" onclick="rateButton(this);" ng-class="{active:rep.usr_rate_value != 1}">{{rep.feed_pos_rate}}</button>
                              <b></b>
                              <button class="rateDown spriteBefore" onclick="rateButton(this);" ng-class="{active:rep.usr_rate_value != -1}">
{{rep.feed_neg_rate}}</button>
                            </span>
                          </div>
                          <div class="owner qFixer" ng-if="rep.owner == 1">
                            <button class="lnkDefault lnkEdit" onclick="editReview(this);">Edit</button>
                            <button class="lnkDefault lnkRemove" type="rev" onclick="confirmation(this);">Remove</button>
                          </div>
                        </div>
                        <?php endif; ?>
												<div ng-if="rep.act_spl_fl == 1" class="spoilerControls"><span class="spriteBefore">Spoiler Alert</span><button onclick="showSpoiler(this);">Reveal</button></div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php //User's seen action ?>
      <div data-itm-id="{{item.feed_id}}" class="feedInner seen" ng-if="item.feed_type == 'sn'">
        
        <?php //Single seen action ?>
        <div class="feedBody sSn" ng-if="item.seen_type == 'single_seen'">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info"><a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a> has watched <a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></span>
              <span class="time" title="{{item.feed_time}}">{{item.feed_ago}}</span>
            </div>
            <div class="content movie posterB">
              <div class="contentLeft">
                <a class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}" href="/movie/{{item.mvs_slug}}" title="{{item.mvs_title}}"></a>
              </div>
              <div class="contentRight">
                <div class="title"><a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a><small>{{item.mvs_year}}</small></div>
                <div class="genres"><span ng-repeat="gnr in item.genres">{{gnr}}</span></div>
                <div class="rating spriteAfter" ng-if="item.mvs_rating != ''">{{item.mvs_rating}}</div>
                <div class="plot" ng-if="item.mvs_plot != null">{{item.mvs_plot}}</div>
                <div class="movieStatus">
                  <i class="sprite iSeen" title="You watched this movie" ng-if="item.usr_seen_fl != 0"></i>
                  <i class="sprite iWtc" title="You have this movie in watchlist" ng-if="item.usr_wtc_fl != 0"></i>
                </div>
              </div>
            </div>                                                
          </div>
        </div>

        <?php //Movie group seen action ?>
        <div class="feedBody mGrpSn" ng-if="item.seen_type == 'movie_group_seen'">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info"><a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a> has marked <a class="movieName" href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a>, <a ng-repeat="grp in item.grp" ng-if="$first" class="movieName" href="/movie/{{grp.mvs_slug}}">{{grp.mvs_title}}</a> <span ng-if="item.grp.length > 1">and {{item.grp.length - 1}} other movies</span> as seen.</span>
            </div>
            <div class="content qFixer posterS">
              <a class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}" href="/movie/{{item.mvs_slug}}" title="{{item.mvs_title}}"></a>
              <a ng-repeat="grp in item.grp" class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{grp.mvs_poster}}" href="/movie/{{grp.mvs_slug}}" title="{{grp.mvs_title}}"></a>
            </div>
            <a href="/user/movies/seen/{{item.usr_nick}}" class="lnkDefault lnkSeeAll">See all</a>
          </div>
        </div>

        <?php //User group seen action ?>
        <div class="feedBody uGrpSn" ng-if="item.seen_type == 'user_group_seen'">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info">
                <span class="grp" ng-if="item.usr_seen_fl == null">
                  <a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a><span ng-repeat="grp in item.grp">, <a href="/user/wall/actions/{{grp.usr_nick}}">{{grp.usr_name}}</a></span>
                  <span ng-if="(item.total_seen - item.seen_count) > 0"> and <button>{{item.total_seen - item.seen_count}} other</button></span>
                </span>
                
                <span class="grp" ng-if="item.owner == 0 && item.usr_seen_fl != null">
                  <a href="<?php echo '/user/wall/actions/'.$user['usr_nick']; ?>">You</a>, <a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a><span ng-repeat="grp in item.grp">, <a href="/user/wall/actions/{{grp.usr_nick}}">{{grp.usr_name}}</a></span>
                  <span ng-if="(item.total_seen - item.seen_count > 0)"> and <a>{{item.total_seen - item.seen_count}} other</a></span>
                </span>
                
                <span class="grp" ng-if="item.owner == 1">
                  <a href="/user/wall/actions/{{item.usr_nick}}">You</a><span ng-repeat="grp in item.grp">, <a href="/user/wall/actions/{{grp.usr_nick}}">{{grp.usr_name}}</a></span>
                  <span ng-if="(item.total_seen - item.seen_count) > 0"> and <a>{{item.total_seen - item.seen_count}} other</a></span>
                </span>
                has watched <a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a>
              </span>
            </div>
            <div class="content movie posterB">
              <div class="contentLeft">
                <a class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}" href="/movie/{{item.mvs_slug}}"></a>
              </div>
              <div class="contentRight">
                <div class="title"><a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a><small>{{item.mvs_year}}</small></div>
                <div class="genres"><span ng-repeat="gnr in item.genres">{{gnr}}</span></div>
                <div class="rating spriteAfter" ng-if="item.mvs_rating != ''">{{item.mvs_rating}}</div>
                <div class="plot" ng-if="item.mvs_plot != null">{{item.mvs_plot}}</div>
                <div class="movieStatus">
                  <i class="sprite iSeen" title="You watched this movie" ng-if="item.usr_seen_fl != 0"></i>
                  <i class="sprite iWtc" title="You have this movie in watchlist" ng-if="item.usr_wtc_fl != 0"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      
      <?php //User's add to watchlist action ?>
      <div data-itm-id="{{item.feed_id}}" class="feedInner wtc" ng-if="item.feed_type == 'wt'">
        
        <?php //Single watchlist action ?>
        <div class="feedBody sWtc" ng-if="item.wtc_type == 'single_wtc'">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info"><a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a> has added to watchlist <a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></span>
              <span class="time" title="{{item.feed_time}}">{{item.feed_ago}}</span>
            </div>
            <div class="content movie posterB">
              <div class="contentLeft">
                <a class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}" href="/movie/{{item.mvs_slug}}" title="{{item.mvs_title}}"></a>
              </div>
              <div class="contentRight">
                <div class="title"><a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a><small>{{item.mvs_year}}</small></div>
                <div class="genres"><span ng-repeat="gnr in item.genres">{{gnr}}</span></div>
                <div class="rating spriteAfter" ng-if="item.mvs_rating != ''">{{item.mvs_rating}}</div>
                <div class="plot" ng-if="item.mvs_plot != null">{{item.mvs_plot}}</div>
                <div class="movieStatus">
                  <i class="sprite iSeen" title="You watched this movie" ng-if="item.usr_seen_fl != 0"></i>
                  <i class="sprite iWtc" title="You have this movie in watchlist" ng-if="item.usr_wtc_fl != 0"></i>
                </div>
              </div>
            </div>                                                
          </div>
        </div>

        <?php //Movie group watchlist action ?>
        <div class="feedBody mGrpWtc" ng-if="item.wtc_type == 'movie_group_wtc'">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info"><a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a> has added <a class="movieName" href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a>, <a ng-repeat="grp in item.grp" ng-if="$first" class="movieName" href="/movie/{{grp.mvs_slug}}">{{grp.mvs_title}}</a> <span ng-if="item.grp.length > 1">and {{item.grp.length - 1}} other movies</span> to watchlist.</span>
            </div>
            <div class="content qFixer posterS">
              <a class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}" href="/movie/{{item.mvs_slug}}" title="{{item.mvs_title}}"></a>
              <a ng-repeat="grp in item.grp" class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{grp.mvs_poster}}" href="/movie/{{grp.mvs_slug}}" title="{{grp.mvs_title}}"></a>
            </div>
          </div>
        </div>

        <?php //User group watchlist action ?>
        <div class="feedBody uGrpWtc" ng-if="item.wtc_type == 'user_group_wtc'">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info">
                <span class="grp" ng-if="item.usr_wtc_fl == null">
                  <a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a><span ng-repeat="grp in item.grp">, <a href="/user/wall/actions/{{grp.usr_nick}}">{{grp.usr_name}}</a></span>
                  <span ng-if="(item.total_wtc - item.wtc_count) > 0"> and <button>{{item.total_wtc - item.wtc_count}} other</button></span>
                </span>
                
                <span class="grp" ng-if="item.owner == 0 && item.usr_wtc_fl != null">
                  <a href="<?php echo '/user/wall/actions/'.$user['usr_nick']; ?>">You</a>, <a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a><span ng-repeat="grp in item.grp">, <a href="/user/wall/actions/{{grp.usr_nick}}">{{grp.usr_name}}</a></span>
                  <span ng-if="(item.total_seen - item.wtc_count > 0)"> and <a>{{item.total_seen - item.wtc_count}} other</a></span>
                </span>
                
                <span class="grp" ng-if="item.owner == 1">
                  <a href="/user/wall/actions/{{item.usr_nick}}">You</a><span ng-repeat="grp in item.grp">, <a href="/user/wall/actions/{{grp.usr_nick}}">{{grp.usr_name}}</a></span>
                  <span ng-if="(item.total_seen - item.wtc_count) > 0"> and <a>{{item.total_seen - item.wtc_count}} other</a></span>
                </span>
                has added to watchlist <a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a>
              </span>
            </div>
            <div class="content movie posterB">
              <div class="contentLeft">
                <a class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}" href="/movie/{{item.mvs_slug}}"></a>
              </div>
              <div class="contentRight">
                <div class="title"><a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a><small>{{item.mvs_year}}</small></div>
                <div class="genres"><span ng-repeat="gnr in item.genres">{{gnr}}</span></div>
                <div class="rating spriteAfter" ng-if="item.mvs_rating != ''">{{item.mvs_rating}}</div>
                <div class="plot" ng-if="item.mvs_plot != null">{{item.mvs_plot}}</div>
                <div class="movieStatus">
                  <i class="sprite iSeen" title="You watched this movie" ng-if="item.usr_seen_fl != 0"></i>
                  <i class="sprite iWtc" title="You have this movie in watchlist" ng-if="item.usr_wtc_fl != 0"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      
      
    
      <?php //User's movie applaud action ?>
      <div data-itm-id="{{item.feed_id}}" class="feedInner app" ng-if="item.feed_type == 'ap'">
        <div class="feedBody">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info"><a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a> has applauded <a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></span>
              <span class="time" title="{{item.feed_time}}">{{item.feed_ago}}</span>
            </div>
            <div class="content movie posterB">
              <div class="contentLeft">
                <a class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{item.mvs_poster}}" href="/movie/{{item.mvs_slug}}"></a>
              </div>
              <div class="contentRight">
                <div class="title"><a href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a><small>{{item.mvs_year}}</small></div>
                <div class="genres"><span ng-repeat="gnr in item.genres">{{gnr}}</span></div>
                <div class="rating spriteAfter" ng-if="item.mvs_rating != ''">{{item.mvs_rating}}</div>
                <div class="plot" ng-if="item.mvs_plot != null">{{item.mvs_plot}}</div>
                <div class="movieStatus">
                  <i class="sprite iSeen" title="You watched this movie" ng-if="item.usr_seen_fl != 0"></i>
                  <i class="sprite iWtc" title="You have this movie in watchlist" ng-if="item.usr_wtc_fl != 0"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php //User's custom list create action ?>
      <div data-itm-id="{{item.feed_id}}" class="feedInner cList" ng-if="item.feed_type == 'cl'">
        <div class="feedBody">
          <div class="feedLeft">
            <a href="/user/wall/actions/{{item.usr_nick}}" title="{{item.usr_name}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
          </div>
          <div class="feedRight">
            <div class="feedHead">
              <span class="info"><a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a> has created <a href="/user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a></span>
              <span class="time" title="{{item.feed_time}}">{{item.feed_ago}}</span>
            </div>
            <div class="content posterS">
              <div class="contentLeft qFixer">
                <a href="/user/movies/detail/{{item.list_slug}}">
                  <figure ng-repeat="cld in item.cld" class="moviePoster lazy" data-original="<?php echo $site_url; ?>{{cld.cover}}"></figure>
                </a>
              </div>
              <div class="contentRight">
                <div class="title"><a href="/user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a><small>{{item.list_data_count}}</small></div>
                <div class="cListData">
                  <ul class="customList" ng-if="item.list_data_slugs != null">
                    <li ng-repeat="cld in item.cld">- {{cld.title}}</li>
                  </ul>
                  <a href="/user/movies/detail/{{item.list_slug}}">See full list</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
    </div>
    
    <div class="noResult" ng-switch-when="2"><b>{{item.result}}</b></div>
    
    <!--<div class="year" ng-switch-when="3"><b>{{item.result}}</b></div>-->
    
  </article>

  <div ng-show='reddit.loading'>Loading data...</div>
  <button ng-show='reddit.btnState' ng-click="reddit.nextPage()">Load More</button>
</section>