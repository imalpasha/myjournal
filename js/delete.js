// delete prompts
function promptDelete( param ) {
	var agree = confirm("Are you sure you want to delete this item?");
	if ( agree ) {
		// proceed
		window.location.href = param;
	} else {
		return;
	}
}
