<script type="text/javascript">
	var nick = '<?php echo $the_user['usr_nick']; ?>', action = '<?php echo $controls['page']; ?>';
</script>
<div class="qHero uHero" style="background-image:url(<?php echo get_user_Cover($the_user['usr_cover']); ?>);"></div>
<div rel="<?php echo $controls['page']; ?>" class="pageDefault pageNetwork qMainBlock">
	<?php $this->load->view('components/menus/_the_user_menu'); ?>
	<div class="networkTop qFixer">
		<?php $this->load->view('components/_user_searchbox'); ?>
		<?php $this->load->view('components/menus/_user_network_menu'); ?>
	</div>
	<?php $this->load->view('components/repeaters/_user_list_repeater'); ?>
</div>