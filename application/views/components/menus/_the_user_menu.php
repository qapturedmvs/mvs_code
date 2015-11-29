<div class="theUserMenu" data-page="<?php echo $controls['page']; ?>">
	<ul class="qFixer">
		<li data-act="wall"><a href="<?php echo '/user/wall/actions/'.$the_user['usr_nick']; ?>">PROFILE</a></li>
		<li data-act="cl"><a href="<?php echo '/user/movies/seen/'.$the_user['usr_nick']; ?>">MY MOVIES</a></li>
		<li data-act="ntw"><a href="<?php echo '/user/network/followers/'.$the_user['usr_nick']; ?>">MY NETWORK</a></li>
		<?php if($controls['owner']): ?>
		<li data-act="set"><a class="spriteAfter" href="/user/settings/general">SETTINGS</a></li>
		<?php endif; ?>
	</ul>
</div>