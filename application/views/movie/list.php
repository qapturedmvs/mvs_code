<?php $this->load->view('components/_filterbox'); ?>
<div class="pageDefault pageMovies qMainBlock">
	<div class="controllers qFixer">
		<ul class="cntrlLinks">
			<li><button class="lnkDefault lnkFilters">Refine</button></li>
			<?php if($logged_in): ?>
			<li class="multiActions">
				<button class="lnkDefault lnkMultiAct">Actions</button>
				
				<div class="listSelection qFixer">
					<div class="title">ADD ALL TO</div>
					<div class="seen">
						<button  class="lnkDefault lnkSeen" rel="seen">Mark All As Watched</button>
					</div>
					<div class="wtc">
						<button  class="lnkDefault lnkWtc" rel="wtc">Add All To Watchlist</button>
					</div>
					<div class="clSearch">
						<input class="rc" type="text" placeholder="List name..." />
					</div>
					<div class="cLists">
						
					</div>
					<div class="ncList">
						<button>Add All To New Custom List</button>
						<div class="listCreate none">
							<input class="rc" maxlength="255" placeholder="List title..." type="text" />
							<button rel="cncl">Add</button>
						</div>
					</div>
				</div>
				
			</li>
			<?php endif; ?>
		</ul>
		<?php $this->load->view('components/_movie_list_views'); ?>
	</div>
	<?php $this->load->view('components/repeaters/_movie_list_repeater'); ?>
	</div>
</div>