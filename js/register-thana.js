function displayUserOrigin() {

	var userorigin = document.getElementById("userorigin").value;
	
	if ( userorigin == "external participant"  ) {
		document.getElementById("trUsername").style.display = "block";
		document.getElementById("trPassword").style.display = "block";
		document.getElementById("trRePassword").style.display = "block";
		document.getElementById("trProfile").style.display = "block";			
	} else {
		document.getElementById("trUsername").style.display = "block";
		document.getElementById("trPassword").style.display = "block";
		document.getElementById("trRePassword").style.display = "none";
		document.getElementById("trProfile").style.display = "none";			
	}
}

function displaySelectedJournal() {

	var usertype = document.getElementById("usertype").value;
	
	if ( usertype == "subscriber"  ) {
		document.getElementById("chkJournal").style.display = "block";
		document.getElementById("selectedJournal").style.display = "none";		
	} else {
		document.getElementById("chkJournal").style.display = "none";
		document.getElementById("selectedJournal").style.display = "block";			
	}
}
