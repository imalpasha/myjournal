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

$search = isset($_GET['search']) ? $_GET['search'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 20;

// Pagination
$offset = ($page - 1) * $limit;
if (is_null($search)) {
  $total_records = SimilarAuthorMapModel::getUngroupedAuthorCount();
  $author_ids = SimilarAuthorMapModel::getUngroupedAuthors($limit, $offset);
} else {
  $total_records = SimilarAuthorMapModel::getUngroupedAuthorCountByAuthorName($search);
  $author_ids = SimilarAuthorMapModel::getUngroupedAuthorsByAuthorName($search, $limit, $offset);
}

$paginator = new SqlPaginator($page, $limit, $total_records);
$paginator_params = array(
  'search' => $search,
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
                <td><div align="left" class="breadcrumb"><a href="admin.php">Home</a> &gt; Author Groups Management </div></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td valign="top">
            <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="30" background="images/tajukpanjang750.png"><span class="fontWhiteBold">Author Groups List</span>
              </tr>
              <tr>
                <td>
                  <table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <div align="left"><span class="title"></span></div>
                        <div class="adminContent authorMap">
                          <div class="searchBar">
                            <form action="#" method="get">
                              <a href="author_map_management.php">All</a>
                              <span>|</span>
                              <label for="search">Author group search:</label>
                              <input type="text" name="search" />
                              <input type="submit" name="submit" value="Search" />
                            </form>
                            <div>
                              <a href="author_map_management_ungroup.php">View ungrouped authors</a>
                            </div>
                            <hr />  
                          </div>
                          <div class="resultList">
                            <?php if (!$author_ids): ?>
                              <p>No result</p>
                            <?php else: ?>
                              <div class="pagination"><?php echo $pagination ?></div>
                              <table class="resultList">
                                <?php $count = $offset; ?>
                                <tr>
                                  <th style="width: 4em">No</th>
                                  <th class="author">Author name</th>
                                  <th class="affil">Affiliation</th>
                                  <th class="action"></th>
                                </tr>  
                                <?php while ($row_author_id = mysql_fetch_array($author_ids)): ?>
                                  <?php
                                  $author_id = $row_author_id['author_id'];
                                  $author_name = $row_author_id['author_name'];
                                  $ipt_id = $row_author_id['ipt_id'];
                                  $article_id = get_article_id_by_author($author_id);
                                  $article_title = getArticleTitle($article_id);
                                  $ipt = getIpt($ipt_id);
                                  $affiliation = $ipt['nama_ipt'];
                                  ?>
                                  <tr class="<?php echo ++$count % 2 == 0 ? 'even' : 'odd' ?>">
                                    <td class="rightPadded"><?php echo $count ?></td>
                                    <td>
                                      <div class="tooltipable">
                                        <?php echo $author_name ?>
                                        <div class="tooltip" style="display: none"><?php echo $article_title ?></div>
                                      </div>
                                    </td>
                                    <td><?php echo $affiliation ?></td>
                                    <td>Move</td>
                                  </tr>
                                <?php endwhile; ?>
                              </table>
                              <div class="pagination"><?php echo $pagination ?></div>
                            <?php endif; ?>
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
