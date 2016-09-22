// App.build.js
// Put this in the build package of Sublime Text 2
/*
{
	"cmd": ["node", "${file_path:${folder}}/app.build.js", "$file_path"],
	"working_dir" : "${file_path:${folder}}"
}
*/

// Require IO operations
var fs = require('fs');

// Uglify-JS for compressing Javascript
var UglifyJS = require("uglify-js");

// Clean-CSS, exactly that
var cleanCSS = require("clean-css");


var scripts = [], styles = [];


fs.readdirSync('./').forEach(function(name){
	if( name.match(/^jquery.*?\.js$/) && name !== "jquery.form.js" && name !== "jquery.editor.js" && name !== "jquery.predict.js" ){
		scripts.push(name);
	}
	else if( name.match(/^jquery.*?\.css$/) && name !== "jquery.editor.css" ){
		styles.push(fs.readFileSync("./"+name).toString());
	}
});

scripts.push('./jquery.form.js');


var unminifedJS = [],
	minifedJS = [];


scripts.forEach(function(name, i){
	unminifedJS.push( fs.readFileSync("./"+name, "utf8") );
	minifedJS.push( UglifyJS.minify("./"+name).code );
});


//
// Build Files
//
var build = {
	"../README.md" : htmlToMarkDown(fs.readFileSync("../index.html", "utf8")),
	"../dist/jquery.form.js" : unminifedJS.join('\n'),
	"../dist/jquery.form.min.js" : minifedJS.join('\n'),
	"../dist/jquery.form.css" : styles.join('\n'),
	"../dist/jquery.form.min.css" : cleanCSS.process(styles.join('\n')),
	"../dist/jquery.editor.js" : fs.readFileSync("./jquery.editor.js", "utf8"),
	"../dist/jquery.editor.min.js" : UglifyJS.minify("./jquery.editor.js").code,
	"../dist/jquery.editor.css" : fs.readFileSync("./jquery.editor.css", "utf8"),
	"../dist/jquery.editor.min.css" : cleanCSS.process(fs.readFileSync("./jquery.editor.css").toString()),
	"../dist/jquery.predict.js" : fs.readFileSync("./jquery.predict.js", "utf8"),
	"../dist/jquery.predict.min.js" : UglifyJS.minify("./jquery.predict.js").code,
	"../dist/jquery.predict.css" : fs.readFileSync("./jquery.predict.css", "utf8"),
	"../dist/jquery.predict.min.css" : cleanCSS.process(fs.readFileSync("./jquery.predict.css").toString())
};

for(var x in build){
	(function(name,code){
		fs.writeFile( name, code, function(err) {
			if(err) {
				console.log(err);
			} else {
				console.log(name + " created!");
			}
		});
	})(x, build[x]);
}


//
function htmlToMarkDown(s){

	//
	function getAttributes(s){
		var o = {};
		s.replace(/([a-z]+)\s*=\s*("|')?(.*?)(\2)/g, function(m,key,quote,value){
			o[key] = value;
		});
		return o;
	}

	// Loop through the HTML
	var lines = s.split(/\n/),
		r = [],
		body = false;

	for(var i=0;i<lines.length;i++){
		var line = lines[i];
		if(!body){
			if(line.match(/<body>/)){
				body = true;
			}
		}
		else if(line.match(/^[\s]/)){
			// replace
			r.push(line);
		}
		else{
			var reg = /<([a-z0-9]+)([^>]*)>(.*?)<\/\1>/g;
			r.push(line.replace(reg, function self(m,tag,attr,content){
				var suffix = '',
					prefix = tag.match(/h[0-9]/)?tag.replace(/h([0-9])/, function(m,c){
						var a = [];
						a.length = parseInt(c,10);
						return "#" + a.join("#")+" ";
					}):'';
				if(tag === 'a'){
					prefix = '[';
					suffix = ']('+(getAttributes(attr).href||'')+')';
				}
				return prefix + content.replace(reg,self) + suffix;
			}).replace(/<[^>]+>/g,''));
		}
	}

	return r.join("\n");
}