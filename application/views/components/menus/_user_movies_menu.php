<div class="userMoviesMenu tabDefault" data-page="<?php echo $controls['page']; ?>">
  <ul class="qFixer">
    <li data-act="sn"><a href="<?php echo '/user/movies/seen/'.$the_user['usr_nick']; ?>">Seen Movies</a></li>
    <li data-act="wtc"><a href="<?php echo '/user/movies/watchlist/'.$the_user['usr_nick']; ?>">Watchlist</a></li>
    <li data-act="app"><a href="<?php echo '/user/movies/applaud/'.$the_user['usr_nick']; ?>">Applaud List</a></li>
    <li data-act="cl"><a href="<?php echo '/user/movies/lists/'.$the_user['usr_nick']; ?>">Custom Movie Lists</a></li>
  </ul>
</div>