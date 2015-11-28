<script type="text/javascript" src="/js/paper-full.min.js"></script>
<script type="text/javascript" src="/js/TweenMax.min.js"></script>
<script type="text/paperscript" canvas="graphs" src="/js/graphs.js"></script>
<script type="text/javascript">
	var paperscript = {},
			slug = '<?php echo $actor['str_slug']; ?>',
			str_id = <?php echo $actor['str_id']; ?>;
</script>
<div class="pageDefault pageStar">
	<section class="info qMainBlock qFixer">
		<aside class="leftCol left">
			<figure class="starPhoto" style="background-image:url(<?php echo $site_url.getStarPhoto($actor['str_photo'], $actor['str_slug'], 'original'); ?>);"></figure>
		</aside>
		<aside class="rightCol left">
			<div class="top">
				<h1><?php echo $actor['str_name']; ?></h1>
				<a class="btnDefault btnExplore rc none" href="#">EXPLORE <i class="sprite"></i></a>
				<div class="role">
					<ul class="qFixer">
						<?php foreach($movies as $type => $data): ?>
						<li><?php echo $type; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php if($featured): ?>
			<div class="featured">
				<h4 class="titleDefault titleStarFeatured">KNOWN FOR</h4>
				<ul class="qFixer">
					<?php
					
						foreach($featured as $slug => $feat)
							echo '<li><a title="'.$feat['title'].' - '.$feat['year'].'" href="'.$site_url.'movie/'.$slug.'"><span class="poster" style="background-image:url('.$site_url.getMoviePoster(1, $slug, 'medium').');"></span><span class="title">'.$feat['title'].' <small>'.$feat['year'].'</small></span></a></li>';	

					?>
				</ul>
			</div>
			<?php endif; ?>
		</aside>
	</section>
	
	<section class="filmographics graphs">
		<div class="qMainBlock">
			<h4 class="titleDefault titleStarFilmographics">FILMOGRAPHICS</h4>
			<div class="compare starCompare">
				<input type="text" id="star_keyword" placeholder="Compare with..." />
				<div class="suggestions"></div>
			</div>
			<div class="graphics qFixer">
				<canvas id="graphs" height="550" width="1000" stats hidpi="on"></canvas>
			</div>
            <div id="graph_tooltip"></div>
		</div>
	</section>

	<section class="filmography qMainBlock">
			<div class="tabDefault tabFilmography">
				<ul class="qFixer">
					<?php foreach($movies as $type => $datas): ?>
					<li><button rel="<?php echo $type; ?>"><?php echo $type; ?></button></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="tabContent">
				<?php foreach($movies as $type => $datas): ?>
					<ul class="<?php echo $type; ?>">
						<?php foreach($datas as $year => $items): ?>
						<li>
							<span class="year"><?php echo $year; ?></span>
							<ul>
								<?php foreach($items as $item): ?>
								<li class="qFixer"><a href="<?php echo '/movie/'.$item['slug']; ?>"><?php echo $item['title']; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endforeach; ?>
				</div>
		</section>
</div>