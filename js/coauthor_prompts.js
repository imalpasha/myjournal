function prompt(param) {
	var agree = confirm("Are you sure you want to delete this item?");
	if ( agree ) {
		// proceed
		window.location.href = param;
	} else {
		return;
	}
}

function delete_coauthor(coauthor_id) {
	var agree = confirm("Are you sure you want to delete this item?");
	
	if (agree) {
		window.location.href = "coauthor-add.php?del=" + coauthor_id;
	} else {
		return;
	}	
}

function edit_coauthor(coauthor_id) {
	window.location.href = "coauthor-add.php?edit=" + coauthor_id;
}