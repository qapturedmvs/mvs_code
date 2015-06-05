<div class="searchbox searchboxUser"> <?php echo form_open($site_url.'search/user'); ?> <?php echo form_input(array('name' => 'keyword', 'id' => 'user_keyword', 'required' => 'required', 'placeholder' => 'Search')); ?>
  <div class="btnHolder"><?php echo form_submit('submit', '', 'class="btnSearch"'); ?></div>
  <?php echo form_close(); ?>
  <hr class="qFixer" />
</div>