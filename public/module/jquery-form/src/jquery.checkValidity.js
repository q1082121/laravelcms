
/**
 * CheckValidity
 * Our shim for which recreates the CheckValidity of HTML5 input's upon form submission
 */

(function(){

function checkValidity(elem){

	if (elem && 'checkValidity' in elem){
		return elem.checkValidity();
	}

	var $el = $(elem),
		m = {
			url : /^https?\:\/\/[a-z0-9]+/i,
			date : /^[0-9]{2,4}[\/\:\.\-][0-9]{2}[\/\:\.\-][0-9]{2,4}$/,
			time : /^[0-9]{2}\:[0-9]{2}(\:[0-9]{2})?$/,
			tel : /^\+?[0-9\s\.]{10,14}/,
			email : /^[a-z0-9\.\'\-]+@[a-z0-9\.\-]+$/i,
			number : /^-?[0-9]+(\.[0-9]+)?$/i,
			text : /.+/
		};

	// REQUIRED ATTRIBUTES
	var type  = $el.attr('data-type') || $el.attr('type'),
		min = $el.attr('min'),
		max = $el.attr('max'),
		step = $el.attr('step'),
		example = {
			url : "http://www.domain.com",
			time : "12:30",
			email : "name@domain.com",
			date : "2012-12-31"
		}[type],
		required= (!!$el.attr('required')),
		pattern = $el.attr('pattern'),
		value = (type === "checkbox" && !$el.prop('checked')) ? '' : (elem.value || elem.innerHTML),
		errorMsgs = {
			valueMissing  : (type === "checkbox" ? "Please tick this box if you want to proceed" : "Value missing"),
			tooLong      : "Too Long",
			typeMismatch  : "Not a valid " + type + ( example ? " (e.g. " +example+ ")" : ''),
			patternMismatch  : "Invalid pattern",
			rangeOverflow : "Value must be less than or equal to "+max,
			rangeUnderflow : "Value must be greater than or equal to "+min,
			stepMismatch : "Invalid value"
		};


	// Remove placeholder
	if($el.filter(".placeholder").attr('placeholder') === value){
		value = "";
	}

	elem.validity = {
		valueMissing  : required&&value.length===0,
		tooLong      : false,
		typeMismatch   : (value.length>0)&&(type in m)&&!value.match( m[type] ),
		patternMismatch  : pattern&&(value.length>0)&&!value.match( new RegExp('^'+pattern+'$') ),
		rangeOverflow : max && value.length && value > parseFloat(max),
		rangeUnderflow : min && value.length && value < parseFloat(min),
		stepMismatch : step && value.length && value%parseFloat(step),
		customError : false,
		valid : false // default
	};

	// if this is a color?
	if(type==='color'&&value.length>0){
		// does it work?
		var div = document.createElement("color");
		
		try{
			div.style.backgroundColor = value;
		}
		catch(e){}
		if( !div.style.backgroundColor ){
			elem.validity.typeMismatch = true;
		}
	}

	// remove any previous error messages
	if($el.hasClass('invalid')){
		$el
			.removeClass('invalid')
			.nextUntil(':input')
			.filter("div.errormsg")
			.remove();
	}
	

	function fadeOutErrMsg(){
		$el
			.removeClass('invalid')
			.nextUntil(':input')
			.filter("div.errormsg")
			.fadeOut();
	}


	// Test each message
	for(var x in elem.validity){

		if(elem.validity[x]){


			$el
				.trigger('invalid')
				.addClass('invalid') // ADD CLASS
				.after('<div class="errormsg">'+errorMsgs[x]+'</div>');

			setTimeout(fadeOutErrMsg,5000);

			return false;
		}
	}

	return (elem.validity.valid = true);
}


// Check a form, or an individual value
$.fn.checkValidity = function(){
	
	var b = true;
	
	// AN HTML FORM WOULDN'T POST IF THERE ARE ERRORS. HOWEVER
	$(this).find(":input").add(this).filter(":input").each(function(){
		if(b){
			b = checkValidity(this);
		}
	});
	
	return b;
};


})();