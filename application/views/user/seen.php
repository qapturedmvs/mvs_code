<script type="text/javascript">
	var usr = '<?php echo $usr_id; ?>';
</script>
<div class="pageDefault pageSeen">
	<div class="titleDefault titleSeen">
		<h4>Seen Movies</h4>
	</div>
	<?php $this->load->view('components/_movie_list_repeater'); ?>
</div>