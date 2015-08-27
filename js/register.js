/***
 * Title	: user registration libraries
 * Date		: 26/12/2007
 * Author	: Mohd Remi Asmuni (remiglobal@gmail.com)
 * Notes	: -
 */

var SERVER_PATH = "http://umrefjournal.um.edu.my/";
var LOCAL_PATH = "http://localhost/ejurnal";
var global_emp_no = "";
var global_stud_id = "";

function verifyNow() {
	// get vars
	var username = $("rusername").value;
	var password = $("rpassword").value;
	var userorigin = $("userorigin").value;
	
	if ( username == "" || password == "") {
		alert("Please enter your username and password.");
		return;
	}
	
	var type = "";
	
	// check origin	
	if ( userorigin == "internal staff"  ) {
		type = "staff";
	} else if ( userorigin == "internal student" ) {
		type = "student";
	} else {
		type = "both";
		// do nothing
	}
	
	// check ummail for any type
	checkUMMAIL(username,password,type);

}

// get ummail info
function getUmmailInfo(type) {
	
	// set xhr dest url
	var url = SERVER_PATH+"/get-ummail-info.php"; 
	//var url = LOCAL_PATH+"/get-ummail-info.php"; 

	var key = "";
	
	if ( type == "staff" ) {
		key = global_emp_no;
	//alert('emp_no: '+global_emp_no);
	} else {
		key = global_stud_id;
//alert('emp_no: '+global_stud_id);		
	}
	//alert(key+","+type);
	// do xhr
	new Ajax.Request(url, {   
		method: 'post',   
		postBody: 'key='+key+'&type='+type,
		onSuccess: function(transport) {  
			//alert(transport.responseText);
			$('divRetInfo').innerHTML = transport.responseText; 
			$('tableSubmit').style.display = "";
			//$('validate').style.display = "none";
		},
		onLoading: function(){
			
		},
       	onLoaded: function(){
			
		} 
	}); 
}

// check username availability
function checkUsernameAvailability(username,type) {
	//alert('username: '+username);
	// set xhr dest url
	var url = SERVER_PATH+"/verify-user-exists.php"; 
//	var url = LOCAL_PATH+"/verify-user-exists.php"; 	

	// do xhr
	new Ajax.Request(url, {   
		method: 'post',   
		postBody: 'username='+username,
		onSuccess: function(transport) {  

			//alert("check local: "+transport.responseText); 
			
			if ( transport.responseText == "true" ) {
				// set success message
				$("errorMsg").innerHTML = "User exists inside UM Refereed Academic Journal. Please login using your username and password.";
				$("validate").style.display = "";	
				
			} else {

				if ( type == "both" ) {
					//alert('both');
					//alert(transport.responseText);
					$("errorMsg").innerHTML = "Verification succeed. Please fill in the rest of the form.";
					$("tableProfile").style.display = "";	
					$("tableProfileForm").style.display = "";	
					$("tableSubmit").style.display = "";
					$("validate").style.display = "";	
				} else {				
					//alert('got profile');
					$("errorMsg").innerHTML = "Verification succeed. Please fill in the rest of the form.";
					$("trUsertype").style.display = "";
					$("validate").style.display = "";	
					$("tableUmmailInfo").style.display = "";		
					getUmmailInfo(type);
				}
			}
			
    
		},
		onLoading: function(){
			$("errorMsg").innerHTML = "Verifying user existence...&nbsp;&nbsp;&nbsp;<img src='../img/load.gif'>";
		},
       	onLoaded: function(){
			//$("divLoading").style.display = "none";
		} 
	}); 	
}

// check ummail according to type
function checkUMMAIL(username,password,type) {
	//alert("u: "+username+" p: "+password+" t: "+type);
	// hide other form fields
	$("trRePassword").style.display = "none";			
	$("trUsertype").style.display = "none";
	$("tableProfile").style.display = "none";
	$("tableProfileForm").style.display = "none";
	$("tableSubmit").style.display = "none";
	$("validate").style.display = "none";
	$("tableUmmailInfo").style.display = "none";			
	// set xhr dest url
	var url = SERVER_PATH+"/verify-ummail.php"; 

	// do xhr
	new Ajax.Request(url, {   
		method: 'post',   
		postBody: 'username='+username+'&password='+password+'&type='+type,
		onSuccess: function(transport) { 
			
			//alert(transport.responseText);     

			if ( transport.responseText == "true" ) {
				//alert('igh1');
				// this happen when type equals to both and the result of verifying the user in ummail is true
				checkUsernameAvailability(username,type);

			} else if ( transport.responseText == "false" ) {
				//alert('igh2');				
				if ( type != "both" ) {
					// this happen when type equals to internal staff or internal student
					// and the result of verifying the user in ummail is false
					$("errorMsg").innerHTML = "Verification with the UMMAIL failed. Please try again with another username or password.";
					$("validate").style.display = "";
				} else {
					// this is for both
					$("errorMsg").innerHTML = "User exist in ummail. Please try again with another username or password.";
					$("validate").style.display = "";
					
				}
			} else {
				//alert('igh3');				
				// this happens when type equals to internal staff and internal user and it returns the user info array
				var tempArray = (transport.responseText).split("|");
				
				// set global_ic_no
				if ( type == "staff" ) {
				//alert('igh4'+global_emp_no);					
					global_emp_no = tempArray[2];
					$('nameHidden').value = tempArray[0];
				} else if ( type == "student" ) {
					global_stud_id = tempArray[1];
					$('nameHidden').value = tempArray[2];
				}

				// set email
				if ( type == "staff" ) {
					//alert('igh5');
					$('emailHidden').value = username+"@um.edu.my";
				} else if ( type == "student" ) {
					$('emailHidden').value = username+"@perdana.um.edu.my";
				}
				//alert($('nameHidden').value+","+$('emailHidden').value);
				// check locally
				checkUsernameAvailability(username,type);
			
			}
			
			
		},
		onLoading: function(){
			//$("divLoading").style.display = "block";
			$("errorMsg").innerHTML = "Verifying with UMMAIL...&nbsp;&nbsp;&nbsp;<img src='../img/load.gif'>";
		},
       	onLoaded: function(){
			//$("divLoading").style.display = "none";
		} 
	}); 
}

function displayUserOrigin() {

	var userorigin = $("userorigin").value;
	
	if ( userorigin == "external participant"  ) {
		//$("trUsername").style.display = "";
		//$("trPassword").style.display = "";
		//$("trRePassword").style.display = "none";			
		//$("trUsertype").style.display = "none";
		//$("trSelectJournal").style.display = "none";		
		$("tableProfile").style.display = "none";	
		$("tableProfileForm").style.display = "none";	
		$("tableSubmit").style.display = "none";			
		$("validate").style.display = "";		
		$("errorMsg").innerHTML = "Please enter your username and password in the corresponding input box and click validate to check whether the username is available. ";	
		$("tableUmmailInfo").style.display = "none";		
	} else if ( userorigin == ""  ) {
		//$("trUsername").style.display = "none";
		//$("trPassword").style.display = "none";
		//$("trRePassword").style.display = "none";	
		//$("trUsertype").style.display = "none";
		//$("trSelectJournal").style.display = "none";		
		$("validate").style.display = "none";		
		$("tableProfile").style.display = "none";	
		$("tableProfileForm").style.display = "none";	
		$("tableSubmit").style.display = "none";			
		$("errorMsg").innerHTML = "Please select your origin.";
		$("tableUmmailInfo").style.display = "none";	
	} else {
		//$("trUsername").style.display = "";
		//$("trPassword").style.display = "";
		//$("trRePassword").style.display = "none";			
		//$("trUsertype").style.display = "none";
		//$("trSelectJournal").style.display = "none";		
		$("tableProfile").style.display = "none";	
		$("tableProfileForm").style.display = "none";	
		$("tableSubmit").style.display = "none";			
		$("validate").style.display = "";		
		$("errorMsg").innerHTML = "Please enter your UMMAIL's username and password in the corresponding input box and click validate. ";	
		$("tableUmmailInfo").style.display = "none";	
	}
}

function displaySelectedJournal() {

	var usertype = $("usertype").value;
	
	if ( usertype == "subscriber"  ) {
		//$("chkJournal").style.display = "";
		//$("selectedJournal").style.display = "none";		
	} else {
		//$("chkJournal").style.display = "none";
		//$("selectedJournal").style.display = "";			
	}
}

function displayProfile() {
	
	var selectedJournal = $("selectedJournal").value;	
	
	if ( selectedJournal == "" ) {
		// hide profile
		$("tableProfile").style.display = "none";	
		$("tableProfileForm").style.display = "none";	
		$("tableSubmit").style.display = "none";	
	} else {
		// display profile
		$("tableProfile").style.display = "";	
		$("tableProfileForm").style.display = "";	
		$("tableSubmit").style.display = "";	
	}
	
}
