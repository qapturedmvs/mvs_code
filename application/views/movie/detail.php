<div class="pageDefault pageMovie">
	<section class="hero"></section>
	<section class="body">
		<aside class="mainCol left">
			<div rel="<?php echo $movie->mvs_id; ?>" class="details">
				<div class="cover left"><div class="posArea"><img src="<?php echo $site_url.'data/movies/thumbs/'.$movie->mvs_slug.'_175X240_.jpg'; ?>" alt="<?php echo $movie->mvs_title; ?>" /></div></div>
				<div class="text left">
					<div class="posArea">
						<h1><?php echo $movie->mvs_title.' ('.$movie->mvs_year.')'; ?></h1>
						<div class="genre">
							<ul>
								<?php foreach($genres as $genre): ?>
								<li><?php echo $genre->gnr_title; ?></li>
								<?php endforeach; ?>
							</ul>
							<hr class="qFixer" />
						</div>
						<div class="country">
							<ul>
								<?php foreach($countries as $country): ?>
								<li><?php echo $country->cntry_title; ?></li>
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
						<span class="title">Stars: </span>
							<?php
								$i = 0;
								
								foreach($casts as $cast){
									if($i == 0)
										echo '<a href="'.$site_url.'actor/'.$cast->str_slug.'">'.$cast->str_name.'</a>';
									else
										echo ', <a href="'.$site_url.'actor/'.$cast->str_slug.'">'.$cast->str_name.'</a>';

									$i++;
								}
							?>
						<hr class="qFixer" />
					</div>
				</div>
				<hr class="qFixer" />
			</div>
			<div class="social">
				<div ng-controller='movieFeedsController' class="movieFeedsHolder">
								<div class="feedsTabs"><ul><li><a href="javascript:void(0);">Top Rated</a></li><li><a href="javascript:void(0);">My Network</a></li></ul></div>
								<div class="feedsContent">
												
								<div ng-repeat='item in items'> 
								<span class='text'>{{item.act_text}}</span> 
								<span class='time'>{{item.act_time}}</span>
								</div>
								
								</div>
				</div>
				<?php $this->load->view('components/_comment_movie'); ?>
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