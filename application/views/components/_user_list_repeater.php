<li class="listItem userItem" ng-repeat='item in items'>
	<div class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></div>
	<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a>
	<?php if($logged_in): ?>
	<div class="followHolder" ng-if="item.usr_me==0">
		<a ng-if="item.flw_id==0" usr-id="{{item.usr_id}}" rel="follow" onclick="follow_unfollow(this)" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
		<a ng-if="item.flw_id!=0" usr-id="{{item.usr_id}}" flw-id="{{item.flw_id}}" rel="unfollow" onclick="follow_unfollow(this)" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
	</div>
	<?php endif; ?>
</li>