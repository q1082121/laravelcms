/**
 *	@author Andrew Dodson
 *	@since 25th may 2007
 *  @since Oct 2011 (that's refreshing!)
 */
$.fn.form = function(){

	return $(this).find('form').add(this).filter("form").each(function(){

		// the interval would be better if it was per input
		var interval;

		// Add checks to elements on blur
		var $inputs = $(this).find(":input").add(this).filter('input,textarea').on('input blur', function(e){
			$(this)
				.removeClass('error')
				.next('div.error')
				.remove(); // clear away error markup because `it ugly`!

			if(interval){
				clearTimeout(interval);
			}
			
			if(e.type==='blur'||e.type==='focusout'){
				// check validity and provide information to user.
				$(this).checkValidity();
			} else {
				var el = this;
				interval = setTimeout(function(){$(el).checkValidity();},5000);
			}
		});


		// Add the placeholder support
		if($.fn.placeholder){
			$inputs.placeholder();
		}
		
		// Add the number support
		if($.fn.number){
			$inputs.number();
		}

		// Add range
		if($.fn.range){
			$inputs.range();
		}

		// Add color
		if($.fn.color){
			$inputs.color();
		}
	
		// Add date
		if($.fn.date){
			$inputs.date();
		}
	
		// Add datalist
		if($.fn.datalist){
			$inputs.datalist();
		}

		// Add textarea expand
		if($.fn.textarea){
			$inputs.textarea();
		}


	// prevent propagation of the form if it fails.
	// this has to be bound to the form element directly, before additional events are added, otherwise it may not be executed.
	}).submit(function(e){

		var b = $(this).checkValidity();

		if(b){
			// if this has passed lets remove placeholders
			$(":input.placeholder[placeholder]", this).val("");
		}
		else{
			// prevent any further executions.. of course anything else could have been called.
			e.preventDefault();
			e.stopPropagation();
		}
		return b;
	});
};