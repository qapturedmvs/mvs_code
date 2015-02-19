<script type="text/javascript">
	var mvs_id = <?php echo $movie->mvs_id; ?>;
</script>
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
							<?php if($logged_in): ?>
							<ul>
								<li class="seenMovie"<?php echo ($actions['seen']) ? ' rel="unseen" seen-id="'.$actions['seen'][0]->seen_id.'"' : ' rel="seen"'; ?>><a href="javascript:void(0);">Seen</a></li>
								<li><a href="javascript:void(0);">Qapture</a></li>
								<li><a href="javascript:void(0);">Add to list</a>
									<div class="listSelection">
										<ul class="dLists">
											<li class="wtc" <?php echo ($actions['watchlist']) ? 'wtc-id="'.$actions['watchlist'][0]->wtc_id.'" rel="rwtc"' : 'rel="awtc"'; ?>><a href="javascript:void(0);"><span class="awtc">Add to Watchlist</span><span class="rwtc">Remove from Watchlist</span></a></li>
											<li class="cnl"><a href="javascript:void(0);">Add to New Custom List</a>
											<div class="listCreate none"><input placeholder="Enter list title" type="text" /><a href="javascript:void(0);">Add</a></div>
											</li>
										</ul>
										<div class="cLists none">
										<h5>My Lists</h5>
										<ul></ul>
										</div>
										<hr class="qFixer" />
									</div>
								</li>
							</ul>
							<hr class="qFixer" />
							<?php endif; ?>
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
				<div ng-controller='movieCommentController' class="movieCommentsHolder">
								<div class="commentsTabs">
								<h4>Comments</h4>
									<ul>
										<li><a href="javascript:void(0);">Top Rated</a></li>
										<li><a href="javascript:void(0);">Newest First</a></li>
										<?php if($logged_in): ?>
										<li><a href="javascript:void(0);">My Network</a></li>
										<?php endif; ?>
									</ul>
									<hr class="qFixer" />
								</div>
								<div class="commentsContent">
												
									<div act-id="{{item.act_id}}" act-ref-id="{{item.act_ref_id}}" class="commentItem" ng-repeat='item in items'>
										<span class='user'><b>{{item.usr_name}}</b></span>
										<a class="btnShowReplies" onclick="showMore(this)" href="javascript:void(0);">
											<span class='text'>{{item.act_text}}</span> 
											<span class='time'>{{item.act_time}} ago</span>
										</a>
										<?php if($logged_in): ?>
										<span ng-if="item.act_ref_id==0" class="btnHolder">
												<a onclick="moveReplyFrom(this)" href="javascript:void(0);" class="btnReply">Reply</a>
										</span>
										<?php endif; ?>
										<hr class="qFixer" />
										<div class="commentReplies">
											<div act-ref-id="{{item.act_id}}" class="commentItem subComment" ng-repeat='reply in item.reply'>
												<span class='user'><b>{{reply.usr_name}}</b></span>
												<span class='text'>{{reply.act_text}}</span> 
												<span class='time'>{{reply.act_time}} ago</span>
												<hr class="qFixer" />
											</div>
										</div>
									</div>
								
								</div>
				</div>
				<?php $this->load->view('components/_commentbox_movie'); ?>
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