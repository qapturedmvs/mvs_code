var coor = {b:{x:50, y:50, width:460}, w:{x:750, y:200, radius:155}};
var sticks, line, line2, grad, grad2, net, net2;
						
var draw = {
	init: function(){
		
		sticks = new Group({pivot:[0, 0]});
		
						
		line2 = new Path({strokeColor: "#69a3bb", strokeWidth: 2});
		grad2 = new Path();
		grad2.opacity = .5;
	    grad2.fillColor = { gradient: {
										stops: ['#69a3bb', '#222222']
									},
        					origin: [0, 100],
							destination: [0, 300]
    					};
		line = new Path({strokeColor: "#bb9f69", strokeWidth: 2});
		grad = new Path();
		grad.opacity = .5;
	    grad.fillColor = { gradient: {
										stops: ['#bb9f69', '#222222']
									},
        					origin: [0, 100],
							destination: [0, 300]
    					};
						
	},
	ball: new Symbol( new Group({children:[ new Path.Circle({radius:3, fillColor: "#ffffff", strokeColor: "#bb9f69", strokeWidth: 2}), new Path.Circle({radius:10}) ], pivot:[0, 0] })),
	ball2: new Symbol( new Group({children:[ new Path.Circle({radius:3, fillColor: "#ffffff", strokeColor: "#69a3bb", strokeWidth: 2}), new Path.Circle({radius:10}) ], pivot:[0, 0] })),
	//stick: new Symbol( new Group({children:[ new Path({segments:[[0, 0], [0, 200]], strokeColor: "#444"}) ], pivot:[0, 0] })),
	stick: function(point){
		return new Path({segments:[point, point + [0, 200]], strokeColor:"#444"});
	},
	text: function(point, content, xalign, yalign){
		
		var text_item = new PointText(point);
            text_item.fillColor = "#6f6f6f";
            text_item.justification = xalign;
            text_item.content = content;
			text_item.pivot = [xalign == "right" ? text_item.bounds.width : 0];
			
		return text_item;
	},
	axis: function(_width){
		
		var axis_lines = new Path({strokeColor: "#6f6f6f"});
			axis_lines.add([coor.b.x, coor.b.y]);
			axis_lines.add([coor.b.x, coor.b.y+250]);
			axis_lines.add([coor.b.x+_width+1, coor.b.y+250]);
			
		draw.text(new Point(coor.b.x - 15, coor.b.y + 50 + Math.round(.1 * 200 )), "9");
		draw.text(new Point(coor.b.x - 15, coor.b.y + 50 + Math.round(.4 * 200 )), "6");
		draw.text(new Point(coor.b.x - 15, coor.b.y + 50 + Math.round(.7 * 200 )), "3");
		
	},
	bars: function(){
		
		//project.activeLayer.removeChildren();
		
		draw.init();
		
		var spacing = Math.floor( coor.b.width / (stones.length)),
			_width = spacing * (stones.length - 1);
			
		draw.axis(_width);
			
		var lifetime_total1 = 0, lifetime_num1 = 0, 
			lifetime_total2 = 0, lifetime_num2 = 0;
		
		for( var i=0; i<stones.length; ++i)
		{
			if( i > 0 )
				sticks.addChild( draw.stick(new Point(spacing * i, 0)) );
			
			var year_total1 = 0, num1 = 0,
				year_total2 = 0, num2 = 0;
			
			for(var j=0; j<stones[i].length; ++j)
			{
				if( stones[i][j].id == 1)
				{
					year_total1 += parseFloat( stones[i][j].mvs_rating );
					num1++;
				}
				else
				{
					year_total2 += parseFloat( stones[i][j].mvs_rating );
					num2++;
				}
			}
			
			var year_avg1 = Math.round( ( year_total1 / num1 ) * 100 ) / 100,
				year_avg2 = Math.round( ( year_total2 / num2 ) * 100 ) / 100;
				
			if( num1 != 0 )
			{
				lifetime_total1 += year_avg1;
				lifetime_num1++;
				
				//var ball = draw.ball.place(new Point(coor.b.x + spacing * i, coor.b.y + 250));
				var ball = draw.ball.place(new Point(coor.b.x + spacing * i, coor.b.y + 50 + ( 200 - 200 * year_avg1 / 10 )));
					ball._name = "ball";
					ball._dest = new Point(coor.b.x + spacing * i, coor.b.y + ( 200 - 200 * year_avg1 / 10 ));
					ball._id = i;
					ball._actor_id = 1;
					ball._av = year_avg1;
					
					//balls.push( ball );
					
					line.add( ball.position );
					grad.add( ball.position );
			}
			
			if( num2 != 0)
			{
				lifetime_total2 += year_avg2;
				lifetime_num2++;
				
				//var ball = draw.ball.place(new Point(coor.b.x + spacing * i, coor.b.y + 250));
				var ball = draw.ball2.place(new Point(coor.b.x + spacing * i, coor.b.y + 50 + ( 200 - 200 * year_avg2 / 10 )));
					ball._name = "ball";
					ball._dest = new Point(coor.b.x + spacing * i, coor.b.y + ( 200 - 200 * year_avg2 / 10 ));
					ball._id = i;
					ball._actor_id = 2;
					ball._av = year_avg2;
					
					//balls.push( ball );
					
					line2.add( ball.position );
					grad2.add( ball.position );
			}
		}
		
		draw.text(new Point(coor.b.x + 10, coor.b.y + 10), "Rating : " + Math.round( ( lifetime_total1 / lifetime_num1 ) * 100) / 100);
		
		grad.add([grad.lastSegment.point.x, coor.b.y + 250]);
		grad.add([grad.firstSegment.point.x, coor.b.y + 250]);
		grad.closePath();
		
		if(grad2.segments.length > 0)
		{
			grad2.add([grad2.lastSegment.point.x, coor.b.y + 250]);
			grad2.add([grad2.firstSegment.point.x, coor.b.y + 250]);
			grad2.closePath();
		}
		
		sticks.position = [coor.b.x, coor.b.y + 50];
		
		var btn = new Path.Circle({center:[50, 350], radius:20, fillColor:"red"});
		draw.text( btn.position + [30, 0], "compare to Christian Bale");
		btn.onClick = function(){
		
		loadData( "qa2iwl77jg", false );
		
	};
		
		view.play();
	}
}


var data = [], data2 = [];

function loadData(ID, first)
{
	console.log(time(), "start");
	
	$.ajax({
		url: "/ajx/actor_ajx/graph/"+ ID,
		xhrFields: {withCredentials:!0},
		success: function(a){ 
		
			console.log(time(), "ajax result");
			
			if( a.result == "OK" )
			{
				//data = a.data;
				//initBars();
				
				first == true ? init.bars_data( a.data ) : init.bars_mix_data( a.data );
				//draw.bars();
				
				//initWeb();
			}
		}
	});
}
loadData(slug, true);

this.getData = function(ID, first){ loadData(ID, first); }
paper.install(window.paperscript);

//var obj = {};
var objarr = [];

var web = {
	initData:function(){
		
		var obj = this.makeObject( data );
		
		for( var genre in obj )
		{
			objarr.push( {title: genre, n: obj[genre][0], id: parseInt(obj[genre][1])} );
		}
		
		objarr.sort(function(a, b){ return b.n - a.n });
		web._max1 = objarr[0].n;
		var w = objarr.slice(0, 8);
		var total = 0;
		
		for(var i=0; i<w.length; ++i)
		{
			total += w[i].n;
			//console.log( (12-i) / 12 );
			//var k = (((i*( _max / w.length * .5)))/_max);
			//w[i].n = w[i].n * k;
		}
		var avg = total / w.length;
		
		w.sort(function(a, b){ return a.id - b.id });
		web.data = w;
		
		console.log(web.data);
		
		web.skeleton();
		web.mesh( false );
		
	},
	mix_data: function(a){
		
		var obj = this.makeObject( a );
		
		for(var i=0; i<web.data.length; ++i)
		{
			web.data[i].m = obj[web.data[i].title] ? parseInt( obj[web.data[i].title][0] ) : 0;
			//web.data[i].m = parseInt( obj[web.data[i].title][0] );
		}
		
		var temp = web.data.slice(0);
		temp.sort(function(a, b){ return b.m - a.m });
		
		web._max2 = temp[0].m;
		
		console.log( web.data, temp );
		
		web.mesh( true );
		
	},
	makeObject: function( a ){
		
		var obj = {};
		
		for(var i=0; i<a.length; ++i)
		{
			if( a[i].gnr_title != null)
			{
				var gnr = a[i].gnr_title.split(",");
				var gnr_id = a[i].gnr_id.split(",");
					
				for( var j in gnr)
				{
					if( obj[ gnr[j] ] == undefined )
						obj[ gnr[j] ] = [1, gnr_id[j] ];
					else
						obj[ gnr[j] ][0] += 1;
				}
			}
		}
		return obj;
	},
	data: null, _max1: null, _max2: null,
	skeleton: function(){
		
		var nest = [new Path({strokeColor:"#444"}), new Path({strokeColor:"#444"}), new Path({strokeColor:"#444"})];
		
		var radian = 360 / web.data.length;
		
		for(var i=0; i<web.data.length; ++i)
		{
			var angle = ( i * radian - 180 ) * ( Math.PI / 180 );
			var _x = coor.w.x + Math.sin( angle ) * coor.w.radius;
        	var _y = coor.w.y + Math.cos( angle ) * coor.w.radius;
			
			var line = new Path([[coor.w.x, coor.w.y], [_x, _y]]);
            	line.strokeColor = '#444';
			
			var ys = i*radian > 90 && i*radian < 270 ? 10 : -5,
				xs = i*radian >= 180 ? 5 : -5;
			
			draw.text(new Point(_x + xs, _y + ys), web.data[i].title, i * radian >= 180 ? "left" : "right");
			
			nest[0].add([_x, _y]);
			nest[1].add([coor.w.x + Math.sin( angle ) * coor.w.radius * .75, coor.w.y + Math.cos( angle ) * coor.w.radius * .75]);
			nest[2].add([coor.w.x + Math.sin( angle ) * coor.w.radius * .50, coor.w.y + Math.cos( angle ) * coor.w.radius * .50]);
		}
		
		nest[0].closed = nest[1].closed = nest[2].closed = true;
		
		net = new Path({strokeColor:"#bb9f69", strokeWidth:2, fillColor:new Color(.7, 0.6, 0.4, 0.4), strokeJoin:"round", strokeCap:"butt"});
		net2 = new Path({strokeColor:"#69a3bb", strokeWidth:2, fillColor:new Color(.4, 0.6, 0.7, 0.4), strokeJoin:"round", strokeCap:"butt"});
		
	},
	mesh: function( iscompare ){
		
		console.log( iscompare );
		
		var radian = 360 / web.data.length;
		
		for(var i=0; i<web.data.length; ++i)
		{
			var angle = ( i * radian - 180 ) * ( Math.PI / 180 );
			
			var k = web.data[i].n / web._max1;	
			var _x = coor.w.x + Math.sin( angle ) * (coor.w.radius * k );
        	var _y = coor.w.y + Math.cos( angle ) * (coor.w.radius * k );
			
			//var ball = draw.ball.place(new Point(_x, _y));
			net.add(new Point(_x, _y));
			
			if( iscompare )
			{
				var k1 = web.data[i].m / web._max2;	
				var _x1 = coor.w.x + Math.sin( angle ) * (coor.w.radius * k1 );
				var _y1 = coor.w.y + Math.cos( angle ) * (coor.w.radius * k1 );
				
				//var ball = draw.ball2.place( new Point(_x1, _y1));
				net2.add(new Point(_x1, _y1));
			}
			
		}
		net.closed = true;
		net2.closed = true;
	}
}
	
function initWeb()
{
	web.initData();
	
	//drawWeb( w, _max, avg );
}

var param = new Path({strokeColor:'#444'});
//var web = new Path({strokeColor:"#bb9f69", strokeWidth:2, fillColor:new Color(.7, 0.6, 0.4, 0.4), strokeJoin:"round", strokeCap:"butt"});


function drawWeb( arr, _max, avg)
{
	console.log( avg );
	
	var radian = 360 / arr.length;
	
	_max = _max;
	
	for( var i=0; i<arr.length; ++i)
	{
		var angle = ( i * radian ) * ( Math.PI / 180 );
		
		//var k = arr[i].n / _max;
		var k = ((arr[i].n / _max ) * .5);
		
		var _x = coor.w.x + Math.sin( angle ) * coor.w.radius;
        var _y = coor.w.y + Math.cos( angle ) * coor.w.radius;
        var _x1 = coor.w.x + Math.sin( angle ) * (coor.w.radius * k );
        var _y1 = coor.w.y + Math.cos( angle ) * (coor.w.radius * k );
		
		var point = new Point(_x, _y);
        
        var line = new Path([[coor.w.x, coor.w.y], [_x, _y]]);
            line.strokeColor = '#444';
			
			draw.text([_x, _y], arr[i].title + " : " + arr[i].n);
		
		param.add(new Point(_x, _y));
        web.add(new Point(_x1, _y1));
	}
	web.closed = true;
	//web.smooth();
    param.closed = true;
}


var stones = [];
var balls = [];


var init = {
	bars_data: function(a){
		
		for( i in a )
		{
			a[i].id = 1;
			data.push( a[i] );
		}
		
		stones = groupBy(data, function(item){ return [item.mvs_year]; });
		
		draw.bars();
		initWeb();
		
	},
	bars_mix_data: function(a){
		
		project.activeLayer.removeChildren();
		
		for( i in a )
		{
			a[i].id = 2;
			data2.push( a[i] );
		}
		
		var array = data.concat( data2 );
			array = array.sort(function(a, b){ return a.mvs_year - b.mvs_year });
		
		stones = groupBy(array, function(item){ return [item.mvs_year]; });
			
		draw.bars();
		//initWeb();
		
		web.mix_data( a );
	}
	
}

						
/*

function initBars()
{
	//ascending
	//movies.sort(function(a, b){ return a.year - b.year })
	
	// group same year movies
	stones = groupBy(data, function(item){ return [item.mvs_year]; });
	
	draw.bars();
	
	var k = Math.floor(480 / (stones.length-1));
	
	for(var i=0; i<stones.length; ++i)
	{
		
		if( i > 0)
		{
		var stick = new Path({strokeColor: "#444"});
			stick.add(50 + k * i, 50+50);
			stick.add(50 + k * i, 50+250);
		}
		
		var s = 0;	
		for(var j=0; j<stones[i].length; ++j)
			s += parseFloat( stones[i][j].mvs_rating );
			
		r = Math.round( (s / stones[i].length) * 100) / 100;
		
		var ball = draw.ball.place(50 + k * i, 100 + 200);
			ball._name = "ball";
			ball._dest = new Point(50 + k * i, 100 + ( 200 - 200 * r / 10 ));
			ball._id = i;
			ball._av = r;
			
			balls.push( ball );
			
			line.add( ball.position );
			
			grad.add( ball.position );
			
	}
	
	grad.add([50+480, 50+250]);
	grad.add([50, 50+250]);
	grad.closePath();
	
	view.play();
	console.log(time(), "sketch is done");
	fireAnim();
}

function fireAnim()
{
	for( var i=0; i<balls.length; ++i)
	{
		TweenMax.to( balls[i].position, 1, {x:balls[i]._dest.x, y:balls[i]._dest.y, ease:Quart.easeOut});
		TweenMax.to( line.segments[i].point, 1, {x:balls[i]._dest.x, y:balls[i]._dest.y, ease:Quart.easeOut});
		TweenMax.to( grad.segments[i].point, 1, {x:balls[i]._dest.x, y:balls[i]._dest.y, ease:Quart.easeOut});
	}
}

function average( arr )
{
	var n = 0;
	for( var i=0; i<arr.length; ++i)
		n += arr[i];
	return n / arr.length;	
}

var x = 700;
var y = 200;
var radius = 150;

var web = new Path({strokeColor:"#bb9f69", strokeWidth:2, fillColor:["#bb9f69", .5]});
var param = new Path({strokeColor:'#444'});

function drawWeb(arr)
{
	var items_number = arr.length > 12 ? 12 : arr.length;
	var radian = 360 / items_number;
	var maxnum = arr[0].n;
	
	for( var i=0; i<items_number; ++i)
	{
		var angle = ( i * radian ) * ( Math.PI / 180 );
		
		var _x = x + Math.sin( angle ) * radius;
        var _y = y + Math.cos( angle ) * radius;
        var _x1 = x + Math.sin( angle ) * (radius * (arr[i].n/maxnum) );
        var _y1 = y + Math.cos( angle ) * (radius * (arr[i].n/maxnum) );
		
		var point = new Point(_x, _y);
        
        var line = new Path([[x, y], [_x, _y]]);
            line.strokeColor = '#444';
		
		param.add(new Point(_x, _y));
        web.add(new Point(_x1, _y1));
	}
	web.closed = true;
    param.closed = true;
}

//---------------------------------------


/*
function drawPath()
{
    for(var i=0; i<rates.length; ++i)
    {
        var point = new Point(i*(w/rates.length), ((10-rates[i])/10)*h);
        var dot = new Path.Circle({center:point, radius:3, fillColor:"silver"});
            dot.rate = rates[i];
            dot.onMouseEnter = enter;
        path.add(point);
    }
    //path.smooth();
}

var web = new Path({strokeColor:"red", fillColor:[0, .2]});
var web2 = new Path({strokeColor:"blue", fillColor:[0, .2]});
var param = new Path({strokeColor:'silver'});

function drawWeb()
{
    var k = 360 / rates.length;
    
    for(var i=0; i<rates.length; ++i)
    {
        var angle = (i * k) * ( Math.PI / 180);
        var _x = x + Math.sin( angle ) * radius;
        var _y = y + Math.cos( angle ) * radius;
        var _x1 = x + Math.sin( angle ) * (radius * (rates[i]/10) );
        var _y1 = y + Math.cos( angle ) * (radius * (rates[i]/10) );
        var _x2 = x + Math.sin( angle ) * (radius * (rates2[i]/10) );
        var _y2 = y + Math.cos( angle ) * (radius * (rates2[i]/10) );
        
        var point = new Point(_x, _y);
        var dot = new Path.Circle({center:point, radius:3, fillColor:'silver'});
        
        var line = new Path([[x, y], [_x, _y]]);
            line.strokeColor = 'silver';
        
        param.add(new Point(_x, _y));
        web.add(new Point(_x1, _y1));
        web2.add(new Point(_x2, _y2));
    }
    web.closed = true;
    web2.closed = true;
    param.closed = true;
    //web.smooth();
    //web2.smooth();
}
drawWeb();

function enter(event)
{
    console.log(event.target.rate)
}

drawPath();
*/
function onMouseMove(event){
    project.activeLayer.selected = false;
    if(event.item && event.item.isDescendant(project.activeLayer) && event.item._name == "ball")
	{
		event.item.selected = true;
		
		displayStone(event.item._id, event.item._av, event.item._actor_id);
	}
	else
		$("#graph_tooltip").removeClass("show");
}

function displayStone(id, av, actor)
{
	var movies = "";
	for(var j=0; j<stones[id].length; ++j)
	{
		if( stones[id][j].id == actor )
			movies += '<div><b>'+ stones[id][j].mvs_rating +'</b> '+ stones[id][j].mvs_title +'</div>';
	}
	
	var html =	'<b>' + av + '</b>' + '<em>' + stones[id][0].mvs_year + '</em>' + movies;
	
	$("#graph_tooltip").html( html ).addClass("show").css({top:0, left:0});
}

function groupBy( array , f )
{
  var groups = {};
  array.forEach( function( o )
  {
    var group = JSON.stringify( f(o) );
    groups[group] = groups[group] || [];
    groups[group].push( o );  
  });
  return Object.keys(groups).map( function( group )
  {
    return groups[group]; 
  })
}

function time(){
	
	var date = new Date();
	
	var val =
	date.getHours() + ":" +
	date.getMinutes() + ":" +
	date.getSeconds() + ":" +
	date.getMilliseconds();
	
	return val;
}