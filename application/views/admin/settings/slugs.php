<div class="container pgaeSlugs">
	<h2 class="sub-header">Slug Generate</h2>
	<div class="NavHolder">
		<ul class="nav nav-tabs" role="tablist">
		  <li role="presentation"><a href="<?php echo $site_url; ?>admin/settings">General</a></li>
		  <li role="presentation" class="active"><a>Generate Slugs</a></li>
			<li role="presentation"><a href="<?php echo $site_url; ?>admin/settings/rate">Rate Movies</a></li>
		</ul>
	</div>
	<div class="settingsHolder">
		<ul class="list-group">
		  <li class="list-group-item">
		    Movies without slug
		    <?php if($movie_slugs > 0): ?>
		    <span title="Generate Slugs" rel="<?php echo $site_url; ?>admin/settings/slug_gen/movies" class="badge"><?php echo $movie_slugs; ?></span>
		    <img src="<?php echo $site_url; ?>back/images/ajax-loader.gif" class="ajax-loader" />
		   <?php endif; ?>
		  </li>
		  <li class="list-group-item">
		    Actors without slug
		    <?php if($actor_slugs > 0): ?>
		    <span title="Generate Slugs" rel="<?php echo $site_url; ?>admin/settings/slug_gen/actors" class="badge"><?php echo $actor_slugs; ?></span>
		    <img src="<?php echo $site_url; ?>back/images/ajax-loader.gif" class="ajax-loader" />
		    <?php endif; ?>
		  </li>
		</ul>
	</div>
</div>