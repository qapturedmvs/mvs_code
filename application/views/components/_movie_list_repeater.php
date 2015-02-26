	<div class="listHolder">
	<div ng-controller='infiniteScrollController' class="movieListHolder row">
	  <div infinite-scroll='reddit.nextPage()' infinite-scroll-disabled='reddit.busy' infinite-scroll-distance='0'>
	    <div ng-repeat='item in reddit.items' ng-class="{movieItem:item.type == 0, seperator:item.type == 1}">
          <div ng-switch="item.type">
          <div ng-switch-when='0' mvs-id="{{item.mvs_id}}" class="movieItemInner"> 
            <span class='poster'><a ng-href='/mvs_code/public_html/movie/{{item.mvs_slug}}'><div class="lazy posterImg" data-original="<?php echo $site_url ?>{{item.mvs_poster}}"></div></a></span> 
            <span class='title'><a ng-href='/mvs_code/public_html/movie/{{item.mvs_slug}}'>{{item.mvs_title}}</a></span> 
            <span class='year'>{{item.mvs_year}}</span> 
            <span class='runtime'>{{item.mvs_runtime}} min.</span> 
            <span class='rating'>{{item.mvs_rating}}</span> 
            <span class='genre'>{{item.mvs_genre}}</span> 
            <span class='country'>{{item.mvs_country}}</span>
						<?php if($logged_in): ?>
							<?php if($controls['seen'] === 'multi'): ?>
							<div class='seen multiSeen' ng-if="item.usr_seen==0"><a class="checkSeen" onclick="select_seen(this)" rel="0" href="javascript:void(0);">Seen</a></div>
							<?php elseif($controls['seen'] === 'single'): ?>
							<div class='seen singleSeen' ng-if="item.usr_seen==0"><a class="checkSeen" onclick="select_seen(this)" href="javascript:void(0);">Seen</a></div>
							<?php endif; ?>
							<?php if($controls['permission'] === TRUE): ?>
							<div class="remove edit-mode"><a ldt-id="{{item.ldt_id}}" class="removeItem" onclick="removeFromList(this)" rel="0" href="javascript:void(0);">Remove</a></div>
							<?php endif; ?>
						<?php endif; ?>
            <hr class="qFixer" />
          </div>
          <div ng-switch-when='1'><b>PAGE {{item.paging}}</b></div>
          <div ng-switch-when='2'><b>{{item.result}}</b></div>
				</div>  
	    </div>
	    <div ng-show='reddit.busy'>Loading data...</div>
	  </div>
	</div>