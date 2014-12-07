<div class="pageDefault pageMovies">
	<div class="controllers">
		<div class="view">
			<a class="row" href="javascript:void(0);">Row View</a>
			<a class="grid" href="javascript:void(0);">Grid View</a>
		</div>
	</div>
	<div ng-app='myApp' ng-controller='DemoController' class="movieListHolder row">
	  <div infinite-scroll='reddit.nextPage()' infinite-scroll-disabled='reddit.busy' infinite-scroll-distance='0'>
	    <div ng-repeat='item in reddit.items' ng-class="{movieItem:item.type == 0, seperator:item.type == 1}">
		  
          <div ng-switch="item.type">
          <div ng-switch-when='0'> 
            <span class='poster'><a ng-href='/mvs_code/public_html/movie/{{item.mvs_slug}}'><div class="lazy" data-original="<?php echo $site_url ?>data/movies/thumbs/{{item.mvs_imdb_id}}_175x240_.jpg"></div></a></span> 
            <span class='title'><a ng-href='/mvs_code/public_html/movie/{{item.mvs_slug}}'>{{item.mvs_title}}</a></span> 
            <span class='year'>{{item.mvs_year}}</span> 
            <span class='runtime'>{{item.mvs_runtime}} min.</span> 
            <span class='rating'>{{item.mvs_rating}}</span> 
            <span class='genre'>{{item.mvs_genre}}</span> 
            <span class='country'>{{item.mvs_country}}</span>
            <hr class="qFixer" />
          </div>
          <div ng-switch-when='1'><b>PAGE {{item.paging}}</b></div>
		</div>  
	      
	    </div>
	    <div ng-show='reddit.busy'>Loading data...</div>
	  </div>
	</div>
<script type="text/javascript">
var site_url = $('#mvs_site_url').val();
/* http://binarymuse.github.io/ngInfiniteScroll/demo_async.html */

var myApp = angular.module('myApp', ['infinite-scroll']);

myApp.config(['$httpProvider', function ($httpProvider) {
  $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);

myApp.controller('DemoController', function($scope, Reddit) {
  $scope.reddit = new Reddit();
});

// Reddit constructor function to encapsulate HTTP and pagination logic
myApp.factory('Reddit', function($http) {
  var Reddit = function() {
    this.items = [];
    this.busy = false;
    this.after = 1;
  };

  Reddit.prototype.nextPage = function() {
    if (this.busy) return;
    this.busy = true;	
	var url = site_url+"ajx/movie_ajx/lister/" + this.after;
    $http.get(url).success(function(d) {

	  if( d['result'] == 'OK' ){
	  	for(var i = 0; i < d['data'].length; ++i){
			var items = d['data'][ i ];
				items['type'] = 0;
				items['mvs_genre'] = items['mvs_genre'].toString();
				items['mvs_country'] = items['mvs_country'].toString();					
			this.items.push( items );
		}
	  	this.after++;
	  	this.busy = false;
	  	this.items.push( { 'type': 1, 'paging': this.after } );
		
		
		// TRIGGER LAZYLOAD
		setTimeout(function(){
			if( $("div.lazy").length > 0 )
				$("div.lazy").lazyload({ effect: 'fadeIn', load: function(){ $( this ).parents('.movieItem').addClass('loaded'); } });
		}, 1);
	  }
    }.bind(this));
  };

  return Reddit;
});




</script>