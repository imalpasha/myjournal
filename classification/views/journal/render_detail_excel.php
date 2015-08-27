<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition:attachment;filename="Journal_List_Classification.xls"');
header('Cache-Control: max-age=0');

/** Include path **/
require_once 'CSV/Classes/PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'CSV/Classes/PHPExcel/Writer/Excel5.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("UM");
$objPHPExcel->getProperties()->setTitle("e-PUBLICATION UM");
$objPHPExcel->getProperties()->setSubject("Journal List With Classification");

$i = 11;
$O = 12;
$index = 0;
$i++;

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:C2');

$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'Journal Detail');
$objPHPExcel->getActiveSheet()->getStyle("B2:B2")->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Title:');
$objPHPExcel->getActiveSheet()->SetCellValue('B5', 'Dicipline:');
$objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Author:');
$objPHPExcel->getActiveSheet()->SetCellValue('B7', 'Year Evaluate:');
$objPHPExcel->getActiveSheet()->SetCellValue('B8', 'Form:');
$objPHPExcel->getActiveSheet()->SetCellValue('B9', 'Score:');
$objPHPExcel->getActiveSheet()->SetCellValue('B10', 'Level:');

$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Title');
$objPHPExcel->getActiveSheet()->SetCellValue('C5', 'Dicipline');
$objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Author');
$objPHPExcel->getActiveSheet()->SetCellValue('C7', 'Year Evaluate');
$objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Form');
$objPHPExcel->getActiveSheet()->SetCellValue('C9', 'Score');
$objPHPExcel->getActiveSheet()->SetCellValue('C10', 'Level');



$objPHPExcel->getActiveSheet()->SetCellValue('B12', 'Criteria');
$objPHPExcel->getActiveSheet()->SetCellValue('C12', 'Score');
$objPHPExcel->getActiveSheet()->SetCellValue('D12', 'Remarks');

$i++;
for($x = 1 ; $x < 10 ; $x++){
	$i++;

	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, "CRITERIA");
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, "SCORE");
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, "REMARKS");
}


$objPHPExcel->getActiveSheet()->getStyle("B12:D12")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("B4:B10")->getFont()->setBold(true);



/*csv border style*/
$styleArray = array(
   'borders' => array(
     'allborders' => array(
       'style' => PHPExcel_Style_Border::BORDER_THIN
     )
   )
);

foreach(range('B','E') as $columnID) {
$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
         ->setAutoSize(true);
}

$objPHPExcel->getActiveSheet()->getStyle("B$O:D".$i)->applyFromArray($styleArray);
unset($styleArray);

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);

$objWriter->save('php://output');


?>
