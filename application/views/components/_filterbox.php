
<?php $labels = array('mfg' => 'GENRE', 'mfc' => 'COUNTRY', 'mfy' => 'YEAR', 'mfr' => 'RATING'); ?>
<section class="filters">
  <?php if($vars): ?>
  <div class="choicesHolder none">
    <div class="chHeader"><span>SELECTIONS</span><a class="clrChoices" href="javascript:void(0);">Clear All</a></div>
    <div class="choices">
      <?php foreach($vars as $key => $val): ?>
        <?php if($key != 'mfr' && $key != 'mfy'): ?>
          <?php foreach($val as $v): ?>
              <a grp="<?php echo $key; ?>" rel="<?php echo $v; ?>" href="javascript:void(0);"><span><?php echo $tables[$key][$v]; ?></span></a>
          <?php endforeach; ?>
        <?php else: ?>
          <a grp="<?php echo $key; ?>" href="javascript:void(0);"><span><?php echo $labels[$key].': '.$val[0].' - '.$val[1]; ?></span></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <hr class="qFixer" />
  </div>
  <?php endif; ?>
  <div class="boxHeader"></div>
  <div class="boxBody"> 
    <ul class="filterList">
   <?php foreach($tables as $group => $filter): ?>
   <li class="filter <?php echo strtolower($labels[$group]); ?>">
   <?php if($group != 'mfy' && $group != 'mfr'): ?>
      <a href="javascript:void(0);" class="title"><?php echo $labels[$group]; ?></a>
      <div class="submenu">
      <ul class="multi" rel="<?php echo $group; ?>">
        <?php foreach($filter as $key => $value): ?>         
          <li><a rel="<?php echo $key; ?>" href="javascript:void(0);"><?php echo $value; ?></a></li>
        <?php endforeach; ?>
      </ul>
      <hr class="qFixer" />
      </div>
      <?php else: ?>
        <?php if($filter['min'] != $filter['max']): ?>
        <div class="sliderHolder" rel="<?php echo $group; ?>">
          <a class="title"><?php echo $labels[$group]; ?></a>
          <span class="limits min"></span>
          <div min="<?php echo $filter['min']; ?>" max="<?php echo $filter['max']; ?>" class="slider"></div>
          <span class="limits max"></span>
          <hr class="qFixer" />
        </div>
        <?php endif; ?>
      <?php endif; ?>
    </li>
   <?php endforeach; ?>
   <li class="filter network">
    <a class="title" href="javascript:void(0);">MY NETWORK</a>
    <select>
      <option value="0">Choose</option>
      <option value="seen">Friend's Seen</option>
      <option value="watchlist">Friend's Watchlist</option>
      <option value="comment">Friend's Commented</option>
    </select>
   </li>
   </ul>
  <hr class="qFixer" />
  </div>
  <div class="boxFooter"></div>
</section>
<script type="text/javascript">

</script>