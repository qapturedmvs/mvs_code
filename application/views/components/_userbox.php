<?php if($logged_in): ?>
<div class="userbox">
  <div class="usrInfo"><?php echo $user['usr_name']; ?></div>
  <div class="userMenu">
    <ul>
      <li><a href="<?php echo $site_url.'user/profile/general/'.$user['usr_nick']; ?>">Profile</a></li>
      <li><a href="<?php echo $site_url.'user/movies/lists/'.$user['usr_nick']; ?>">My Movie Lists</a></li>
      <li><a href="<?php echo $site_url.'user/network/followers/'.$user['usr_nick']; ?>">My Network</a></li>
    </ul>
  </div>
  <div class="usrLogout"><a href="<?php echo $site_url.'user/logout'; ?>">logout</a></div>
</div>
<?php endif; ?>