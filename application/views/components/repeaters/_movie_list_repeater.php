<section class="listHolder">
	<div ng-controller="movRpt" class="movieListHolder grid">
	  <div class="movieListInner qFixer" infinite-scroll="reddit.nextPage()" infinite-scroll-disabled="reddit.busy" infinite-scroll-distance="0">
	    <article ng-repeat="item in <?php echo ($controls['page'] === 'cld') ? 'reddit.' : ''; ?>items" ng-class="{movieItem:item.type == 0, seperator:item.type == 1}">
          <div ng-switch="item.type">
          <div ng-switch-when="0" data-mvs-id="{{item.mvs_id}}" class="movieItemInner">
						<div class="poster">
							<a class="lazy posterImg" data-original="<?php echo $site_url ?>{{item.mvs_poster}}" ng-href="/movie/{{item.mvs_slug}}"></a>
						</div>
						<div class="info">
							<span class="title qValign"><a ng-href="/movie/{{item.mvs_slug}}">{{item.mvs_title}}</a><small class="year">{{item.mvs_year}}</small></span> 
							<span class="genre">{{item.mvs_genre}}</span> 
							<span class="rating" ng-if="item.mvs_rating != ''"><i class="sprite iconRate"></i>{{item.mvs_rating}}</span> 
							<div class="plot">{{item.mvs_plot}}</div>
						</div>
						<?php if($logged_in): ?>
							<div class="movieActions">
								<div class="singleActions">
									<ul class="qFixer">
										<li class="seen"><button class="btnDefault btnSeen sprite" data-itm-id="{{item.lgn_seen_fl}}" onclick="qptAction.seen(this)">WATCHED</button></li>
										<li class="addToList">
											<button onclick="qptAction.addToList(this)" class="btnDefault btnAddToList sprite">ADD TO LIST</button>
											<div class="listSelection">
												<div class="wtc">
													<button class="chkDefault chkWtc" data-itm-id="{{item.lgn_wtc_fl}}" onclick="qptAction.watchlist(this)">Watchlist</button>
												</div>
												<div class="clSearch">
													<input type="text" placeholder="List name..." />
												</div>
												<div class="cLists qFixer"></div>
												<div class="ncList">
													<button>Add to New Custom List</button>
													<div class="listCreate none">
														<input maxlength="255" placeholder="List title..." type="text" />
														<button rel="cncl">Add</button>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
								<div class="multiActions">
									<button data-itm-sn="{{item.lgn_seen_fl}}" data-itm-wt="{{item.lgn_wtc_fl}}" data-itm-cl="{{item.lgn_cl_fl}}">Select</button>
								</div>
								<?php if($controls['page'] === 'cld'): ?>
								<div class="remove edit-mode">
									<button data-itm-id="{{item.ldt_id}}" class="removeItem" onclick="qptAction.removeFromList(this)" rel="0">Remove</button>
								</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
          </div>
          <span ng-switch-when="1"><b>PAGE {{item.paging}}</b></span>
          <span ng-switch-when="2"><b>{{item.result}}</b></span>
				</div>
	    </article>
	    <div ng-show="reddit.loading">Loading data...</div>
      <div class="loadMore">
				<button ng-show="reddit.btnState" ng-click="reddit.nextPage()" class="btnDefault btnLoadMore">LOAD MORE</button>
			</div>
	</div>
	<?php if($controls['page'] != 'cld'): ?>
	<div ng-controller="pagingController" class="pagingHolder">
		<div paging class="qFixer" page="0" page-size="100" total="<?php echo $total; ?>" show-prev-next="true" paging-action="pagingClick(page, pageSize, total)"></div>  
	</div>    
	<?php endif; ?>
</div>
</section>