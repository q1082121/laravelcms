/**
 * input[list=id]
 * Datalist provides a mechanism for suggesting values in an input field
 */
$.fn.datalist = function(){


	var support = "list" in document.createElement("input");

	if(support){
		return false;
	}

	// Add keyup event to build the list based on user suggestions
	return $(this).find("input").add(this).filter("input[list]").on("keyup",function(e){

		// Show
		$(this).addClass("datalist");

		// $list
		var $list = $(this).nextUntil(":input").filter("div.datalist").eq(0);
		if($list.length===0){
			$list = $("<div class='datalist'></div>").css({
				position: 'absolute'
			}).insertAfter(this);
		}

		// dont change the list?
		if((e.which===38||e.which===40)&&$list.find("ul").length>0){
			return;
		}

		// get the datalist
		var list = [],
			value = $(this).val().toLowerCase();
			
//		log("#" + $(this).attr("list"));

		$( "option", "#" + $(this).attr("list") ).each(function(){
			var v = $(this).attr("value").toLowerCase();

			//log(v);
			if(v.indexOf(value)>-1){
				list.push(v);
			}
		});

		$list.empty();
		$list.width($(this).width());

		// AppendTo DOM
		$("<ul><li>"+list.join("<\/li><li>")+"<\/li><\/ul>").appendTo($list);

	}).on("up down",function(e){

		var $list = $(this).nextUntil(":input").filter("div.datalist").eq(0),
			$sel = $list.find("li.hover");
		if($sel.length){
			$sel = $sel[e.type==='up'?'prev':'next']().addClass('hover');
			$sel[e.type==='down'?'prev':'next']().removeClass('hover');
		}
		else{
			$sel = $list.find("li:first").addClass('hover');
		}
		$(this).val($sel.text());

	// hide the datalist on blur
	}).on("blur",function(e){
		// self
		var self = this;

		// hide on timeut, because it might have been the datalist which was selected
		setTimeout(function(){
			$(self).removeClass("datalist");
		},100);

	}).find("+ div.datalist li").on('click',function(){

		$(this).parents("div.datalist").prevAll("input[list]").eq(0).val( $(this).text() );

	});

};
