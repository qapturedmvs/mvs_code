<div class="container pageActors">
	<?php if(count($actors)): ?>
	<input type="hidden" id="str_slug" value="<?php echo $actors->str_slug; ?>" />
	<div class="topLeft">
		<a><img rel="<?php echo $site_url.'data/stars/thumbs/'.$actors->str_slug.'_250X362_.jpg'; ?>" src="<?php echo $site_url.getStarPhoto($actors->str_photo, $actors->str_slug, 'medium'); ?>" alt="<?php echo $actors->str_name; ?>" /></a>
		<h2 class="sub-header"><?php echo $actors->str_name; ?></h2>
		</div>
	<div class="topRight">
		<div class="btnHolder">
			<a href="javascript:void(0);" class="btn btn-default btnPhotos">Photos</a>
		</div>
		<div class="photos">
			<ul></ul>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php else: ?>
		<?php echo getMessage('info', 'Actor data not found.'); ?>
	<?php endif; ?>
	<div class="table-responsive">
		<?php if(is_array($casting)): ?>
			<table class="table table-striped table-movies">
				<thead>
					<tr>
						<th>Movie</th>
						<th>year</th>
						<th>Rating</th>
						<th>Character Name</th>
						<th>Role</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($casting as $cast): ?>
					<tr>
						<td><a href="<?php echo $site_url.'admin/movie/detail/'.$cast->mvs_id; ?>"><?php echo $cast->mvs_title; ?></a></td>
						<td><?php echo $cast->mvs_year; ?></td>
						<td><?php echo $cast->mvs_rating; ?></td>
						<td><?php echo $cast->char_name; ?></td>
						<td><?php echo $cast->type_title; ?></td>
					</tr>
				<?php endforeach; ?>		
				</tbody>
			</table>
		<?php else: ?>
			<?php echo getMessage('info', 'Actor data not found.'); ?>
		<?php endif; ?>
	</div>
</div>