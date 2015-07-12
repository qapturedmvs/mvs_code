<div class="userMoviesMenu" page="<?php echo $controls['page']; ?>">
  <ul>
    <li><a href="<?php echo $site_url.'user/movies/seen/'.$the_user['usr_nick']; ?>">Seen Movies</a></li>
    <li><a href="<?php echo $site_url.'user/movies/watchlist/'.$the_user['usr_nick']; ?>">Watchlist</a></li>
    <li><a href="<?php echo $site_url.'user/movies/applaud/'.$the_user['usr_nick']; ?>">Applaud List</a></li>
    <li><a href="<?php echo $site_url.'user/movies/lists/'.$the_user['usr_nick']; ?>">Custom Movie Lists</a></li>
  </ul>
  <hr class="qFixer" />
</div>