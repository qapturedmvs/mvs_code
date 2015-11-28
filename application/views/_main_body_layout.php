<?php $this->load->view('components/_page_head'); ?>
<header id="qHeader">
	<div class="innerHeader qMainBlock qFixer">
		<div class="logo left">
			<a href="<?php echo ($logged_in) ? '/user/feeds' : '/'; ?>">Qaptured</a>
		</div>
		<nav class="mainMenu left">
			<a href="<?php echo ($logged_in) ? '/user/feeds' : '/'; ?>">Home</a>
			<a href="/movies">Movies</a>
		</nav>
		<section class="searchHolder mainSearchHolder left">
			<?php $this->load->view('components/_searchbox'); ?>
		</section>
		<section class="userHolder right">
			<?php if(!$logged_in): ?>
			<a class="btnDefault btnSignIn" href="/">SIGN IN</a>
			<?php endif; ?>
			<?php $this->load->view('components/_userbox'); ?>
		</section>
	</div>
</header>
<div id="qBody">
	<?php $this->load->view($subview); ?>
</div>
<footer id="qFooter" class="qMainBlock qFixer">
		<span class="copyright">Qaptured &copy; 2015</span>
		<div class="menu">
			<a href="/about/what-is-qaptured">About</a>
			<a href="/about/terms-and-conditions">Terms & Conditions</a>
			<a href="#">Cookies</a>
			<a href="#">Send Us Feedback +</a>
		</div>
 </footer>
<?php $this->load->view('components/_page_foot'); ?>