<div style="width:100%; padding:60px 0; background:#f0f0f0; margin:0;">
<table width="640" align="center" style="width:640px; margin:0 auto;">
  <tr>
    <td style="padding-top:60px; padding-right:60px; padding-bottom:60px; padding-left:60px; background-color:#fff;">
    <table width="520" align="center" style="width:520px; text-align:left;">
        <tr>
          <td style="text-align:left; padding-bottom:25px;"><img width="68" height="75" src="http://104.236.111.82/images/mail/mail-logo.png" border="0" alt="Qaptured Logo" /></td>
        </tr>
        <tr>
          <td style="text-align:left; font-family:Helvetica, Arial, sans-serif; font-size:45px; color:#000000;">Hello! <?php echo $mail['usr_name']; ?>.</td>
        </tr>
        <tr>
          <td style="text-align:left; padding-top:20px; padding-bottom:40px; border-bottom:1px solid #ddd; font-family:Helvetica, Arial, sans-serif; font-size:45px; color:#000000;">Welcome to Qaptured</td>
        </tr>
        <tr>
          <td style="text-align:left; padding-top:40px; padding-bottom:40px; font-family:Helvetica, Arial, sans-serif; font-size:21px; color:#000000;">Qaptured is platform for movie lovers where you can share your passion, discover new movies, and connect with others.</td>
        </tr>
        <tr>
          <td style="text-align:left; padding-bottom:70px;"><a href="<?php echo $site_url.'user/account/activate?act='.$mail['usr_act_key']; ?>"><img width="158" height="39" src="http://104.236.111.82/images/mail/mail-act-button.png" border="0" alt="Qaptured Activation Button" /></a></td>
        </tr>
      </table>
      </td>
  </tr>
  <tr>
    <td style="padding-top:30px; padding-right:60px; padding-bottom:30px; padding-left:60px; background-color:#f7f7f7; border-top:1px solid #f0f0f0;">
    	<table width="520" align="center" style="width:520px;">
        <tr>
          <td style="text-align:left; padding-bottom:15px;"><a style="font-family:Helvetica, Arial, sans-serif; font-size:13px; color:#000000; text-decoration:none;" href="<?php echo $site_url.''; ?>">Account Settings</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="font-family:Helvetica, Arial, sans-serif; font-size:13px; color:#000000; text-decoration:none;" href="<?php echo $site_url.'about/faq'; ?>">Help</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="font-family:Helvetica, Arial, sans-serif; font-size:13px; color:#000000; text-decoration:none;" href="<?php echo $site_url.'about/terms-of-use'; ?>">Terms of Use</a></td>
        </tr>
        <tr>
          <td style="text-align:left; font-family:Helvetica, Arial, sans-serif; font-size:13px; color:#888888; line-height:22px;">&copy; 2015 All Rights Reserved. Qaptured.com is a registered trademark of Qaptured Inc. 2500 East Second Avenue, 2nd Floor | Denver, Colorado 80206</td>
        </tr>
      	</table>
    </td>
  </tr>
  <tr>
    <td style="text-align:center; padding-top:45px; padding-bottom:45px;"><img width="140" height="30" src="http://104.236.111.82/images/mail/mail-footer-logo.png" border="0" alt="Qaptured Footer Logo" /></td>
  </tr>
</table>
</div>