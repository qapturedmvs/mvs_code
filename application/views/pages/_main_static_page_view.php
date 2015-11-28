<div class="pageDefault pageStatic qMainBlock qFixer">
  <aside class="pageStaticLeft left">
  <section class="staticLeftMenu">
    <ul>
      <li class="menuTitle">About Qaptured</li>
      <?php foreach($pages as $page): ?>
      <li<?php echo ($page->stp_slug == $active['slug']) ? ' class="active"' : ''; ?>><a href="<?php echo $page->stp_slug; ?>"><?php echo $page->stp_title; ?></a></li>
      <?php endforeach; ?>
    </ul>
  </section>
  </aside>
  <div class="pageStaticContent left">
    <h1 class="titleDefault titleStatic"><?php echo $active['title']; ?></h1>
    <?php $this->load->view('pages/contents/'.$active['slug']); ?>
  </div>
  <aside class="pageStaticRight right">
    <a href="/" class="btnDefault btnStaticBack spriteAfter">BACK TO QAPTURED</a>
  </aside>
</div>