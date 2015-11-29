<script type="text/javascript">
	var mvs_id = <?php echo $movie['mvs_id']; ?>;
</script>
<div data-mvs-id="<?php echo $movie['mvs_id']; ?>" class="pageDefault pageMovie<?php echo ($movie['mvs_cover'] != 0) ? ' scrolledPage"><div class="qHero" style="background-image:url('.get_movie_Cover($movie['mvs_slug']).');">' : ' noCover"><div class="qHero">'; ?>
		<div class="qHeroInner qMainBlock">
			<div class="title"><h1><?php echo $movie['mvs_title']; ?></h1><small><?php echo $movie['mvs_year']; ?></small></div>
			<section class="movieInfoTop qFixer">
				<?php if(isset($movie['genres'])): ?>
				<div class="genre">
					<ul class="qFixer">
						<?php foreach($movie['genres'] as $key => $genre): ?>
						<li><a href="/movies?mfg=<?php echo $movie['gnr_id'][$key]; ?>"><?php echo $genre; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
				<?php if(isset($movie['audience'])): ?>
				<div class="audience"><?php echo $movie['audience']; ?></div>
				<?php endif; ?>
				<?php if($movie['mvs_runtime'] != '' && $movie['mvs_runtime'] != 0): ?>
				<div class="runtime"><?php echo $movie['mvs_runtime']; ?> min</div>
				<?php endif; ?>
			</section>
		</div>
	</div>
	<div class="body qMainBlock qFixer">
		<aside class="leftCol left">
			<section class="visuals">
				<div rel="<?php echo $movie['mvs_poster']; ?>" data-thumb="<?php echo $site_url.getMoviePoster($movie['mvs_poster'], $movie['mvs_slug'], 'small'); ?>" class="poster qFixer"><img src="<?php echo $site_url.getMoviePoster($movie['mvs_poster'], $movie['mvs_slug'], 'original'); ?>" alt="<?php echo $movie['mvs_title']; ?>" />
				<div class="miniInfo"><span><?php echo $movie['mvs_title']; ?></span><small><?php echo $movie['mvs_year']; ?></small></div>
				</div>
				<?php if($movie['mvs_cover'] != 0 || ($movie['mvs_poster'] != 0 && $movie['mvs_rating'] >= 5)): ?>
				<div class="trailer qFixer"><button class="spriteBefore" onclick="watch_trailer(this);">Trailer</button></div>
				<?php endif; ?>
			</section>
		</aside>
		<aside class="midCol left">
			<section class="movieInfoBottom">
				<div class="stats">
					<ul class="qFixer">
						<?php if($movie['mvs_rating'] !== ''): ?>
						<li class="rating spriteBefore"><?php echo $movie['mvs_rating']; ?></li>
						<?php endif; ?>
						<li class="imdbRate">
							<a class="imdbRatingPlugin spriteAfter" target="_blank" data-title="<?php echo $movie['mvs_imdb_id']; ?>" data-style="p4" title="<?php echo $movie['mvs_title'].' ('.$movie['mvs_year'].')'; ?> on IMDb" href="http://www.imdb.com/title/<?php echo $movie['mvs_imdb_id']; ?>/?ref_=plg_rt_1"></a>
						<script>(function(d,s,id){var js,stags=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return;}js=d.createElement(s);js.id=id;js.src="http://g-ec2.images-amazon.com/images/G/01/imdb/plugins/rating/js/rating.min.js";stags.parentNode.insertBefore(js,stags);})(document,'script','imdb-rating-api');</script>
						</li>
						<?php if($movie['rev_count'] !== NULL && $movie['rev_count'] != 0): ?>
						<li class="revCount"><a class="spriteAfter"><?php echo $movie['rev_count']; ?></a></li>
						<?php endif; ?>
					</ul>
				</div>
				
				<div class="plot">
					<p><?php echo $movie['mvs_plot']; ?></p>
				</div>
				
				<?php if($logged_in): ?>
				<div class="movieActions">
					<ul class="qFixer">
						<li class="seen"><button class="btnDefault btnSeen spriteBefore" data-itm-id="<?php echo ($movie['seen_id'] !== NULL) ? $movie['seen_id'] : 0; ?>" onclick="qptAction.seen(this)">WATCHED</button></li>
						<li class="addToList">
							<button class="btnDefault btnAddToList spriteBefore">ADD TO LIST</button>
							<div class="listSelection qFixer">
								<div class="title">ADD TO</div>
								<div class="wtc">
									<button  class="chkDefault chkWtc spriteBefore" onclick="qptAction.watchlist(this)" data-itm-id="<?php echo ($movie['wtc_id'] !== NULL) ? $movie['wtc_id'] : 0; ?>">Watchlist</button>
								</div>
								<div class="clSearch">
									<input class="rc" type="text" placeholder="List name..." />
								</div>
								<div class="cLists">
									<?php foreach($cls as $cl): ?>
									<button class="chkDefault chkCl" onclick="qptAction.customlist(this)" data-prn-id="<?php echo $cl['list_id']; ?>" data-itm-id="<?php echo ($cl['ldt_id'] !== NULL) ? $cl['ldt_id'] : 0; ?>"><?php echo $cl['list_title']; ?></button>
									<?php endforeach; ?>
								</div>
								<div class="ncList">
									<button>Add to New Custom List</button>
									<div class="listCreate none">
										<input class="rc" maxlength="255" placeholder="List title..." type="text" />
										<button rel="cncl">Add</button>
									</div>
								</div>
							</div>
						</li>
						<li class="applaud"><button class="btnDefault btnApplaud spriteBefore" data-itm-id="<?php echo ($movie['app_id'] !== NULL) ? $movie['app_id'] : 0; ?>" onclick="qptAction.applaud(this)">APPLAUD</button></li>
					</ul>
				</div>

				<div class="userNetworkSeen" ng-controller="pmdUsrNetSn">
					<div class="qFixer" ng-if="items.users.length > 0">
						<span class="avatars" ng-repeat="item in items.users"><a ng-if="$first && item.seen_fl!=0" class="usrAvatar lazy" title="<?php echo $user['usr_name']; ?>" href="/user/wall/actions/<?php echo $user['usr_nick']; ?>" data-original="<?php echo get_user_avatar($user['usr_avatar']); ?>"></a><a class="usrAvatar lazy" title="{{item.usr_name}}" href="/user/wall/actions/{{item.usr_nick}}" data-original="{{item.usr_avatar}}"></a></span>
						<span class="names" ng-repeat="item in items.users"><a ng-if="$first && item.seen_fl!=0" href="/user/wall/actions/<?php echo $user['usr_nick']; ?>">You</a><span ng-if="$first && item.seen_fl!=0">, </span><span ng-if="!$first">, </span><a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a></span>
						<span ng-if="items.total > 2"> and <b>{{items.total-2}} others</b></span> have watched this
					</div>
				</div>
				<?php endif; ?>
				
				<div class="casts">
					<?php if(isset($casts['director'])): ?>
					<span class="director">
						<b>DIRECTOR</b>
						<?php
							
							foreach($casts['director'] as $key => $star){

								echo ($key == 0) ? '' : ', ';
								echo '<a href="/actor/'.$star['str_slug'].'">'.$star['str_name'].'</a>';
								
							}
						?>
					</span>
					<?php endif; ?>
					<?php if(isset($casts['stars'])): ?>
					<span class="stars">
					<b>STARS</b>
						<?php
							
							foreach($casts['stars'] as $key => $star){

								echo ($key == 0) ? '' : ', ';
								echo '<a href="/actor/'.$star['str_slug'].'">'.$star['str_name'].'</a>';
								
							}
						?>
					</span>
					<?php endif; ?>
				</div>
				
				<?php if(isset($movie['countries'])): ?>
				<div class="country">
					<b>COUNTRY</b>
					<?php foreach($movie['countries'] as $key => $country): ?>
						<?php echo ($key == 0) ? '' : ', '; ?><a href="/movies?mfc=<?php echo $movie['cntry_id'][$key]; ?>"><?php echo $country; ?></a>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				
			</section>
			<section class="reviews revMovie">
				<?php $this->load->view('components/_reviewbox'); ?>
			</section>
		</aside>
		
		<aside class="rightCol right">
			<section class="lists relatedLists rlClMovie" ng-controller="mdUserCustomlists">
				<div ng-if="items.lists.length > 0">
					<h5>RELATED LISTS</h5>
					<ul>
						<li class="clist qFixer" ng-repeat="item in items.lists">
							<div class="listCover left" ng-if="item.list_data_slugs != null">
								<a class="qFixer" href="/user/movies/detail/{{item.list_slug}}">
									<figure ng-repeat="cld in item.cld" class="lazy left" data-original="<?php echo $site_url; ?>{{cld.cover}}"></figure>
								</a>
							</div>
							<div class="listInfo left">
								<div class="listTitle">
									<a href="/user/movies/detail/{{item.list_slug}}">{{item.list_title}}</a>
									<small>{{item.list_movie_count}}</small>
								</div>
								<div class="listOwner">
									by <a href="/user/wall/actions/{{item.usr_nick}}">{{item.usr_name}}</a>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</section>
		</aside>
	</div>

</div>