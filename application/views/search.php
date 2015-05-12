<div class="pageDefault pageSearch">
  <h1>SEARCH RESULTS</h1>
  <?php if($keyword): ?>
  <script type="text/javascript">
    var keyword = "<?php echo $keyword; ?>";
  </script>
  <div ng-controller='searchController' class="results">
    <div class="movies">
      <h4>MOVIES</h4>
      <ul>
        <li ng-repeat='item in items.movie'> 
        <span class='title'><a ng-href='/mvs_code/public_html/movie/{{item.result_slug}}'>{{item.result_title}}</a></span> 
        <span class='year'>{{item.result_year}}</span>
        </li>
      </ul>
      <a class="more" href="<?php echo $site_url.'search/movie?q='.$keyword; ?>">Get More Results</a>
    </div>
    <div class="stars">
      <h4>STARS</h4>
      <ul>
        <li ng-repeat='item in items.star'> 
        <span class='title'><a ng-href='/mvs_code/public_html/actor/{{item.result_slug}}'>{{item.result_title}}</a></span>
        </li>
      </ul>
      <a class="more" href="<?php echo $site_url.'search/star?q='.$keyword; ?>">Get More Results</a>
    </div>
  </div>
  <?php else: ?>
  <div class="no-keyword">Please enter a keyword.</div>
  <?php endif; ?>
</div>
