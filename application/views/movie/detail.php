<script type="text/javascript">
	var mvs_id = <?php echo $movie->mvs_id; ?>;
</script>
<div class="pageDefault pageMovie" mvs-id="<?php echo $movie->mvs_id; ?>">
	<section class="hero"></section>
	<section class="body">
		<aside class="mainCol left">
			<div class="details">
				<div class="cover left"><div class="posArea"><img src="<?php echo $site_url.getCoverPath($movie->mvs_slug, 'medium'); ?>" alt="<?php echo $movie->mvs_title; ?>" /></div></div>
				<div class="text left">
					<div class="posArea">
						<h1 title="<?php echo $movie->mvs_title; ?>"><?php echo $movie->mvs_title.' (<small>'.$movie->mvs_year.'</small>)'; ?></h1>
						<div class="genre">
							<ul>
								<?php foreach($genres['data'] as $genre): ?>
								<li><?php echo $genres['table'][$genre]; ?></li>
								<?php endforeach; ?>
							</ul>
							<hr class="qFixer" />
						</div>
						<div class="country">
							<ul>
								<?php foreach($countries['data'] as $country): ?>
								<li><?php echo $countries['table'][$country]; ?></li>
								<?php endforeach; ?>
							</ul>
							<hr class="qFixer" />
						</div>
						<div class="trailer"><a class="trailerBtn button" onclick="watch_trailer(this)" href="javascript:void(0);">Trailer</a></div>
						<hr class="qFixer" />
						<div class="actions">
							<?php if($logged_in): ?>
							<ul>
								<li class="seenMovie singleSeen"><a<?php echo ($actions['lists'][0]->seen_id !== NULL) ? ' rel="unseen" seen-id="'.$actions['lists'][0]->seen_id.'"' : ' rel="seen"'; ?> href="javascript:void(0);" onclick="single_seen(this)"><span class="actSeen">Seen</span><span class="actUnseen">Unseen</span></a></li>
								<li><a href="javascript:void(0);">Qapture</a></li>
								<li class="addToList"><a href="javascript:void(0);">Add to list</a>
									<div class="listSelection">
										<ul class="dLists">
											<li class="wtc addtoWtc"><a onclick="add_remove_wtc(this)" <?php echo ($actions['lists'][0]->wtc_id !== NULL) ? 'wtc-id="'.$actions['lists'][0]->wtc_id.'" rel="rwtc"' : 'rel="awtc"'; ?> href="javascript:void(0);"><span class="awtc">Add to Watchlist</span><span class="rwtc">Remove from Watchlist</span></a></li>
											<li class="cnl"><a href="javascript:void(0);">Add to New Custom List</a>
											<div class="listCreate none"><input maxlength="255" placeholder="Enter list title" type="text" /><a rel="cncl" href="javascript:void(0);">Add</a></div>
											</li>
										</ul>
										<div class="cLists none">
										<h5>My Lists</h5>
										<ul>
											<?php foreach($actions['lists'] as $list): ?>
												<?php if($list->list_id !== NULL): ?>
												<li <?php echo ($list->ldt_id !== NULL) ? 'ldt-id="'.$list->ldt_id.'" rel="rfcl"' : 'rel="atcl"'; ?> list-id="<?php echo $list->list_id; ?>"><a href="javascript:void(0);"><?php echo $list->list_title; ?></a></li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
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
				<?php $this->load->view('components/_commentbox'); ?>
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
<script type="text/javascript">
	
	var color = {
    get: function(a, b, c) {
        var e = new Image;
        e.onerror = function() {
            alert("y\u00fcklemede hata")
        };
        e.onload = function() {
            var a = document.createElement("canvas");
            a.width = e.width;
            a.height = e.height;
            a = a.getContext("2d");
            a.drawImage(e, 0, 0);
            a = a.getImageData(0, 0, this.width, this.height).data;
            a = color.rgbToHex(a[0], a[1], a[2]);
            //a = color.shade("#" + a, -8);
            b((!1 == c ? "" : "#") + a);
        };
        e.src = a
    },
    rgbToHex: function(a, b, c) {
        return color.toHex(a) + color.toHex(b) + color.toHex(c)
    },
    toHex: function(a) {
        a = parseInt(a, 10);
        if (isNaN(a)) return "00";
        a = Math.max(0, Math.min(a,
            255));
        return "0123456789ABCDEF".charAt((a - a % 16) / 16) + "0123456789ABCDEF".charAt(a % 16)
    },
    shade: function(a, b) {
        var c = parseInt(a.slice(1), 16),
            e = Math.round(2.55 * b),
            h = (c >> 16) + e,
            g = (c >> 8 & 255) + e,
            c = (c & 255) + e;
        return (16777216 + 65536 * (255 > h ? 1 > h ? 0 : h : 255) + 256 * (255 > g ? 1 > g ? 0 : g : 255) + (255 > c ? 1 > c ? 0 : c : 255)).toString(16).slice(1)
    }
};

 color.get('<?php echo $site_url.getCoverPath($movie->mvs_slug, 'small'); ?>', function( k ) {
		$('.pageMovie .hero').css("background-color", k);  
  });
	
</script>