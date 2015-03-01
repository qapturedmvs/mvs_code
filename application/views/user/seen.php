<script type="text/javascript">
	var usr = '<?php echo $the_user->usr_id; ?>';
</script>
<div class="pageDefault pageSeen">
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