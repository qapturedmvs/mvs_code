<div class="container pageSettings pageThumbs">
	<h2 class="sub-header">Settings</h2>
	<div class="NavHolder">
		<ul class="nav nav-tabs" role="tablist">
		  <li role="presentation"><a href="<?php echo $site_url; ?>admin/settings">General</a></li>
		  <li role="presentation" class="active"><a>Generate Thumbs</a></li>
		  <li role="presentation"><a href="<?php echo $site_url; ?>admin/settings/slug">Generate Slugs</a></li>
		</ul>
	</div>
	<div class="settingsHolder">
	<?php echo validation_errors(); ?>
		<?php echo form_open(); ?>
					<div class="input-group">
					  <span class="input-group-addon">Path of Images</span>
					  <?php echo form_input(array('name' => 'img_path', 'id' => 'img_path', 'class' => 'form-control')); ?>
					  <span class="input-group-addon">Example: "/upload/movies/images"</span>
					</div>
					<div class="row">
  						<div class="col-lg-6">
							<div class="input-group">
							  <span class="input-group-addon">Width</span>
							  <?php echo form_input(array('name' => 'img_width', 'id' => 'img_width', 'class' => 'form-control')); ?>
							  <span class="input-group-addon">pixel</span>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="input-group">
							  <span class="input-group-addon">Height</span>
							  <?php echo form_input(array('name' => 'img_height', 'id' => 'img_height', 'class' => 'form-control')); ?>
							  <span class="input-group-addon">pixel</span>
							</div>
						</div>
					</div>
					<?php echo form_submit(array('name' => 'img_submit', 'value' => 'Start', 'class' => 'btn btn-primary btnThumbGenerate')); ?>
					<div class="clearfix"></div>
			<?php echo form_close(); ?>
	</div>
	<?php if($form_success === TRUE) echo getMessage('success', 'All thumbs generated.'); elseif($form_success === FALSE) echo getMessage('danger', 'An error occured.');?>
</div>