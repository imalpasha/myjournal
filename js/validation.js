/**
 * Title 	: Helper functions for validation 
 * Author	: Mohd Remi Asmuni, remi@secretlabmedia.com
 * Date		: 1/5/2007
 * Desc  	: This class contains all helper functions for validation component.
 */

// function to get drop down label
function addOptionLabel(){
	var validation = document.getElementById("validation");
	var txtHidden = document.getElementById("validationLabel");
	txtHidden.value = validation.options[validation.selectedIndex].text;
	document.getElementById("validationLabel").value = txtHidden.value;
//	alert(txtHidden.value);
//	alert(document.getElementById("validationLabel").value);
	return true;
}

// merge validation and validationInput
function mergeValidation() {
	var validation = document.getElementById("validation");
	if ( document.getElementById('validationInput') ) {
		var validationInput = document.getElementById("validationInput");
		var y = validation.value + "=" + validationInput.value;
		document.getElementById("validation2").value = y;
	}
	//alert(document.getElementById("validation").value); return;
}

// validate min max to be number only
function validateMC() {
	
	var value = document.getElementById("answer").value;

	if ( value != "" ) {
		return true;
	} else {
		alert("You have not enter your answer !!! ");
		return false;
	}
}

// validate min max to be number only
function validateRating() {
	
	var value = document.getElementById("value").value;
	var description = document.getElementById("description").value;

	if ( ( value != "" ) && ( description != "" ) ) {
		return true;
	} else {
		alert("There are missing fields");
		return false;
	}
}

// validate min max to be number only
function validateMinMax() {
	
	var myregex=/^[0-9]$/;
	var validationInput = document.getElementById("validationInput").value;

	if ( myregex.test(validationInput) ) {
		return true;
	} else {
		alert("please enter numeric value only");
		return false;
	}
}

// adding input for min and max length validation option
function addInput () {
	var validation = document.getElementById("validation");
	var x = "";
	x = validation.options[validation.selectedIndex].value;
	//	alert( x + "selected");		
	if ( x == "minlength" || x == "maxlength" ) {
		
		if ( !document.getElementById('validationInput') ) {

			var data = document.getElementById('validationInputTD');
			var el = document.createElement('input');
			el.type = 'text';
			el.name = 'validationInput';
			el.id = 'validationInput';
			el.size = '7';
	
			data.appendChild(el);
		}
	} 
	
	/*else if ( document.getElementById('validationInput') ) {
		delete validation
	}*/
	
}

// remove input, this is to solve a bug when user returns to other validation scheme. 4/5/2007
function removeInput () {
	var validation = document.getElementById("validation");
	var x = "";
	x = validation.options[validation.selectedIndex].value;
	//	alert( x + "selected");		
	if ( x != "minlength" && x != "maxlength" ) {
		//alert("it goes here");
		if ( document.getElementById('validationInput') ) {

			var data = document.getElementById('validationInputTD');
			while ( data.hasChildNodes() ) {
				data.removeChild(data.lastChild);
			}
		}
	} 
}

// writing the layer
function WriteLayer(ID,parentID,URL) {
	if (document.layers) {
		var oLayer;
		if(parentID){
			oLayer = eval('document.' + parentID + '.document.' + ID + '.document');
		}else{
			oLayer = document.layers[ID].document;
		}
		oLayer.open();
		oLayer.write(URL);
		oLayer.close();
	} else if (parseInt(navigator.appVersion)>=5&&navigator.appName=="Netscape") {
		document.getElementById(ID).innerHTML = URL;
	}
	else if (document.all) document.all[ID].innerHTML = URL
}