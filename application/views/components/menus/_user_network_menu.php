<?php $umm_slug = (isset($the_user)) ? $the_user->usr_nick : $user['usr_nick']; ?>
<div class="userNetworkMenu" page="<?php echo $controls['page']; ?>">
  <ul>
    <li><a href="<?php echo $site_url.'user/network/followers/'.$umm_slug; ?>">Followers</a></li>
    <li><a href="<?php echo $site_url.'user/network/followings/'.$umm_slug; ?>">Followings</a></li>
  </ul>
  <hr class="qFixer" />
</div>