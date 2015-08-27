<?php

/**
 * Title  : session checker file
 * Date   : 14/4/2007
 * Project: e-journal, universiti malaya
 * Author : Mohd Remi Asmuni, remiglobal@gmail.com
 * Notes  : an include file that will get session variables and 
 * 			check whether a user has been logged in or not.
 */
 
//include("/usr/local/apache/htdocs/ejurnal/include/CAS/cas.php");
// start session
session_start();


// assign session variable to local var
	

//ORIGINAL
$username = @$_SESSION['username'];
$timestamp = @$_SESSION['timestamp'];
$group = @$_SESSION['group']; 
$user_id = @$_SESSION['user_id']; 
$sess_journal_id = @$_SESSION['journal_id'];
/**/


// check if this user has login or not
/*if ( $pageGroup == "backend" ) {
	$current_page=$_SERVER['PHP_SELF'];
	if((!$username)||(!$timestamp)){
		header("Location: index.php?redirect=".$current_page);
		exit;
	}
}*/

?>
