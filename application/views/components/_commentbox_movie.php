<?php if($logged_in): ?>
<div class="commentForm">
	<textarea name="comment_text" id="comment_text" required></textarea>
	<a href="javascript:void(0);" class="btnDefault btnComment rc">Comment</a>
	<hr class="qFixer" />
	<div class="comment_result"></div>
</div>
<div class="replyHolder none">
<?php $this->load->view('components/_comment_reply'); ?>
</div>
<?php endif; ?>
<script src="<?php echo site_url('js/comment.js'); ?>"></script>