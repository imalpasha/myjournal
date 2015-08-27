<?php
include_once 'config.php';

// set page properties
$pageGroup = "backend";

// check session
include_once 'include/session.checker.php';
$user_id = $_SESSION["user_id"]; 
$username = $_SESSION["username"];
$group = $_SESSION["group"];

include_once 'include/db.start.php';
include_once 'include/SimilarAuthorMapModel.php';
include_once 'include/SqlPaginator.php';
include_once 'include/authors.php';
include_once 'include/articles.php';
include_once 'include/journals.php';

$author_id = isset($_GET['id']) ? $_GET['id'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 20;

$cur_group_id = SimilarAuthorMapModel::getUniqueAuthorIdByAuthorId($author_id);

// Pagination
$offset = ($page - 1) * $limit;
if (is_null($search) || trim($search) == '') {
  $total_records = SimilarAuthorMapModel::getUniqueAuthorIdCount();
  $uniq_author_ids = SimilarAuthorMapModel::getUniqueAuthorIdsExcept($limit, $offset, $cur_group_id);
} else {
  $total_records = SimilarAuthorMapModel::getUniqueAuthorIdCountByAuthorName($search);
  $uniq_author_ids = SimilarAuthorMapModel::findByAuthorNameExcept($search, $limit, $offset, $cur_group_id);
}

if ($cur_group_id) --$total_records;

$paginator = new SqlPaginator($page, $limit, $total_records);
$paginator_params = array(
  'search' => $search,
	'id' => $author_id
);
$paginator->setGetParameters($paginator_params);
$pagination = $paginator->getPagination();

$author_name = get_author_name_by_id($author_id);
$article_id = get_article_id_by_author($author_id);
$article_title = getArticleTitle($article_id);
$journal_id = get_journal_id_by_article($article_id);
$journal_name = getJournalName($journal_id);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Author Group</title>
	<link href="lib/style.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/admin_main.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/author_map_management.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
  <script type="text/javascript" language="javascript" src="js/jquery-1.6.2.min.js"></script>
  <script type="text/javascript" language="javascript" src="js/jquery.colorbox-min.js"></script>
  <script type="text/javascript" language="javascript" src="js/author_group_picker.js"></script>
</head>
<body>
	<div id="innerBody">
		<div class="adminContent authorMap">
			<div class="searchBar">
				<form action="#" method="get">
          <a href="author_group_picker.php?id=<?php echo $author_id ?>">All</a>
          <span>|</span>
					<label for="search">Author group search:</label>
          <input type="text" name="search" value="<?php echo $search ?>" />
          <input type="hidden" name="id" value="<?php echo $author_id ?>" />
					<input type="submit" name="submit" value="Search" />
				</form>
				<hr />  
			</div>
			<div class="info">
				<p>Move <em><?php echo $author_name ?></em>, the author of <em><?php echo $article_title ?></em>, of <em><?php echo $journal_name ?></em> into any of the following author groups:</p>
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
              <th width="100%">Author names</th>
              <th></th>
              <th class="action">Actions</th>
            </tr>  
            <?php while ($uniq_author_id = mysql_fetch_array($uniq_author_ids)): ?>
              <?php
              $uniq_id = $uniq_author_id['unique_id'];
              $authors = SimilarAuthorMapModel::getAuthorsByUniqueIdGroupByName($uniq_id, 4);
              ?>
              <tr class="<?php echo ++$count % 2 == 0 ? 'even' : 'odd' ?>">
                <td class="rightPadded">
                  <?php echo $uniq_id ?>
                </td>
                <td>
                  <ul class='separatedItem'>
                    <?php while ($author = mysql_fetch_array($authors)): ?>
                      <li><?php echo $author['author_name'] ?></li>
                    <?php endwhile; ?>
                  </ul>
                </td>
                <td><a href="#" onclick="getGroupDetails(<?php echo $uniq_id ?>); return false">Details</a></td>
                <td><input onclick="window.opener.submitMoveAuthor(<?php echo $author_id ?>, <?php echo $uniq_id ?>); self.close();" type="button" value="Move into this group" /></td>
              </tr>
            <?php endwhile; ?>
          </table>
					<div class="pagination"><?php echo $pagination ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
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
