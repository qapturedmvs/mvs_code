<li class="listItem userItem" ng-repeat='item in items'>
	<div class="userInner" usr-id="{{item.usr_id}}">
		<div class="usrAvatar lazy" data-original="<?php echo $site_url; ?>{{item.usr_avatar}}"></div>
		<a href="<?php echo $site_url; ?>user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a>
		<?php if($logged_in): ?>
		<div class="loginUserActions" ng-if="item.usr_me==0">
			<div class="statusHolder">
				<span ng-if="item.lgn_flwr!=0" class="flwrStatus">You'r following</span>
				<span ng-if="item.lgn_flwd!=0" class="flwdStatus">Following you</span>
			</div>
			<div class="followHolder">
				<a class="btnDefault btnFollow" data-itm-id="{{item.lgn_flwr}}" onclick="follow_user(this)" href="javascript:void(0);"><span class="flw">Follow</span><span class="uflw">Unfollow</span></a>
			</div>
		</div>
		<?php endif; ?>
	</div>
</li>