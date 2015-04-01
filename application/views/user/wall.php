<script type="text/javascript">
	var nick = '<?php echo (isset($the_user)) ? $the_user->usr_nick : $user['usr_nick']; ?>';
</script>
<div class="pageDefault pageWall">
	<?php $this->load->view('components/_the_user'); ?>
	<div class="titleDefault titleWall">
		<h1>Wall</h1>
	</div>
	
	<div class="listHolder wallHolder" ng-controller='userWall'>
		<ul>
			<li class="listItem wallItem" ng-repeat='item in items'>
				
				<div act-id="{{item.feed_id}}" class="feedHolder ctm mov" ng-if="item.feed_type == 'ctm'">
					<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>data/movies/thumbs/{{item.mvs_slug}}_175x240_.jpg"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
          <div class="textContent">
            <div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
            <div class="text">{{item.feed_text}}</div>
          </div>
					<div class="time">{{item.feed_time}}</div>
          <hr class="qFixer" />
				</div>
				
				<div act-id="{{item.feed_id}}" class="feedHolder ctcl" ng-if="item.feed_type == 'ctcl'">
          <div class="textContent">
            <div class="title"><a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a></div>
            <div class="text">{{item.feed_text}}</div>
          </div>
					<div class="time">{{item.feed_time}}</div>
          <hr class="qFixer" />
				</div>
				
				<div list-id="{{item.feed_id}}" class="feedHolder clist" ng-if="item.feed_type == 'clist'">
          <div class="textContent">
            <div class="title"><a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a></div>
            <div class="text">Custom List created</div>
          </div>
					<div class="time">{{item.feed_time}}</div>
          <hr class="qFixer" />
				</div>
				
				<div seen-id="{{item.feed_id}}" class="feedHolder seen mov" ng-if="item.feed_type == 'seen'">
					<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>data/movies/thumbs/{{item.mvs_slug}}_175x240_.jpg"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
          <div class="textContent">
            <div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
            <div class="text">Marked as Seen</div>
          </div>
					<div class="time">{{item.feed_time}}</div>
          <hr class="qFixer" />
				</div>
				
				<div wtc-id="{{item.feed_id}}" class="feedHolder wtc mov" ng-if="item.feed_type == 'wtc'">
					<div class="moviePoster lazy" data-original="<?php echo $site_url; ?>data/movies/thumbs/{{item.mvs_slug}}_175x240_.jpg"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}"></a></div>
          <div class="textContent">
            <div class="title"><a href="<?php echo $site_url; ?>movie/{{item.mvs_slug}}">{{item.mvs_title}}</a></div>
            <div class="text">Added to Watchlist</div>
          </div>
					<div class="time">{{item.feed_time}}</div>
          <hr class="qFixer" />
				</div>
				
				<div bdg-id="{{item.feed_id}}" class="feedHolder bdg" ng-if="item.feed_type == 'bdg'">
          <div class="textContent">
            <div class="text">You Won a Badge</div>
            <div class="title">{{item.bdg_type_title}}</div>
          </div>
					<div class="time">{{item.feed_time}}</div>
          <hr class="qFixer" />
				</div>
				
			</li>
		</ul>
		<hr class="qFixer" />
	</div>
	
</div>