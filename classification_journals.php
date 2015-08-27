<?php
include ('classification/classes/Journal.php');
include ('include/admin-header.php');

$journal = new Journal();
$journal->indexAction();


include ('include/admin-footer.php');
