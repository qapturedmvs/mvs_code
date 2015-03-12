<script type="text/javascript">
	var nick = '<?php echo (isset($the_user)) ? $the_user->usr_nick : $user['usr_nick']; ?>';
</script>
<div rel="<?php echo $controls['page']; ?>" class="pageDefault pageNetwork page-<?php echo $controls['page']; ?>">
	<?php $this->load->view('components/_the_user'); ?>
	<?php $this->load->view('components/menus/_user_network_menu'); ?>
	<div class="titleDefault titleNetwork">
		<h1>Followers</h1>
	</div>
	<div class="listHolder" ng-controller='userNetwork'>
		<ul>
			<li class="listItem userItem" ng-repeat='item in items'>
				<div class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></div>
				<a href="<?php echo $site_url; ?>user/wall/{{item.usr_nick}}">{{item.usr_name}}</a>
				<?php if($logged_in): ?>
				<div class="followHolder" ng-if="item.usr_me==0">
					<a ng-if="item.flw_id==0" usr-id="{{item.usr_id}}" rel="follow" onclick="follow_unfollow(this)" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
					<a ng-if="item.flw_id!=0" usr-id="{{item.usr_id}}" flw-id="{{item.flw_id}}" rel="unfollow" onclick="follow_unfollow(this)" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
				</div>
				<?php endif; ?>
			</li>
		</ul>
		<hr class="qFixer" />
	</div>
</div>