<div class="container pgaeSettings">
	<h2 class="sub-header">Settings</h2>
	<div class="settingsHolder">
		<?php if($settings): ?>
			<?php echo form_open(); ?>
				<?php foreach($settings as $setting): ?>
					<div class="input-group input-group-lg">
					  <span class="input-group-addon"><?php echo $setting->adm_set_title; ?></span>
					  <?php echo form_input(array('name' => 'adm_set_value', 'value' => $setting->adm_set_value, 'id' => $setting->adm_set_code, 'class' => 'form-control')); ?>
					  <?php if($setting->adm_set_info != NULL) echo '<span class="input-group-addon">'.$setting->adm_set_info.'</span>'; ?>
					</div>
				<?php endforeach; ?>
			<?php form_close(); ?>
		<?php else: ?>
			<?php echo getMessage('info', 'Settings data not found.'); ?>
		<?php endif; ?>
	</div>
</div>