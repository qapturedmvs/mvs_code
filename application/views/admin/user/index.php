<div class="container pgaeUsers">
	<h2>Users</h2>
	<?php echo anchor('admin/user/edit', '<i class="icon-plus"></i> Add new user'); ?>
<?php if(count($users)): ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Email</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($users as $user): ?>
		<tr>
			<td><?php echo anchor('admin/user/edit/' . $user->adm_usr_id, $user->adm_usr_email); ?></td>
			<td><?php echo btnType('admin/user/edit/' . $user->adm_usr_id, 'edit'); ?></td>
			<td><?php echo btnType('admin/user/delete/' . $user->adm_usr_id, 'remove', array(
			'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
	) ); ?></td>
		</tr>
<?php endforeach; ?>
	</table>
<?php else: ?>
	<?php echo getMessage('info', 'We could not find any users.'); ?>
<?php endif; ?>	
</div>