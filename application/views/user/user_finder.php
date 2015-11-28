<div class="pageDefault pageUserFinder qMainBlock">
  <?php if($keyword): ?>
  <script type="text/javascript">
    var keyword = "<?php echo $keyword; ?>";
  </script>
  <div class="searchHeader">
    <?php $this->load->view('components/_user_searchbox'); ?>
    <div class="tabDefault tabSearch" data-page="<?php echo $type; ?>">
      <ul class="qFixer">
        <li data-act="all"><a href="/search/user?q=<?php echo $keyword; ?>">All</a></li>
        <?php if($logged_in): ?>
        <li data-act="myn"><a href="/search/user?type=myn&q=<?php echo $keyword; ?>">My Network</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <div class="resultHolder">
    <h4>USER</h4>
    <div class="users">
      <?php $this->load->view('components/repeaters/_user_list_repeater'); ?>
    </div>
  </div>
  <?php else: ?>
  <div class="no-keyword">Please enter a keyword.</div>
  <?php endif; ?>
</div>