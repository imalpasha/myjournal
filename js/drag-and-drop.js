/***
 * Title	: porlets drag and drop functions
 * Date		: 26/12/2007
 * Author	: Mohd Remi Asmuni (remiglobal@gmail.com)
 * Notes	: -
 */

// set reflex portlets
function reflexPortlets() {  
/*
	if ( document.getElementById("item_1") ) {
		document.getElementById("item_1").innerHTML = document.getElementById("div_alerts").innerHTML;
	}
	if ( document.getElementById("item_2")) {
		document.getElementById("item_2").innerHTML = document.getElementById("div_login").innerHTML;
	}
	if ( document.getElementById("item_3")) {
	document.getElementById("item_3").innerHTML = document.getElementById("div_sideMenu").innerHTML;
	}
	if ( document.getElementById("item_4") ) {
		document.getElementById("item_4").innerHTML = document.getElementById("div_notes").innerHTML;
	}
	if ( document.getElementById("item_8") ) {
		document.getElementById("item_8").innerHTML = document.getElementById("div_custom").innerHTML;
	}	
*/
}

// remove fields that cannot be edited
function forceFieldEdit() {

	var inputs = document.getElementsByTagName("input");
	for (var i = 0; i < inputs.length; i++){
		var inp = inputs[i];
		if ( inp.name == 'back' ) {
			// do nothing
		} else {
			iniInput(inp);
		}
	}
	
	var inputs2 = document.getElementsByTagName("textarea");
	for (var i = 0; i < inputs2.length; i++){
		var inp = inputs2[i];
		iniInput(inp);
	}	
} 

// initialisation of item input
function iniInput(element){
	//alert(element.name);
	var view = element;
	
	// Events functions
	function edit(){
		this.focus();
	}
	
	function select(){
		this.select();
	}
	

	// Events declarations
	view.ondblclick = select;
	view.onclick = edit;
	
	
}

//Debug Functions for checking the group and item order
function getGroupOrder() {
	alert(document.getElementById("sortableListOrder").value);
	//alert(Sortable.serialize('sortableList'));
}

// save the sortable list
function saveMySortableList(mySortableList) {
	var url = 'dnd-save-position.php'; 
	var user_id = $('p_user_id').value;
	var portal_id = $('p_portal_id').value;
	//alert(escape(mySortableList));
	new Ajax.Request(url, {   
		method: 'post',   
		postBody: 'user_id='+user_id+'&portal_id='+portal_id+'&sortableListsSubmitted=true&sortableListOrder='+escape(mySortableList),
		onSuccess: function(transport) {     
			//alert(transport.responseText);     
		},
		onLoading: function(){$('workingMsg').innerHTML = "saving portlet position...";$('workingMsg').style.display = "block";},
        onLoaded: function(){$('workingMsg').style.display = "none";} 
	}); 
}

// save the portlet state
function savePortletState(portletId,portletState) {
	var url = 'dnd-save-state.php'; 
	var user_id = $('p_user_id').value;

	new Ajax.Request(url, {   
		method: 'post',   
		postBody: 'user_id='+user_id+'&portlet_id='+portletId+'&portlet_state='+portletState,
		onSuccess: function(transport) {     
			//alert(transport.responseText);     
		},
		onLoading: function(){$('workingMsg').innerHTML = "saving portlet state...";$('workingMsg').style.display = "block";},
        onLoaded: function(){$('workingMsg').style.display = "none";} 
	}); 
}

// save notes
function saveNotes() {
	//alert('eheheh');
	var url = 'notes-save.php'; 
	var user_id = $('p_user_id').value;
	var notesInput = $('notesInput').value;	

	new Ajax.Request(url, {   
		method: 'post',   
		postBody: 'user_id='+user_id+'&notesInput='+notesInput+'&notesSave=true',
		onSuccess: function(transport) {     
			alert(transport.responseText);     
		},
		onLoading: function(){$('workingMsg').innerHTML = "saving notes...";$('workingMsg').style.display = "block";},
        onLoaded: function(){$('workingMsg').style.display = "none";} 
	}); 
}

// save notes
function closePortlet(portlet_id) {
	//alert('eheheh');
	var url = 'dnd-delete-portlet.php'; 
	var user_id = $('p_user_id').value;

	new Ajax.Request(url, {   
		method: 'post',   
		postBody: 'user_id='+user_id+'&portlet_id='+portlet_id,
		onSuccess: function(transport) {     
			//alert(transport.responseText);
			// this is not a smart hack, but it will do
			if ( portlet_id == "12" ) {
				$('displayPortletManagerDiv').style.display = "block";
			}
		},
		onLoading: function(){
			$('workingMsg').innerHTML = "deleting portlet...";
			$('workingMsg').style.display = "block";
			},
        onLoaded: function(){
			$('workingMsg').style.display = "none";
			
			} 
	}); 
}