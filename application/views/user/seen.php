<script type="text/javascript">
	var usr = '<?php echo $the_user['usr_nick']; ?>';
</script>
<div class="pageDefault pageSeen">
	<?php $this->load->view('components/_the_user'); ?>
	<?php $this->load->view('components/menus/_user_movies_menu'); ?>
	<div class="controllers">
		<?php $this->load->view('components/_movie_list_views'); ?>
	</div>
	<div class="titleDefault titleSeen">
		<h4>Seen Movies</h4>
	</div>
	<?php $this->load->view('components/repeaters/_movie_list_repeater'); ?>
</div>