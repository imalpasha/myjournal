<?php
include ('classification/classes/Journal.php');
include ('include/admin-header.php');

$journal = new Journal();
$journal->editJournal();


include ('include/admin-footer.php');
