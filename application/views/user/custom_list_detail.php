<script src="<?php echo site_url('js/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
	var list_id = <?php echo $list['list_id']; ?>;
</script>
<div class="qHero uHero" style="background-image:url(<?php echo get_user_Cover($the_user['usr_cover']); ?>);"></div>
<div class="pageDefault pageCustomList qMainBlock">
	<?php $this->load->view('components/menus/_the_user_menu'); ?>
	<?php $this->load->view('components/menus/_user_movies_menu'); ?>
	<div class="mListTop qFixer">
		<div class="titleDefault titleCustomList">
			<input type="text" class="clTitleInput edit-mode" value="<?php echo $list['list_title']; ?>" />
			<h4 class="normal-mode"><?php echo $list['list_title']; ?></h4><small><?php echo $list['list_data_count']; ?></small>
			<?php if($controls['cld_action'] === TRUE): ?>
			<span class="editHolder"><button class="lnkDefault lnkEdit"><span class="normal-mode">EDIT</span><span class="edit-mode">DONE</span></button><button onclick="qptAction.deleteCustomList(this)" class="lnkDefault lnkDelete">DELETE LIST</button></span>
			<?php endif; ?>
		</div>
		<?php $this->load->view('components/_movie_list_views'); ?>
	</div>
	<?php if($logged_in): ?>
	<div class="rateHolder clRate<?php if($list['rate_value'] == 1) echo ' disableUp'; elseif($list['rate_value'] == -1) echo ' disableDown'; ?>" data-itm-id="<?php echo ($list['rate_id']) ? $list['rate_id'] : 0; ?>">
		<button class="rateUp spriteAfter<?php echo ($list['rate_value'] == 1) ? ' disableUp' : ''; ?>" onclick="rateButton(this);"><?php echo $list['pos_rate']; ?></button>
		<b></b>
		<button class="rateDown spriteBefore<?php echo ($list['rate_value'] == -1) ? ' disableUp' : ''; ?>" onclick="rateButton(this);"><?php echo $list['neg_rate']; ?></button>
	</div>
	<?php endif; ?>
	<?php $this->load->view('components/repeaters/_movie_list_repeater'); ?>
	<div class="social">
		<?php $this->load->view('components/_reviewbox'); ?>
	</div>
</div>