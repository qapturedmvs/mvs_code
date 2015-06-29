<div class="pageDefault pageActor">
  <section class="body">
		<aside class="cover left">
			<img src="<?php echo $site_url; ?>images/actor.jpg" alt="<?php echo $actor; ?>" title="<?php echo $actor; ?>" />
		</aside>
		<aside class="detail right">
			<h1><?php echo $actor; ?></h1>
			<div class="position">
				<ul>
					<?php foreach($movies as $type => $data): ?>
					<li><?php echo $type; ?></li>
					<?php endforeach; ?>
				</ul>
					<hr class="qFixer" />
			</div>
			<div class="btnSet">
				<a class="btnDefault btnExplore rc" href="#">Explore &gt;</a>
			</div>
			<div class="movies">
				<div class="featured">
					<div class="titleDefault titleFilmography">Known For</div>
					<ul>
						<?php
							foreach($featured as $slug => $feat){
									
								$cover = getCoverPath($slug, 'medium');
								
								echo '<li><a title="'.$feat['title'].' - '.$feat['year'].'" href="'.$site_url.'movie/'.$slug.'"><span class="poster" style="background:url('.$site_url.$cover.') center center no-repeat; background-size:cover;"></span><span class="title">'.$feat['title'].' <small>'.$feat['year'].'</small></span></a></li>';	
	
							}
						?>
						</ul>
						<hr class="qFixer" />
					</div>
					<div class="filmography">
					<div class="titleDefault titleFilmography">Full Filmography</div>
						<div class="tabDefault tabFilmography">
							<ul>
								<?php foreach($movies as $type => $datas): ?>
								<li<?php echo ($type == 'Actor') ? ' class="selected"' : ''; ?>><a rel="<?php echo $type; ?>" href="javascript:void(0);"><?php echo $type; ?></a></li>
								<?php endforeach; ?>
							</ul>
								<hr class="qFixer" />
						</div>
						<div class="tabContent">
							<?php foreach($movies as $type => $datas): ?>
								<ul class="<?php echo $type; ?>">
									<?php foreach($datas as $year => $items): ?>
									<li>
										<span class="year"><?php echo $year; ?></span>
										<ul>
											<?php foreach($items as $item): ?>
											<li><a href="<?php echo $site_url.'movie/'.$item['slug']; ?>"><?php echo $item['title']; ?></a></li>
											<?php endforeach; ?>
										</ul>
										<hr class="qFixer" />
									</li>
									<?php endforeach; ?>
								</ul>
								<?php endforeach; ?>
							</div>
					</div>
			</div>
		</aside>
    <hr class="qFixer" />
  </section>
</div>