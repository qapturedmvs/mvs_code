<div class="container pgaeMovies">
	<h2 class="sub-header">Stars</h2>
	<div class="table-responsive">
		<?php if(is_array($actors)): ?>
			<table class="table table-striped table-movies">
				<thead>
					<tr>
						<th><a href="<?php echo $current_url; ?>">#</a></th>
						<th><a rel="name" href="javascript:void(0);">Name</a></th>
						<th>iMDB ID</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($actors as $actor): ?>
					<tr>
						<td><?php echo $actor->str_id; ?></td>
						<td><a href="<?php echo $site_url . 'admin/actors/star?id=' . $actor->str_id ?>"><?php echo $actor->str_name; ?></a></td>
						<td><?php echo $actor->str_imdb_id; ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php else: ?>
			<div class="noData"><?php echo $actors; ?></div>
		<?php endif; ?>
	</div>
</div>