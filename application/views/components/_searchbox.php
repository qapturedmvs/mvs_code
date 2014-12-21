<div class="searchbox rc">
	<?php echo form_open(); ?>
		<?php echo form_input(array('name' => 'mvs_search', 'id' => 'mvs_search', 'required' => 'required', 'placeholder' => 'Search')); ?>
		<div class="btnHolder"><?php echo form_submit('submit', '', 'class="btnSearch"'); ?></div>
	<?php echo form_close(); ?>
	<hr class="qFixer" />
</div>