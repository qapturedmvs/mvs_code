<section class="filters">
  <div class="boxHeader"></div>
  <div class="boxBody">
    <ul class="filterList">
    <?php foreach($filters as $group => $filter): ?>
    <?php if($group == 'gnr_id'): ?>
    <li class="filter genre">
      <a href="javascript:void(0);" class="title">GENRE</a>
      <div class="submenu">
      <ul class="multi" rel="mfg">
        <?php foreach($filter as $key => $val): ?>
          <?php if(array_key_exists(0, $filter)): ?>
            <li><a rel="<?php echo $val->gnr_id; ?>" href="javascript:void(0);"><?php echo $val->gnr_title; ?></a></li>
          <?php else: ?>
            <li><a rel="<?php echo $key; ?>" href="javascript:void(0);"><?php echo $val; ?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <hr class="qFixer" />
      </div>
    </li>
    <?php endif; ?>
    <?php if($group == 'cntry_id'): ?>
    <li class="filter country">
      <a href="javascript:void(0);" class="title">COUNTRY</a>
      <div class="submenu">
      <ul class="multi" rel="mfc">
        <?php foreach($filter as $key => $val): ?>
          <?php if(array_key_exists(0, $filter)): ?>
            <li><a rel="<?php echo $val->cntry_id; ?>" href="javascript:void(0);"><?php echo $val->cntry_title; ?></a></li>
          <?php else: ?>
            <li><a rel="<?php echo $key; ?>" href="javascript:void(0);"><?php echo $val; ?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <hr class="qFixer" />
      </div>
    </li>
    <?php endif; ?>
    <?php endforeach; ?>
  </ul>
  <hr class="qFixer" />
  </div>
  <div class="boxFooter"></div>
</section>