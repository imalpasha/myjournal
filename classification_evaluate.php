<?php
include ('classification/classes/Journal.php');
include ('include/admin-header.php');

$journal = new Journal();
if ($_GET['e']) {
    $journal->editEvaluateAction();
}
else {
    $journal->evaluateAction();
}



include ('include/admin-footer.php');
