<script type="text/javascript">
	var usr = <?php echo ($the_user['view_user']) ? $the_user['view_user']->usr_id : $the_user['login_user']; ?>;
</script>
<div class="pageDefault pageSeen">
	<?php $this->load->view('components/_the_user'); ?>
	<div class="controllers">
		<section class="view">
			<a class="row" href="javascript:void(0);">Row View</a>
			<a class="grid" href="javascript:void(0);">Grid View</a>
		</section>
	</div>
	<div class="titleDefault titleSeen">
		<h4>Seen Movies</h4>
	</div>
	<?php $this->load->view('components/_movie_list_repeater'); ?>
</div>