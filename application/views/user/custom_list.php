<script type="text/javascript">
	var usr = '<?php echo $the_user['usr_nick']; ?>';
</script>
<div class="qHero uHero" style="background-image:url(<?php echo get_user_Cover($the_user['usr_cover']); ?>);"></div>
<div class="pageDefault pageCustomLists qMainBlock">
	<?php $this->load->view('components/menus/_the_user_menu'); ?>
	<?php $this->load->view('components/menus/_user_movies_menu'); ?>
	<?php $this->load->view('components/repeaters/_customlist_repeater'); ?>
</div>