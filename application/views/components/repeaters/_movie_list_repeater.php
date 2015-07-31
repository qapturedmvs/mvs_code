<div class="listHolder">
	<div ng-controller='infiniteScrollController' class="movieListHolder qFixer grid">
	  <div infinite-scroll='reddit.nextPage()' infinite-scroll-disabled='reddit.busy' infinite-scroll-distance='0'>
	    <div ng-repeat='item in reddit.items' ng-class="{movieItem:item.type == 0, seperator:item.type == 1}">
          <div ng-switch="item.type">
          <div ng-switch-when='0' mvs-id="{{item.mvs_id}}" class="movieItemInner"> 
            <a class="poster lazy posterImg" data-original="<?php echo $site_url ?>{{item.mvs_poster}}" ng-href="<?php echo $site_url ?>movie/{{item.mvs_slug}}"></a> 
            <span class="title"><a ng-href="<?php echo $site_url ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a><small class="year">{{item.mvs_year}}</small></span> 
            <span class="genre">{{item.mvs_genre}}</span> 
            <span class="rating">{{item.mvs_rating}}</span> 
						<div class="plot">{{item.mvs_plot}}</div>
						
						<?php if($logged_in): ?>
							<div class="movieActions">
								<ul class="qFixer">
									<li class="seenMovie singleSeen"><a data-itm-id="{{item.lgn_seen_fl}}" href="javascript:void(0);" onclick="s_seen(this)">Watched</a></li>
									<li class="addToList"><a href="javascript:void(0);">Add to list</a>
										<div class="listSelection">
											<ul class="cLists qFixer">
												<li class="wtc addtoWtc"><a data-itm-id="{{item.lgn_wtc_fl}}" onclick="s_watchlist(this)" href="javascript:void(0);">Watchlist</a></li>
											</ul>
										</div>
									</li>
								</ul>
								<div class="multiActSelect"><a data-itm-sn="{{item.lgn_seen_fl}}" data-itm-wt="{{item.lgn_wtc_fl}}" data-itm-cl="{{item.lgn_cl_fl}}" href="javascript:void(0);">Select</a></div>
							</div>
							<?php if($controls['page'] === 'cld'): ?>
							<div class="remove edit-mode qFixer"><a data-itm-id="{{item.ldt_id}}" class="removeItem" onclick="removeFromList(this)" rel="0" href="javascript:void(0);">Remove</a></div>
							<?php endif; ?>
							
						<?php endif; ?>
          </div>
          <span ng-switch-when='1'><b>PAGE {{item.paging}}</b></span>
          <span ng-switch-when='2'><b>{{item.result}}</b></span>
				</div>
	    </div>
	    <div ng-show='reddit.loading'>Loading data...</div>
      <button ng-show='reddit.btnState' ng-click="reddit.nextPage()">Load More</button>
	</div>
</div>