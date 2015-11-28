<script src="<?php echo site_url('js/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
	var review = true;
</script>
<div class="pageDefault pageFeeds qMainBlock qFixer">
	<aside class="feedsLeft left">
	<?php $this->load->view('components/_reply_edit_box'); ?>
	<?php $this->load->view('components/repeaters/_feeds_repeater'); ?>
	</aside>
	<aside class="feedsRight right">
		<?php $this->load->view('components/_people_suggest_box'); ?>
		<?php $this->load->view('components/_user_searchbox'); ?>
	</aside>
	<?php $this->load->view('components/_system_messagebox', array('qBox' => 'remove')); ?>
</div>