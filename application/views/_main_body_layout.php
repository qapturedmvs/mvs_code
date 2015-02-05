<?php $this->load->view('components/_page_head'); ?>
<div id="qContainer">
	<div id="qHeader">
		<div class="logo">
			<a href="<?php echo $site_url; ?>">Qaptured</a>
		</div>
		<div class="mainMenu">
			<nav>
				<ul>
					<?php if($logged_in): ?>
					<li><a href="<?php echo $site_url.'user/profile'; ?>">me</a></li>
					<li><a href="#">explore</a></li>
					<li><a href="<?php echo $site_url.'user/feeds'; ?>">home</a></li>
					<?php endif; ?>
					<li><a href="<?php echo $site_url.'movies'; ?>">Movies 1</a></li>
					<li><a href="<?php echo $site_url.'movies2'; ?>">Movies 2</a></li>
				</ul>
			</nav>
		</div>
		<div class="userHolder">
			<?php $this->load->view('components/_userbox'); ?>
		</div>
		<div class="searchHolder">
			<?php $this->load->view('components/_searchbox'); ?>
		</div>
		<hr class="qFixer" />
	</div>
	<div id="qBody">
<?php $this->load->view($subview); ?>
</div>
	<div id="qFooter"></div>
</div>
<?php $this->load->view('components/_page_foot'); ?>