<div class="pageDefault pageAvatar">
	<?php if($mode == 'upload'): ?>
	<?php echo form_open_multipart();?>
	<input type="file" name="userfile" size="20" />
	<br /><br />
	<input type="hidden" id="hdnAvatar" name="hdnAvatar" value="1" />
	<input type="submit" value="upload" />
	<?php echo form_close();?>
	<div class="errorHolder">
		<?php if(isset($image['error'])) echo $image['error']; ?>
	</div>
	<?php else: ?>
	<div class="avatarHolder">
		<img id="cropImg" rel="<?php echo $image['file_name']; ?>" src="<?php echo $site_url.'data/users/'.$image['file_name']; ?>" />
	</div>
	<a class="btnDefault btnSaveImg" href="javascript:void(0);">SAVE</a>
</div>
<script type="text/javascript">

var imgData = null;

function get_img_data(d){
	
	imgData = d;
	
}

jQuery(function($){
		$('#cropImg').Jcrop({
			bgColor:     'black',
			bgOpacity:   .4,
			aspectRatio: 1 / 1,
			onChange: get_img_data,
			onSelect: get_img_data
		});
});

$('.btnSaveImg').click(function(){
		if(imgData != null){

			imgData['src'] = $('#cropImg').attr("rel");

			getAjax( { uri: site_url + "ajx/user_visuals_ajx", param: imgData }, function( d ){
				
				if( d.result == 'OK' )
					window.location.replace(site_url+'user/settings/details');
				
			});
    }else{
			
			alert('Please select crop area');
			
		}
});
	
</script>
<?php endif; ?>