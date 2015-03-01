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
        <li ng-repeat='item in items.movies'> 
        <span class='title'><a ng-href='/mvs_code/public_html/movie/{{item.mvs_slug}}'>{{item.mvs_title}}</a></span> 
        <span class='year'>{{item.mvs_year}}</span>
        </li>
      </ul>
      <a class="more" href="javascript:void(0);">Get More Results</a>
    </div>
    <div class="stars">
      <h4>STARS</h4>
      <ul>
        <li ng-repeat='item in items.stars'> 
        <span class='title'><a ng-href='/mvs_code/public_html/movie/{{item.str_slug}}'>{{item.str_name}}</a></span>
        </li>
      </ul>
      <a class="more" href="javascript:void(0);">Get More Results</a>
    </div>
  </div>
  <?php else: ?>
  <div class="no-keyword">Please enter a keyword.</div>
  <?php endif; ?>
</div>
