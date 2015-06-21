<div class="pageDefault pageCover">
	<?php if(!isset($image)): ?>
	<script type="text/javascript">
		localStorage.setItem('coverRef', '<?php echo $referer_url; ?>');
	</script>
	<?php endif; ?>
	<?php echo form_open_multipart();?>
		<input type="file" name="userfile" size="20" />
		<br /><br />
		<input type="hidden" id="refUrl" name="refUrl" value="1" />
		<input type="submit" value="save" />
	<?php echo form_close();?>
	<div class="errorHolder">
		<?php if(isset($image['error'])) echo $image['error']; ?>
	</div>
	<?php if(isset($image['result'])): ?>
	<script type="text/javascript">
		var coverRef = localStorage.getItem('coverRef');
		localStorage.setItem('coverRef', null);
		window.location.replace(coverRef);
	</script>
	<?php endif; ?>
</div>