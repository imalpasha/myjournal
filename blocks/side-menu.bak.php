<!--link href="../css/common.css" rel="stylesheet" type="text/css"-->
<?php 

// set block info 
$blockId = "3";
$blockName = "sideMenu"; 
$blockTitle = "Quicklinks"; 
$blockActive = false;

?>
<div id="div_<?php echo $blockName; ?>" style="display:<?php echo getBlockState($blockActive); ?>">
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
  <tr>
	<td bgcolor="#CCCCCC" height="15">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  			<tr >
			  <td bgcolor="#CCCCCC" valign="middle"><span class="blockTitle"><?php echo $blockTitle; ?></span></td>
			  <td height="15" bgcolor="#CCCCCC" align="right">
				    <img id="min<?php echo $blockName; ?>" name="min<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/minimize.jpg" alt="minimize this portlet" width="15" height="15" align="middle" onClick="hideLayer('<?php echo $blockName; ?>');savePortletState('<?php echo $blockId; ?>','minimized');"  onMouseOver="this.style.cursor='pointer'"><img id="max<?php echo $blockName; ?>" name="max<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/maximize.jpg" alt="maximize this portlet" width="15" height="15" align="middle" onClick="showLayer('<?php echo $blockName; ?>');savePortletState('<?php echo $blockId; ?>','maximized');" style="display:none; "  onMouseOver="this.style.cursor='pointer'">
			  </td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
	<td valign="top" bgcolor="#FFFFFF">

		<table width="220" align="center" id="<?php echo $blockName; ?>" >
			<tr>
				<td class="sidemenu black">
                  <?php if ( $group != "subscriber" ) { ?>                  


				  <?php if ( $group == "manager" ) { ?>
                  - <a href="sys-portal.php">portal management</a><br>
                  - <a href="admin.php">journal management</a><br />
                  - <a href="manager.php">journal editing</a><br />
                  - <a href="reviewer.php">journal review</a><br />
                  - <a href="contributor.php">journal contribute</a>
                  <?php } ?>
                  <?php if ( $group == "editor" ) { ?>
                  - <a href="manager.php">journal editing</a><br />
                  <?php } ?>
                  <?php if ( $group == "reviewer" ) { ?>
                  - <a href="reviewer.php">journal review</a><br />
                  <?php } ?>
                  <?php if ( $group == "contributor" ) { ?>
                  - <a href="contributor.php">journal contribute</a>
                  <?php } ?>


                  <?php } ?>		
				  
					<?php 
					
					// set current portlet state
					if ( getUserPortletState($user_id,$blockId) == "maximized" ) {
						echo '<SCRIPT LANGUAGE="JavaScript">showLayer("'.$blockName.'");</SCRIPT>';
					} else {
						echo '<SCRIPT LANGUAGE="JavaScript">hideLayer("'.$blockName.'");</SCRIPT>';				
					}
					
					?>		
			  </td>
			</tr>
		</table>

	</td>
  </tr>
</table>
</div>