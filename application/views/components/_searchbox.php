<div class="searchbox rc">
  <?php echo form_open('/search', array('method' => 'GET')); ?>
    <?php echo form_input(array('name' => 'q', 'id' => 'search_keyword', 'required' => 'required', 'placeholder' => 'Search')); ?>
    <div class="btnHolder"><button class="btnSubmit btnSearch sprite" type="submit">Search</button></div>
  <?php echo form_close(); ?>
  <div class="suggestions"></div>
</div>