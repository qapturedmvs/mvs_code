<style type="text/css">
#ci_profiler_benchmarks{position:absolute; top:0; margin:0 !important; width:97%;}
#qContainer{margin-top:100px;}
</style>

<div class="pageDefault pageMovies">
	<div class="controllers">
		<?php $this->load->view('components/_filterbox'); ?>
		<div class="btnMultiSeenHolder"><a class="btnDefault btnMultiSeen" href="javascript:void(0);">Mark All as Seen</a></div>
		<section class="view">
			<a class="row" href="javascript:void(0);">Row View</a>
			<a class="grid" href="javascript:void(0);">Grid View</a>
		</section>
		<hr class="qFixer" />
	</div>
	<?php $this->load->view('components/_movie_list_repeater'); ?>
	</div>
</div>