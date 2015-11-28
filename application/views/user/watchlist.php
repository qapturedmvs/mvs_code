<script type="text/javascript">
	var usr = '<?php echo $the_user['usr_nick']; ?>';
</script>
<div class="qHero uHero" style="background-image:url(<?php echo get_user_Cover($the_user['usr_cover']); ?>);"></div>
<div class="pageDefault pageWatchlist qMainBlock">
	<?php $this->load->view('components/menus/_the_user_menu'); ?>
	<?php $this->load->view('components/menus/_user_movies_menu'); ?>
	<div class="mListTop qFixer">
		<div class="titleDefault titleWatchlist">
			<h4>Watchlist</h4><small><?php echo $total; ?></small>
		</div>
		<?php $this->load->view('components/_movie_list_views'); ?>
	</div>
	<?php $this->load->view('components/repeaters/_movie_list_repeater'); ?>
</div>