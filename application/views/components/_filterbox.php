<section class="filterbox">
  <div class="boxHeader"><button class="lnkDefault lnkFilterClose">Cancel</button></div>
  <div class="boxBody"> 
    <ul class="filterList qFixer">
      <li class="filter rating qFixer">
        <div class="sliderHolder qFixer">
          <h5 class="title">RATING</h5>
          <div min="<?php echo $tables['mfr']['min']; ?>" max="<?php echo $tables['mfr']['max']; ?>" class="slider" rel="mfr"></div>
        </div>
      </li>
      <li class="filter genre qFixer">
        <h5 class="title">GENRE</h5>
        <div class="submenu">
        <ul class="multi qFixer" rel="mfg">
          <?php foreach($tables['mfg'] as $key => $value): ?>         
            <li><button rel="<?php echo $key; ?>"><?php echo $value; ?></button></li>
          <?php endforeach; ?>
        </ul>
        </div>
      </li>
      <li class="filter country qFixer">
        <h5 class="title">COUNTRY</h5>
        <input name="country_suggest" id="country_suggest" placeholder="Type country name..." type="text" />
        <button class="lnkDefault lnkFilterClear">Clear</button>
        <div class="suggestions"></div>
        <script type="text/javascript">
          var cntryData = <?php echo json_encode($tables['mfc']); ?>;
        </script>
      </li>
      <li class="filter year qFixer">
        <div class="sliderHolder qFixer">
          <h5 class="title">RATING</h5>
          <div min="<?php echo $tables['mfy']['min']; ?>" max="<?php echo $tables['mfy']['max']; ?>" class="slider" rel="mfy"></div>
        </div>
      </li>
   <?php if($logged_in): ?>
   <li class="filter network qFixer">
    <h5 class="title">MY NETWORK</h5>
    <select>
      <option value="0">Choose</option>
      <option value="1">Friend's Seen</option>
      <option value="2">Friend's Watchlist</option>
      <option value="3">Friend's Commented</option>
      <option value="4">Friend's Applauded</option>
    </select>
   </li>
   <li class="filter unseen qFixer"><button rel="<?php echo (isset($vars['mfu'])) ? 1 : 0; ?>">Hide Seen Movies</button></li>
   <?php endif; ?>
   </ul>
  </div>
  <div class="boxFooter"><button class="btnDefault btnApplyFilter grc">APPLY FILTERS</button></div>
</section>