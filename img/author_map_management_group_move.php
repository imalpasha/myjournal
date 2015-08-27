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
$groupTo = isset($_GET['groupTo']) ? $_GET['groupTo'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$action = isset($_GET['action']) ? $_GET['action'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;

$limit = 20;

// Pagination
$offset = ($page - 1) * $limit;

if ($action) {
  if ($action == 'merge') {
    if (SimilarAuthorMapModel::moveGroupInto($unique_id, $groupTo)) {
      $msg = "Successfully moving author group $unique_id into author group $groupTo";
      $unique_id = $groupTo;
    } else {
      $msg = "Error moving author group $unique_id into author group $groupTo";
    }
  }
}

if (is_null($search)) {
  $total_records = SimilarAuthorMapModel::getUniqueAuthorIdCount() - 1;
  $uniq_author_ids = SimilarAuthorMapModel::getUniqueAuthorIdsExcept($limit, $offset, $unique_id);
} else {
  $total_records = SimilarAuthorMapModel::getUniqueAuthorIdCountByAuthorName($search) - 1;
  $uniq_author_ids = SimilarAuthorMapModel::findByAuthorNameExcept($search, $limit, $offset, $unique_id);
}

$paginator = new SqlPaginator($page, $limit, $total_records);
$paginator_params = array(
  'id' => $unique_id,
  'search' => $search
);
$paginator->setGetParameters($paginator_params);
$pagination = $paginator->getPagination();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>e-publication universiti malaya</title>
<script type="text/javascript" language="javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" language="javascript" src="js/author_group_picker.js"></script>
<link href="css/admin_main.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/author_map_management.css" rel="stylesheet" type="text/css" media="screen" />
<link href="lib/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript">
function mergeGroupInto(groupFrom, groupTo) {
  window.location.href = 'author_map_management_group_move.php?id=' + groupFrom + '&groupTo=' + groupTo + '&action=merge';
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
                            <h3>Author Group ID: <?php echo $unique_id ?> <a title="Edit this group" href="author_map_management_group.php?id=<?php echo $unique_id ?>">[Edit]</a></h3>
                            <ul>
                              <?php $preview_authors = SimilarAuthorMapModel::getLimitedAuthorsByUniqueIdGroupByName($unique_id, 5, 0) ?>
                              <?php $preview_count = 0 ?>
                              <?php while ($preview_author = mysql_fetch_array($preview_authors)): ?>
                                <?php $preview_count++ ?>
                                <?php if ($preview_count == 5): ?>
                                  <li>...</li>
                                  <?php break; ?>
                                <?php endif; ?>
                                <li><?php echo $preview_author['author_name'] ?></li>
                              <?php endwhile; ?>
                            </ul>
                            <p><a href="#" onclick="getGroupDetails(<?php echo $unique_id ?>); return false">View details</a></p>
                            <p>Merge this group, into any of the following groups:</p>
                          </div>
                          <div class="searchBar">
                            <hr />  
                            <form action="author_map_management_group_move.php" method="get">
                              <a href="author_map_management_group_move.php?id=<?php echo $unique_id ?>">All</a>
                              <span>|</span>
                              <label for="search">Author group search:</label>
                              <input type="text" name="search" value="<?php echo $search ?>" />
                              <input type="hidden" name="id" value="<?php echo $unique_id ?>" />
                              <input type="submit" name="submit" value="Search" />
                            </form>
                            <hr />  
                          </div>
                          <div class="resultList">
                            <?php if (!$uniq_author_ids): ?>
                              <p>No result</p>
                            <?php else: ?>
                              <div class="pagination"><?php echo $pagination ?></div>
                              <table class="resultList">
                                <?php $count = $offset; ?>
                                <tr>
                                  <th class="groupId">Group ID</th>
                                  <th>Author names</th>
                                  <th class="affiliation">Affiliation</th>
                                  <th class="detail"></th>
                                  <th class="action"></th>
                                </tr>  
                                <?php while ($row_uniq_author_id = mysql_fetch_array($uniq_author_ids)): ?>
                                  <?php
                                  $row_uniq_id = $row_uniq_author_id['unique_id'];
                                  $authors = SimilarAuthorMapModel::getAuthorsByUniqueIdGroupByName($row_uniq_id, 4);
                                  $affils = SimilarAuthorMapModel::getAffiliationsByUniqueId($row_uniq_id, 5);
                                  ?>
                                  <tr class="<?php echo ++$count % 2 == 0 ? 'even' : 'odd' ?>">
                                    <td class="rightPadded">
                                      <a title="Edit group <?php $row_uniq_id ?>" href="author_map_management_group.php?id=<?php echo $row_uniq_id ?>"><?php echo $row_uniq_id ?></a>
                                    </td>
                                    <td>
                                      <ul class='separatedItem'>
                                        <?php $tempCount = 0 ?>
                                        <?php while ($author = mysql_fetch_array($authors)): ?>
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
                                    <td><a title="See the details of the authors associated with group <?php echo $uniq_id ?>" href="#" onclick="getGroupDetails(<?php echo $row_uniq_id ?>); return false">Details</a></td>
                                    <td><input onclick="mergeGroupInto(<?php echo $unique_id ?>, <?php echo $row_uniq_id ?>)" type="button" value="Merge" title="Merge group <?php echo $unique_id ?> into group <?php echo $row_uniq_id ?>" /></td>
                                  </tr>
                                <?php endwhile; ?>
                              </table>
                              <div class="pagination"><?php echo $pagination ?></div>
                            <?php endif; ?>
                          </div>
                          <div class="resultList">
                            <p>These ungrouped authors may belong to this group</p>
                          </div>
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
	<div class="loadingDialog" style="display: none">
    <h1>Loading...</h1>
  </div>
  <div id="groupDetailDialog" style="display: none">
    <div class="close"><a href="#" class="close">Close [X]</a></div>
    <div class="groupDetailDialogInner">
      <div class="pagination dialogPagination"></div>
      <div class="clear"></div>
      <table class="authorList">
        <thead>
          <tr>
            <th width="80px">Author</th>
            <th>Article</th>
            <th width="120px">Journal</th>
            <th width="120px">Affiliation</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div class="pagination dialogPagination"></div>
      <div class="clear"></div>
    </div>
  </div>
</body>
</html>
