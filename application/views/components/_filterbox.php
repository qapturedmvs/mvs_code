<link href="<?php echo site_url('js/jquery-ui/jquery-ui.css'); ?>" rel="stylesheet">
<script src="<?php echo site_url('js/jquery-ui/jquery-ui.min.js'); ?>"></script>
<section class="filters">
  <?php if($vars && (isset($vars['mfg']) || isset($vars['mfc']) || isset($vars['mfa']))): ?>
  <div class="choicesHolder none">
    <div class="chHeader"><span>SELECTIONS</span><a class="clrChoices" href="javascript:void(0);">Clear All</a></div>
    <div class="choices">
      <?php foreach($vars as $key => $val): ?>
        <?php if($key != 'mfr' && $key != 'mfy'): ?>
          <?php foreach($val as $v): ?>
              <a grp="<?php echo $key; ?>" rel="<?php echo $v; ?>" href="javascript:void(0);"><span><?php echo $tables[$key][$v]; ?></span></a>
          <?php endforeach; ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <hr class="qFixer" />
  </div>
  <?php endif; ?>
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
        <a class="title"><?php echo $labels[$group]; ?></a>
        <span class="limits min"></span>
        <div min="<?php echo $filter['min']; ?>" max="<?php echo $filter['max']; ?>" class="slider"></div>
        <span class="limits max"></span>
        <hr class="qFixer" />
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
  var defs = [], vals = [], fg, qs = window.location.search;
  
  function set_slider_vals(obj, min, max){
    $('span.min', obj).text(min);
    $('span.max', obj).text(max);
  }
  
  $('.sliderHolder').each(function(){
    fg = $(this).attr("rel");
    defs[fg] = [];
    defs[fg][0] = parseFloat($('.slider', this).attr("min"));
    defs[fg][1] = parseFloat($('.slider', this).attr("max"));
    
    if(qs.indexOf(fg+'=') != -1){
      vals[fg] = qsManager.get(fg).split(',');
      set_slider_vals(this, vals[fg][0], vals[fg][1]);
    }else{
      vals[fg] = [defs[fg][0],defs[fg][1]];
      set_slider_vals(this, defs[fg][0], defs[fg][1]);
    }
    
    $('.slider', this).slider({max:defs[fg][1], min:defs[fg][0], range:true, values:vals[fg], change:function(event, ui){
      fg = $(this).parents('.sliderHolder').attr("rel");
      
      
      if(ui.values[0] != vals[fg][0] || ui.values[1] != vals[fg][1]){
        if(ui.values[0] == defs[fg][0] && ui.values[1] == defs[fg][1])
          qsManager.remove(fg);
        else
          qsManager.put(fg, ui.values[0]+','+ui.values[1], false);
      }
    },
    slide:function(event, ui){
      var obj = $(this).parents('.sliderHolder');
      set_slider_vals(obj, ui.values[0], ui.values[1]);
    }
    });
  });
</script>