//
// jquery.event.submit
//
$.event.special.submit = {

	add : function(handleObj){

		// Save a reference to the bound event handler.
		var old_handler = handleObj.handler,
			// The current element.
			elem = $(this);

		handleObj.handler = function( event ) {
			if ( !elem.checkValidity() ) {

				// If the checkValidity fails
				// callback is bound matches the specified selector, prevent the
				// default action without stopping propagation, and don't call
				// the originally bound event handler.
				event.preventDefault();

				// Find the first invalid input and add a focus to that element
				elem.find(":input.invalid").eq(0).focus();

			} else {
				// Otherwise call the originally-bound event handler and return
				// its value.
				return old_handler.apply( this, arguments );
			}
		};
	}
};