<div class="container pageRate">
	<h2 class="sub-header">Settings</h2>
	<div class="NavHolder">
		<ul class="nav nav-tabs" role="tablist">
		  <li role="presentation"><a href="<?php echo $site_url; ?>admin/settings">General</a></li>
		  <li role="presentation"><a href="<?php echo $site_url; ?>admin/settings/slug">Generate Slugs</a></li>
      <li role="presentation" class="active"><a>Rate Movies</a></li>
		</ul>
	</div>
	<div class="settingsHolder">
    <ul class="list-group">
		  <li class="list-group-item">
		    <?php if($unrated > 0): ?>
        Number of Unrated Movies
		    <span title="Unrated Movies" rel="<?php echo $site_url; ?>admin/settings/calc_rating" class="badge"><?php echo $unrated; ?></span>
		    <img src="<?php echo $site_url; ?>back/images/ajax-loader.gif" class="ajax-loader" />
        <?php else: ?>
        No unrated movie found
        <?php endif; ?>
		  </li>
		</ul>
	</div>
</div>