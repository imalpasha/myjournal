/***
 * Title	: categories functions
 * Date		: 26/12/2007
 * Author	: Mohd Remi Asmuni (remiglobal@gmail.com)
 * Notes	: -
 */

// function delete category by categoryId
function deleteCategoryId(id) {

	// get category id
	var categoryId = document.getElementById("categoryId").value;
	// put in array
	var categoryArray = categoryId.split(',');
	// search in array and empty it
	var categoryArrayLength = categoryArray.length;

	// remove item from array
	for ( var i = 0; i < categoryArrayLength ; i++ ) {
		//alert(categoryArray[i]+","+id)
		if ( categoryArray[i] == id ) {
			// this is a shortcut
			categoryArray.splice(i,1);
			// remove from innerHTML
			removeCatFromTable(id);
			break;
		}
	}
	
	// reinitialize categoryId
	document.getElementById("categoryId").value = "";
	
	// print all items into categoryId
	for ( var i = 0; i < categoryArray.length ; i++ ) {
		if ( document.getElementById("categoryId").value == "" ) {
			document.getElementById("categoryId").value = categoryArray[i];
		} else {
			document.getElementById("categoryId").value += ","+categoryArray[i];
		}
	}
	
	//alert(document.getElementById("categoryId").value);
}

// function add new category
function addNewCat(name,id) {

	// creating rows
	var myTable = document.getElementById("myTable");
	var lastRow = myTable.rows.length;
	var row = myTable.insertRow(lastRow);
	
	row.id = "row_"+id;
	
	// first column, row no
	var firstCol = row.insertCell(0);
	var textNode1 = document.createTextNode( name );
	firstCol.appendChild(textNode1);
	  
	// second column, create new input element
  	var secondCol = row.insertCell(1); 
	var deleteLink = document.createElement("a");
	deleteLink.innerHTML = "delete";
	//deleteLink.id = "row_"+id;
	deleteLink.rowIndex = "";//lastRow;	
	//deleteLink.onClick = "deleteCategoryId("+id+");";
	deleteLink.href="javascript:deleteCategoryId("+id+");";
	secondCol.appendChild(deleteLink);
}

// function to remove category from table 
function removeCatFromTable(id){
	
	// get row index
	var i = document.getElementById("row_"+id).rowIndex;
	//alert(id+","+i);
	//return;
	// get table
	var myTable = document.getElementById("myTable");
	// delete row from table
	myTable.deleteRow(i);
}