<script type="text/javascript">
	var usr = <?php echo ($the_user['view_user']) ? $the_user['view_user']->usr_id : $the_user['login_user']; ?>;
</script>
<div class="pageDefault pageCustomList">
	<?php $this->load->view('components/_the_user'); ?>
	<div class="listHolder" ng-controller='userCustomList'>
		<h4>My Movie Lists</h4>
		<ul>
			<li class="listItem" ng-repeat='item in items'  list-id="{{item.list_id}}">
					<a href="<?php echo $site_url; ?>user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a>
			</li>
		</ul>
	</div>
</div>