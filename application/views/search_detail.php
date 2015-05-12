<div class="pageDefault pageSearchDetail">
<script type="text/javascript">
	var keyword = "<?php echo $keyword; ?>", type = '<?php echo $type; ?>';
</script>

	<div ng-controller='searchController' class="searchLister">
		<?php if($type == 'movie'): ?>
		
		<div class="movies">
			<h4>MOVIES</h4>
			<ul>
				<li ng-repeat='item in items.movie'> 
				<span class='title'><a ng-href='/mvs_code/public_html/movie/{{item.result_slug}}'>{{item.result_title}}</a></span> 
				<span class='year'>{{item.result_year}}</span>
				</li>
			</ul>
		</div>
		
		<?php elseif($type == 'star'): ?>
		
		<div class="stars">
      <h4>STARS</h4>
      <ul>
        <li ng-repeat='item in items.star'> 
        <span class='title'><a ng-href='/mvs_code/public_html/actor/{{item.result_slug}}'>{{item.result_title}}</a></span>
        </li>
      </ul>
    </div>
		
		<?php endif; ?>
	
	</div>

</div>