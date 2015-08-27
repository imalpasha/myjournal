<?php 
// set block info 
$blockName = "alerts"; 
$blockTitle = "Alerts"; 
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#666666">
  <tr>
	<td bgcolor="#CCCCCC" height="15">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
  			<tr >
			  <td bgcolor="#CCCCCC" valign="middle"><span class="blockTitle"><?php echo $blockTitle; ?></span></td>
			  <td height="15" bgcolor="#CCCCCC">
			  	<div align="right">
					<img id="min<?php echo $blockName; ?>" name="min<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/minimize.jpg" width="15" height="15" align="middle" onClick="showLayer('<?php echo $blockName; ?>');"><img id="max<?php echo $blockName; ?>" name="max<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/maximize.jpg" width="15" height="15" align="middle" onClick="showLayer('<?php echo $blockName; ?>');" style="display:none; ">
				</div>
	          </td>
			</tr>
		</table>	
	</td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF">
	  <div id="<?php echo $blockName; ?>">	
		<table width="220" align="center">
			<tr>
				<td>
				
				</td>
			</tr>
		</table>			
	  </div>
	</td>
  </tr>
</table>
