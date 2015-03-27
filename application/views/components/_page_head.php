<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
			$temp_title = $site_name;
			
			if(isset($meta_tags)):
		
				$temp_title = $meta_tags->title.' - '.$temp_title;
		?>
			<link rel='image_src' href="<?php echo $site_url.$meta_tags->image; ?>">
			<meta property='og:image' content="<?php echo $site_url.$meta_tags->image; ?>" />
			<meta property='og:type' content="<?php echo $meta_tags->type; ?>" />
			<meta property='og:title' content="<?php echo $meta_tags->title; ?>" />
			<meta property='og:site_name' content='<?php echo $site_name; ?>' />
			<meta name="title" content="<?php echo $temp_title; ?>" />
			<meta name="description" content="<?php echo $meta_tags->description; ?>" />
			<meta property="og:description" content="<?php echo $meta_tags->description; ?>" />
		<?php endif; ?>
    <title><?php echo $temp_title; ?></title>
			<script type="text/javascript">
				var site_url = '<?php echo $site_url; ?>',
						current_url = '<?php echo $current_url; ?>',
						page = '<?php echo (isset($controls['page'])) ? $controls['page'] : ''; ?>';
			</script>
    <link href="<?php echo site_url('css/main.css'); ?>" rel="stylesheet">
    <script src="<?php echo site_url('js/jquery-1.11.1.min.js'); ?>"></script>
    <script src="<?php echo site_url('js/angular.min.js'); ?>"></script>
    <link href="<?php echo site_url('js/jquery-ui/jquery-ui.css'); ?>" rel="stylesheet">
		<script src="<?php echo site_url('js/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo site_url('js/plugins.js'); ?>"></script>
  </head>
  <body ng-app="qapturedApp">
		<input type="hidden" id="site_url" value="<?php echo $site_url; ?>" />