<div class="container pgaeMovies">
	
	<?php if(is_array($actors)): ?>
		<?php foreach($actors as $actor): ?>
			<h2 class="sub-header"><?php echo $actor->str_name; ?></h2>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="noData"><?php echo $actors; ?></div>
	<?php endif; ?>
	
	
	<div class="table-responsive">
		<?php if(is_array($casting)): ?>
			<table class="table table-striped table-movies">
				<thead>
					<tr>
						<th>Movie</th>
						<th>year</th>
						<th>Character Name</th>
						<th>Role</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($casting as $cast): ?>
					<tr>
						<td><?php echo $cast->mvs_title; ?></td>
						<td><?php echo $cast->mvs_year; ?></td>
						<td><?php echo $cast->char_name; ?></td>
						<td><?php echo $cast->type_id; ?></td>
					</tr>
				<?php endforeach; ?>		
				</tbody>
			</table>
		<?php else: ?>
			<div class="noData"><?php echo $casting; ?></div>
		<?php endif; ?>
	</div>
</div>