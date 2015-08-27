<?php 

// portlet display mechanism on all portlet delete
// this is a work in progress
$navigation_count = 0;

// ensure that all portlets have been mapped
// get portlets that is within this portal_id and owned by this user_id or the administrator (0)
$queryP=mysql_query("select id,name,shortname,block from portlets where portal_id = '$portal_id' and (owner = '$user_id' or owner = '0')") or die ("could not select");

$portNumrows = mysql_num_rows($queryP);
//echo "no of portlet: ".$portNumrows." user_id: ".$user_id;

while( $resultP=mysql_fetch_array($queryP) ){

	$portlet_id = $resultP["id"];
	$portlet_name = $resultP["name"];	
	$portlet_shortname = $resultP["shortname"];		
	$portlet_block = $resultP["block"];		
	
	// check if users has been mapped to this portlet
	// ***need to add porlet delete audit check later 
	//echo "portlet_id: ".$portlet_id." -> ".checkUserPortletExists($user_id,$portlet_id);
	if ( !checkUserPortletExists($user_id,$portlet_id) ) {
		
		// get max portlet position
		$position = getMaxPortletPosition($user_id);
		//echo "up does not exist. portlet_id: ".$portlet_id.", position: ".$position;
		// set window state 
		$window_state = "maximized";
		// add portlet
		addUserPortlet($user_id,$portlet_id,$portlet_shortname,$position,$window_state);

	} else {
		//echo "up exist. ".$portlet_id.",".$portlet_name."<br>";
	}
}


// start draggable
echo "<div id='sortableList'>";

// get all custom blocks
$no = 0;

$queryPortlet=mysql_query("select b.portlet_id,a.name,a.shortname,a.block,b.window_state,b.position from portlets a, portlets_users_map b where b.user_id = '$user_id' and a.portal_id = '$portal_id' and a.id = b.portlet_id order by b.position") or die ("could not select");

while( $resultPortlet=mysql_fetch_array($queryPortlet) ){

	$no++;
	$portlet_id = $resultPortlet["portlet_id"];
	$portlet_name = $resultPortlet["name"];	
	$portlet_shortname = $resultPortlet["shortname"];		
	$portlet_block = $resultPortlet["block"];		
	$portlet_state = $resultPortlet["window_state"];
	$portlet_position = $resultPortlet["position"];	
		
	// set block info 
	$blockId = $portlet_id;
	$blockName = $portlet_shortname; 
	$blockTitle = $portlet_name; 
	$blockActive = $portlet_state;
	
	// skip if portlet state is not maximized
	if ( $portlet_state != "disabled" ) {
		// remi hack - 28052008
		// check navigation portlet found
		if ( $portlet_shortname == "navigation" ) {
			$navigation_count = 1;
		}
		//$navigation_count++;
?>
<!-- custom block <?php echo $user_id.",".$portal_id; ?>: <?php echo $blockName; ?> -->
<div id="item_<?php echo $portlet_id; ?>">
<!--div id="div_<?php echo $blockName; ?>" style="display:<?php echo getBlockState($blockActive); ?>"-->
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666" id="div_<?php echo $blockName; ?>" style="display:<?php echo getBlockState($blockActive); ?>" >
  <tr>
	<td height="15">
	
		<table width="100%" border="0" cellpadding="0" cellspacing="0" background="<?php echo $APP_URL; ?>/img/portlet-bg.jpg">
  			<tr>
			  			  <td width="200" align="left" class="blockTitle">
			  
			  &nbsp;<?php echo strtoupper($blockTitle); ?>
			  
			  </td>
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
  <tr <?php if ($portlet_shortname == "analog_clock") { ?> align="center" <?php } ?>>
	<td valign="top" bgcolor="#FFFFFF" width="100%">

		<table cellpadding="0" cellspacing="0" border="0" id="<?php echo $blockName; ?>" width="100%" >
			<tr>
				<td>
					<?php
					
					$query = mysql_query("select embed from portlets_map where portlet_id = '$portlet_id';") or die ("could not select custom portlet");
					$numrows = mysql_num_rows($query);
					
					if ( $numrows > 0 ) {
						$portletCount = 0;
						while($result=mysql_fetch_array($query))	{
							$portletCount++;
							$embed=stripslashes($result["embed"]);	
							//echo "this is a custom portlet";
							
						}
					} else {
						
						if ( $portlet_block != "" ) {
							$portletCount++;
							// get from block

							$myIncludeFile = "blocks/".$portlet_block;
							//echo "igh 1: ".$portlet_block.", mif: ".$myIncludeFile;
							include($myIncludeFile);
							//echo "igh 2: ".$portlet_block.", mif: ".$myIncludeFile;
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
<!--/div-->
<?php
	} // end of if portlet state is not maximized

} // end of getting custom portlets

// close db
//include("include/db.end.php");
echo "</div>";

echo "<div id='displayPortletManagerDiv' style='display:none'><a href=\"portlet-manager.php\">You have just closed the main navigation. Click here to go to the portlet manager</a></div>";

if ( $navigation_count == 0 ) { echo "<a href=\"portlet-manager.php\">Currently the main navigation is not displayed. To turn it on, please go to the portlet manager</a>"; }  

?>
