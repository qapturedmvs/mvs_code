
<div class="pageDefault pageSearch">
  <h1>SEARCH RESULTS</h1>
  <div class="results">
    <?php if($results['status'] != 'none'): ?>
      <?php if($results['movies'] && ($results['status'] == 'both' || $results['status'] == 'movie')): ?>
      <div class="movies">
        <h4>MOVIES</h4>
        <ul>
          <?php foreach($results['movies'] as $movie): ?>
            <li><a href="<?php echo $site_url.'movie/'.$movie->mvs_slug; ?>">
              <span class="title"><?php echo $movie->mvs_title; ?></span>
              <?php if($movie->mvs_org_title != ''): ?>
              <span class="orgTitle"><?php echo $movie->mvs_org_title; ?></span>
              <?php endif; ?>
              <span class="year">(<?php echo $movie->mvs_year; ?>)</span>
            </a></li>
          <?php endforeach; ?>
        </ul>
        <?php if($results['status'] == 'both'): ?>
        <a class="more" href="javascript:void(0);">Get More Results</a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      <?php if($results['stars'] && ($results['status'] == 'both' || $results['status'] == 'star')): ?>
      <div class="stars">
        <h4>STARS</h4>
        <ul>
          <?php foreach($results['stars'] as $star): ?>
            <li><a href="<?php echo $site_url.'actor/'.$star->str_slug; ?>">
              <span class="title"><?php echo $star->str_name; ?></span>
            </a></li>
          <?php endforeach; ?>
        </ul>
        <?php if($results['status'] == 'both'): ?>
        <a class="more" href="javascript:void(0);">Get More Results</a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    <?php else: ?>
    <span class="noData">Please enter a keyword</span>
    <?php endif; ?>
  </div>
</div>