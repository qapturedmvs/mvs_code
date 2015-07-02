<script type="text/javascript">
	var usr = '<?php echo (isset($the_user)) ? $the_user->usr_nick : $user['usr_nick']; ?>';
</script>
<div class="pageDefault pageCustomList">
	<?php $this->load->view('components/_the_user'); ?>
	<?php $this->load->view('components/menus/_user_movies_menu'); ?>
	<div class="listHolder" ng-controller="userCustomList">
		<h4>My Movie Lists</h4>
		<ul>
			<li class="listItem" ng-repeat="item in items">
				<a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a>
				<?php if($controls['owner']): ?>
				<a class="clDeleteBtn" list-id="{{item.list_id}}" href="javascript:void(0);" onclick="deleteCustomList(this)">DELETE</a>
				<?php endif; ?>
			</li>
		</ul>
	</div>
</div>