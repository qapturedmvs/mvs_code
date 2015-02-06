<div class="pageDefault pagePasswordReset">
<?php if($pwr_result !== 'success'): ?>
	<div class="passwordResetForm">
	<?php echo form_open($current_url.'?act='.$act, array('class' => 'form-password-reset', 'role' => 'form')); ?>
		<h2 class="form-signin-heading">Password Reset</h2>
		<div class="error"><?php echo $pwr_result; ?></div>
		<input name="pwr_password" id="pwr_password" type="password" class="form-control" placeholder="Password">
		<input name="repassword" id="repassword" type="password" class="form-control" placeholder="Re-enter Password">
		<button class="btn btn-lg btn-primary btn-block" name="pwr_submit" id="pwr_submit" type="submit">Save</button>
	<?php echo form_close(); ?>
	</div>
<?php else: ?>
<div class="formResultHolder pwrResultHolder">YOUR PASSWORD CHANGED SUCCESSFULLY.</div>
<?php endif; ?>
</div>