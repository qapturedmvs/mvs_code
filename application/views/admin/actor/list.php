<div class="container pgaeMovies">
	
	<form action="<?php echo $current_url; ?>" method="POST">
		<div class="input-group">
			<input type="text" name="search_name" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit">Bul biseyler</button>
			</span>
		</div>
	</form>
	
	<h2 class="sub-header">Stars</h2>
	<div class="table-responsive">
		<?php if(is_array($actors)): ?>
			<table class="table table-striped table-movies">
				<thead>
					<tr>
						<th><a href="<?php echo $current_url; ?>">#</a></th>
						<th><a rel="name" href="javascript:void(0);">Name</a></th>
						<th>IMDB ID</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($actors as $actor): ?>
					<tr>
						<td><?php echo $actor->str_id; ?></td>
						<td><a href="<?php echo $site_url . 'admin/actor/detail/' . $actor->str_id; ?>"><?php echo $actor->str_name; ?></a></td>
						<td><?php echo $actor->str_imdb_id; ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		<?php else: ?>
			<?php echo getMessage('info', 'Actor data not found.'); ?>
		<?php endif; ?>
	</div>
	<?php if($paging != '') echo '<nav><ul class="pagination">'.$paging.'</ul></nav>'; ?>
</div>