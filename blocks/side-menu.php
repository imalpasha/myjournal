<!--link href="../css/common.css" rel="stylesheet" type="text/css"-->
<?php 

// set block info 
$blockId = "3";
$blockName = "sideMenu"; 
$blockTitle = "My Quicklinks"; 
$blockActive = false;

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
<div id="div_<?php echo $blockName; ?>" style="display:<?php echo getBlockState($blockActive); ?>">
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
  <tr>
	<td height="15">
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
	<td valign="top" bgcolor="#FFFFFF">

		<table width="220" align="center" id="<?php echo $blockName; ?>" >
			<tr>
				<td>
					<?php
					
					$query = mysql_query("select id,name,link from quicklinks where user_id = '$user_id';") or die ("could not select quicklinks");
					$numrows = mysql_num_rows($query);
					if ( $numrows > 0 ) {
						while($result=mysql_fetch_array($query))	{
							$name=$result["name"];	
							$link=$result["link"];
					?>
				  	- <a class="sidemenu" href="http://<?php echo $link; ?>"><?php echo $name; ?></a><br>
					<?php 
						}
					}
					
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

	</td>
  </tr>
</table>
</div>