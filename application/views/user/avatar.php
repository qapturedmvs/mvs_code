<div class="pageDefault pageAvatar">
	<?php echo form_open_multipart('user/avatar/edit');?>
	<input type="file" name="userfile" size="20" />
	<br /><br />
	<input type="submit" value="upload" />
	<?php echo form_close();?>
	<div class="errorHolder">
		<?php if(isset($image['error'])) echo $image['error']; ?>
	</div>
</div>