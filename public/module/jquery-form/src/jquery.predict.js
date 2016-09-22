//
// Predict
// A helper function to search items from a list
// @author Andrew Dodson
$.fn.predict = function(opts){

	opts = opts || {};
	opts.limit = opts.limit || 10;
	opts.placeholder = opts.placeholder || "";
	opts.selected = opts.selected || function(){};
	opts.each = opts.each || function(){ return "<div>"+this+"</div>"; };
	opts.filter = opts.filter || function (i,item,q){return !!q;};
	opts.hintElement = opts.hintElement || null;
	opts.dataListElement = opts.dataListElement || null;
	opts.toggleItemClass = opts.toggleItemClass || "predict-list-item";
	opts.toggleItemClassHover = opts.toggleItemClassHover || opts.toggleItemClass+"-hover";

	return $(this).each(function(){

		if(!opts.hintElement){

			// Create hint element
			opts.hintElement = $("<input type='"+this.type+"' style='position:absolute;' class='predict-hint'/>");

			// Create a hint element, wrap the current element in an position relative span
			$(this).addClass("predict-input").wrap('<span class="predict"></span>').parent().prepend(opts.hintElement);
		}

		if(!opts.dataListElement){
			// Create a hint element, wrap the current element in an position relative span
			opts.dataListElement = $("<div></div>").addClass("predict-list").attr("tabindex","0").insertAfter(this);
		}

		var $input = $(this),
			$list = $(opts.dataListElement),
			$hint = $(opts.hintElement),
			// Array of Items
			list = [];


		// Set the placeholder
		$hint.val(opts.placeholder);

		var focusDatalist = 0;

		function datalistNavigate(e){

			var $sel = $list.find('.'+opts.toggleItemClass).removeClass(opts.toggleItemClassHover);

			switch(e.keyCode){
				case 40: // Down Key
					focusDatalist++;
				break;
				case 38: // Up Key
					focusDatalist--;
					if(focusDatalist<0){
						focusDatalist += ($sel.length+1);
					}
				break;
				case 13: // Return Key
					if(focusDatalist){
						$sel.eq(focusDatalist-1).trigger("click");
					}
				return;
				default:
				return false;
			}
			e.preventDefault();
			e.stopPropagation();

			focusDatalist = focusDatalist % ($sel.length+1);

			if(focusDatalist>0){
				$sel.eq( focusDatalist - 1 ).addClass(opts.toggleItemClassHover).siblings().removeClass(opts.toggleItemClassHover);
			}

			return true;
		}

		// Trigger the selection of the given item
		function selected(i){

			$input.add($hint).val($(list[i]).text());

			var item = opts.data[i];
			opts.selected.call(item,i,item);

		}

		// Build the List of items
		// could use docFrag here for speed, Oh well.
		$(opts.data).each(function(i){

			// Create a new matchresource
			var item = $(opts.each.call(this,i,this)).on("mousedown click", function(e){
				e.preventDefault();
				selected(i);
			}).appendTo($list).get(0);

			// Store item
			list.push( item );
		});

		// Add list keyup
		$list.on('keyup', datalistNavigate);

		// hintID
		var hintID;

		// Add events to INPUT
		$(this).on('keyup click', function(e){

			e.stopPropagation();

			// Is this a navigation of the list?
			if(datalistNavigate(e)){
				console.log("Break");
				return;
			}


			var Q = this.value,
				q = Q.toLowerCase();
			
			hintID = null;

			// reset the current focus
			focusDatalist = 0;

			// Clear or set the placeholder
			$hint.val(!!Q?'':opts.placeholder);

			// Var limit
			var limit = opts.limit;

			// reset the focus Postiion of the datalist
			$(list).each(function(i){
				var T = $(this).text(),
					t = T.toLowerCase();

				var bool = (t.match(q) && opts.filter.call(this,i,opts.data[i],Q) );

				$(this)[bool&&--limit>0?'addClass':'removeClass'](opts.toggleItemClass);

				if( bool && !!Q && !!T && t.indexOf(q)===0 && hintID === null ){

					hintID = i;

					T = T.replace(new RegExp("^"+Q,'i'), function(m){
						return Q;
					});

					$hint.val( T );
				}
			});

		}).on('keydown',function(e){

			e.stopPropagation();

			// Submit the form
			// User has clicked `tab`
			if(e.which === 9 || e.which === 13){
				if(focusDatalist){
					e.preventDefault();
					datalistNavigate(e);
				}
				else{
					var hint = $hint.val();
					var input = $input.val();
					if(hint&&hint!==input){
						e.preventDefault();
						$(this).val(hint);
						selected(hintID);
					}
				}
			}
		});
	});
};