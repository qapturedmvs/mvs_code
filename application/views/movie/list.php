<?php $this->load->view('components/_filterbox'); ?>
<div class="pageDefault pageMovies qMainBlock">
	<div class="controllers qFixer">
		<div class="btnMultiSeenHolder"><a class="btnDefault btnMultiSeen" href="javascript:void(0);">Mark All as Seen</a></div>
		<?php $this->load->view('components/_movie_list_views'); ?>
	</div>
	<?php $this->load->view('components/repeaters/_movie_list_repeater'); ?>
	</div>
</div>