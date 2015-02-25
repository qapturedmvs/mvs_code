<script type="text/javascript">
	var list_id = <?php echo $list->list_id; ?>;
</script>
<div class="pageDefault pageCustomListDetail">
	<div class="controllers">
		<section class="view">
			<a class="row" href="javascript:void(0);">Row View</a>
			<a class="grid" href="javascript:void(0);">Grid View</a>
		</section>
		<hr class="qFixer" />
	</div>
	<div class="titleDefault titleCustomList">
		<h4><?php echo $list->list_title; ?></h4>
	</div>
	<?php $this->load->view('components/_movie_list_repeater'); ?>
</div>