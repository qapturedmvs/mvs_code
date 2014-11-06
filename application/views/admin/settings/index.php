<div class="container pgaeSettings">
	<h2 class="sub-header">Settings</h2>
	<div class="NavHolder">
		<ul class="nav nav-tabs" role="tablist">
		  <li role="presentation" class="active"><a>General</a></li>
		  <li role="presentation"><a href="<?php echo $site_url; ?>admin/settings/thumbs">Generate Thumbs</a></li>
		</ul>
	</div>
	<div class="settingsHolder">
		<?php if($settings): ?>
		<?php if($form_success) echo getMessage('success', 'Settings successfully saved.'); ?>
		<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
				<?php foreach($settings as $setting): ?>
					<div class="input-group input-group-lg">
					  <span class="input-group-addon"><?php echo $setting->adm_set_title; ?></span>
					  <?php echo form_input(array('name' => $setting->adm_set_code, 'value' => $setting->adm_set_value, 'id' => $setting->adm_set_code, 'class' => 'form-control')); ?>
					  <?php if($setting->adm_set_info != NULL) echo '<span class="input-group-addon">'.$setting->adm_set_info.'</span>'; ?>
					</div>
				<?php endforeach; ?>
				<div class="btnHolder"><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></div>
			<?php form_close(); ?>
		<?php else: ?>
			<?php echo getMessage('info', 'Settings data not found.'); ?>
		<?php endif; ?>
	</div>
</div>