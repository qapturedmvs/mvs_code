<div class="pageDefault pageSearch pageSearchDetail qMainBlock qFixer">
  <?php if($keyword): ?>
  <script type="text/javascript">
    var keyword = "<?php echo $keyword; ?>", sType = "<?php echo $type; ?>";
  </script>
  <div class="searchHeader">
    <div class="keywordText">Results for <b>"<?php echo $keyword; ?>"</b></div>
    <div class="tabDefault tabSearch" data-page="<?php echo $type; ?>">
      <ul class="qFixer">
        <li data-act="all"><a href="/search?q=<?php echo $keyword; ?>">All</a></li>
        <li data-act="movie"><a href="/search/movie?q=<?php echo $keyword; ?>">Movies</a></li>
        <li data-act="star"><a href="/search/star?q=<?php echo $keyword; ?>">Stars</a></li>
      </ul>
    </div>
  </div>
  <aside class="pageLeft left">
    <div ng-controller="searchRpt" class="results">
      <?php if($type == 'movie' || $type == 'all'): ?>
      <div class="movies">
        <h4>MOVIES</h4>
        <div class="list" infinite-scroll="reddit.nextPage()" infinite-scroll-disabled="reddit.busy" infinite-scroll-distance="0">
          
          <div ng-repeat="item in reddit.items" class="row row-movie" ng-class="{rowMovie:item.type == 0, rowSep:item.type == 1}">
            <div ng-switch="item.type">
              <a ng-switch-when="0" class="qFixer" href="/movie/{{item.result_slug}}">
                <figure class="posterImg lazy rowLeft left" data-original="<?php echo $site_url; ?>{{item.result_poster}}"></figure>
                <div class="rowRight left">
                  <span class="title">{{item.result_title}} ({{item.result_year}})</span>
                </div>
              </a>
              <!--<span ng-switch-when="1"><b>PAGE {{item.paging}}</b></span>-->
              <span ng-switch-when="2"><b>{{item.result}}</b></span>
            </div>
          </div>
          <div ng-show="reddit.loading">Loading data...</div>
          <div class="loadMore">
            <button ng-show="reddit.btnState" ng-click="reddit.nextPage()" class="btnDefault btnLoadMore">LOAD MORE</button>
          </div>
        </div>
      </div>
      <?php elseif($type == 'star'): ?>
      <div class="stars">
        <h4>STARS</h4>
        <div class="list" infinite-scroll="reddit.nextPage()" infinite-scroll-disabled="reddit.busy" infinite-scroll-distance="0">
          
          <div class="row row-star qFixer" ng-repeat="item in reddit.items" ng-class="{rowStar:item.type == 0, rowSep:item.type == 1}">
            <div ng-switch="item.type">
              <a ng-switch-when="0" href="/actor/{{item.result_slug}}">
                <figure class="rowLeft lazy left" data-original="<?php echo $site_url; ?>{{item.result_poster}}"></figure>
                <div class="rowRight left">
                  <span class="title">{{item.result_title}}</span>
                </div>
              </a>
              <!--<span ng-switch-when="1"><b>PAGE {{item.paging}}</b></span>-->
              <span ng-switch-when="2"><b>{{item.result}}</b></span>
            </div>
          </div>
          <div ng-show="reddit.loading">Loading data...</div>
          <div class="loadMore">
            <button ng-show="reddit.btnState" ng-click="reddit.nextPage()" class="btnDefault btnLoadMore">LOAD MORE</button>
          </div>
        </div>
      </div>
      <?php endif; ?>
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
