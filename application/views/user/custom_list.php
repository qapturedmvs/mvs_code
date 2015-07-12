<script type="text/javascript">
	var usr = '<?php echo $the_user['usr_nick']; ?>';
</script>
<div class="pageDefault pageCustomList">
	<?php $this->load->view('components/menus/_the_user_menu'); ?>
	<?php $this->load->view('components/_the_user'); ?>
	<?php $this->load->view('components/menus/_user_movies_menu'); ?>
	<div class="listHolder" ng-controller="userCustomList">
		<h4>My Movie Lists</h4>
		<ul>
			<?php $this->load->view('components/repeaters/_customlist_repeater'); ?>
		</ul>
	</div>
</div>