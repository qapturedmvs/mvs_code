<?php if($logged_in): ?>
<div class="userbox">
  <div class="userInfo qFixer">
    <a class="usrAvatar lazy" data-original="<?php echo get_user_avatar($user['usr_avatar']); ?>" href="<?php echo '/user/wall/actions/'.$user['usr_nick']; ?>"></a>
    <a class="usrName" href="<?php echo '/user/wall/actions/'.$user['usr_nick']; ?>"><?php echo $user['usr_name']; ?></a>
  </div>
  <div class="userMenu none spriteBefore">
    <ul>
      <li><a href="<?php echo '/user/wall/actions/'.$user['usr_nick']; ?>">My Profile</a></li>
      <li><a href="<?php echo '/user/movies/seen/'.$user['usr_nick']; ?>">My Movies</a></li>
      <li><a href="<?php echo '/user/movies/lists/'.$user['usr_nick']; ?>">Custom Lists</a></li>
      <li><a href="<?php echo '/user/movies/watchlist/'.$user['usr_nick']; ?>">Watch List</a></li>
      <li><a href="<?php echo '/user/network/followers/'.$user['usr_nick']; ?>">My Network</a></li>
      <li class="usrSettings"><a href="/user/settings/general">Settings</a></li>
      <li class="usrSignout"><a href="/user/logout">Sign Out</a></li>
    </ul>
  </div>
</div>
<?php endif; ?>