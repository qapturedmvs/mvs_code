<?php foreach($feeds as $feed): ?>
<div act-id="<?php echo $feed['feed_id']; ?>" class="listItem refItem<?php echo ($feed['act_spl_fl'] == 1) ? ' spl' : ''; ?>">
	<div class="feedContent">
		<div class="userInfo">
		<a href="<?php echo $site_url.'user/wall/actions/'.$feed['usr_nick']; ?>" title="<?php echo $feed['usr_name']; ?>" class="usrAvatar lazy" data-original="<?php echo $site_url.$feed['usr_avatar']; ?>"></a>
		<hr class="qFixer" />
		</div>
		<div class="feedInfo">
			<div class="textContent">
				<div class="text"><?php echo $feed['act_text']; ?></div>
			</div>
			<div class="time"><span title="<?php echo $feed['feed_time']; ?>"><?php echo $feed['feed_ago']; ?></span></div>
			<hr class="qFixer" />
		</div>
		<?php if($logged_in): ?>
		<div class="feedControls">
			<div class="generalControls">
				<div class="rateHolder feedRate">
					<a class="rateUp<?php echo ($feed['usr_rate_value'] != 1) ? ' active' : ''; ?>" onclick="rateButton(this);" href="javascript:void(0);">Up <small><?php echo ($feed['feed_pos_rate'] != NULL) ? $feed['feed_pos_rate'] : 0; ?></small></a>
					<a class="rateDown<?php echo ($feed['usr_rate_value'] != -1) ? ' active' : ''; ?>" onclick="rateButton(this);" href="javascript:void(0);">Down <small><?php echo ($feed['feed_neg_rate'] != NULL) ? $feed['feed_neg_rate'] : 0; ?></small></a>
				</div>
			</div>
			<?php if($feed['owner'] == 1): ?>
			<div class="ownerControls">
				<a class="btnEdit" href="javascript:void(0);">Edit</a>	
				<a class="btnRemove" href="javascript:void(0);">Remove</a>
			</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	</div>
	<hr class="qFixer" />
</div>
<?php endforeach; ?>