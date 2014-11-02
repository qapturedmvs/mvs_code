<div class="container pgaeMovies">
	<h2 class="sub-header">Movies</h2>
	<div class="table-responsive">
		<?php if(count($movies)): ?>
			<table class="table table-striped table-movies">
				<thead>
					<tr>
						<th><a href="<?php echo $current_url; ?>">#</a></th>
						<th>Poster</th>
						<th><a rel="title" href="javascript:void(0);">Title</a></th>
						<th>Original Title</th>
						<th><a rel="year" href="javascript:void(0);">Year</a></th>
						<th style="text-align:right;"><a rel="runtime" href="javascript:void(0);">Runtime</a></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($movies as $movie): ?>
					<tr>
						<td><?php echo $offset; ?>.</td>
						<td class="posterGrid"><a href="<?php echo $site_url.'admin/movie/detail/'.$movie->mvs_id; ?>"><?php if($movie->mvs_poster != '') echo '<img src="'.$site_url.'data/movies/thumbs/'.$movie->mvs_imdb_id.'_thumb.jpg" alt="'.$movie->mvs_title.'" />'; ?></a></td>
						<td><a href="<?php echo $site_url.'admin/movie/detail/'.$movie->mvs_id; ?>"><?php echo $movie->mvs_title; ?></a></td>
						<td><?php echo $movie->mvs_org_title; ?></td>
						<td><?php echo $movie->mvs_year; ?></td>
						<td style="text-align:right;"><?php echo $movie->mvs_runtime; ?> min.</td>
					</tr>
				<?php $offset++; ?>
				<?php endforeach; ?>		
				</tbody>
			</table>
		<?php else: ?>
			<?php echo getMessage('info', 'Movie data not found.'); ?>
		<?php endif; ?>
	</div>
    <?php if($paging != '') echo '<nav><ul class="pagination">'.$paging.'</ul></nav>'; ?>
</div>