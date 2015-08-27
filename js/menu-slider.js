var menuSliderArray; 
menuSliderArray = new Array();	
var sliderPressed = false;
var debugStep = 0;
var defaultBgColor = "#FFFFFF";
//var highlightedBgColor = "#daeda3";
var highlightedBgColor = "#99CCCC";

// toggle menu slider
function toggleMenuSlider(el) {
	// debug
	//displayArrayContent(menuSliderArray);	
	// extract div el
	var exEl = el
	exEl = exEl.replace(/div/,"");
	
	// add items 
	if ( !sliderPressed ) {
		// set slider active
		sliderPressed = true;
		// individual sliding
		if ( !checkMenuInArray(el,menuSliderArray) ) {
			// this happens when user click the first times	
			// slide up other items in array
			if (menuSliderArray.length > 0 ) {
				removeArrayItems(el,menuSliderArray);	
				// add to array
				addMenuToArray(el,menuSliderArray); 
				//setTimeout("Effect.SlideDown("+el+");",700);
				// the following should be integrated further to Effect.slideDown fn
				setTimeout("slideDownHelper('"+el+"');",1000);		
				// highlight td
				highlightBg("td"+exEl);
				// reset javascript events
				if (document.getElementById("td"+exEl).onmouseover != "" ) {
					//highlightBg("td"+exEl);
					document.getElementById("td"+exEl).onmouseover = "";
					document.getElementById("td"+exEl).onmouseout = "";					
				}
			} else {
				// add to array
				addMenuToArray(el,menuSliderArray); 
				// toggle slider downs
				Effect.SlideDown(el);
				sliderPressed = false;	
				// highlight td
				highlightBg("td"+exEl);		
				// reset javascript events
				if (document.getElementById("td"+exEl).onmouseover != "" ) {
					//highlightBg("td"+exEl);
					document.getElementById("td"+exEl).onmouseover = "";
					document.getElementById("td"+exEl).onmouseout = "";					
				}			
			}
		} else {
			// this happens when user clicks again on the same button
			// remove from array
			removeMenuFromArray(el,menuSliderArray);
			// slide up
			Effect.SlideUp(el);
			sliderPressed = false;		
			unHighlightBg("td"+exEl);
			mouseoutHelper("td"+exEl); 
		}
		// are u sure?
		//sliderPressed = false;
	}
}

function hoverHelper(el) {
	document.getElementById(el).style.backgroundColor = highlightedBgColor;		
}

function mouseoutHelper(el) {	
	
	var myEl = document.getElementById(el);
	myEl.onmouseover = function () {
		myEl.style.backgroundColor = highlightedBgColor;
	}
	
	myEl.onmouseout = function () {
		myEl.style.backgroundColor = defaultBgColor;
	}

}

function highlightBg(el) {
	document.getElementById(el).style.backgroundColor = highlightedBgColor;	
}

function unHighlightBg(el) {
	document.getElementById(el).style.backgroundColor = defaultBgColor;	
}

function slideDownHelper(el) {
	//alert(el);
	Effect.SlideDown(el,{duration: 1});
	//sliderPressed = false;	
	setTimeout("sliderPressed = false;",1800);			
}

function slideUpHelper(el) {
	Effect.SlideUp(el);
	sliderPressed = false;	
}

function removeArrayItems(el,selArray) {
	
	// hide divs
	for (var i = 0; i < selArray.length; i++ ) {
		Effect.SlideUp(selArray[i]);

		// extract div el
		var exEl = selArray[i];
		exEl = exEl.replace(/div/,"");
		unHighlightBg("td"+exEl);
		
		// on mouseout fix....aarrgghhhhhhhhhhhhh
		if ( el != selArray[i] ) {
			mouseoutHelper("td"+exEl);
		} 
	}
	// remove other items 
	menuSliderArray = new Array();

}

function removeMenuFromArray(el,selArray) {
	// get element position in array
	var elPos = getMenuPositionInArray(el,selArray);
	// set range to delte
	var delRange = "1";
	selArray.splice(elPos,delRange);
}

// retrieve object 
function displayArrayContent(selArray) {
	//alert(selArray.toString()+" length is: "+selArray.length);
	var savedAsset = "";
	// increase debug step

	for (var i=0;i<selArray.length;i++) {
		debugStep++;
		savedAsset += "<br>"+debugStep+". el["+i+"]: "+selArray[i];
	}
	//alert("array val: "+savedAsset);
	document.getElementById("debugPanel").innerHTML += savedAsset;
}

function getMenuPositionInArray(el,selArray) {
	var retResult;
	
	for ( var i = 0; i < selArray.length; i++ ) {
		if ( selArray[i] == el.toString() ) {
			retResult = i;
		} else {
			retResult = "";
		}		
	}
	
	return retResult;	
}

function checkMenuInArray(el,selArray) {
	var retResult;

	for ( var i = 0; i < selArray.length; i++ ) {
		
		if ( selArray[i] == el ) {
			retResult = true;
		} else {
			retResult = false;
		}		
	}
	
	return retResult;	
}

function addMenuToArray(val,selArray) {
	// get the array length
	var selArrayLength = selArray.length;
	// add new val to array
	selArray[selArrayLength] = val;
	// display
	//displayArrayContent(selArray);
}

// checking if variable or object is an array
function isArray(obj) {
	//returns true is it is an array
	if (obj.constructor.toString().indexOf("Array") == -1) {
		return false;
	} else {
		return true;
	}
}

function countElement(myEl,myClass) {	
	var el = document.getElementsByTagName(myEl);
	var tdLen = el.length;
	var cnt = 0;
	for ( var i = 0; i < tdLen; i++) {
		if ( el[i].className == myClass ) {
			cnt++;
		}
	}
	alert("found "+cnt+"/"+tdLen);
}