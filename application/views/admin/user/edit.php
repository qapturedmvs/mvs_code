<div class="container pgaeUserDetail">
<h3><?php echo empty($user->adm_usr_id) ? 'Add a new user' : 'Edit user: ' . $user->adm_usr_name; ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open('', array('class' => 'form-update', 'role' => 'form')); ?>
	<div class="input-group">
	  <span class="input-group-addon">Name</span>
	  <?php echo form_input('name', set_value('name', isset( $user->adm_usr_name ) ? $user->adm_usr_name : ''), 'class="form-control"'); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Email</span>
	  <?php echo form_input('email', set_value('email', isset( $user->adm_usr_email ) ? $user->adm_usr_email : ''), 'class="form-control"'); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Password</span>
	  <?php echo form_password('password', '', 'class="form-control"'); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Confirm password</span>
	  <?php echo form_password('password_confirm', '', 'class="form-control"'); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Note</span>
	  <?php echo form_input('note', set_value('note', isset( $user->adm_usr_note ) ? $user->adm_usr_note : ''), 'class="form-control"'); ?>
	</div>
	<div class="btnHolder"><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></div>
<?php echo form_close();?>
</div>