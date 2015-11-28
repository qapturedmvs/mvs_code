<script src="<?php echo site_url('js/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
	var nick = '<?php echo $the_user['usr_nick']; ?>';
</script>
<div class="qHero uHero" style="background-image:url(<?php echo get_user_Cover($the_user['usr_cover']); ?>);"></div>
<?php $this->load->view('components/_reply_edit_box'); ?>
<div class="pageDefault pageWall qMainBlock qFixer">
  <?php $this->load->view('components/menus/_the_user_menu'); ?>
  <aside class="pageLeft left">
  <?php $this->load->view('components/_the_user'); ?>
  <section class="sideBar left"></section>
  <?php $this->load->view('components/repeaters/_wall_repeater'); ?>
  </aside>
  <aside class="pageRight right"></aside>
</div>
