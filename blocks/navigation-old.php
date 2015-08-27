
<?php 



// site-wide
$short_name = "site-wide";
$nav_role_id = getRoleIdByShortName($short_name);

if ( isUserExistInRole($nav_role_id,$_SESSION['user_id']) ) {
	$navigation_count++;
?>
<table width="236"  border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
  <tr bgcolor="#999999">
    <td bgcolor="#CCCCCC" ><span class="navigationTitle">ADMINISTRATOR </span></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/user.php">User and Group Management</a></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/role.php">Roles Management</a></td>
  </tr> 
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/task.php">Task Management</a></td>
  </tr> 
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/sys-portal.php">Portal Management</a></td>
  </tr>   

</table>

<?php
}

// manager
$short_name = "manager";
$nav_role_id = getRoleIdByShortName($short_name);
if ( isUserExistInRole($nav_role_id,$_SESSION['user_id']) ) {
	$navigation_count++;
?>
<table width="236"  border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
  <tr bgcolor="#999999">
    <td bgcolor="#CCCCCC" ><span class="navigationTitle">MANAGER</span></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/journal-add.php">Journal Management</a></td>
  </tr> 
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/journal-editor-add.php">Editor Management</a></td>
  </tr>    
</table>  

<?php

}

// editor
$short_name = "editor";
$nav_role_id = getRoleIdByShortName($short_name);
if ( isUserExistInRole($nav_role_id,$_SESSION['user_id']) ) {
	if ( isEditorExist($_SESSION['journal_id'],$_SESSION['user_id']) ) {
		$navigation_count++;
?>
<table width="236"  border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
  <tr bgcolor="#999999">
    <td bgcolor="#CCCCCC"><span class="navigationTitle">EDITOR</span></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/journal-select.php">Summary</a></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/journal-edit.php">Edit Journal </a></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/manual-article-upload.php">Manual Article Upload</a></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/editor-view-article-list.php">Article Management </a></td>
  </tr>  
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/editor-reviewer-add.php">Reviewer Management</a></td>
  </tr>  
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/category-manager.php?type=articles">Category Management</a></td>
  </tr>  
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/eg-edit.php">Editorial Group Management</a></td>
  </tr>  
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/sr-edit.php">Submission Rules Management</a></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/volume-add.php">Volumes &amp; Issues Management</a></td>
  </tr>
  <tr>
    <td class="bg">&#8226; User Subscription Management</td>
  </tr>
  <tr>
    <td class="bg">&#8226; Enterprise Subscription Management</td>
  </tr> 
  <tr>
    <td class="bg">&#8226; Statistics</td>
  </tr>           
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/content.php">Web Content</a></td>
  </tr>           
</table>

<?php
	}
}

// reviewer
$short_name = "reviewer";
$nav_role_id = getRoleIdByShortName($short_name);
if ( isUserExistInRole($nav_role_id,$_SESSION['user_id']) ) {
	 if ( isReviewerExist($_SESSION['journal_id'],$_SESSION['user_id']) ) {
	 	$navigation_count++;
?>
<table width="236"  border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
  <tr bgcolor="#999999">
    <td bgcolor="#CCCCCC"><span class="navigationTitle">REVIEWER</span></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/reviewer-list-article.php">Review Management</a></td>
  </tr>     
</table>

<?php
	}
}

// author
$short_name = "author";
$nav_role_id = getRoleIdByShortName($short_name);
if ( isUserExistInRole($nav_role_id,$_SESSION['user_id']) ) {
	if ( checkUserCreatesArticle($_SESSION['journal_id'],$_SESSION['user_id']) ) {
		$navigation_count++;
?>
<table width="236"  border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
  <tr bgcolor="#999999">
    <td bgcolor="#CCCCCC"><span class="navigationTitle">AUTHOR</span></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/article-add.php">Article Management</a></td>
  </tr>     
</table>
<?php
	}
}

?>
<table width="236"  border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
  <tr bgcolor="#999999">
    <td bgcolor="#CCCCCC"><span class="navigationTitle">OTHERS</span></td>
  </tr>
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/message.php">Message Center</a></td>
  </tr> 
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/quicklinks.php">Quicklinks Manager</a></td>
  </tr> 
  <tr>
    <td class="bg">&#8226; <a style="text-decoration:none; " href="<?php echo $APP_URL; ?>/portlet-manager.php">Portlet Manager</a></td>
  </tr>      
</table> 
