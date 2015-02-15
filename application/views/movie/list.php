<style type="text/css">
#ci_profiler_benchmarks{position:absolute; top:0; margin:0 !important; width:97%;}
#qContainer{margin-top:100px;}
</style>

<div class="pageDefault pageMovies">
	<div class="controllers">
		<?php $this->load->view('components/_filterbox'); ?>
		<div class="btnMultiSeenHolder"><a class="btnDefault btnMultiSeen" href="javascript:void(0);">Mark All as Seen</a></div>
		<section class="view">
			<a class="row" href="javascript:void(0);">Row View</a>
			<a class="grid" href="javascript:void(0);">Grid View</a>
		</section>
		<hr class="qFixer" />
	</div>
	<div ng-controller='infiniteScrollController' class="movieListHolder row">
	  <div infinite-scroll='reddit.nextPage()' infinite-scroll-disabled='reddit.busy' infinite-scroll-distance='0'>
	    <div ng-repeat='item in reddit.items' ng-class="{movieItem:item.type == 0, seperator:item.type == 1}">
          <div ng-switch="item.type">
          <div ng-switch-when='0' rel="{{item.mvs_id}}" class="movieItemInner"> 
            <span class='poster'><a ng-href='/mvs_code/public_html/movie/{{item.mvs_slug}}'><div class="lazy posterImg" data-original="<?php echo $site_url ?>{{item.mvs_poster}}"></div></a></span> 
            <span class='title'><a ng-href='/mvs_code/public_html/movie/{{item.mvs_slug}}'>{{item.mvs_title}}</a></span> 
            <span class='year'>{{item.mvs_year}}</span> 
            <span class='runtime'>{{item.mvs_runtime}} min.</span> 
            <span class='rating'>{{item.mvs_rating}}</span> 
            <span class='genre'>{{item.mvs_genre}}</span> 
            <span class='country'>{{item.mvs_country}}</span>
						<?php if($logged_in): ?>
						<div class='seen' ng-if="item.usr_seen==0"><a class="checkSeen" onclick="select_seen(this)" rel="0" href="javascript:void(0);">Seen</a></div>
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
</div>