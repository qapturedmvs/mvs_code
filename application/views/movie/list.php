<div class="pageDefault pageMovies">
	<div ng-app='myApp' ng-controller='DemoController'>
	  <div infinite-scroll='reddit.nextPage()' infinite-scroll-disabled='reddit.busy' infinite-scroll-distance='0'>
	    <div ng-repeat='item in reddit.items'>
		    <div ng-if="item.type == 0 ">
		      <span class='poster'><img class="lazy" data-original="<?php echo $site_url ?>{{item.mvs_poster}}" alt="{{item.mvs_title}}" /></span>
			  <span class='title'><a ng-href='/mvs_code/public_html/movie/{{item.mvs_slug}}'>{{item.mvs_title}}</a></span>
		      <span class='runtime'>{{item.mvs_runtime}} min.</span>
		      <span class='genre'>{{item.mvs_genre}}</span>
		      <span class='country'>{{item.mvs_country}}</span>
		      <hr class="qFixer" />
	      	</div>
	      <div ng-if="item.type == 1 " class="seperator"><b>PAGE {{item.paging}}</b></div>
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
			if( $("img.lazy").length > 0 )
				$("img.lazy").lazyload();
		}, 1);
	  }
    }.bind(this));
  };

  return Reddit;
});




</script>