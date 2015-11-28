<div class="pageDefault pageCover">
	<?php if($mode == 'upload'): ?>
	<div class="uploadHolder">
		<?php echo form_open_multipart();?>
		<div class="uploadInner">
			<i class="sprite"></i>
			<p>Drop file here to upload</p>
			<span class="rc">SELECT FILE</span>
			<small>JPG or PNG with maximum file size of 2MB</small>
		</div>
		<input id="coverSel" type="file" name="userfile" size="20" />
		<input type="hidden" id="hdnCover" name="hdnCover" value="1" />
		<div class="btnHolder none qMainBlock">
			<button type="submit" class="btnDefault btnUpload">UPLOAD</button>
		</div>
		<?php echo form_close();?>
		<div class="errorHolder">
			<?php if(isset($image['error'])) echo $image['error']; ?>
		</div>
	</div>
	<script type="text/javascript">
		$('#coverSel').change(function(){
			$('.btnUpload').click();
		});
	</script>
	<?php else: ?>
	<div class="coverHolder">
		<div class="draggable ui-widget-content">
			<img id="cropImg" src="<?php echo '/data/user-covers/temp/'.$image['file_name']; ?>" />
		</div> 
	</div>
	<div class="btnHolder qMainBlock">
		<button class="btnDefault btnSaveImg">SAVE</button>
	</div>
</div>
<script type="text/javascript">

var imgData = {'raw_name':'<?php echo $image['raw_name']; ?>'};

$('.draggable').qptCover({ wrapper: '.coverHolder' });

$('.btnSaveImg').bind('click', function(){
	
	var imgTop =  $('.draggable')[0].getPosition();
	imgData['y_axis'] = Math.abs(imgTop['top']);

	getAjax( { uri: site_url + "ajx/user_visuals_ajx/cover", param: imgData }, function( d ){
		
		if( d.result == 'OK' )
			window.location.replace(site_url+'user/settings/general');
		
	});

});

</script>
<?php endif; ?>