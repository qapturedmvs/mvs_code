<div class="pageDefault pageMovie">
	<aside class="mainCol left">
		<section class="info">
			<div class="heroPic"></div>
			<div class="details">
				<div class="cover left"></div>
				<div class="text left">
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
					<div class="actions">
						<ul>
							<li><button>Seen</button></li>
							<li><button>Like</button></li>
							<li><button>Add to list</button></li>
						</ul>
						<hr class="qFixer" />
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
							<li class="topBilled"><a href="#<?php echo $cast->str_slug; ?>"><img src="<?php echo $cast->str_photo; ?>" alt="<?php echo $cast->str_name; ?>" title="<?php echo $cast->str_name; ?>" /></a></li>
							<?php else:?>
							<li><a href="#<?php echo $cast->str_slug; ?>"><?php echo $cast->str_name; ?></a><span><?php echo $cast->char_name; ?></span></li>
							<?php endif; ?>
							<?php 
								$i++;
								endforeach; 
							?>
						</ul>
						<hr class="qFixer" />
					</div>
				</div>
			</div>
		</section>
		<section class="social"></section>
	</aside>
	<aside class="sidebar right"></aside>
	<hr class="qFixer" />
</div>