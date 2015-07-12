<div class="pageDefault pageMovies">
	<div class="controllers">
		<?php $this->load->view('components/_filterbox'); ?>
		<div class="btnMultiSeenHolder"><a class="btnDefault btnMultiSeen" href="javascript:void(0);">Mark All as Seen</a></div>
		<?php $this->load->view('components/_movie_list_views'); ?>
		<hr class="qFixer" />
	</div>
	<?php $this->load->view('components/repeaters/_movie_list_repeater'); ?>
	</div>
</div>