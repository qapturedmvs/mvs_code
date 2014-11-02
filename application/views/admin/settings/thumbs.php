<div class="container pgaeSettings">
	<h2 class="sub-header">Settings</h2>
	<div class="NavHolder">
		<ul class="nav nav-tabs" role="tablist">
		  <li role="presentation"><a href="<?php echo $site_url; ?>admin/settings">General</a></li>
		  <li role="presentation" class="active"><a>Generate Thumbs</a></li>
		</ul>
	</div>
	<div class="settingsHolder">
		<?php echo form_open(); ?>
					<div class="input-group input-group-lg">
					  <span class="input-group-addon">Path of Images</span>
					  <?php echo form_input(array('name' => 'img_path', 'id' => 'img_path', 'class' => 'form-control')); ?>
					  <span class="input-group-addon">Example: "/upload/movies/images"</span>
					</div>
					<div class="row">
  						<div class="col-lg-6">
							<div class="input-group input-group-lg">
							  <span class="input-group-addon">Width</span>
							  <?php echo form_input(array('name' => 'img_width', 'id' => 'img_width', 'class' => 'form-control')); ?>
							  <span class="input-group-addon">pixel</span>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="input-group input-group-lg">
							  <span class="input-group-addon">Height</span>
							  <?php echo form_input(array('name' => 'img_height', 'id' => 'img_height', 'class' => 'form-control')); ?>
							  <span class="input-group-addon">pixel</span>
							</div>
						</div>
					</div>
					<?php echo form_submit(array('name' => 'img_submit', 'value' => 'Start', 'class' => 'btn btn-primary btn-lg btnThumbGenerate')); ?>
					<div class="clearfix"></div>
			<?php form_close(); ?>
	</div>
</div>