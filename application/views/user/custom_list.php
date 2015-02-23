<div class="pageDefault pageCustomList">
	<div class="listHolder" ng-controller='userCustomList'>
		<h4>My Movie Lists</h4>
		<ul>
			<li class="listItem" ng-repeat='item in items'  list-id="{{item.list_id}}">
					<a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_id}}">{{item.list_title}}</a>
			</li>
		</ul>
	</div>
</div>