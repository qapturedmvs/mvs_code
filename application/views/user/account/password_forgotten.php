<div class="pageDefault pageForget">
<?php if($pwf_result !== 'success'): ?>
	<div class="passwordForgetForm">
	<?php echo form_open('', array('class' => 'form-password-forget', 'role' => 'form')); ?>
		<h2 class="form-password-forget-heading">Forget Password</h2>
		<div class="error">
			<?php
				if($pwf_result === 'no-user')
					echo 'We couldn\'t find your account with that information. Please try searching for your email.';
				else
					echo $pwf_result;
			?>
		</div>
		<input name="pwf_email" id="pwf_email" type="email" class="form-control" placeholder="Email" required>
		<button class="btn btn-lg btn-primary btn-block" name="pwf_submit" id="pwf_submit" type="submit">Reset</button>
	<?php echo form_close(); ?>
	</div>
<?php else: ?>
<div class="formResultHolder pwrResultHolder">Your password reset link send to your email.</div>
<?php endif; ?>
</div>