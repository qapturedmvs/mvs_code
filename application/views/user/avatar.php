<div class="pageDefault pageAvatar">
	<?php if($mode == 'upload'): ?>
	<?php echo form_open_multipart();?>
	<input type="file" name="userfile" size="20" />
	<br /><br />
	<input type="hidden" id="hdnAvatar" name="hdnAvatar" />
	<input type="submit" value="upload" />
	<?php echo form_close();?>
	<div class="errorHolder">
		<?php if(isset($image['error'])) echo $image['error']; ?>
	</div>
	<?php else: ?>
	<div class="avatarHolder">
		<img id="cropImg" src="<?php echo $site_url.'data/users/'.$image['file_name']; ?>" />
	</div>
</div>
<script type="text/javascript">


////////////////////////////////////////////////////////////////////////////////////////////////////// CROP TOOL
/*
<div class="jc-demo-box"> <img src="demo_files/sago.jpg" id="cropImg" alt="" />
  <div id="preview-pane">
    <div class="preview-container"> <img src="demo_files/sago.jpg" class="jcrop-preview" alt="Preview" /> </div>
  </div>
  <div class="clearfix"></div>
</div>
*/

//var crop = {
//	el: '#cropImg',
//	preview: '#preview-pane',
//	previewCon: '#preview-pane .preview-container',
//	previewImg: '#preview-pane .preview-container img',
//	xsize: 200,
//	ysize: 200,
//	boundx: null,
//	boundy: null,
//	jcrop_api: null,
//	updatePreview: function( c ){
//		/*var _this = crop, previewImg = $( _this.previewImg );
//		if( parseInt( c.w ) > 0 ){
//        	var rx = _this.xsize / c.w, 
//				ry = _this.ysize / c.h;
//		    previewImg.css({
//				width: Math.round( rx * _this.boundx ) + 'px',
//				height: Math.round( ry * _this.boundy ) + 'px',
//				marginLeft: '-' + Math.round( rx * c.x ) + 'px',
//				marginTop: '-' + Math.round( ry * c.y ) + 'px'
//			});
//      }*/
//	},
//	init: function(){
//		var _this = this, el = $( _this.el ), preview = $( _this.preview ) ;
//		if( el.length > 0 && preview.length > 0 ){
//			el.Jcrop({
//				onChange: _this.updatePreview,
//				onSelect: _this.updatePreview,
//				aspectRatio: _this.xsize / _this.ysize
//			},function(){
//				var bounds = this.getBounds();
//				_this.boundx = bounds[ 0 ];
//				_this.boundy = bounds[ 1 ];
//				_this.jcrop_api = this;	
//				//preview.appendTo( _this.jcrop_api.ui.holder );
//			});
//		}
//	}
//};
//
//crop.init();

jQuery(function($) {
		$('#cropImg').Jcrop({
			bgColor:     'black',
			bgOpacity:   .4,
			//setSelect:   [ 100, 100, 50, 50 ],
			aspectRatio: 1 / 1
		});
});
	
</script>
<?php endif; ?>