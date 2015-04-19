<table width="600" align="center" style="text-align:left;">
  <tr>
    <td style="padding:20px;"><h2>Qaptured Activation</h2></td>
  </tr>
  <tr>
    <td style="padding:20px;">
      <p>Hi dear <?php echo $mail['usr_name']; ?>,</p>
      <p>Welcome to Qaptured. For activate your account, please click link below...</p>
    </td>
  </tr>
  <tr>
    <td style="padding:20px;"><a href="<?php echo $site_url.'user/account/activate?act='.$mail['usr_act_key']; ?>"><?php echo $site_url.'user/account/activate?act='.$mail['usr_act_key']; ?></a></td>
  </tr>
</table>