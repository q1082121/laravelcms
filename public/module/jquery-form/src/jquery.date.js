/**
 * Calendar
 */

$.fn.date = function(){

	// Detect support?
	var support = (function(type){
		try{
			var el = document.createElement("input");
			el.type=type;
			return el.type === type;
		}catch(e){
			return false;
		}
	})("date");

	if(support){
		return $(this);
	}


	return $(this).find("input").add(this).filter("input[type=date],input[data-type=date]").on("focus select", function(){
	
		var $calendar = $("+ div.calendar div", this).fadeIn('fast'),
			days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],
			month= ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
			$input = $(this);
		
		if(!$calendar.length){
			$calendar = $('<div class="date"><div></div></div>').insertAfter(this).find('div');
		}

		// trigger close calendar when clicked outside
		$(this).blur(function(){$calendar.fadeOut('fast');});
		
		var d = new Date();
		if($(this).val().match(/^[0-9]{4}\-[0-1]?[0-9]\-[0-3]?[0-9]$/)){
			var a = $(this).val().split("-").slice(0,3);
			d.setYear(a[0]);
			d.setDate(a[2]);
			d.setMonth(--a[1]);
		}

		// print the headline
		(function createcalendar(d){
			var s='<table><caption></caption><thead><tr>';
			for(var x in days){
				s += "<th>"+days[x]+"<\/th>";
			}
			s+='</tr></thead><tbody>';
			var dom = d.getDate();// user selected dom(day of month)?
			d.setDate(1);
			// pad the table
			var dow = d.getDay();// first dom falls on a...
			if(dow>0){
				s += "<tr><td colspan='"+dow+"'>&nbsp;<\/td>";
			}
			// get the last day of the month
			d.setMonth(d.getMonth()+1);
			d.setDate(0);
			
			for(var j=1;j<=d.getDate();j++){
				s += ((dow+j-1)%7===0?'<tr>':'')
					+ "<td"+(dom===j?' class="selected"':'')
					+  "><a href='javascript:void(0);'>"+j+"<\/a><\/td>" 
					+ ((dow+j)%7===0?'</tr>':'');
			}
			// pad the table
			if(d.getDay()<6){
				s += "<td colspan='"+(6-d.getDay())+"'>&nbsp;<\/td><\/tr>";
			}
			s+='<\/tbody><\/table>';
			
			// create the calendar and add events
			$calendar.empty().append('<a href="javascript:void(0);" class="close">close</a>').find('a').click(function(){
				$calendar.fadeOut('fast');
			});

			$(s)
				.prependTo($calendar)
				.find('td')
				.click(function(){
					var s = $(this).text();
					$input.val(d.getUTCFullYear()+'-'+( (d.getMonth()+1) < 10 ? '0' : '' ) + (d.getMonth()+1)+'-'+( s < 10 ? '0' : '' ) + s );
					$input.trigger('blur');
					$calendar.fadeOut('fast');
				})
				.end()
				.find('caption')
				.append('<a href="javascript:void(0);" class="prev">'+ month[d.getMonth()===0?11:(d.getMonth()-1)] +'</a> <span class="current">'+ month[d.getUTCMonth()] + ' ' + d.getUTCFullYear() +'</span> <a href="javascript:void(0);" class="next">'+ month[(d.getMonth()+1)%12] +'</a>')
				.find('a')
				.click(function(e){
					e.preventDefault();
					e.stopPropagation();
					if(this.className==='current'){
						//$input.val(d.getUTCFullYear()+'-'+(d.getMonth()+1));
						return false;
					}
					$calendar.fadeIn('fast');
					d.setDate(1);
					d.setMonth((d.getMonth()+{'next':1,'prev':-1}[this.className]));
					createcalendar(d);
					return false;
				});
		})(d);
	});
};
