<li ng-repeat="item in items">
	<a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">
	<div class="listCover" ng-if="item.list_data_slugs != null">
		<ul>
			<li ng-repeat="cld in item.cld" class="lazy" data-original="<?php echo $site_url; ?>{{cld.cover}}"></li>
		</ul>
		<hr class="qFixer" />
	</div>
	</a>
	<div class="listInfoHolder">
		<div class="listInfo"><a class="listTitle" href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a> <small>{{item.list_movie_count}}</small></div>
		<div class="listInfoBottom"><a class="listOwner" href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a><span class="listRevs">{{item.list_rev_count}}</span><span class="listPosRate">{{item.list_pos_rates}}</span><span class="listNegRate">{{item.list_neg_rates}}</span></div>
		<?php if($controls['owner']): ?>
		<a class="clDeleteBtn" list-id="{{item.list_id}}" href="javascript:void(0);" onclick="deleteCustomList(this)">DELETE</a>
		<?php endif; ?>
	</div>
</li>