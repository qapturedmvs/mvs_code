/*
	
	Minus QS Manager v2.1 www.minus99.com - 2014
	
*/

var qsManager = {
	hash:window.location.hash, 
	query:window.location.search,
	url:window.location.href,
	history: function(url){
		var state = {"qs": true};
		history.pushState(state, "", url);
	},
	qto: function queryToObj(qs){
		var qo = {};
		
		if(qs != '' && qs != null && qs != undefined){
			var qa = qs.substring(qs.indexOf("?")+1,qs.length+1).split("&"), qt, qst;
			
			for(var i=0; i<qa.length; i++){
				qt = qa[i].split("=");
				qst = qt[1].split(",");
				qo[qt[0]] = qst;
			}
		}
		return qo;
	},
	otq: function objToQuery(obj){
		var qs = '';
		
		if(obj != '' && obj != null && obj != undefined){
			for(var i in obj){
				if(obj.hasOwnProperty(i))
					qs += (qs.length == 0) ? '?'+i+'='+obj[i] : '&'+i+'='+obj[i];
			}
		}
		return qs;
	},
	mput: function(prop, param, history){
		var q = this.qto(this.query), url = this.url.replace(this.hash, ''), rUrl;
				prop = prop.split('|'),
				param = param.split('|');
				
		for(var i=0; i<prop.length; i++){
			if(q[prop[i]] != undefined){
				sParam = param[i].split(",");
				for(var j=0; j<sParam.length; j++){
					if(q[prop[i]].indexOf(sParam[j]) != -1){
						q[prop[i]].splice(q[prop[i]].indexOf(sParam[j]), 1);
						if(q[prop[i]] == '')
							delete q[prop[i]];
					}else{
						q[prop[i]].push(sParam[j]);
					}
				}
			}else{
				q[prop[i]] = param[i];
			}
		}
		
		url = (this.query == '') ? url+this.otq(q)+this.hash : url.replace(this.query, this.otq(q))+this.hash;
		
		if(history)
			this.history(url);
		else
			window.location = url;
	},
	put: function(prop, param, history) {
		var q = this.qto(this.query), url = this.url.replace(this.hash, '');
				prop = prop.split('|'),
				param = param.split('|');
		
		for(var i=0; i<prop.length; i++){
			if(q[prop[i]] == undefined)
				q[prop[i]] = param[i];
			else
				delete q[prop[i]];
		}

		url = (this.query == '') ? url+this.otq(q)+this.hash : url.replace(this.query, this.otq(q))+this.hash;
		
		if(history)
			this.history(url);
		else
			window.location = url;
	},
	get: function(prop, string) {
		var str = (string == undefined) ? this.query : string,
				q = this.qto(str.substring(str.indexOf("?"), str.length)), result;
		
		if(q[prop] != undefined)
			result = q[prop];

		return decodeURIComponent(result);
	},
	remove: function(prop, history){
		var q = this.qto(this.query), url = this.url.replace(this.hash, '');

		if(q[prop] != undefined)
			delete q[prop];
		
		url = (this.query == '') ? url+this.otq(q)+this.hash : url.replace(this.query, this.otq(q))+this.hash;
		
		if(history)
			this.history(url);
		else
			window.location = url;
	}
};