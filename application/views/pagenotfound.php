<?php

  $quotes = array(
    1 => array('slug' => 'qme0a9n1uf', 'msg' => 'Not what you are looking for? Good.'),
    2 => array('slug' => 'qmpi6llp75', 'msg' => 'You shall not go further!'),
    3 => array('slug' => 'qm0d2hm4fq', 'msg' => 'Sorry! we could not retrive the page'),
    4 => array('slug' => 'qmv0i3tt8c', 'msg' => 'That\'s it, no further!'),
    5 => array('slug' => 'qmxian97v4', 'msg' => 'Page no longer exists!'),
    6 => array('slug' => 'qmqy76wp4v', 'msg' => 'We have a problem!')
  );
  
  $quote = $quotes[mt_rand(1, 6)];
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Qaptured - 404 Page Not Found</title>
    <link href="http://local.qaptured.com/css/main.css" rel="stylesheet">
  </head>
  <body>
		<main id="qContainer">
      <header id="qHeader">
	<div class="innerHeader qMainBlock qFixer">
		<div class="logo left">
			<a href="/user/feeds">Qaptured</a>
		</div>
	</div>
</header>
<div id="qBody">
<div class="pageDefault page404">
  <div class="qHero" style="background-image:url(/data/404/<?php echo $quote['slug']; ?>.jpg);">
    <div class="qHeroInner qMainBlock">
      <div class="quoteHolder">
        <small class="rc">404</small>
        <p><?php echo $quote['msg']; ?></p>
        <span>we could not find the page you requested</span>
        <a href="/movie/<?php echo $quote['slug']; ?>">come this way</a>
      </div>
    </div>
  </div>
</div>
</div>
    </main> 

  </body>
</html>