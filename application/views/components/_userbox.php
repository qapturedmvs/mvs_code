<?php if($logged_in): ?>
<div class="userbox">
  <div class="usrInfo"><?php echo $user['usr_name']; ?></div>
  <div class="usrLogout"><a href="<?php echo $site_url.'user/logout'; ?>">logout</a></div>
</div>
<?php endif; ?>