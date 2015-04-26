<script type="text/javascript">
	var nick = '<?php echo (isset($the_user)) ? $the_user->usr_nick : $user['usr_nick']; ?>';
</script>
<div rel="<?php echo $controls['page']; ?>" class="pageDefault pageNetwork page-<?php echo $controls['page']; ?>">
	<?php $this->load->view('components/_the_user'); ?>
	<hr class="qFixer" />
	<?php $this->load->view('components/menus/_user_network_menu'); ?>
	<div class="searchHolder userSearchHolder">
		<?php $this->load->view('components/_user_searchbox'); ?>
	</div>
	<hr class="qFixer" />
	<div class="titleDefault titleNetwork">
		<h1><?php echo ($controls['page'] == 'followers') ? 'Followers' : 'Followings'; ?></h1>
	</div>
	<div class="listHolder" ng-controller='userNetwork'>
		<ul>
			<?php $this->load->view('components/_user_list_repeater'); ?>
		</ul>
		<hr class="qFixer" />
	</div>
</div>