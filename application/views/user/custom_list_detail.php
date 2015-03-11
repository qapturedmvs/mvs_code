<script type="text/javascript">
	var list_id = <?php echo $list['list_id']; ?>;
</script>
<div class="pageDefault pageCustomListDetail">
	<?php $this->load->view('components/_the_user'); ?>
	<?php $this->load->view('components/menus/_user_movies_menu'); ?>
	<div class="controllers">
		<section class="view">
			<a class="row" href="javascript:void(0);">Row View</a>
			<a class="grid" href="javascript:void(0);">Grid View</a>
		</section>
		<?php if($controls['cld_action'] === TRUE): ?>
		<div class="editHolder"><a href="javascript:void(0);"><span class="normal-mode">EDIT</span><span class="edit-mode">DONE</span></a></div>
		<?php endif; ?>
		<hr class="qFixer" />
	</div>
	<div class="titleDefault titleCustomList">
		<h4 class="normal-mode"><?php echo $list['list_title']; ?></h4>
		<input type="text" class="listTitle edit-mode" value="<?php echo $list['list_title']; ?>" />
	</div>
	<?php $this->load->view('components/_movie_list_repeater'); ?>
	<div class="social">
		<?php $this->load->view('components/_commentbox'); ?>
	</div>
</div>