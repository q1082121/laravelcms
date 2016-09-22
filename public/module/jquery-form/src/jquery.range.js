/**
 * Range
 */
$.fn.range = function(){

	// Feature Detect
	var support = (function(type){
		var el = document.createElement("input");
		el.type=type;
		return el.type === type;
	})("range");

	if(support){
		return $(this);
	}

	// check for support for the placeholder attribute
	return $(this).find("input").add(this).filter("input[type=range],input[data-type=range]").each(function(){
	
		var step = parseFloat($(this).attr('step')) || 1,
			max = parseFloat($(this).attr('max')) || 100,
			min = parseFloat($(this).attr('min')) || 0,
			w = $(this).width();

		// Mouse key depressed
		var clicked = false;
		$(document).on("mousedown mouseup", function(e){
			clicked = (e.type === 'mousedown');
		});

		$(this).addClass("range").bind("click mousemove",function(e){

			if(e.type === "mousemove" && !clicked ){
				return;
			}

			// FF bug
			if(!e.offsetX){
				e.offsetX = e.clientX - $(this).offset().left;
			}

			var w = $(this).width(),
				v = ((e.offsetX/w)*(max-min))+min,
				m = v%step;
			
			v -= m;

			if((2*m)>step){
				v += step;
			}

			// boundaries
			v = Math.max(v,min);
			v = Math.min(v,max);

			// value
			$(this).val(v);
			$(this).attr("value", v);
			$(this).trigger('change');
		});
	}).on('change', function(){
	
		var step = parseFloat($(this).attr('step')) || 1,
			max = parseFloat($(this).attr('max')) || 100,
			min = parseFloat($(this).attr('min')) || 0,
			w = $(this).width(),
			v = $(this).val();

		// style
		var x = (v-min)/(max-min);
		$(this).css({backgroundPosition: ((x*w)-500)+"px center" });

	});
};

