<section class="searchHolder userSearchHolder">
  <div class="searchbox rc searchboxUser qFixer">
    <?php echo form_open('/search/user', array('method' => 'GET')); ?>
      <?php echo form_input(array('name' => 'q', 'id' => 'user_keyword', 'required' => 'required', 'placeholder' => 'Name, email...')); ?>
      <div class="btnHolder"><button class="btnSearch sprite" type="submit">Search</button></div>
    <?php echo form_close(); ?>
    <div class="suggestions"></div>
  </div>
</section>