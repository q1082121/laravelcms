/**
 * Expands textarea as one types
 */
$.fn.textarea = function(){

	return $(this).find("textarea").add(this).filter("textarea").on('keyup focus', function(){

		var el = this;
		if(el.tagName.toLowerCase()!=="textarea"){return;}

		// has the scroll height changed?, we do this because we can successfully change the height
		var prvLen = el.preValueLength;
		el.preValueLength = el.value.length;

		if(el.scrollHeight===el.prvScrollHeight&&el.prvOffsetHeight===el.offsetHeight&&el.value.length>=prvLen){
			return;
		}
		while(el.rows>1 && el.scrollHeight<el.offsetHeight){
			el.rows--;
		}
		var h=0;
		while(el.scrollHeight > el.offsetHeight && h!==el.offsetHeight && (h=el.offsetHeight) ){
			el.rows++;
		}

		el.rows++;

		el.prvScrollHeight = el.scrollHeight;
		el.prvOffsetHeight = el.offsetHeight;
	});

};
