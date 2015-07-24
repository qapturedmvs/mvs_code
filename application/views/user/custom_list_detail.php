<script src="<?php echo site_url('js/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
	var list_id = <?php echo $list['list_id']; ?>;
</script>
<div class="pageDefault pageCustomListDetail">
	<?php $this->load->view('components/menus/_user_movies_menu'); ?>
	<div class="controllers">
		<?php $this->load->view('components/_movie_list_views'); ?>
		<?php if($controls['cld_action'] === TRUE): ?>
		<div class="editHolder"><a href="javascript:void(0);"><span class="normal-mode">EDIT</span><span class="edit-mode">DONE</span></a>
			<a class="deleteList edit-mode" onclick="deleteCustomList(this);" href="javascript:void(0);">DELETE LIST</a>
		</div>
		<?php endif; ?>
		<hr class="qFixer" />
	</div>
	<div class="titleDefault titleCustomList">
		<h4 class="normal-mode"><?php echo $list['list_title']; ?></h4><small><?php echo $list['list_data_count']; ?></small>
		<input type="text" class="listTitle edit-mode" value="<?php echo $list['list_title']; ?>" />
	</div>
	<?php if($logged_in): ?>
<div class="rateHolder clRate<?php if($list['rate_value'] == 1) echo ' disableUp'; elseif($list['rate_value'] == -1) echo ' disableDown'; ?>"><a class="rateUp" href="javascript:void(0);">Up <small><?php echo $list['pos_rate']; ?></small></a><a class="rateDown" href="javascript:void(0);">Down <small><?php echo $list['neg_rate']; ?></small></a></div>
	<?php endif; ?>
	<?php $this->load->view('components/repeaters/_movie_list_repeater'); ?>
	<div class="social">
		<?php $this->load->view('components/_commentbox'); ?>
	</div>
</div>