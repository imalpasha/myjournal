<?php 

// set block info
$blockName = "login";
$blockTitle = "Login Information"; 

// get full name
$l_fullname = getName($_SESSION['user_id']);
$sel_journal = $_SESSION['id_journal_luar'];
$sel_name=getJournalName($sel_journal); 

?>

	  <div id="<?php echo $blockName; ?>">		
      <table>
	  <tr >
		  <td><?php	
			
			// get passed login error msg
			$msg = @$_GET["msg"]; 
				
			// set redirect page
			$redirect_page=curPageURL(); 
			if ( $username == "" && $cas_enable) { 
			if ( ereg("index.php",$redirect_page) ) {
				$redirect_page=$_SERVER['PHP_SELF'];
			}
			?>
      
                <form name="form" method="post" action="<?php echo $APP_URL; ?>/admin.php" name="casLoginForm" style="margin-bottom:0;" >
                  <div class="warning"> <br />
                      <?php if ( $msg != "" ) { echo $msg; echo "<br><br>"; } ?>
                  </div>

                  <span class="feInstruction">		
				  	<br />			
                    <input type="submit" name="submit" value="Login" />
                    <br />
             		<br />
      				If you are not a UM staff, click here to <a href="newregister.php">register</a>.<br><br>Please download the  guidelines <a href="../public/umrefjournal guideline.pdf" target="_blank">here</a>.</span>
                </form>
              <?php	

	      } else if ( $username == "" && !$cas_enable) {

	      ?> 

                <form name="form" method="post" action="<?php echo $APP_URL; ?>/login.php" style="margin-bottom:0;" >
                  <?php if ( $msg == "" ) { ?>
				  <div align="left">
			      <b><?php echo $sel_name; ?></b><br /><br /><span class="feInstruction">Enter your username and password</span></div>		
				  <?php } ?>
                  <div class="warning"><br />
                      <?php if ( $msg != "" ) { echo $msg; echo "<br><br>"; } ?>
                  </div>
                  <TABLE border="0" cellPadding="0" cellSpacing="0" class="feInstruction">
                    <TBODY>
                      <TR>
                        <TD>Username
                            <input id="username" name="username">                        </TD>
                      </TR>
                      <TR>
                        <TD>Password
                            <input id="password" type="password" value="" name="password"></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                  <span class="feInstruction">		
				  	<br />			
				  	<input type="hidden" name="redirect_page" value="<?php echo $redirect_page; ?>" />
                    <input type="submit" name="submit" value="submit" />
                    <input type="reset" name="Reset" value="reset" />
                    <br />
             		<br />
      				If you are not a member, click here to <a href="newregister.php">register</a>.</span>
                </form>

	      <?php
			} else {
			?>
              <form name="form" method="post" action="<?php echo $APP_URL; ?>/logout.php" style="margin-bottom:0;">
                <div align="left">
                  <span class="feInstruction">You are now logged in as </span><br /><br /><span class="feInstructionBigWhite"><?php echo $l_fullname; ?> ( <?php echo $username; ?> )</span> <span class="feInstruction"> <br />
                  <br />

                  <?php if ( $group != "subscriber" && $pageGroup != "backend" ) { ?>
				  &#8226; Go to <a href="<?php echo $APP_URL; ?>/admin.php">admin page</a>.<br>
				  <?php } ?>				   
                  <br>
				  <?php if ( $group != "subscriber" && $pageGroup != "backend" ) { ?>
                  If you have finished using the system, please click on logout button below.</span> </div>
				  <p align="justify" class="feInstruction">
					<input type="hidden" name="redirect_page" value="<?php echo $redirect_page; ?>" />
					<input type="submit" name="submit" value="logout" />
					<br />
				  </p>
				  <?php } ?>
    </form>
    <?php	
} 
?>			</td>
  		</tr>
    </table>
</div>

