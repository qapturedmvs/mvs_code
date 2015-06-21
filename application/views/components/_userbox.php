<?php if($logged_in): ?>
<div class="userbox">
  <div class="userInfo">
    <span class="userAvatar"><img src="<?php echo $site_url.get_user_avatar($user['usr_avatar']).'?t='.time(); ?>" alt="<?php echo $user['usr_name']; ?>" /></span>
    <a href="<?php echo $site_url.'user/feeds'; ?>"><?php echo $user['usr_name']; ?></a>
  </div>
  <div class="userMenu">
    <ul>
      <li><a href="<?php echo $site_url.'user/settings/details'; ?>">Settings</a></li>
      <li><a href="<?php echo $site_url.'user/wall/actions/'.$user['usr_nick']; ?>">Wall</a></li>
      <li><a href="<?php echo $site_url.'user/movies/lists/'.$user['usr_nick']; ?>">My Movie Lists</a></li>
      <li><a href="<?php echo $site_url.'user/network/followers/'.$user['usr_nick']; ?>">My Network</a></li>
    </ul>
  </div>
  <div class="usrLogout"><a href="<?php echo $site_url.'user/logout'; ?>">logout</a></div>
</div>
<?php endif; ?>