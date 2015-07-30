<div class="searchbox rc">
  <?php echo form_open($site_url.'search'); ?>
  <?php echo form_input(array('name' => 'keyword', 'id' => 'search_keyword', 'required' => 'required', 'placeholder' => 'Search')); ?>
  <div class="btnHolder"><?php echo form_submit('submit', '', 'class="btnSubmit btnSearch sprite"'); ?></div>
  <?php echo form_close(); ?>
  <div class="suggestions"></div>
</div>