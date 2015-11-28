<div class="listHolder qFixer" ng-controller="clRpt">
	<article class="cListItem" ng-repeat="item in items">
		<div class="listCover qFixer" ng-if="item.list_data_slugs != null">
			<figure ng-repeat="cld in item.cld" class="lazy" data-original="<?php echo $site_url; ?>{{cld.cover}}"></figure>
		</div>
		<a class="listOverlay" href="/user/movies/detail/{{item.list_slug}}"></a>
		<div class="listTitle qFixer">
			<a href="/user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a>
			<small>{{item.list_data_count}}</small>
		</div>
		<div class="listInfo qFixer">
			<a class="owner" href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a>
			<span class="negRates" ng-if="item.list_neg_rates != 0">{{item.list_neg_rates}}</span>
			<span class="posRates" ng-if="item.list_pos_rates != 0">{{item.list_pos_rates}}</span>
			<span class="reviews" ng-if="item.list_rev_count != 0">{{item.list_rev_count}}</span>
		</div>
	</article>
</div>