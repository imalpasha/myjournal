// Author 		: Mohd Remi Asmuni, remi@secretlabmedia.com
// Date			: Someday in August, 2007
// Description	: form helper class 
// - contains all functions related to HTML form

// this function count the number of char in a text field
// if it exceeds the maximum number of char allowed, the extra character will be sliced
function countChar(sourceElement,destElement,maxChar){
	var maxChar = eval(maxChar);
	var strlen = document.getElementById(sourceElement).value.length;
	document.getElementById(sourceElement).value = document.getElementById(sourceElement).value.slice(0, maxChar);
	if ( strlen <= maxChar ) {
		//document.getElementById(sourceElement).readonly = false;
		document.getElementById(destElement).innerHTML = strlen + " aksara telah di taip";
	} else {
		document.getElementById(destElement).innerHTML = "<span class='fontcomfirm'>anda telah melebihi jumlah aksara yang telah ditetapkan.</span>";			
		return;
	}
}

function addUploadField() {

	// make some space before adding a new upload form
	var myTable = document.getElementById("myTable");
	var lastRow = myTable.rows.length;
	var row = myTable.insertRow(lastRow);
	var number = lastRow + 1;
	
	// first column, row no
	var firstCol = row.insertCell(0);
	var textNode = document.createTextNode( number + ".");
	firstCol.appendChild(textNode);
	  
	// second column, create new input element
  	var secondCol = row.insertCell(1); 
	var uploadFile = document.createElement("input");
	uploadFile.name = "otherfile" + number;
	uploadFile.id = "otherfile" + number;
	uploadFile.type = "file";
	uploadFile.size="35";
	secondCol.appendChild(uploadFile);
	
	// third column, delete link
	/*
	var thirdCol = row.insertCell(2);
	var deleteLink = document.createElement("a");
	deleteLink.innerHTML = "delete";
	deleteLink.onClick = "deleteUploadFile("+number+");";
	//	deleteLink.href="javascript:deleteUploadFile("+number+");";
	deleteLink.href="javascript:deleteLastRow();";	
	thirdCol.appendChild(deleteLink);
	*/
	
	// update upload file count
	document.getElementById("uploadFileCount").value = number;

}

// delete row by its id
// somehow this function is not perfect when you delete some row in the middle
// may be need to update the row id 
function deleteUploadFile( deleteID ) {
	var myTable = document.getElementById("myTable");
	myTable.deleteRow(deleteID);
}

// delete last row
function deleteLastRow() {
	var myTable = document.getElementById("myTable");
	var lastRow = myTable.rows.length;
	if ( lastRow > 0 ) {
		lastRow--;
		myTable.deleteRow(lastRow);
		document.getElementById("uploadFileCount").value = lastRow;
	}
}