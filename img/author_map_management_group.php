<?php

// read system configuration
include("config.php");
include("include/CountryModel.php");

// set page properties
$pageGroup = "backend";

// check session
include("include/session.checker.php");
$user_id = $_SESSION["user_id"]; 
$username = $_SESSION["username"];
$group = $_SESSION["group"];

// call helper functions
include("include/helper.functions.php");

// instantiate db
include("include/db.start.php");

// call user functions
include("include/users.php");
include("include/roles.php");
include("include/blocks.php");
include("include/portals.php");
include("include/journals.php");
include("include/date.php");
include("include/articles.php");
include('include/authors.php');
include('include/categories.php');
include("include/editors.php");
include("include/editorial-group.php");
include("include/reviewers.php");
include("include/FCKeditor/fckeditor.php");
include("include/ipt.php");
include("include/SqlPaginator.php");
include("include/CharPaginator.php");
include_once 'include/SimilarAuthorMapModel.php';

// call portal components
// include('portal.php');

$unique_id = isset($_GET['id']) ? $_GET['id'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 20;

$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action) {
  $action_group_id = $_GET['group_id'];
  $action_author_id = $_GET['author_id'];

  $action_author_name = get_author_name($action_author_id);
  $action_article_title = SimilarAuthorMapModel::getArticleTitleByAuthor($action_author_id);
  if (trim($action_article_title) == '') $action_article_title = '{article title unavailable}';

  $sub_msg = "$action_author_name, the author of <em>$action_article_title</em>";

  if ($action == 'move') {
    if (SimilarAuthorMapModel::moveAuthorToGroup($action_author_id, $action_group_id, $unique_id)) {
      $msg = "Successfully moving $sub_msg into 
              <a href=\"author_map_management_group.php?id=$action_group_id\">$action_group_id</a>";
      $unique_id = $action_group_id;
    } else {
      $msg = "Error moving $sub_msg into 
              <a href=\"author_map_management_group.php?id=$action_group_id\">$action_group_id</a>";
    }
  } else if ($action == 'new') {
    if ($new_group_id = SimilarAuthorMapModel::addAuthorToNewGroup($action_author_id, $unique_id)) {
      $msg = "Successfully moving $sub_msg into 
              <a href=\"author_map_management_group.php?id=$new_group_id\">$new_group_id</a>";
    } else {
      $msg = "Error moving $sub_msg into a new group";
    }
  } else if ($action == 'remove') {
      $msg = "Successfully removing $sub_msg from author group: $unique_id";
    if (SimilarAuthorMapModel::deleteAuthorFromGroup($action_author_id, $unique_id)) {
    } else {
      $msg = "Error removing $sub_msg from author group: $unique_id";
    }
  }
}

// Pagination
$offset = ($page - 1) * $limit;
if (SimilarAuthorMapModel::isUniqueAuthorIdExists($unique_id)) {
  $total_records = SimilarAuthorMapModel::getAuthorCountByUniqueId($unique_id);
  $authors = SimilarAuthorMapModel::getLimitedAuthorsByUniqueId($unique_id, $limit, $offset);
} 

$paginator = new SqlPaginator($page, $limit, $total_records);
$paginator->setGetParameters(array('id' => $unique_id));
$pagination = $paginator->getPagination();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>e-publication universiti malaya</title>
<link href="css/admin_main.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/author_map_management.css" rel="stylesheet" type="text/css" media="screen" />
<link href="lib/style.css" rel="stylesheet" type="text/css" media="screen" />
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript">
        function onClickMoveAuthor(a) {
                var authorId = $(a).attr('value');
                var groupPickerDialog = window.open("author_group_picker.php?id=" + authorId, "Author_Group", "scrollbars=1,resizable=0,width=650,height=500");
        }

  function submitMoveAuthor(author_id, group_id) {
    <?php // alert('author_id:' + author_id + ' group_id:' + group_id); ?>
    window.location.href = 'author_map_management_group.php?id=<?php echo $unique_id ?>&group_id=' + group_id + '&author_id=' + author_id + '&action=move';
  }
</script>
</head>
<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0">
<?php include("blocks/main-menu-be.php"); ?>
<?php include "header.php"; ?>
<table width="979" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <table width="980" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="219" rowspan="3" valign="top"><?php include("blocks/menu.php"); ?> </td>
          <td width="750" height="25" colspan="2">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
              <td><div align="left" class="breadcrumb"><a href="admin.php">Home</a> &gt; <a href="author_map_management.php">Author Groups Management</a> &gt; Author Group <?php echo $unique_id ?></div></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td valign="top">
            <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="30" background="images/tajukpanjang750.png"><span class="fontWhiteBold">Author Group <?php echo $unique_id ?></span>
              </tr>
              <tr>
                <td>
                  <table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <div align="left"><span class="title"></span></div>
                        <div class="adminContent authorMap">
                          <div class="notice" <?php if ($msg): ?>style="display: block"<?php endif; ?>>
                            <?php echo $msg ?>
                          </div>
                          <div class="info">
                            <h3>Author Group ID: <?php echo $unique_id ?></h3>
                            <ul class="action">
                              <li><a href="author_map_management_group_move.php?id=<?php echo $unique_id ?>">Merge this author group into another group</a></li>
                              <? /*
                              <li><a href="author_map_management_group_add.php?author=<?php echo $unique_id ?>">Add an author to this group</a></li>
                              */ ?>
                            </ul>
                            <hr />  
                          </div>
                          <div class="resultList">
                            <?php if (!$authors): ?>
                              <p>No result</p>
                            <?php else: ?>
                              <?php echo $pagination ?>
                              <table class="resultList">
                                <?php $count = $offset; ?>
                                <tr>
                                  <th style="width: 80px">Author</th>
                                  <th style="width: 150px">Affiliation</th>
                                  <th>Article</th>
                                  <th class="action" colspan="3">Actions</th>
                                </tr>  
                                <?php while ($author = mysql_fetch_array($authors)): ?>
                                  <?php
                                  $author_id = $author['author_id'];
                                  $author_name = $author['author_name'];
                                  $author_ipt_id = $author['author_ipt_id'];
                                  $ipt = getIpt($author_ipt_id);
                                  $article_title = SimilarAuthorMapModel::getArticleTitleByAuthor($author_id);
                                  ?>
                                  <tr class="<?php echo ++$count % 2 == 0 ? 'even' : 'odd' ?>">
                                    <td><?php echo $author_name ?></td>
                                    <td><?php echo $ipt['nama_ipt'] ?></td>
                                    <td><?php echo htmlentities($article_title) ?></td>
                                    <td class="action">
                                      <a title="Move the author into a new group" href="author_map_management_group.php?id=<?php echo $unique_id ?>&author_id=<?php echo $author_id ?>&action=new">New group</a>
                                    </td>
                                    <td class="action">
                                      <a href="#" title="Move the author into another group" onclick="onClickMoveAuthor(this); return false;" value="<?php echo $author_id ?>">Move</a>
                                    </td>
                                    <td class="action">
                                      <a title="Unassociate the author with the current group" href="author_map_management_group.php?id=<?php echo $unique_id ?>&author_id=<?php echo $author_id ?>&action=remove">Remove</a>
                                    </td>
                                  </tr>
                                <?php endwhile; ?>
                              </table>
                              <?php echo $pagination ?>
                            <?php endif; ?>
                          </div>
                          <?php /*
                          <div class="resultList">
                            <?php $similar_groups = SimilarAuthorMapModel::getSimilarGroups($unique_id, 10) ?>
                            <?php if ($similar_groups): ?>
                              <p>The following groups might be similar to <em>Group <?php echo $unique_id ?></em>:</p>
                              <table id="similarGroups" class="resultList">
                                <tr>
                                  <th class="groupId">Group ID</th>
                                  <th>Author names</th>
                                  <th class="affiliation">Affiliation</th>
                                  <th class="detail"></th>
                                  <th class="action"></th>
                                </th>
                                <?php while ($similar_group = mysql_fetch_array($similar_groups)): ?>
                                  <?php
                                  $similar_group_id = $similar_group['unique_id'];
                                  $similar_authors = SimilarAuthorMapModel::getAuthorsByUniqueIdGroupByName($similar_group_id, 5);
                                  $affils = SimilarAuthorMapModel::getAffiliationsByUniqueId($similar_group_id, 5);
                                  ?>
                                  <tr class="<?php echo ++$count % 2 == 0 ? 'even' : 'odd' ?>">
                                    <td class="rightPadded">
                                      <a title="Edit group <?php $similar_group_id ?>" href="author_map_management_group.php?id=<?php echo $similar_group_id ?>"><?php echo $similar_group_id ?></a>
                                    </td>
                                    <td>
                                      <ul class='separatedItem'>
                                        <?php $tempCount = 0 ?>
                                        <?php while ($author = mysql_fetch_array($similar_authors)): ?>
                                          <li><?php echo $author['author_name'] ?></li>
                                        <?php endwhile; ?>
                                      </ul>
                                    </td>
                                    <td>
                                      <ul class='separatedItem'>
                                      <?php $tempCount = 0 ?>
                                      <?php while ($affil = mysql_fetch_array($affils)): ?>
                                        <?php if (++$tempCount == 5) break ?>
                                        <li><?php echo $affil['affil_name'] ?></li>
                                      <?php endwhile; ?>
                                      <?php if ($tempCount == 5): ?><li class="more">More ...</li><?php endif; ?>
                                      </ul>
                                    </td>
                                    <td><a title="See the details of the authors associated with group <?php echo $uniq_id ?>" href="#" onclick="getGroupDetails(<?php echo $similar_group_id ?>); return false">Details</a></td>
                                    <td><input onclick="mergeGroupInto(<?php echo $unique_id ?>, <?php echo $similar_group_id ?>)" type="button" value="Merge" title="Merge group <?php echo $unique_id ?> into group <?php echo $similar_group_id ?>" /></td>
                                  </tr>
                                <?php endwhile; ?>
                              </table>
                            <?php endif; ?>
                          </div>
                          */ ?>
                        </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
          <td width="1">
          </td>
        </tr>
      </table>
<!-- start of wrapper -->
    </td>
  </tr>
</table>
<?php include "footer.php"; ?>
<!-- end of wrapper -->
</body>
</html>
