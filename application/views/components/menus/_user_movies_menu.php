<?php $umm_slug = (isset($the_user)) ? $the_user->usr_nick : $user['usr_nick']; ?>
<div class="userMoviesMenu" page="<?php echo $controls['page']; ?>">
  <ul>
    <li><a href="<?php echo $site_url.'user/movies/seen/'.$umm_slug; ?>">Seen Movies</a></li>
    <li><a href="<?php echo $site_url.'user/movies/watchlist/'.$umm_slug; ?>">Watchlist</a></li>
    <li><a href="<?php echo $site_url.'user/movies/lists/'.$umm_slug; ?>">Custom Movie Lists</a></li>
  </ul>
  <hr class="qFixer" />
</div>