<div rel="<?php echo $controls['page']; ?>" class="pageDefault pageSettings">
	<div class="qHero uHero" style="background-image:url(<?php echo get_user_Cover($the_user['usr_cover']); ?>);">
		<a href="/user/settings/cover">
			<i class="sprite"></i>
			<div class="text">Change Your Cover Photo</div>
		</a>
	</div>
	<div class="pageSettingsInner qMainBlock qFixer">
		<?php $this->load->view('components/menus/_the_user_menu'); ?>
		<aside class="pageLeft left">
			<a href="<?php echo $site_url.'user/settings/avatar'; ?>" data-original="<?php echo get_user_avatar($user['usr_avatar']); ?>" class="lazy spriteAfter" title="<?php echo $the_user['usr_name']; ?>"></a>
		</aside>
		<aside class="pageRight left">
			<div class="titleDefault titleProfile">
				<h1>ACCOUNT INFO</h1>
			</div>
		<?php echo form_open('', array('class' => 'form-profile', 'role' => 'form')); ?>
			<?php echo (isset($result)) ? '<div class="formResult '.$result['status'].'">'.$result['info'].'</div>' : ''; ?>
			<ul>
				<li class="qFixer">
					<label class="lblPrf">Name</label>
					<input name="prf_name" id="prf_name" type="text" class="form-control rc" value="<?php echo $the_user['usr_name']; ?>" required="required" />
				</li>
				<li class="qFixer">
					<label class="lblPrf">Username</label>
					<input name="prf_nick" id="prf_nick" type="text" class="form-control rc" rel="<?php echo $the_user['usr_nick']; ?>" value="<?php echo $the_user['usr_nick']; ?>" required="required" />
				</li>
				<li class="qFixer">
					<label class="lblPrf">E-mail</label>
					<input name="prf_email" id="prf_email" type="email" class="form-control rc" value="<?php echo $the_user['usr_email']; ?>" required="required" />
				</li>
				<li class="qFixer">
					<label class="lblPrf">Bio</label>
					<input name="prf_slogan" id="prf_slogan" type="text" class="form-control rc" value="<?php echo $the_user['usr_slogan']; ?>" />
				</li>
				<li class="userLoc qFixer">
					<label class="lblPrf">Location</label>
					<input name="prf_location" id="prf_location" type="text" class="form-control rc" placeholder="City name, region..." value="<?php echo $the_user['usr_location']; ?>" />
					<input name="city_id" id="city_id" type="hidden" value="<?php echo $the_user['city_id']; ?>" />
					<div class="suggestions"></div>
				</li>
				<li class="qFixer">
					<label class="lblPrf">Password</label>
					<input name="prf_password" id="prf_password" type="password" class="form-control rc" />
				</li>
				<li class="qFixer">
					<label class="lblPrf">Re-Password</label>
					<input name="repassword" id="repassword" type="password" class="form-control rc" />
				</li>
			</ul>
			<button class="btnDefault btnSaveSettings" name="prf_submit" id="prf_submit" type="submit">Save Changes</button>
		<?php echo form_close(); ?>
		</aside>
	</div>
</div>
<?php //if($modified_data): ?>
<script type="text/javascript">
	//profile_save('<?php echo $modified_data; ?>');
</script>
<?php //endif; ?>