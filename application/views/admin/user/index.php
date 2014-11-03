<div class="container pgaeUsers">
	<h2 class="sub-header">Admin Users</h2>
	<div class="panel panel-default panelMovies">
	<div class="panel-heading"><?php echo anchor('admin/user/edit', '<i class="glyphicon glyphicon-plus"></i> Add new user'); ?></div>
<?php if(count($users)): ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th class="alignCenter">Edit</th>
				<th class="alignCenter">Delete</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($users as $user): ?>
		<tr>
			<td><?php echo anchor('admin/user/edit/' . $user->adm_usr_id, $user->adm_usr_name); ?></td>
			<td><?php echo anchor('admin/user/edit/' . $user->adm_usr_id, $user->adm_usr_email); ?></td>
			<td class="alignCenter"><?php echo btnType('admin/user/edit/' . $user->adm_usr_id, 'edit'); ?></td>
			<td class="alignCenter"><?php echo btnType('admin/user/delete/' . $user->adm_usr_id, 'remove', array(
			'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
	) ); ?></td>
		</tr>
<?php endforeach; ?>
	</table>
	</div>
<?php else: ?>
	<?php echo getMessage('info', 'We could not find any users.'); ?>
<?php endif; ?>	
</div>