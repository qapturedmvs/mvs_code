<?php $this->load->view('components/_page_head'); ?>
<div id="qContainer">
	<div id="qHeader">
		<div class="logo">
			<a href="#">Qaptured</a>
		</div>
		<div class="mainMenu">
			<nav>
				<ul>
					<li><a href="#">me</a></li>
					<li><a href="#">explore</a></li>
					<li><a href="#">home</a></li>
				</ul>
			</nav>
		</div>
		<div class="searchHolder">
			<?php $this->load->view('components/searchbox'); ?>
		</div>
		<hr class="qFixer" />
	</div>
	<div id="qBody">
<?php $this->load->view($subview); ?>
</div>
	<div id="qFooter"></div>
</div>
<?php $this->load->view('components/_page_foot'); ?>