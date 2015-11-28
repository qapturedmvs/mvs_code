<div class="qHero" style="background-image:url(data/covers/<?php echo $cover['mvs_slug']; ?>.jpg);">
  <div class="qHeroInner qMainBlock">
    <div class="slogan">Share your passion, discover new movies and connect with others.</div>
    <div class="userboxes <?php echo $sys_msg['type']; ?>">
      <?php $this->load->view('components/_loginbox'); ?>
    </div>
    <div class="movieInfo">
      <div class="title qValign">
        <a href="/movie/<?php echo $cover['mvs_slug']; ?>"><?php echo $cover['mvs_title']; ?></a><small><?php echo $cover['mvs_year']; ?></small>
      </div>
    </div>
  </div>
</div>
<div class="innerBody"></div>
