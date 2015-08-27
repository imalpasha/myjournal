<?php 

// set block info
$blockId = "2";
$blockName = "login";
$blockTitle = "Login Information"; 

// get portlet id
$portlet_id = $blockId;
//$portlet_id = getPortletId($blockName);
//$blockId = $portlet_id;
// check if users has been mapped to this portlet
if ( !checkUserPortletExists($user_id,$portlet_id) ) {
	// get max portlet position
	$position = getMaxPortletPosition($user_id);
	// set window state 
	$window_state = "maximized";
	// add portlet
	addUserPortlet($user_id,$portlet_id,$blockName,$position,$window_state);
	// redirect to resolve some js bug
	header("Location: ".$current_page);
	exit;	
}

?>
<div id="div_<?php echo $blockName; ?>" style="display:none ">
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
  <tr valign="top">
  	<td>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" background="<?php echo $APP_URL; ?>/img/portlet-bg.jpg">
  			<tr>
			  			  <td width="200" align="left">
			  
			  <span class="blockTitle"><?php echo $blockTitle; ?></span></td>
			  <td height="15" align="right">
				<table width="35" border="0" cellpadding="0" cellspacing="0"  align="right">
					<tr>
						<td><img id="min<?php echo $blockName; ?>" name="min<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/minimize.jpg" alt="minimize this portlet" width="15" height="15" onClick="hideLayer('<?php echo $blockName; ?>');savePortletState('<?php echo $blockId; ?>','minimized');"  onMouseOver="this.style.cursor='pointer'">
					<img id="max<?php echo $blockName; ?>" name="max<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/maximize.jpg" alt="maximize this portlet" width="15" height="15" onClick="showLayer('<?php echo $blockName; ?>');savePortletState('<?php echo $blockId; ?>','maximized');" style="display:none; "  onMouseOver="this.style.cursor='pointer'"></td>
						<td><img width="15" height="15" onClick="document.getElementById('item_<?php echo $blockId; ?>').style.display = 'none';closePortlet('<?php echo $portlet_id; ?>');" onMouseOver="this.style.cursor='pointer'" alt="close this portlet" src="<?php echo $APP_URL; ?>/img/close.jpg"></td>
					</tr>
				</table>
					
	          </td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
    <!-- td  colspan="2" bgcolor="#99CC99" -->
	    <td  colspan="2" bgcolor="#FFFFFF" >

      <table width="220" align="center" id="<?php echo $blockName; ?>">
	  <tr>
		  <td valign="top" align="left">
			<br />
                  <span class="instructions">You are now logged in as </span>
				  <span class="titleBold"><?php echo $username; ?> ( <?php echo $group; ?> )</span>
			<br /> <br />				
				  <table border="0" cellpadding="0" cellspacing="0" border="0">
				  	<tr><td><img src="<?php echo $APP_URL; ?>/img/email.png" alt="go to front page" style="border:0px; " /></td><td>&nbsp;&nbsp;<a href="message.php">You have 1 new message(s)</a></td></tr>
					<tr><td><img src="<?php echo $APP_URL; ?>/img/house.png" alt="go to front page" style="border:0px; " /></td><td>&nbsp;&nbsp;<a href="admin.php">Home</a>&nbsp;<a href="public/index.php">Go to front page</a></td></tr>
					<tr><td><img src="<?php echo $APP_URL; ?>/img/journal-16x16.jpg" alt="selected journal" style="border:0px; " /></td><td>&nbsp;&nbsp;<a href="journal-select.php"><?php echo $_SESSION["journal_name"]; ?></a></td></tr>
				  </table> 
			
			</td>
  		</tr>
    </table>

	<?php 
	
				// set current portlet state
				if ( getUserPortletState($user_id,$blockId) == "maximized" ) {
					// maximized
					echo '<SCRIPT LANGUAGE="JavaScript">showLayer("'.$blockName.'");</SCRIPT>';
				} else if ( getUserPortletState($user_id,$blockId) == "minimized" ) {
					// minimized
					echo '<SCRIPT LANGUAGE="JavaScript">hideLayer("'.$blockName.'");</SCRIPT>';				
				} else {
					// if disabled, then hide portlet 
					echo '<SCRIPT LANGUAGE="JavaScript">document.getElementById("item_'.$blockId.'").style.display = "none";</SCRIPT>';	
				}
	
	?>	
	</td>
  </tr>
</table>
</div>