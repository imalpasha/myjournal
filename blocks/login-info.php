<?php

// get full name
$li_fullname = getName($_SESSION['user_id']);

?>
      <table width="220" align="center" id="<?php echo $blockName; ?>">
	  <tr>
		  <td valign="top" align="left">
			<br />
                  <span class="instructions">You are now logged in as </span>
				  <span class="titleBold"><?php echo $li_fullname; ?> ( <?php echo $username; ?> )</span>
			<br /> <br />				
				  <!--table border="0" cellpadding="0" cellspacing="0">
				  	<tr><td><img src="<?php echo $APP_URL; ?>/img/email.png" alt="go to front page" style="border:0px; " /></td><td>&nbsp;&nbsp;<a href="message.php">You have 1 new message(s)</a></td></tr>
					<tr><td><img src="<?php echo $APP_URL; ?>/img/house.png" alt="go to front page" style="border:0px; " /></td>
					<td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>&nbsp;&nbsp;<a href="admin.php">Home</a>&nbsp;</td>
                          <td><img src="<?php echo $APP_URL; ?>/img/house.png" alt="go to front page" style="border:0px; " /></td>
                          <td>&nbsp;<a href="public/index.php">Front page</a></td>
                        </tr>
                      </table></td></tr>
<?php if (isset($_SESSION["journal_name"])) { ?>					  
					<tr><td><img src="<?php echo $APP_URL; ?>/img/journal-16x16.jpg" alt="selected journal" style="border:0px; " /></td><td>&nbsp;&nbsp;<a href="admin.php"><?php echo strtoupper($_SESSION["journal_name"]); ?></a></td></tr>
<?php } ?>					
				  </table--> 
			
			</td>
  		</tr>
    </table>