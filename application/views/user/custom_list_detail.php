<script type="text/javascript">
	var list_id = <?php echo $list->list_id; ?>;
</script>
<div class="pageDefault pageCustomListDetail">
	<div class="controllers">
		<section class="view">
			<a class="row" href="javascript:void(0);">Row View</a>
			<a class="grid" href="javascript:void(0);">Grid View</a>
		</section>
		<?php if($controls['permission'] === TRUE): ?>
		<div class="editHolder"><a href="javascript:void(0);"><span class="normal-mode">EDIT</span><span class="edit-mode">DONE</span></a></div>
		<?php endif; ?>
		<hr class="qFixer" />
	</div>
	<div class="titleDefault titleCustomList">
		<h4 class="normal-mode"><?php echo $list->list_title; ?></h4>
		<input type="text" class="listTitle edit-mode" value="<?php echo $list->list_title; ?>" />
	</div>
	<?php $this->load->view('components/_movie_list_repeater'); ?>
</div>