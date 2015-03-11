<div act-id="{{item.act_id}}" act-ref-id="{{item.act_ref_id}}" class="commentItem" ng-repeat='item in items'>
  <span class='user'><b>{{item.usr_name}}</b></span>
  <a class="btnShowReplies" onclick="showMore(this)" href="javascript:void(0);">
    <span class='text'>{{item.act_text}}</span> 
    <span class='time'>{{item.act_time}}</span>
  </a>
  <?php if($logged_in): ?>
  <span ng-if="item.act_ref_id==0" class="btnHolder">
      <a onclick="moveReplyFrom(this)" href="javascript:void(0);" class="btnReply">Reply</a>
  </span>
  <?php endif; ?>
  <hr class="qFixer" />
  <div class="commentReplies">
    <div act-ref-id="{{item.act_id}}" class="commentItem subComment" ng-repeat='reply in item.reply'>
      <span class='user'><b>{{reply.usr_name}}</b></span>
      <span class='text'>{{reply.act_text}}</span> 
      <span class='time'>{{reply.act_time}}</span>
      <hr class="qFixer" />
    </div>
  </div>
</div>