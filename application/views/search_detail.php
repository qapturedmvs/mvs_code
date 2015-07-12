<div class="pageDefault pageSearch pageSearchDetail">
<script type="text/javascript">
	var keyword = "<?php echo $keyword; ?>", type = '<?php echo $type; ?>';
</script>

	<div ng-controller='searchController' class="results">
		<?php if($type == 'movie'): ?>
		
		<div class="movies">
			<h4>MOVIES</h4>
			<ul>
				<li ng-repeat='item in items.movie'>
					<a ng-href='<?php echo $site_url ?>movie/{{item.result_slug}}'>
						<span class="poster"><div class="lazy posterImg" data-original="<?php echo $site_url ?>{{item.result_poster}}"></div></span>
						<span class='title'>{{item.result_title}} <span class='year'>({{item.result_year}})</span></span> 
						<hr class="qFixer" />
					</a>
				</li>
			</ul>
		</div>
		
		<?php elseif($type == 'star'): ?>
		
		<div class="stars">
      <h4>STARS</h4>
      <ul>
        <li ng-repeat='item in items.star'> 
        <span class='title'><a ng-href='<?php echo $site_url ?>actor/{{item.result_slug}}'>{{item.result_title}}</a></span>
        </li>
      </ul>
    </div>
		
		<?php endif; ?>
	
	</div>

</div>