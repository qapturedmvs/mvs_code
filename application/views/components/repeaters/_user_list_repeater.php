<div class="userlist qFixer" ng-controller="usrRpt" infinite-scroll='reddit.nextPage()' infinite-scroll-disabled='reddit.busy' infinite-scroll-distance='0'>
	<article class="listItem userItem qFixer" ng-repeat="item in reddit.items" data-usr-id="{{item.usr_id}}" ng-class="{usr:item.type == 0, sepItem:item.type == 1, me:item.usr_me == 1}">
		<div ng-switch="item.type">
			<div ng-switch-when="0">
				<div class="userLeft left">
					<a href="/user/wall/actions/{{item.usr_nick}}" class="usrAvatar lazy" data-original="{{item.usr_avatar}}"></a>
					<?php if($logged_in): ?>
					<button ng-if="item.usr_me == 0" class="btnDefault btnFollow" data-itm-id="{{item.lgn_flwr}}" onclick="follow_user(this)"><span class="data-itm-0">FOLLOW</span><span class="data-itm-1">UNFOLLOW</span></button>
					<?php endif; ?>
				</div>
				<div class="userRight left">
					<a href="/user/wall/actions/{{item.usr_nick}}" class="usrName">{{item.usr_name}}</a>
					<?php if($logged_in): ?>
					<div class="status" ng-if="item.usr_me == 0">
						<span ng-if="item.lgn_flwr != 0" class="flwrStatus">Following</span>
						<span ng-if="item.lgn_flwd != 0" class="flwdStatus">Following you</span>
					</div>
					<span ng-if="item.usr_me == 1" class="meStatus">Me</span>
					<?php endif; ?>
				</div>
				<!--<span ng-switch-when="1"><b>PAGE {{item.paging}}</b></span>-->
        <span ng-switch-when="2"><b>{{item.result}}</b></span>
			</div>
		</div>
	</article>
	<div ng-show="reddit.loading">Loading data...</div>
  <div class="loadMore">
		<button ng-show="reddit.btnState" ng-click="reddit.nextPage()" class="btnDefault btnLoadMore">LOAD MORE</button>
	</div>
</div>