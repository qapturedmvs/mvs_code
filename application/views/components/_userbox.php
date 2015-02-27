<?php if($logged_in): ?>
<div class="userbox">
  <div class="usrInfo"><?php echo $user['usr_name']; ?></div>
  <div class="userMenu">
    <ul>
      <li><a href="<?php echo $site_url.'user/profile'; ?>">Profile</a></li>
      <li><a href="<?php echo $site_url.'user/movies/lister'; ?>">My Movie Lists</a></li>
      <li><a href="<?php echo $site_url.'user/movies/seen'; ?>">Seen Movies</a></li>
      <li><a href="<?php echo $site_url.'user/movies/watchlist'; ?>">Watchlist</a></li>
    </ul>
  </div>
  <div class="usrLogout"><a href="<?php echo $site_url.'user/logout'; ?>">logout</a></div>
</div>
<?php endif; ?>