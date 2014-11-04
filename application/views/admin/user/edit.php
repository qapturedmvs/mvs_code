<div class="container pgaeUserDetail">
<h3><?php echo empty($user->adm_usr_id) ? 'Add a new user' : 'Edit user ' . $user->adm_usr_name; ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open('', array('class' => 'form-update', 'role' => 'form')); ?>
<table class="table">
	<tr>
		<td>Name</td>
		<td><?php echo form_input('name', set_value('name', isset( $user->adm_usr_name ) ? $user->adm_usr_name : '')); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo form_input('email', set_value('email', isset( $user->adm_usr_email ) ? $user->adm_usr_email : '')); ?></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><?php echo form_password('password'); ?></td>
	</tr>
	<tr>
		<td>Confirm password</td>
		<td><?php echo form_password('password_confirm'); ?></td>
	</tr>
	<tr>
		<td>Note</td>
		<td><?php echo form_input('note', set_value('note', isset( $user->adm_usr_note ) ? $user->adm_usr_note : '')); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close();?>
</div>