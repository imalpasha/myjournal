<?php 
// set block info 
$blockName = "shortMessage"; 
$blockTitle = "My Message Centre"; 
?>
<div id="div_<?php echo $blockName; ?>" style="display:none ">
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
  <tr>
	<td bgcolor="#CCCCCC" height="15">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" background="<?php echo $APP_URL; ?>/img/portlet-bg.jpg">
  			<tr>
			  <td valign="middle"><span class="blockTitle"><?php echo $blockTitle; ?></span></td>
			  <td height="15" align="right">

					<img id="min<?php echo $blockName; ?>" name="min<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/minimize.jpg" width="15" height="15" align="middle" onClick="showLayer('<?php echo $blockName; ?>');"  onMouseOver="this.style.cursor='pointer'"><img id="max<?php echo $blockName; ?>" name="max<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/maximize.jpg" width="15" height="15" align="middle" onClick="showLayer('<?php echo $blockName; ?>');" style="display:none; "  onMouseOver="this.style.cursor='pointer'">

	          </td>
			</tr>
		</table>	
	</td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF">
		<table width="220" align="center" id="<?php echo $blockName; ?>" name="<?php echo $blockName; ?>">
			<tr>
				<td align="center">
					&#8226; You have <a href="#">1 new message(s)</a>.<br>
				</td>
			</tr>
		</table>			
	</td>
  </tr>
</table>
</div>