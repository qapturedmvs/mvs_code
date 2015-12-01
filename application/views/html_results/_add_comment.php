<div data-itm-id="<?php echo $result['act_id']; ?>" class="listItem repItem<?php echo ($result['act_spl_fl'] == 1) ? ' spl' : ''; ?>">
  <div class="contentLeft">
    <a href="/user/wall/actions/<?php echo $this->user['usr_nick']; ?>" title="<?php echo $this->user['usr_name']; ?>" class="usrAvatar lazy" data-original="<?php echo $this->user['usr_avatar']; ?>"></a>
  </div>
  <div class="contentRight">
    <div class="feedHead">
      <span class="info"><a href="/user/wall/actions/<?php echo $this->user['usr_nick']; ?>"><?php echo $this->user['usr_name']; ?></a></span>
      <span class="time" title="<?php echo $result['act_time']; ?>"><?php echo time_calculator($result['act_time']); ?></span>
    </div>
    <div class="text"><?php echo $result['act_text']; ?></div>
    <div class="revControls qFixer">
      <div class="general qFixer">
        <span class="rateHolder feedRate">
          <button class="rateUp spriteAfter" onclick="rateButton(this);"></button>
          <b></b>
          <button class="rateDown spriteBefore" onclick="rateButton(this);"></button>
        </span>
      </div>
      <div class="owner qFixer">
        <button class="lnkDefault lnkEdit" onclick="editReview(this);">Edit</button>
        <button class="lnkDefault lnkRemove" type="rev" onclick="confirmation(this);">Remove</button>
      </div>
    </div>
    <?php echo ($result['act_spl_fl'] == 1): ?>
    <div class="spoilerControls"><span class="spriteBefore">Spoiler Alert</span><button onclick="showSpoiler(this);">Reveal</button></div>
    <?php endif; ?>
  </div>
</div>