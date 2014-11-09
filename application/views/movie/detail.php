<div class="pageDefault pageMovie">
<section class="info">
<aside class="top"></aside>
<aside class="bottom">
<div class="cover left"></div>
<div class="text left">
<h1><?php echo $movie->mvs_title.' ('.$movie->mvs_year.')'; ?></h1>
<div class="genre">
<ul>
<?php var_dump($countries); ?>
<?php foreach($genres as $genre): ?>
<li><?php echo $genre->gnr_title; ?></li>
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
<div class="plot"><p><?php echo $movie->mvs_plot; ?></p></div>
<div class="cast">
<ul>
<?php foreach($casts as $cast): ?>
<li><a href="<?php echo $cast->str_slug; ?>"><?php echo $cast->str_name; ?></a><span><?php echo $cast->char_name; ?></span></li>
<?php endforeach; ?>
</ul>
<hr class="qFixer" />
</div>
</div>
</aside>
</section>
<section class="social">

</section>
</div>