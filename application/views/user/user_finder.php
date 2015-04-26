<div class="pageDefault pageUserFinder">
  <h1>USER FINDER</h1>
  <?php if($keyword): ?>
  <script type="text/javascript">
    var keyword = "<?php echo $keyword; ?>";
  </script>
  <div ng-controller='UserSearchController' class="results">
    <div class="users">
      <ul>
        <?php $this->load->view('components/_user_list_repeater'); ?>
      </ul>
      <a class="more" href="javascript:void(0);">Get More Results</a>
    </div>
  </div>
  <?php else: ?>
  <div class="no-keyword">Please enter a keyword.</div>
  <?php endif; ?>
</div>