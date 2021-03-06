<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->config->item('mvs_site_name'); ?> Admin</title>
    <link href="<?php echo site_url('back/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('back/css/main.css'); ?>" rel="stylesheet">
    <script src="<?php echo site_url('back/js/jquery-1.11.1.min.js'); ?>"></script>
    <script src="<?php echo site_url('back/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('back/js/location.plugin.min.js'); ?>"></script>
   <!-- <link href="<?php echo site_url('back/js/jquery-ui/jquery-ui.css'); ?>" rel="stylesheet">-->
		<script src="<?php echo site_url('back/js/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
      var site_url = '<?php echo $site_url; ?>',
          current_url = '<?php echo $current_url; ?>';
    </script>
  </head>
  <body>
  <input type="hidden" id="hdnSiteUrl" value="<?php echo $site_url; ?>" />