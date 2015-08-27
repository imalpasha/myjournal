<?php
include_once 'config.php';
include_once 'db.start.php';
include_once 'include/SimilarAuthorMapModel.php';

$action = $_GET['action'];
$author_id = $_GET['author_id'];
$group_id = $_GET['group_id'];

if (is_null($action)) die('An error has occured. Please try again');

$close_window = false;

if ($action == 'move') {
  if (SimilarAuthorMapModel::moveAuthorToGroup($author_id, $group_id)) {
    $close_window = true;
  } else {
    $msg = 'An error has occured. Please try again';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript">
    <?php if ($close_window): ?>
      self.close();
    <?php endif; ?>
  </script>
</head>
</html>
