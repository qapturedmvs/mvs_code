<section class="filters">
  <div class="boxHeader"></div>
  <div class="boxBody"> 
    <?php $labels = array('mfg' => 'GENRE', 'mfc' => 'COUNTRY', 'mfy' => 'YEAR', 'mfr' => 'RATING'); ?>
   <?php foreach($filters as $group => $filter): ?>
   <ul class="filterList">
   <li class="filter <?php echo strtolower($labels[$group]); ?>">
      <a href="javascript:void(0);" class="title"><?php echo $labels[$group]; ?></a>
      <div class="submenu">
      <ul class="multi" rel="<?php echo $group; ?>">
        <?php foreach($filter as $key => $value): ?>
          <?php if($group != 'mfy' && $group != 'mfr'): ?>
            <li><a rel="<?php echo $value; ?>" href="javascript:void(0);"><?php echo $tables[$group][$value]; ?></a></li>
          <?php else: ?>
            <li><a rel="<?php echo $value; ?>" href="javascript:void(0);"><?php echo $value; ?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <hr class="qFixer" />
      </div>
    </li>
   </ul>
   <?php endforeach; ?>
  <hr class="qFixer" />
  </div>
  <div class="boxFooter"></div>
</section>