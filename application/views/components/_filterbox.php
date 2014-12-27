<link href="<?php echo site_url('js/jquery-ui/jquery-ui.css'); ?>" rel="stylesheet">
<script src="<?php echo site_url('js/jquery-ui/jquery-ui.min.js'); ?>"></script>
<section class="filters">
  <div class="boxHeader"></div>
  <div class="boxBody"> 
    <?php $labels = array('mfg' => 'GENRE', 'mfc' => 'COUNTRY', 'mfy' => 'YEAR', 'mfr' => 'RATING'); ?>
    <ul class="filterList">
   <?php foreach($filters as $group => $filter): ?>
   <li class="filter <?php echo strtolower($labels[$group]); ?>">
   <?php if($group != 'mfy' && $group != 'mfr'): ?>
      <a href="javascript:void(0);" class="title"><?php echo $labels[$group]; ?></a>
      <div class="submenu">
      <ul class="multi" rel="<?php echo $group; ?>">
        <?php foreach($filter as $key => $value): ?>         
          <li><a rel="<?php echo $value; ?>" href="javascript:void(0);"><?php echo $tables[$group][$value]; ?></a></li>
        <?php endforeach; ?>
      </ul>
      <hr class="qFixer" />
      </div>
      <?php else: ?>
      <div class="sliderHolder" rel="<?php echo $group; ?>">
        <a href="javascript:void(0);" class="title"><?php echo $labels[$group]; ?></a>
        <div min="<?php echo $filter['min']; ?>" max="<?php echo $filter['max']; ?>" class="slider"></div>
      </div>
      <?php endif; ?>
    </li>
   <?php endforeach; ?>
   </ul>
  <hr class="qFixer" />
  </div>
  <div class="boxFooter"></div>
</section>
<script type="text/javascript">
  var defs = [], vals, fg, qs = window.location.search;
  $('.sliderHolder').each(function(){
    defs['min'] = parseFloat($('.slider', this).attr("min"));
    defs['max'] = parseFloat($('.slider', this).attr("max"));
    fg = $(this).attr("rel");
    if(qs.indexOf(fg+'=') != -1){
      vals = qsManager.get(fg).split(',');
    }else{
      vals = [defs['min'],defs['max']];
    }
    
    
    $('.slider', this).slider({max:defs['max'], min:defs['min'], range:true, values:vals, change:function(event, ui){
      fg = $(this).parents('.sliderHolder').attr("rel");
      qsManager.mput(fg, ui.values[0]+','+ui.values[1]);
    }});
  });
</script>