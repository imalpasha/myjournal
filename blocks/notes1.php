<?php 

// include notes
include('include/notes.php');

// set block info ... for the time being this is hardcoded
$blockId = "4";
$blockName = "notes"; 
$blockTitle = "My Scratch Pad"; 

// process saving of notes
/*
$notesSave = $_POST["notesSave"];
if ( $notesSave != "" ) {
	// get data
	$notesInput = $_POST["notesInput"];
	
	// check notes exist
	if ( isNotesExists($user_id) ) {
		$msg = updateNotes($user_id,$notesInput);
	} else {
		$msg = addNotes($user_id,$notesInput);
	}
}
*/

// get notes
$notesOutput = getNotes($user_id);

?>
<div id="div_<?php echo $blockName; ?>" style="display:none ">
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
	<td bgcolor="#FFFFFF" align="left">
		<table width="220" align="left" id="<?php echo $blockName; ?>" name="<?php echo $blockName; ?>">
			<tr>
				<td align="left">
				<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin:0px; padding:0px; ">
					<textarea name="notesInput" id="notesInput" cols="22" rows="5"><?php echo $notesOutput; ?></textarea>
					<br><input name="notesSave" id="notesSave" value="save" type="submit">
				</form>
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