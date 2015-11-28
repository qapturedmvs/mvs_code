<div class="pageDefault pageSearch searchAll qMainBlock qFixer">
  <?php if($keyword): ?>
  <script type="text/javascript">
    var keyword = "<?php echo $keyword; ?>";
  </script>
  <section class="searchHeader">
    <div class="keywordText">Results for <b>"<?php echo $keyword; ?>"</b></div>
    <div class="tabDefault tabSearch" data-page="all">
      <ul class="qFixer">
        <li data-act="all"><a href="/search?q=<?php echo $keyword; ?>">All</a></li>
        <li data-act="movie"><a href="/search/movie?q=<?php echo $keyword; ?>">Movies</a></li>
        <li data-act="star"><a href="/search/star?q=<?php echo $keyword; ?>">Stars</a></li>
      </ul>
    </div>
  </section>
  <aside class="pageLeft left">
    <div ng-controller="searchRpt" class="results">
      <div class="movies">
        <h4>MOVIES</h4>
        <div class="list">
          
          <div ng-repeat="item in items.movie" class="row row-movie">
            <a class="qFixer" href="/movie/{{item.result_slug}}">
              <figure class="posterImg lazy rowLeft left" data-original="<?php echo $site_url; ?>{{item.result_poster}}"></figure>
              <div class="rowRight left">
                <span class="title">{{item.result_title}} ({{item.result_year}})</span>
              </div>
            </a>
          </div>

        </div>
        <div class="more">
          <a class="lnkDefault lnkSearchMore" href="/search/movie?q=<?php echo $keyword; ?>">Show more movie results for <b>"<?php echo $keyword; ?>"</b></a>
        </div>
      </div>

      <div class="stars">
        <h4>STARS</h4>
        <div class="list">
          
          <div class="row row-star qFixer" ng-repeat="item in items.star">
            <a href="/actor/{{item.result_slug}}">
              <figure class="rowLeft lazy left" data-original="<?php echo $site_url; ?>{{item.result_poster}}"></figure>
              <div class="rowRight left">
                <span class="title">{{item.result_title}}</span>
              </div>
            </a>
          </div>

        </div>
        <div class="more">
          <a class="lnkDefault lnkSearchMore" href="/search/star?q=<?php echo $keyword; ?>">Show more star results for <b>"<?php echo $keyword; ?>"</b></a>
        </div>
      </div>
    </div>
    <?php else: ?>
    <div class="no-keyword">Please enter a keyword.</div>
    <?php endif; ?>
    </aside>
    <aside class="pageRight right">
      <div class="text">Not finding what you are looking for?</div>
      <a href="#" class="btnDefault btnAdvSearch">ADVANCED SEARCH</a>
    </aside>
</div>
