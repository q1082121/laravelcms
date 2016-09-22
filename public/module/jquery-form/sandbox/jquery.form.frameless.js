/**
 *	@author Andrew Dodson
 *	@since 25th may 2007
 */

jQuery.fn.isObject = function ( s ){
	return ( s !== null && typeof( s ) === "object" ? true:false );
}

jQuery.fn.isEmpty = function(s){
	if(this.isObject(s)){
		for(var x in s) if(x!=='prototype') return false;
		return true;
	}
	return ( s === null || s === undefined || s === 0 || s === '' || s === false ? true:false );
};


/**
 * Get information about the selected text.
 * @param the scope/window object
 & @return selected element
 */
jQuery.fn.selectedText = function(win){
	win = win || window;
	
	var obj = null;
	var text = null;

	// Get parent element to determine the formatting applied to the selected text
	if(win.getSelection){
		var obj = win.getSelection().anchorNode;

		var text = win.getSelection().toString();
		// Mozilla seems to be selecting the wrong Node, the one that comes before the selected node.
		// I'm not sure if there's a configuration to solve this,
		var sel = win.getSelection();
		console.log(win.getSelection());
		if(!sel.isCollapsed&&$.browser.mozilla){
			// If we've selected an element, (note: only works on Anchors, only checked bold and spans)
			// we can use the anchorOffset to find the childNode that has been selected
			if(sel.focusNode.nodeName !== '#text'){
				// Is selection spanning more than one node, then select the parent
				if((sel.focusOffset - sel.anchorOffset)>1)
					console.log("Selected spanning more than one",obj = sel.anchorNode);
				else if ( sel.anchorNode.childNodes[sel.anchorOffset].nodeName !== '#text' )
					console.log("Selected non-text",obj = sel.anchorNode.childNodes[sel.anchorOffset]);
				else
					console.log("Selected whole element",obj = sel.anchorNode);
			}
			// if we have selected text which does not touch the boundaries of an element
			// the anchorNode and the anchorFocus will be identical
			else if( sel.anchorNode.data === sel.focusNode.data ){
				console.log("Selected non bounding text",obj = sel.anchorNode.parentNode);
			}
			// This is the first element, the element defined by anchorNode is non-text.
			// Therefore it is the anchorNode that we want
			else if( sel.anchorOffset === 0 && !sel.anchorNode.data ){
				console.log("Selected whole element at start of paragraph (whereby selected element has not text e.g. &lt;script&gt;",obj = sel.anchorNode);
			}
			// If the element is the first child of another (no text appears before it)
			else if( sel.anchorOffset === 0 && sel.anchorOffset < sel.anchorNode.data.length ){
				console.log("Selected whole element at start of paragraph",obj = sel.anchorNode.parentNode);
			}
			// If we select text preceeding an element. Then the focusNode becomes that element
			// The difference between selecting the preceeding word is that the anchorOffset is less that the anchorNode.length
			// Thus
			else if( sel.anchorOffset < sel.anchorNode.data.length ){
				console.log("Selected preceeding element text",obj = sel.anchorNode.parentNode);
			}
			// Selected text which fills an element, i.e. ,.. <b>some text</b> ...
			// The focusNode becomes the suceeding node
			// The previous element length and the anchorOffset will be identical
			// And the focus Offset is greater than zero
			// So basically we are at the end of the preceeding element and have selected 0 of the current.
			else if( sel.anchorOffset === sel.anchorNode.data.length 
					&& sel.focusOffset === 0 ){
				console.log("Selected whole element text", obj = (sel.anchorNode.nextSibling || sel.focusNode.previousSibling));
			}
			// if the suceeding text, i.e. it bounds an element on the left
			// the anchorNode will be the preceeding element
			// the focusNode will belong to the selected text
			else if( sel.focusOffset > 0 ){
				console.log("Selected suceeding element text", obj = sel.focusNode.parentNode);
			}
		}
		else if(sel.isCollapsed)
			obj = obj.parentNode;
		
	}
	else if(win.document.selection){
		var sel = win.document.selection.createRange();
		var obj = sel;

		if(sel.parentElement)
			obj = sel.parentElement();
		else 
			obj = sel.item(0);

		text = sel.text || sel;
	
		if(text.toString)
			text = text.toString();
	}
	else 
		throw 'Error';
		
	// webkit
	if(obj.nodeName==='#text')
		obj = obj.parentNode;

	// if the selected object has no tagName then return false.
	if(typeof obj.tagName === 'undefined')
		return false;

	return {'obj':obj,'text':text};
};


( function($){


/**
 * Load default Form CSS
 */
var a = {
	NOTNULL : { regexp : [".+"],
				errmsg : "Cannot be empty" },
	UNIQUE	: { errmsg : "Is not unique",
				onblur : function(el){
					var patn,
						attr={t:el.value},
						p=/([a-z]+):([^\;]+)/ig,
						ktools = $(el).attr('ktools');
					// check that this does not already exist
					// if the item contains the attribute "ktools" then use the parameters to build the query.
					// ktools="type:type;parent:;", etc..
					if(ktools)
						while(patn = p.exec(ktools))
							attr[patn[1]]=patn[2];

					$.getJSON("/ktools/list",attr,function(d){
						form_tick(el,$().isEmpty(d.items),"Already exists");
					});/**/
				}} ,
	MATCH	: { errmsg : "Do not match" },
	EMAIL	: { regexp : ["[a-zA-Z0-9\\.-]+", "@", "[a-zA-Z0-9-]+", "[\\.]", "[a-zA-Z0-9\\.-]{1,10}"],
				errmsg : "Invalid Email Address - e.g. name@domain.com" },
	INTEGER : { regexp : ["-?[0-9]+"],
				errmsg : "Use only numbers" },
	PASSWORD: { regexp : ["[a-zA-Z0-9-]{6,20}"],
				errmsg : "Six or more alphanumerical characters long (e.g. pa55word)" },
	STRING	: { regexp : ["[a-zA-Z0-9 -]+"],
				errmsg : "Invalid string" },
	POSTCODE: { regexp : ["[a-zA-Z]{1,2}","[0-9]{1,2}","[a-zA-Z]? ?","[0-9]","[a-zA-Z]{2}"],
				errmsg : "Invalid postcode - correct example \"CM3 2JW\"",
				include: 'lib/AjaxRequest.js', 
				ajxmsg : "Could not find postcode" },
	KEY		: null,
	ADDDATE	: null,
	DATE	: { regexp : ["[0-3]?","[0-9]","\/[0|1]?","[0-9]","\/([1|2][0|9])?","[0-9]{2}"],
				errmsg : "Invalid Date",
				onbuild: "" },
	TEXT	: null,
	TIME	: { regexp : ["[0-2]", "[0-9]", ":", "[0-6]", "[0-9]"], 
				errmsg : "Invalid time" },
	DATETIME: {  },
	CHECKBOX: null,
	RADIOS	: null,
	SELECT	: null,
	HIDDEN	: null,
	FIXED	: null,
	CATEGORY: null,
	EDITOR	: {
				// building of the editor comes afterwards
				},
	FCKEDITOR	: { onbuild : function(el){
						var h = $(el).parent().find('iframe');
						$("<a>Enlarge writing area</a>").click(function (){
							this.innerHTML=(h.attr('clientHeight')=="600"?"enlarge":"shrink" ) + " writing area";
							h.animate({height:(h.attr('clientHeight')=="600"?300:600)},'fast','swing');
						}).appendTo($(el).parent());
					}
				},
	CONFIRMATION : { errmsg	: "Incorrect",
					regexp	: ["[A-Za-z0-9]{6}"],
					onbuild : function(el){
						$(el).siblings("a").on('click',function(){
							$(this).siblings("img").attr({src:"/ktools/captcha?"+Math.random()});
						});
					},
					onblur	: function (el){
						$.getJSON("/ktools/capt",{s:el.value},function(d){
							form_tick(el, d.bool, "Incorrect, Check again");
						});
					}
				},
	URL		: { regexp : "((ht|f)tp(s?):\\/\\/)?[a-z0-9]([a-z0-9\\.-]+)\\.([a-z]{1,4})(\\:[0-9]+)*(/($|[a-zA-Z0-9\\.\\,\\;\\?\\'\\\\\\+&%\\$#\\=~_\\-]+))*",
				errmsg : "Invalid URL" },
	EXISTS	: { regexp : "Does not match any records",
				include: 'lib/AjaxRequest.js',
				ajax   : "xml/handler.php",
				ajxmsg : "Is not available" },
	PHONE	: { regexp : ["[0-9ext.()- ]{10,}"],
				errmsg : "Invalid Telephone" },
	'NULL'	: null,
	FILE	: {
				onbuild: function ()
					{
						if ( inArray( this.xtype, INPUT.MULTI ) )
						{
								
							var div = document.createElement('div');
							div.id = this.name + "_list";
	
							insertAfter($e("parent_" + this.name), div, this);
	
							var multi_selector = new MultiSelector( $e(div.id), 5, this.name);
							<!-- Pass in the file element -->
							multi_selector.addElement( this );
						}
					}
				},
	MULTI	: null,
	ENABLE	: null,
	WIKI	: null,
	FLOAT	: null,
	YESNO	: null,
	AJAX	: null
};

var i=1;
var xtypes=[];
var INPUT=[];

for(var x in a)
{
	INPUT[ i ] = x;
	xtypes[i] = a[x];
	i = (i*2);
}



/*****************************
 * Add controls to non-form elements
 *****************************/

$("form :input").each(function(){
	var x=explode_factorial(this.className.match(/[0-9]+/));
	for(var i=0;i<x.length;i++)
		if(xtypes[x[i]]&&xtypes[x[i]].onbuild)
			xtypes[x[i]].onbuild(this);
});

/**
 * Set the spinner function, because forms can take a while to load
 */
$("form :submit").click(function (){
	var o = $(this).parent('form').get(0);
	var a = [0,0];
	var oo = o;
	if (oo.offsetParent)
	{
		a = [o.offsetLeft, o.offsetTop];

		while ( ( oo = oo.offsetParent ) )
		{
			a[0] += oo.offsetLeft;
			a[1] += oo.offsetTop;
		}
	}

//	$(o).append('<div class="dither" style="width:' + o.offsetWidth + 'px;height:' + o.offsetHeight + 'px;left:' + a[0] + 'px;top:'+ a[1] +'px;"><div>Please Wait..</div></div>');

	var c = document.createElement('div');
	c.className = "dither";
	c.style.left = a[0] + "px";
	c.style.top = a[1] + "px";
	c.style.width = o.offsetWidth + "px";
	c.style.height = o.offsetHeight + "px";
	c.innerHTML = "<div>Please Wait..</div>";
	o.parentNode.appendChild(c);

	return true;
});



$.fn.clearForm = function() {
  return this.each(function() {
 var type = this.type, tag = this.tagName.toLowerCase();
 if (tag == 'form')
   return $(':input',this).clearForm();
 if (type == 'text' || type == 'password' || tag == 'textarea')
   this.value = '';
 else if (type == 'checkbox' || type == 'radio')
   this.checked = false;
 else if (tag == 'select')
   this.selectedIndex = -1;
  });
};

/********************************************************
 * Find all the tabs
 * Assign the first tab as "selected"
 * Give on click event to all the tabs.
 * Hide all the "tabtargets", with exception to the one which is assigned to the selected tab.
 ********************************************************/

$('#tabs .tab:first-child').addClass( "selected" );
$('#tabtargets .tabtarget:first-child').addClass( "selected" );
$('#tabtargets .tabtarget:not(:first-child)').css( {"display" : "none"} );

$('#tabs .tab').click( function(){
	$('#tabtargets .tabtarget').removeClass( "selected" );
	$('#tabtargets .tabtarget').css( {"display" : "none"} );
	this.className = "selected";
	var str = this.id;
	$("#"+str.replace("tabtarget", 'tab')).css( {"display" : "block"} );
});


/**
 * At this point the form_input array of objects has been created.
 * Now we want to add links to add table rows and /input's. To existing data.
 * This can be done by looping through our array form input and identifying elements which need to be expanded.
 * For instance there are multiple markets. And market data is sotred in market[0][typename1], market[0][typename2], ... market[N][typenameN], 
 */


/****************************************************
 *
 * Add Table Events. 
 *		- Add/Remove rows/columns
 ****************************************************/


/**
 * Attach "Add row" button to table
 */
$("form table.multiple").each(function(){
	/** Add delete row control */
	$(this).find("tbody tr").append("<td><a class='del_row'>Delete</a></td>");

	var len = 0;
	$(this).find("thead tr").append("<th>Delete</th>").find("th").each( function (){ len++;} );

	/** Add new row control to a "tfoot a"*/
	$(this).append("<tfoot><tr><td colspan='" + len + "'><a>Add " + ( this.className.match(/\bpivot\b/) ? "Row" : "Col" ) + "</a></td></tr></tfoot>").find("tfoot td a").click( function(){
		addRecord($(this).closest('table').get(0));
	});
});


/****************************************************
 *
 * Add Form Events. 
 * 		- AutoCompletion
 *
 * TODO 
 *		- Add Type verification
 ****************************************************/

$("form").each( function(){
	addControls(this);
});


/**
 * Create EDITOR on the currently selected TEXTAREA
 */
	function createeditor(){
	
		/**
		 * Add Tools
		 */
		var attr = {
			bold 		: {css:{'fontWeight':'bold'}, tag:'B|STRONG'},
			italic		: {css:{'fontStyle':'italic'},tag:'I|EM'},
			underline	: {css:{'textDecoration':'underline'},tag:'U'},
			strikethrough : {css:{'textDecoration':'line-through'},tag:'STRIKE'},
			justifyright : {css:{'textAlign':'right'},attr:{'align':'right'}},
			justifycenter : {css:{'textAlign':'center'}},attr:{'align':'center'},
			justifyfull : {css:{'textAlign':'justify'}},
			justifyleft : {css:{'textAlign':'left'},attr:{'align':'left'}},
			insertorderedlist : {tag:'OL'},
			createlink : {tag:'A'},
			insertimage : {tag:'IMG'},
			insertunorderedlist : {tag:'UL'},
			fontname	: {css:{'fontFamily':null}, attr:{'face':null}},// null: accepts a variety of values
			formatblock : {tag:'ADDRESS|P|PRE|H[0-9]|BLOCKQUOTE'}
		};
	
		var tools = [
			' ',
			{cmd:'bold', desc:'Make the Selected text bold', label:'<b>B</b>'},
			{cmd:'italic', desc:'Make the Selected text Italic', label:'<i>I</i>'},
			{cmd:'underline', desc:'Underline the selected text', label:'<u>U</u>'},
			{cmd:'strikethrough',desc:'Strike through the selected text', label:'<strike>S</strike>'},
			' ',
			{cmd:'createlink', desc:'Create Link', label:'<u>URL</u>',prompt:'URL of a Link?', promptValue:'http://'},
			{cmd:'insertimage', desc:'Insert image', label:'<u>IMG</u>',prompt:'URL of an image?'}, // &#9660;
			' ',
			{cmd:'insertorderedlist', desc:'Insert Numbered list', label:'<b>1</b> List'},
			{cmd:'insertunorderedlist', desc:'Insert Bullet list', label:'&#9679; List'},		
			' Align',
			{cmd:'justifyleft', desc:'Align Left', label:'<b>|</b>&#9668;'},
			{cmd:'outdent', desc:'Outdent', label:'&#9668;'},
			{cmd:'justifycenter', desc:'Align center', label:'&#9679;'},
			{cmd:'indent', desc:'Indent', label:'&#9658;'},
			{cmd:'justifyright', desc:'Align right', label:'&#9658;<b>|</b>'},
			{cmd:'justifyfull', desc:'Jusitfy', label:'&#9776;'},//8801
			' ',
			{label:' Format', cmd:'formatblock', desc:'Format selected text', cmds:[
				{value:'p', desc:'Normal', label:'Normal'},
				{value:'h1', desc:'Heading 1', label:'<h1>Heading 1</h1>'},
				{value:'h2', desc:'Heading 2', label:'<h2>Heading 2</h2>'},
				{value:'h3', desc:'Heading 3', label:'<h3>Heading 3</h3>'},
				{value:'h4', desc:'Heading 4', label:'<h4>Heading 4</h4>'},
				{value:'pre', desc:'Formatted', label:'<pre>Formatted</pre>'},
				{value:'address', desc:'Address', label:'<address>Address</address>'},
				{value:'blockquote', desc:'Blockquote', label:'<blockquote>Blockquote</blockquote>'},
				{value:'div', desc:'Normal Div', label:'Normal (Div)'}
	//			{value:'acronym', desc:'Acronym', cmd:'inserthtml', prompt:'What is the ', label:'<acronym>Acronym</acronym>'}
			]},
			' ', 
			{cmd:'inserthtml', desc:'Insert Special Character or Symbol', label:' Symbol', cmds : [
				// CURRENCY
				'$','&pound;','&euro;','&yen;',
				// COPY
				'&copy;', '&trade;', '&reg;', 
				// LATIN LOWERCASE
				'&aacute;', '&acirc;', '&aelig;', '&agrave;','&aring;', '&atilde;', '&auml;', 
				'&eacute;', '&ecirc;', '&egrave;', '&eth;', '&euml;', 
				'&iacute;', '&icirc;', '&iexcl;', '&igrave;', '&iuml;', 
				'&ntilde;', 
				'&oacute;', '&ocirc;', '&oelig;', '&ograve;', '&otilde;', '&ouml;', 
				'&szlig;',
				'&uacute;', '&ucirc;', '&ugrave;','&uuml;', 
				'&yacute;', '&yuml;', 
				// MATHS
				'&frac12;', '&frac14;', '&frac34;', '&times;', '&divide;', '&lt;', '&gt;', '&deg;', 
				'&circ;', '&plusmn;', '&sum;', '&radic;', '&infin;', '&ne;', '&le;', '&ge;','&asymp;',
				// Punctuation
				'&hellip;', '&iquest;'
			]},
			' ',
			{label:' Font', cmd:'fontname', desc:'Apply font to selected text', cmds:[
				{value:'Times', label:'<span style="font-family:times">Times</span>'},
				{value:'Helvetica', label:'<span style="font-family:Helvetica">Helvetica</span>'},
				{value:'Arial', label:'<span style="font-family:Arial">Arial</span>'},
				{value:'Tahoma', label:'<span style="font-family:Tahoma">Tahoma</span>'},
				{value:'Courier', label:'<span style="font-family:Courier">Courier</span>'},
				{value:'Western', label:'<span style="font-family:Western">Western</span>'},
				{value:'serif', label:'<span style="font-family:serif">Serif</span>'},
				{value:'sans-serif', label:'<span style="font-family:sans-serif">sans-serif</span>'},
				{value:'fantasy', label:'<span style="font-family:fantasy">fantasy</span>'},
				{value:'monospace', label:'<span style="font-family:monospace">monospace</span>'},
				{value:'Verdana', label:'<span style="font-family:Verdana">Verdana</span>'},
			]},
			{cmd:'removeformat', desc:'Remove Formatting', label:'<b style="color:red;">X</b>'}
		];
	

		// Unbind the click event
		// We dont want this script running twice for the same textarea
		// This is only useful if the textarea  click event was set, i.e. see how this current lambda function was triggered
//		$(this).unbind('click');

		var $textarea = $(this);

		// If the iframe is not present, then we need to create it.
		// Set this as the controller for deciding whether to just set events
		// This is used in the dynamic form, where a editt area can be copied several times.

		if($textarea.siblings('div.editor').length){
			/**
			 * Delete iframe and toolbar if already exists.
			 */
			$textarea.siblings('div.editor').remove();
			$textarea.siblings('div.toolbar').remove();
			/**/
		}

		// Add EDITOR
		// Set editor events
		var $editor = $("<div class='editor' contentEditable='true'>").insertAfter($textarea).html($textarea.val()).bind('click keyup blur', function(e){

			$textarea.val(this.innerHTML);
			
	
			if(e.type==='blur')
				return;
	
			var obj;
	
			if(!(obj = $().selectedText(window).obj))
				return;
	
	
	
			// loop through each parent of the currently selected
			// Capture styles and tagNames to imply formatting
			// Formatting of some tags, i.e b,i,u, can be overridden by styles
			// And can also be inferred by tagNames.
	
			var c = {}; // commands, these are 
			var getattr = function(){
				if(!this.tagName)
					return;
				var t = this.tagName.toUpperCase(),
					x,y,m;
			
	
				if(t==='BODY'||t==='HTML')
					return;

				for(x in attr){
					if(c[x]) continue;
					for( y in attr[x].css ){
						if( this.style[y] 
							&& ( this.style[y].match( attr[x].css[y], 'i' ) 
								|| ( attr[x].css[y] === null && this.style[y].length > 0 ) ) ){
							c[x] = this.style[y];
							continue;
						}
					}
					if($.browser.msie)
						for( y in attr[x].attr ){
							if( this.getAttribute 
								&& ( this.getAttribute(y) === attr[x].attr[y] 
									|| ( attr[x].attr[y] === null && this.getAttribute(y).length > 0 ) ) ){
								c[x] = this.getAttribute(y);
								continue;
							}
						}
					if(c[x]) continue;
					if((m=t.match( '^('+attr[x].tag+')$' ))!==null){
						c[x] = m[0].toLowerCase();
					}
				}
			};
	
			$(obj).each(getattr).parents().each(getattr);
	
			console.log(["selected",obj,c,$(this).siblings('div.toolbar').find(':input[cmd]')]);
	
			$(this).siblings('div.toolbar').find(':input[cmd]').each(function(){
				var cmd = $(this).attr('cmd');
				var bool = !(typeof c[cmd] === 'undefined');
	
				if(this.tagName === 'BUTTON'){
					if(bool)
						$(this).addClass('selected');
					else
						$(this).removeClass('selected');
				};
				if(this.tagName === 'SELECT'){
					if(bool)
						this.value = c[cmd];
					else 
						this.selectedIndex = -1;
				};
				
			});
	
			//console.log(c,obj,$(obj).parents());
				
			// Record the last selected position in the Iframe
			try{
				var s = document.selection.createRange().duplicate().getBoundingClientRect();
				window.posx = s.left; 
				window.posy = s.top; 
			}
			catch(e){}
		});

		// ADD toolbar.
		var $toolbar = $('<div class="toolbar">').insertBefore($textarea);
		
		$textarea.hide();
		// Store the height of the iframe
		var height = $textarea.height();

		$editor.attr('style', $textarea.attr('style'));
		// just in case the textarea is hidden
		$editor.show();

		// ADD BUTTONS
		// Add controls above the contentEditable(DIV)
		$("<button>").html('<code>Source</code>').css({width:'50px'}).click(function(){

			// Toggle display DIV vs TEXTAREA
			// Copy the content from the div to the textarea
			// Show the Textarea
			if($textarea.css('display')=='none'){
				// DIV => TEXT
				// Copy the div content to the text and show text
				$textarea.val($editor.html()).show();
				// Hide the DIV
				
				$editor.hide();
				
				//Disable tools
				$(this).html("<b>Editor</b>").parent().find(".tool").attr("disabled", true);
			}
			else {
				// TEXT => DIV
				// Copy the text content to the div and show
				$editor[0].innerHTML = $textarea.val();

				$editor.show();

				// Hide the TEXT
				// Show DIV
				$textarea.hide();
				// Change Text
				//Enable tools
				$(this).html("<code>Source</code>").parent().find(".tool").removeAttr("disabled");
			}
			return false;
		}).appendTo($toolbar);

		/**
		 * Insert cmd
		 */
		var insert = function(cmd,value,tool){
			/**
			 * Get the selected Text if there is any. 
			 * This function returns {obj:element,text:string}
			 */
			var sel = $().selectedText(window);

			/**
			 * If this is the createLink or insert image
			 * Get the href|src value of the selected element
			 * set this as the value
			 */
			if( (cmd==='insertimage'||cmd==='createlink') && ( typeof tool.prompt !== 'undefined' )){
				if(sel.obj.tagName==='A'){
					tool.promptValue = sel.obj.href;
				}
				if(sel.obj.tagName==='IMG'){
					tool.promptValue = sel.obj.src;
				}
			}

			/**
			 * User prompted to put in a value
			 */
			if(tool&&tool.prompt){
				/**
				 * Is text selected?
				 * Is selected text a URL? Then prepopulate the content of the prompt
				 */
				value = prompt(tool.prompt, (cmd==='createlink'&&sel.text.match('^https?://')?sel.text:(tool.promptValue || '')));
			}
			
			//If the command is for a Link there must be text
			//Otherwise we need to insertHTML instead
			if(cmd==='createlink'&&(!sel.text.length)){
				// Get the text
				if(!(sel.text = prompt("Text")))
					sel.text = value;
					
				if(sel.text===null)
					return false;
				// We are going to insert the element manually
				// Using pasteHTML IE and execCommand insertHTML if the browser supports it.
				value = "<a href='"+value+"'>"+sel.text+"</a>";
				cmd = 'inserthtml';
			}

			/**
			 * IE requires format block tags (e.g. h1, p, pre) to be wrapped with <> syntax
			 */
			if(cmd=='formatblock'&&$.browser.msie)
				value = '<'+value+'>';

			
			// Send the action to the frame
			// update the text area with this new value

			try{
				console.log([window, cmd, value]);
				document.execCommand(cmd, false, value);
			}
			catch(e){
				//IE WAY to insert at the current point
				if(document.selection){
					var s = document.selection.createRange();
					if(s.pasteHTML){
						s.pasteHTML(value);
						return false;
					}
				}
				alert("Could not execute "+cmd);
			}
			return false;
		}

		/**
		 * Loop through tools object and create buttons for each
		 */
		for(var x in tools){
			
			/**
			 * Seperator?
			 * If the current tool is a string then insert as just a string
			 */
			if(typeof tools[x] == 'string'){
				if(tools[x].match('[a-z]', 'ig'))
					tools[x] = "<span class='tool'>"+tools[x].replace(' ', '&nbsp;')+"</span>";
				$toolbar.append(tools[x]);
				continue;
			}
			
			
			/**
			 * Create a drop down list (currently a select->option).
			 * Add values from the tool to the select
			 * Add change event to the list
			 * @todo Change this to a drop down div with buttons and attach events to each of the option. 
			 		Two reasons: 
					1. Style (selects dont allow us flexibility to style option labels).
			 		2. Only trigger onchange event. We might want to select the same item twice, the change event wont get fired the second time...  i.e. the user has to navigate away. Using other triggers get fired when selecting anywhere, even the select scrollbar. Deselecting the option after use would be a workaround.
			 * 
			 */
			if(tools[x].cmds){
				/**
				 * Create select in memory
				 * Attach event to insert into the current iframe
				 */
				var $select = $("<select>").attr({'class':'tool', 'xtool':x, 'cmd':tools[x].cmd, 'title':tools[x].desc}).change(function(){
					// Make sure the focus is on the window
					if($.browser.msie){
						// $('#iframe_'+$(this).parents("div.toolbar")[0].id.match('[0-9]+')[0])
						var win = window;
						var doc = win.document;
						$editor[0].focus();
						cursorPos = doc.body.createTextRange();
						cursorPos.moveToPoint( win.posx, win.posy);
						cursorPos.select();
					}

					/**
					 * Add insert event
					 */
					insert(tools[$(this).attr('xtool')].cmd, this.options[this.selectedIndex].value);
				});

				/** 
				 * Create the select OPTIONs
				 */
				for(var y in tools[x].cmds){
					if(typeof tools[x].cmds[y] == 'string')
						tools[x].cmds[y] = {value:tools[x].cmds[y],label:tools[x].cmds[y]};
					$select.append('<option value="'+tools[x].cmds[y].value+'">'+tools[x].cmds[y].label+'</option>');
				}

				/**
				 * Wrap the select in a div. 
				 * Append the DIV into the toolbar
				 */
				$("<span class='tool'>"+tools[x].label.replace(' ', '&nbsp;')+"</span>").append($select).appendTo($toolbar);

				continue;
			}

			/**
			 * Create a button 
			 * This is the last option for what a tool can be. 
			 */
			$("<button>").attr({'class':'tool', 'xtool':x, 'cmd':tools[x].cmd, 'title':tools[x].desc}).html(tools[x].label).click( function(){
				
				// make sure this is not going to insert outside the contentEditable iframe
				if($.browser.msie){
					try{
					//$('#iframe_'+$(this).parents("div.toolbar")[0].id.match('[0-9]+')[0])
					$editor[0].focus();
					var win = window;
					var doc = win.document;
					// have we lost cursor positions?
					// excpetions occur selecting images
					var s = doc.selection.createRange().duplicate().getBoundingClientRect();
					if(!(s.left>=0&&s.top>=0)){
						// restore the cursor position
						doc.body.createTextRange().moveToPoint( win.posx, win.posy).select();
					}}
					catch(e){}
				}
				
				/**
				 * Which tool is this
				 */
				var tool = tools[$(this).attr('xtool')];
				
				$(this).hasClass('selected')
					? $(this).removeClass('selected')
					: $(this).addClass('selected');

				/**
				 * Trigger edit command
				 */
				insert(tool.cmd, null,tool);
				return false;
			}).appendTo($toolbar);
		}
	};


//$('textarea.editor').each(createeditor);


/**
 * Add Controls
 */
function addControls(el){
	/**
	 * Remove the parent TR, table row of this object.
	 */
	$(el).find("a.del_row").click( function(){
		console.log("PARENT", $(this).closest('tr'));
		$(this).closest('tr').each(function(){
			/**
			 * Check that if there are no other rows to simply unset all the values
			 */
			if ( this.parentNode.rows.length > 1 )
				// In IE we can't hide rows, so lets select the td's instead. 
				// This means we can only run the delete rows once. So check that the elements exist.
				$(this).children().fadeOut('fast',function(){
					if(this&&this.parentNode&&this.parentNode.parentNode)
						this.parentNode.parentNode.deleteRow( this.parentNode.sectionRowIndex );
				});
			else
				$( this ).find(':input').clearForm();
		});
	});


	/**
	 * :Input will match any INPUT/TEXTAREA/SELECT, this is a jQuery special
	 */
	$(el).find(":input").change( function(){
		console.log("CHANGE", this.name);
		validateInput(this, true);
	});

	var expandText = function(el){
		if(el.tagName!=="TEXTAREA") return;

		while(el.rows>1 && el.scrollHeight<el.offsetHeight)
			el.rows--;
		var h=0;
		while(el.scrollHeight > el.offsetHeight && h!==el.offsetHeight && (h=el.offsetHeight) )
			el.rows++;

		el.rows++
	}
	$(el).find(":input:not(:button):not(:textarea)").keyup( function(){
		console.log("KEYUP", this.name);
		validateInput(this, false);
		expandText(this);
	});
	$(el).find('textarea.editor').each(createeditor);
	$(el).find("textarea:not(.editor)").focus( function(){
		expandText(this);
	});
}


/****************************************************
 * Validate input
 * Is used to provide an error message as the user	/
 * types into a form field alternatively as the user /
 * changes part of the text
 ****************************************************/

function validateInput(el,complete)
{
	var patt,
		patn,
		bool=true,
		fail,
		patn;
	
	if (jQuery.inArray(el.tagName,['INPUT','SELECT','TEXTAREA']) === -1)
		return console.log("This is not a form element", el, el.tagName);

	/**
	 * Determine whether validation is needed 
	 */
	var x=explode_factorial(el.className.match(/[0-9]+/));
	
	console.log("Validate",el,x, INPUT[x]);

	if ( el.value === null || el.value === '' )
		return form_tick(el.name,null);
	/**
	 * Loop through the xtypes and process the array of regexp
	 */
	for(var i=0;i<x.length;i++)
	{
		console.log(xtypes[x[i]]);
		if ( xtypes[x[i]] && xtypes[x[i]].regexp )
		{
			var patt = (complete===true? [xtypes[x[i]].regexp.join('')] : xtypes[x[i]].regexp);
			/**
			 * If it gets here. The pattern has failed to be recognised by this type so flag a fail
			 */
			fail = xtypes[x[i]].errmsg;
			var len=patt.length;
			var regexp = "";
			for(var j=0;j<len;j++)
			{
				regexp += patt[j];
				try{
					patn=new RegExp( "^" + (!complete?regexp.replace(new RegExp("\\{([0-9]+,)?([0-9]+)?\\}$",'gi'),"{0,$2}"):regexp) + "$" );
					bool=patn.test(el.value);
				}catch(e){
					bool=true;
				}

				/**
				 * Does the pattern match part or all of the regular expression?
				 * Then remove any error sign which is present.
				 */
				if(bool&&!complete)
					return form_tick(el,null);
				else if(!bool&&complete)
					return form_tick(el,false,fail);
				console.log(bool,regexp.replace(new RegExp("\\{([0-9]+,)?([0-9]+)?\\}$",'gi'),"{0,$2}"));
			}
		}

		/**
		 * Does this have an on blur event?
		 */
		try{
		if(complete&&xtypes[x[i]]&&xtypes[x[i]].onblur){
			console.log("ONBLUR",xtypes[x[i]].onblur);
			xtypes[x[i]].onblur(el);
			return true;
		}}
		catch(e){}
	}

	if(fail&&!bool)
		return form_tick(el,false,fail);
	if(complete)
		return form_tick(el,true);
}


function form_tick(el, b, m)
{
	var p = $(el).closest("td").get(0);

	console.log( el,b,m );

	if(!p)
		return console.log("No parent ", el);

	$(p).find("div.alert_form").remove();

	if(b===null||$(el).length===0)
		return true;

	if(b===false)
		$(el).addClass('alert_input');
	else
		$(el).removeClass('alert_input');

	$(p).append("<div class='alert_form "+(typeof(b)=='string'?b:(b?"ok":"neg")) + "'>" + (b===false?m:"&nbsp;") + "</div>")

	if(b===true)
		$(p).find(".alert_form").fadeOut('slow');

	return true;
}


/****************************************************
 *
 * Table Add Records
 *
 ****************************************************/

function addRecord( tbl )
{

	var m = /depth_([0-9]+)/.exec(tbl.className);
	level = m[1];
	
	// determine the depth based upon the number of nested table elements taken to get to this
	
	
	console.log("LEVEL:", level);

	if ( tbl.className.match(/\bpivot\b/) )
	{
		addRow( tbl, level );
	}
	else
	{
		addColumn( tbl, level );
	}

}

/**
 * Add row to the table.
 * This script copies the last row of the table and appends a new row to the table.
 * It removes all user inserted values in the copy. And increments the keys
 */
function addRow( tbl, level )
{
	/**
	 * Clone the first row
	 */
	var b = tbl.tBodies[0];
	var n = b.rows[b.rows.length - 1].cloneNode(true);

	/**
	 * Remove any previous value/and multiple records.
	 * Reassign dynamic effects.
	 */
	clearRowFormValues(n,level);

	// Add controls to new nodes created.
	// If we were using JQuery this could be done with $(this).clone(true);
	addControls($(n).appendTo(b));
}

/**
 * Add row to the table.
 * This script copies the last column of the table and appends a new column to the table.
 * It removes all user inserted values in the copy. And increments the keys
 */
function addColumn( tbl, level )
{

	var tblHead = tbl.tHead;
	var tblBody = tbl.tBodies[0];
	var i = 0;
	var newCell = {};


	if ( tblHead !== null && ! $().isUndefined( tblHead.rows ) )
	{
		for ( i=0; i<tblHead.rows.length; h++ )
		{
			/** NOT SUPPORTED */
		}
	}
	

	if ( tblBody !== null && ! $().isUndefined( tblBody.rows ) )
	{
		for ( i=0; i<tblBody.rows.length; i++)
		{
			/**
			 * copy the content of the previous cell.
			 */
			newCell = tblBody.rows[i].cells[ tblBody.rows[i].cells.length -1 ].cloneNode(true);
			
			clearCellFormValues( newCell, level );

			addControls(newCell);
			tblBody.rows[i].appendChild(newCell);
		}
	}
}


/**
 * What level are we editing?
 * E.g. if there is a multiple option.
 */
function currentCellLevel( str, level )
{
	var  i=0;

	if ( ! isInt( level ) )
	{
		/**
		 * Set the current level
		 */
		i = str.match( /\[[0-9]+\]/ );
		level = ( i === null ? 0 :  i.length );

	}
	return level;
}




/**************************************************
 *
 * Table CELL clear out and reassign properties
 *
 * Both the above functions need to clear the cells. 
 * Since they clone the originals completely, inclusing the user values.
 *
 **************************************************/

function clearRowFormValues( row, level )
{
	$(row).children().each(function(){
		clearCellFormValues( this, level );
	});
}


function clearCellFormValues( cell, level )
{
	var elem = {};
	var classInt = 0;
	var classArr = [];
	var previousName = '';
	
	for ( var i=0; i < cell.childNodes.length; i++ )
	{
		/**
		 * Initiate elem
		 */
		elem = cell.childNodes[i];

		/**
		 * These are the only element types we have controls for.
		 */
		if ( $.inArray( elem.tagName, ['INPUT', 'TEXTAREA', 'SELECT', 'DIV', 'TABLE'] ) === -1 )
		{
			return;
		}

		classInt = ( elem.className !== null ? elem.className.replace( /[^0-9]+/, '' ) : null );

		classArr = ( classInt >= 1 ? explode_factorial( classInt ) : [] );
			
		/**
		 * Remove previous values/selections from cells
		 */
		if ( $.inArray( elem.tagName, ['INPUT', "TEXTAREA"] ) !== -1 )
		{
			elem.value = "";
		}
		if ( elem.tagName === "SELECT" )
		{
			elem.selectedIndex = -1;
		}

		/**
		 * Change the name to reflect incrementing
		 */
		if ( $.inArray( elem.tagName, ['INPUT', 'SELECT', "TEXTAREA"] ) !== -1 )
		{
			previousName = elem.name;
			elem.name = incrementFormName( elem.name, level );
		}
		
		/**
		 * If element of the cell is a TABLE. With a dynamic option. then we need to recurse this table
		 */
		if ( elem.tagName === "TABLE" && elem.className === "dynamic" )
		{
			clearTableFormValues( elem, level );
		}
	}
}





function clearTableFormValues( tbl, level )
{
	var elem = {};
	
	/**
	 * Update the depth Variable
	 */
	tbl.depth = level + 1;
	
	/**
	 * Keep the table head. Remove all the other duplicates.
	 */
	var Body = tbl.tBodies[0];


	var count = Body.rows.length;

	/**
	 * Remove all the other rows
	 */
	for( var i = 1; i < count; i++ )
	{
		
		/**
		 * Because this constantly deletes rows. the orders are re-arranged.
		 * so `1` is always the key of the table row that we want to delete. 
		 */
		Body.deleteRow( Body.rows[1].sectionRowIndex );
	}

	clearRowFormValues( Body.rows[0], level );
	
	/**
	 * Update the button
	 */
	for( var x in tbl.childNodes )
	{
		elem = tbl.childNodes[x];

		if ( elem.tagName === 'INPUT' && elem.type === 'button' )
		{
			elem.onclick = function(){ addRecord( this ); };
		}
	}
}




/****************************************************
 *
 * Table Remove Records
 *
 ****************************************************/



function deleteColumn( p )
{
	/**
	 * Find the column number
	 */
	var colInt = $(p).parent("td").get(0).cellIndex;
	
	$(p).parent("tbody").find("tr").each( function(el){
		if ( el.cells.length > 2 && colInt >= 1)
		{
			el.deleteCell( colInt );
		}
		else if ( colInt === 1 )
		{
			clearCellFormValues( el.cells[1] );
		}
	} );
}


/**************************************************
 * 
 * Special function to Forms 
 *
 **************************************************/


function incrementFormName(el,lev)
{
	/**
	 * Break the string apart.
	 */
	var a = el.split(/[\[\]]+/);
	a.pop();
	var pos = (2*lev)-1;
	a[pos] = -(Math.abs(parseInt(a[pos],0))+1);
	
	if( /\[\]$/.test(el) )
		a.push();

	for (var j=1;j<a.length;j++)
		a[j]="["+a[j]+"]";
	
	return a.join('');
};


function sum(a){
	for(var i=0,j=0;i<a.length;i++)
		j += Math.ceil(a[i]);
	return j;
}
/**
 * Retrieve all the factorial numbers from the int given
 */
function explode_factorial(i){
	var a = [1],
		r = [];
	
	while(sum(a)<i)
		a.push((a[a.length-1])*2);
		
	for(var j=a.length-1;0<j;j--)
		if(i>=a[j]&&(i=i-a[j])+1)
			r.push(a[j]);
	return r;
}


})($);