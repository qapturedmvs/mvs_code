<div class="pageDefault pageMovie">
	<section class="hero"></section>
	<section class="body">
		<aside class="mainCol left">
			<div class="details">
				<div class="cover left"><div class="posArea"><img src="<?php echo $site_url."data/movies/thumbs/".$movie->mvs_imdb_id."_175X240_.jpg"?>" alt="<?php echo $movie->mvs_title; ?>" /></div></div>
				<div class="text left">
					<div class="posArea">
						<h1><?php echo $movie->mvs_title.' ('.$movie->mvs_year.')'; ?></h1>
						<div class="genre">
							<ul>
								<?php foreach($genres as $genre): ?>
								<li><?php echo $genre['gnr_title']; ?></li>
								<?php endforeach; ?>
							</ul>
							<hr class="qFixer" />
						</div>
						<div class="country">
							<ul>
								<?php foreach($countries as $country): ?>
								<li><?php echo $country['cntry_title']; ?></li>
								<?php endforeach; ?>
							</ul>
							<hr class="qFixer" />
						</div>
						<hr class="qFixer" />
						<div class="actions">
							<ul>
								<li><a href="#">Seen</a></li>
								<li><a href="#">Like</a></li>
								<li><a href="#">Add to list</a></li>
							</ul>
							<hr class="qFixer" />
						</div>
					</div>
					<div class="plot">
						<p><?php echo $movie->mvs_plot; ?></p>
					</div>
					<div class="cast">
						<ul>
							<?php 
								$i = 0;
								foreach($casts as $cast): 
									if($i < 3):
							?>
							<li class="topBilled"><a href="<?php echo $site_url.'actor/'.$cast->str_slug; ?>"><img src="<?php if($cast->str_photo != '') echo $cast->str_photo; else echo $site_url."images/actor.jpg"; ?>" alt="<?php echo $cast->str_name; ?>" title="<?php echo $cast->str_name; ?>" /></a></li>
							<?php else:?>
							<li><span class="actor"><a href="<?php echo $site_url.'actor/'.$cast->str_slug; ?>"><?php echo $cast->str_name; ?></a></span><span class="character"><?php echo $cast->char_name; ?></span></li>
							<?php endif; ?>
							<?php 
								$i++;
								endforeach; 
							?>
						</ul>
						<hr class="qFixer" />
					</div>
				</div>
				<hr class="qFixer" />
			</div>
			<div class="social">
				<?php $this->load->view('components/_comment'); ?>
			</div>
		</aside>
		<aside class="sidebar right">
			<section class="btnSet">
				<a class="btnDefault btnExplore rc" href="#">Explore &gt;</a>
			</section>
			<section class="lists relatedLists">
				<span class="sectionTitle">Related Lists</span>
				<ul>
					<li><a href="#">My Horror Movies</a></li>
					<li><a href="#">Best Movies</a></li>
					<li><a href="#">Movies of mine</a></li>
					<li><a href="#">Steven's movies</a></li>
					<li><a href="#">My oldies list</a></li>
				</ul>
			</section>
		</aside>
		<hr class="qFixer" />
	</section>
</div>