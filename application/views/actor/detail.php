<div class="pageDefault pageActor">
    <section class="body">
	<aside class="cover left"><img src="<?php echo $site_url; ?>images/actor.jpg" alt="<?php echo $actor->str_name; ?>" title="<?php echo $actor->str_name; ?>" /></aside>
        <aside class="detail right">
            <h1><?php echo $actor->str_name; ?></h1>
            <div class="position">
				<ul>
					<?php foreach($types as $type): ?>
					<li><?php echo $type; ?></li>
					<?php endforeach; ?>
				</ul>
                <hr class="qFixer" />
            </div>
            <div class="btnSet">
                <a class="btnDefault btnExplore rc" href="#">Explore &gt;</a>
            </div>
						<?php
						
								function sortByYear($a, $b){
										if ($a->mvs_year == $b->mvs_year){
												return 0;
										}
										return ($a->mvs_year > $b->mvs_year) ? -1 : 1;
								}
														
								$i = 0;
						?>
            <div class="movies">
								<div class="featured">
										<div class="titleDefault titleFilmography">Known For</div>
										<ul>
												<?php
														foreach($chars as $char){
																
																$cover = getCoverPath($char->mvs_imdb_id, 'medium');
																
																if($i < 5 && file_exists($cover)){
																		echo '<li style="background:url('.$site_url.$cover.') center center no-repeat; background-size:cover;"><a href="'.$site_url.'movie/'.$char->mvs_slug.'"></a></li>';	
																		$i++;
																}

														}
												
												?>
										</ul>
										<hr class="qFixer" />
								</div>
								<div class="filmography">
								<div class="titleDefault titleFilmography">Full Filmography</div>
								<?php usort($chars, "sortByYear"); ?>
										<ul>
												<?php foreach($chars as $char): ?>
												<li><span class="year"><?php echo $char->mvs_year; ?></span></span><span class="movie"><a href="<?php echo $site_url.'movie/'.$char->mvs_slug; ?>"><?php echo $char->mvs_title; ?></a></span><span class="character"><?php echo $char->char_name; ?></span><hr class="qFixer" /></li>
												<?php endforeach; ?>
										</ul>
								</div>
            </div>
        </aside>
        <hr class="qFixer" />
    </section>
</div>