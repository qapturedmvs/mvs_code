<div class="container pgaeMovies">
<h2 class="sub-header">Movies</h2>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th><a href="<?php echo $current_url; ?>">#</a></th>
				<th>Poster</th>
				<th><a href="<?php echo $current_url; ?>?sort=title">Title</a></th>
				<th>Original Title</th>
				<th><a href="<?php echo $current_url; ?>?sort=year">Year</a></th>
				<th style="text-align:right;"><a href="<?php echo $current_url; ?>?sort=runtime">Runtime</a></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($movies as $movie): ?>
			<tr>
				<td><?php echo $movie->mvs_id; ?></td>
				<td><?php echo $movie->mvs_poster; ?></td>
				<td><a href="<?php echo '#'.$movie->mvs_id; ?>"><?php echo $movie->mvs_title; ?></a></td>
				<td><?php echo $movie->mvs_org_title; ?></td>
				<td><?php echo $movie->mvs_year; ?></td>
				<td style="text-align:right;"><?php echo $movie->mvs_runtime; ?> min.</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>