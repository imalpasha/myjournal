// this js collections is for table rendering

// onMouseOver="cellOn(this);" onMouseOut="cellOut(this);"
// function to change cell background color when mouse is over
function cellOn(td){
	if(document.getElementById||(document.all && !(document.getElementById))){
		td.style.backgroundColor="#cccccc";
	}
}

// function to change cell background color when mouse is out
function cellOut(td){
	if(document.getElementById||(document.all && !(document.getElementById))){
		td.style.backgroundColor="#ffffff";
	}
}

// function to change cell background color when mouse is over
function rowOn(tr){
	if(document.getElementById||(document.all && !(document.getElementById))){
		tr.style.backgroundColor="#FFCC66";
	}
}

// function to change cell background color when mouse is out
function rowOut(tr){
	if(document.getElementById||(document.all && !(document.getElementById))){
		tr.style.backgroundColor="#ffffff";
	}
}