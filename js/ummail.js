/***
 * Title	: ummail verification functions
 * Date	: 07/05/2008
 * Author	: Mohd Remi Asmuni (remiglobal@gmail.com)
 * Notes	: -
 */

// save the sortable list
function checkUMMAIL(username,password,type) {

	// check type
	if ( type == "staff" ) {
		var url = "http://umrefjournal.um.edu.my/verify-ummail.php"; 
	} else {
		var url = "http://umrefjournal.um.edu.my/verify-ummail.php"; 
	}

	// do xhr
	new Ajax.Request(url, {   
		method: 'post',   
		postBody: 'username='+rusername+'&password='+rpassword+'&type='+type,
		onSuccess: function(transport) {     
			alert(transport.responseText);     
		},
		onLoading: function(){

		},
       	onLoaded: function(){

		} 
	}); 
}

