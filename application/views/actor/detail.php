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
            <div class="movies">
                <ul>
                    <?php foreach($chars as $char): ?>
                    <li><span class="movie"><a href="<?php echo $site_url.'movie/'.$char->mvs_slug; ?>"><?php echo $char->mvs_title; ?></a></span><span class="character"><?php echo $char->char_name; ?></span><hr class="qFixer" /></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>
        <hr class="qFixer" />
    </section>
</div>