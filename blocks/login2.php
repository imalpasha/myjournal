<?php 

// set block info
$blockName = "login";
$blockTitle = "Login Information"; 

// get full name
$l_fullname = getName($_SESSION['user_id']);

?>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr valign="top">
  	<td >
		<table width="100%" border="0" cellpadding="0" cellspacing="0" background="<?php echo $APP_URL; ?>/img/portlet-bg.jpg">
  			<tr >
			  <td valign="middle"><span class="blockTitle"><?php echo $blockTitle; ?></span></td>
			  <td height="15">
			  <?php if ( $pageGroup == "backend" ) { ?>
			  	<div align="right">
					<img id="min<?php echo $blockName; ?>" name="min<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/minimize.jpg" width="15" height="15" align="middle" onClick="showLayer('<?php echo $blockName; ?>');"><img id="max<?php echo $blockName; ?>" name="max<?php echo $blockName; ?>" src="<?php echo $APP_URL; ?>/img/maximize.jpg" width="15" height="15" align="middle" onClick="showLayer('<?php echo $blockName; ?>');" style="display:none; ">
				</div>
			  <?php } ?>
	          </td>
			</tr>
		</table>
	</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td  colspan="2" >
	  <div id="<?php echo $blockName; ?>">		
      <table width="220" align="center" >
	  <tr >
		  <td><?php	
			
			// get passed login error msg
			$msg = $_GET["msg"]; 
				
			// set redirect page
			$redirect_page=curPageURL(); 
			if ( $username == "" ) { 
			if ( ereg("index.php",$redirect_page) ) {
				$redirect_page=$_SERVER['PHP_SELF'];
			}
			?>
                <form name="form" method="post" action="login.php">
                  <div align="left"><br />
                      <span class="titleBold">Welcome to UM E-Publication System</span><span class="instructions"> <br>
                      <br>
                    University of Malaya, please enter your username and password to access the system.</span> </div>
                  <div class="message"> <br />
                      <?php if ( $msg != "" ) { echo $msg; echo "<br><br>"; } ?>
                  </div>
                  <table width="219" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="65" class="content">Username </td>
                      <td width="154" class="content"><input type="text" name="username" id="username" />
                      </td>
                    </tr>
                    <tr>
                      <td height="29" class="content">Password</td>
                      <td class="content"><input type="password" name="password" id="password" />
                      </td>
                    </tr>
                  </table>
                  <p align="left" class="content">
                    <input type="hidden" name="redirect_page" value="<?php echo $redirect_page; ?>" />
                    <input type="submit" name="submit" value="submit" />
                    <input type="reset" name="Reset" value="reset" />
                    <br />
                    <br />
      If you are not a member, click here to <a href="fe-subscribe-now.php">register</a>.</p>
              </form>
              <?php	
			} else {
			?>
              <form name="form" method="post" action="logout.php">
                <div align="left"><br />
                  <span class="instructions">You are now logged in as </span><span class="titleBold"><?php echo $l_fullname; ?> ( <?php echo $username; ?> ) </span><span class="instructions"> <br />
                  <br />

                  <?php if ( $group != "subscriber" && $pageGroup != "backend" ) { ?>
				  &#8226; Go to <a href="admin.php">admin page</a>.<br>
				  <?php } ?>				   
                  <br>
				  <?php if ( $group != "subscriber" && $pageGroup != "backend" ) { ?>
                  If you have finished using the system, please click on logout button below.</span> </div>
				  <p align="justify" class="content">
					<input type="hidden" name="redirect_page" value="<?php echo $redirect_page; ?>" />
					<input type="submit" name="submit" value="logout" />
					<br />
				  </p>
				  <?php } ?>
    </form>
    <?php	
} 
?> 

			</td>
  		</tr>
    </table>
	</div>
	</td>
  </tr>
</table>
