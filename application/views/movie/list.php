<div ng-app='myApp' ng-controller='DemoController'>
  <div infinite-scroll='reddit.nextPage()' infinite-scroll-disabled='reddit.busy' infinite-scroll-distance='0'>
    <div ng-repeat='item in reddit.items'>
      <div ng-if="item.type == 0 "> <span class='score'>{{item.mvs_runtime}}</span> <span class='title'> <a ng-href='#' target='_blank'>{{item.mvs_title}}</a> </span> <small>by {{item.mvs_country}} - <a ng-href='#' target='_blank'>{{item.cntry_id}} comments</a> </small>
        <div style='clear: both;'></div>
      </div>
      <div ng-if="item.type == 1 " class="seperator">
        <h2>{{item.paging}} . SAYFA</h2>
      </div>
    </div>
    <div ng-show='reddit.busy'>Loading data...</div>
  </div>
</div>
<script type="text/javascript">

/* http://binarymuse.github.io/ngInfiniteScroll/demo_async.html */

var myApp = angular.module('myApp', ['infinite-scroll']);

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
	var url = "/qapturedmvs/mvs_code/public_html/ajx/movie_ajx/lister/" + this.after;
    $http.get(url).success(function(d) {

	  if( d['result'] == 'OK' ){
	  	for(var i = 0; i < d['data'].length; ++i){
			var items = d['data'][ i ];
				items['type'] = 0;			
			this.items.push( items );
		}
	  	this.after++;
	  	this.busy = false;	
		this.items.push( { 'type': 1, 'paging': this.after } );

	  }
    }.bind(this));
  };

  return Reddit;
});




</script>