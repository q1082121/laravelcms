NOTE: We've set up this repository as a branch of jquery.form.js by @MrSwitch. This fork is to enable the use of this plugin via bower. We have registed the plugin on the bower name of "good-form", as "jquery-form" was taken.

-----

# I say, good &lt;form&gt;!



Wot'O, this is a jolly jQuery plugin for adding cheeky HTML5 forms to your site and wotnot. So simple to use you'll be done before morning tea. 
Should you be bored after tea, then fear not for the want of being excited! There's a cracking WYSIWYG editor and a psyhic predictive text input to entertain you well in time for afternoon tea.



## The quick and dirty implementation
Simply, include the folllowing JavaScript file...

[&lt;script src="./dist/jquery.form.js"&gt;&lt;/script&gt;](./dist/jquery.form.js)

and CSS StyleSheet... 

[&lt;link rel="stylesheet" href="./dist/jquery.form.css"/&gt;](./dist/jquery.form.css)

Then at the bottom of the page invoke the shim on the form elements in the page...


	$("form").form();


Minified versions are available at [jquery.form.min.js](./dist/jquery.form.min.js) and add the css [jquery.form.min.css](./dist/jquery.form.min.css)

Alternatively you can implement the features individually, see below


## Check Validity (HTML5 Shim)


	<form>
		<label class="required">Text required</label> 
		<input type="text" required/>
		<br />
		<label class="required">Checked required</label> 
		<input type="checkbox" required="required"/>
		<br />
		<label>Type time</label>
		<input type="time" data-type="time" />
		<br />
		<label>Type number</label>
		<input type="number" data-type="number" placeholder="Number 1-10" max="10" min="0"/>
		<br />
		<label>Type email</label>
		<input type="email" data-type="email" placeholder="e.g. me@example.com" />
		<br />
		<label>Type Url</label>
		<input type="url" data-type="url" placeholder="e.g. http://example.com"/>
		<br/>
		<label>Type Match pattern</label>
		<input type="text" pattern="[a-z0-9]"/>
		<br />
		<button type="submit">Submit</button>
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.checkValidity.css"/>

Include the script

	<script class="pre" src="./src/jquery.checkValidity.js"></script>

Bind the test to the form submit

	<script class="pre">
	$("form").submit(function(){
		if( $(this).checkValidity() ){
			alert("Form passed");	
		}
	});
	</script>


### CheckValidity Automatic

Include the script

	<script class="pre" src="./src/jquery.event.submit.js"></script>

Intiate the bound test automatically, just by assigning a form on submit event, e.g.

	<script class="pre">
	$("form").submit(function(e){
		alert("Form passed again, notice this wasn't sent when the form fails, yet the check wasn't included");
		e.preventDefault();
	});
	</script>



## Range (HTML5 Shim)

	<form>
		<label>input [type=range]</label>
		<input type="range" data-type="range" />
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.range.css"/>

Include the script

	<script class="pre" src="./src/jquery.range.js"></script>

Bind the Control to input elements with [type=range] attribute

	<script class="pre">
	$(":input").range();
	</script>


## Color (HTML5 Shim)

	<form>
		<label>input [type=color]</label>
		<input type="color" data-type="color" />
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.color.css"/>

Include the script

	<script class="pre" src="./src/jquery.color.js"></script>

Bind the Control to input elements with [type=color] attribute

	<script class="pre">
	$(":input").color();
	</script>



## Date (HTML5 Shim)

	<form>
		<label>input [type=date]</label>
		<input type="date" data-type="date" />
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.date.css"/>

Include the script

	<script class="pre" src="./src/jquery.date.js"></script>

Bind the Control to input elements with [type=date] attribute

	<script class="pre">
	$(":input").date();
	</script>



## Placeholder (HTML5 Shim)

	<form>
		<label>input [placeholder]</label>
		<input type="text" placeholder="Can you see it?"/>		
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.placeholder.css"/>

Include the script

	<script class="pre" src="./src/jquery.placeholder.js"></script>

Bind the Control to any input elements with a placeholder attribute

	<script class="pre">
	$(":input").placeholder();
	</script>


## Number (HTML5 Shim)

	<form>
		<label>Number field</label>
		<input type="number" data-type="number"/>
		<br />
		<label>Number limited to [min=0] and [max=10]</label>
		<input type="number" data-type="number" min="0" max="10"/>
		<br />
		<label>Number with a [step]</label>
		<input type="number" data-type="number" step="2"/>
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.number.css"/>

Include the script

	<script class="pre" src="./src/jquery.number.js"></script>

Bind the Control to the input elements with [type=number] attributes

	<script class="pre">
	$("input[type=number],input[data-type=number]").number();
	</script>




## Datalist (HTML5 Shim)

	<form>
		<label>[datalist]</label>
		<input list="datalist" type="text" placeholder="Predictive"/>
		<datalist id="datalist">
			<select>
			<option value="Hello" />
			<option value="Yo" />
			<option value="To my Dearest" />
			<option value="Oi you, no!" />
			</select>
		</datalist>
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.datalist.css"/>

Include the script

	<script class="pre" src="./src/jquery.datalist.js"></script>

Bind the Control to the datalist

	<script class="pre">
	$("input[list]").datalist();
	</script>



## Textarea -  Expand as you type
	<form>
		<label>&lt;textarea&gt;</label>
		<textarea placeholder="Expands as you type"></textarea>
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.textarea.css"/>

Include the script

	<script class="pre" src="./src/jquery.textarea.js"></script>

Bind the Control to the textarea

	<script class="pre">
	$("textarea").textarea();
	</script>


## WYSIWYG Editor

	<form>
		<textarea type="html">Write here</textarea>
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.editor.css"/>

Include the script

	<script class="pre" src="./src/jquery.editor.js"></script>

Bind the Control to the editor

	<script class="pre">
	$("textarea[type=html]").editor();
	</script>


## Predict - AutoComplete

	<form>
		<label>Predicting</label> <input type="search" name="countries" placeholder="Country Names"/>
	</form>

Include the stylesheet

	<link class="pre" rel="stylesheet" href="./src/jquery.predict.css"/>

Include the script

	<script class="pre" src="./src/jquery.predict.js"></script>

Attach the data ('countryNames' here, is an Array, but it can be something else)

	<script class="pre">
	$("input[name=countries]").predict({
		data : countryNames
	});
	</script>


