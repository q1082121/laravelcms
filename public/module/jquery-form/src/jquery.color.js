/**
 * input[type=color]
 * @todo: Create a color wheel popup
 */
$.fn.color = function(){

	var support = (function(type){
		try{
			var el = document.createElement("input");
			el.type=type;
			return el.type === type;
		}
		catch(e){
			return false;
		}
	})("color");

	if(support){
		return $(this);
	}

	return $(this).find("input").add(this).filter("input[type=color],input[data-type=color]").on('click focusout', function(){

		$(this).css({backgroundColor:this.value});

		var rgb = $(this).css("backgroundColor"),
			m;

		if(rgb){
			m = rgb.match(/([0-9]+).*?([0-9]+).*?([0-9]+)/);

			// @todo a fix for IE8 to show colors in rgb format
			if(!m && ("currentStyle" in this)){
				//m = rgb.match(/([0-9]+).*?([0-9]+).*?([0-9]+)/);
			}

			if(m){
				// change the text color to contrast with the backgorund color
				this.style.color = ( parseInt(m[1],10) + parseInt(m[2],10) + parseInt(m[3],10) ) < 500 ? 'white' : 'black';
			}
		}
	});
};
