<?php $labels = array('mfg' => 'GENRE', 'mfc' => 'COUNTRY', 'mfy' => 'YEAR', 'mfr' => 'RATING', 'mfn' => array("Friend's Seen", "Friend's Watchlist", "Friend's Commented", "Friend's Applauded"), 'mfu' => 'Hide seen movies'); ?>
<section class="filters">
  <?php if($vars): ?>
  <div class="choicesHolder none">
    <div class="chHeader"><span>SELECTIONS</span><a class="clrChoices" href="javascript:void(0);">Clear All</a></div>
    <div class="choices">
      <?php foreach($vars as $key => $val): ?>
        <?php if($key == 'mfg' || $key == 'mfc'): ?>
          <?php foreach($val as $v): ?>
              <a grp="<?php echo $key; ?>" rel="<?php echo $v; ?>" href="javascript:void(0);"><span><?php echo $tables[$key][$v]; ?></span></a>
          <?php endforeach; ?>
        <?php elseif($key == 'mfr' || $key == 'mfy'): ?>
          <a grp="<?php echo $key; ?>" href="javascript:void(0);"><span><?php echo $labels[$key].': '.$val[0].' - '.$val[1]; ?></span></a>
        <?php elseif($key == 'mfn'): ?>
          <a grp="<?php echo $key; ?>" href="javascript:void(0);"><span><?php echo 'NETWORK: '.$labels[$key][($val[0]-1)]; ?></span></a>
        <?php elseif($key == 'mfu'): ?>
          <a grp="<?php echo $key; ?>" href="javascript:void(0);"><span><?php echo 'UNSSEN: '.$labels[$key]; ?></span></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <hr class="qFixer" />
  </div>
  <?php endif; ?>
  <div class="boxHeader"></div>
  <div class="boxBody"> 
    <ul class="filterList">
      <li class="filter country">
        <a href="javascript:void(0);" class="title">COUNTRY</a>
        <?php echo form_input(array('name' => 'country_suggest', 'id' => 'country_suggest', 'placeholder' => 'Type country name...')); ?>
        <hr class="qFixer" />
        <script type="text/javascript">
          var cntryData = <?php echo json_encode($tables['mfc']); ?>;
        </script>
      </li>
      <li class="filter genre">
        <a href="javascript:void(0);" class="title">GENRE</a>
        <div class="submenu">
        <ul class="multi" rel="mfg">
          <?php foreach($tables['mfg'] as $key => $value): ?>         
            <li><a rel="<?php echo $key; ?>" href="javascript:void(0);"><?php echo $value; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <hr class="qFixer" />
        </div>
      </li>
      <li class="filter rating">
        <div class="sliderHolder" rel="mfr">
          <a class="title">RATING</a>
          <span class="limits min"></span>
          <div min="<?php echo $tables['mfr']['min']; ?>" max="<?php echo $tables['mfr']['max']; ?>" class="slider"></div>
          <span class="limits max"></span>
          <hr class="qFixer" />
        </div>
      </li>
      <li class="filter year">
        <div class="sliderHolder" rel="mfy">
          <a class="title">RATING</a>
          <span class="limits min"></span>
          <div min="<?php echo $tables['mfy']['min']; ?>" max="<?php echo $tables['mfy']['max']; ?>" class="slider"></div>
          <span class="limits max"></span>
          <hr class="qFixer" />
        </div>
      </li>
   <?php if($logged_in): ?>
   <li class="filter network">
    <a class="title" href="javascript:void(0);">MY NETWORK</a>
    <select>
      <option value="0">Choose</option>
      <option value="1">Friend's Seen</option>
      <option value="2">Friend's Watchlist</option>
      <option value="3">Friend's Commented</option>
      <option value="4">Friend's Applauded</option>
    </select>
   </li>
   <li class="filter unseen"><a rel="<?php echo (isset($vars['mfu'])) ? 1 : 0; ?>" href="javascript:void(0);">Hide Seen Movies</a></li>
   <?php endif; ?>
   </ul>
  <hr class="qFixer" />
  </div>
  <div class="boxFooter"></div>
</section>