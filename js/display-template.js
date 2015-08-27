
function displayTemplate() {
	var x = document.getElementById("quesType");
	var getSelected = x.options[x.selectedIndex].value;	

	
	if ( getSelected == "multiple_choice" ) {
		document.getElementById("multiple_choice").style.display = 'block';
	} else if ( getSelected == "true_false" ) {
		document.getElementById("true_false").style.display = 'block';
	} else if ( getSelected == "yes_no" ) {
		document.getElementById("yes_no").style.display = 'block';		
	} else if ( getSelected == "short_answer" ) {
		document.getElementById("short_answer").style.display = 'block';		
	} else if ( getSelected == "essay" ) {
		document.getElementById("essay").style.display = 'block';		
	} 
	
	// display submit_button
	document.getElementById("submit_button").style.display = 'block';		

}
