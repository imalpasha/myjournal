<?php

// function display header
function dispHeader($username) {


//warna asal CAC9F1 ?>
<tr bgcolor="#374D81">
	<td><div class="greeting">Hi <?php echo $username; ?> </div></td>
	<td width="192">&nbsp;</td>
	<td width="354" bgcolor="#374D81"><div class="greeting"  align="right"><a href="update-profile.php">Update Profile</a> &#8226; <a href="change-password.php">Change Password</a> &#8226; <a href="manual.php">Manual</a> &#8226; <a href="logout.php">Logout</a> </div></td>
</tr>

<tr bgcolor="#CAC9F1">
	<td colspan="3" bgcolor="#FFFFFF"><img src="img/esurvey_1.jpg"></td>
</tr>

<?php 
}

?>