
var app = require("express")(),
	mysql = require("mysql");
	http = require('http').Server(app);
	io = require("socket.io")(http),
	pool = mysql.createPool({
		connectionLimit   :   100,
		host              :   'localhost',
		user              :   'root',
		password          :   '',
		database          :   'mvs_db',
		debug             :   false
	});

app.get("/", function( req, res ){
    res.sendFile( __dirname + '/index.html' );
});

io.on('connection',function(socket){  
 
    socket.on('status added',function(status){
      add_status(status, function(res){
        if(res){
            io.emit('refresh feed',status);
        } else {
            io.emit('error');
        }
      });
    });
});

var add_status = function (status,callback) {
    pool.getConnection(function(err,connection){
        if (err) {
          connection.release();
          callback(false);
          return;
        }
    connection.query("INSERT INTO `status` (`s_text`) VALUES ('"+status+"')",function(err,rows){
            connection.release();
            if(!err) {
              callback(true);
            }
        });
     connection.on('error', function(err) {
              callback(false);
              return;
        });
    });
}

http.listen(3000,function(){
    console.log("Listening on 3000");
});