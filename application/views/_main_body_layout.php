<?php $this->load->view('components/_page_head'); ?>
<div id="qContainer">
	<div id="qHeader">
		<div class="innerHeader qFixer">
			<div class="logo left">
				<a href="/">Qaptured</a>
			</div>
			<nav class="mainMenu left">
				<ul>
					<?php if($logged_in): ?>
					<li class="m-feeds"><a href="/user/feeds">Home</a></li>
					<?php else: ?>
					<li class="m-home"><a href="/">Home</a></li>
					<?php endif; ?>
					<li class="m-explore"><a href="#">Explore</a></li>
					<li class="m-movies"><a href="/movies">Movies</a></li>
				</ul>
			</nav>
			<div class="searchHolder mainSearchHolder left">
				<?php $this->load->view('components/_searchbox'); ?>
			</div>
			<div class="userHolder right">
				<?php $this->load->view('components/_userbox'); ?>
			</div>
		</div>
	</div>
	<div id="qBody">
		<?php $this->load->view($subview); ?>
	</div>
	<div id="qFooter"></div>
</div>
<?php $this->load->view('components/_page_foot'); ?>