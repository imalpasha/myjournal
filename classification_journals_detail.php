<?php
include ('classification/classes/Journal.php');
include ('include/admin-header.php');

$journal = new Journal();
$journal->detailJournal();


include ('include/admin-footer.php');
