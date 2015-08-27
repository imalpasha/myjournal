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

foreach($forms as $form_): 
endforeach; 

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("UM");
$objPHPExcel->getProperties()->setTitle("e-PUBLICATION UM");
$objPHPExcel->getProperties()->setSubject("Journal List With Classification");

$i = 10;
$O = 9;
$index = 0;

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:C2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D9:G9');

$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'Journal With Classification');
$objPHPExcel->getActiveSheet()->getStyle("B2:B2")->getFont()->setBold(true);

/*FILTER FIELD*/

$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Year:');
$objPHPExcel->getActiveSheet()->SetCellValue('B5', 'Dicipline:');
$objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Form Category:');

$objPHPExcel->getActiveSheet()->SetCellValue('C4', $form_['name']);
$objPHPExcel->getActiveSheet()->SetCellValue('C5', 'Dicipline');
$objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Form Category');


$objPHPExcel->getActiveSheet()->SetCellValue('B9', 'No.');
$objPHPExcel->getActiveSheet()->SetCellValue('C9', 'Journal Title');
$objPHPExcel->getActiveSheet()->SetCellValue('D9', 'Score');

$objPHPExcel->getActiveSheet()->SetCellValue('D10', 'Wajib');
$objPHPExcel->getActiveSheet()->SetCellValue('E10', 'Optional');
$objPHPExcel->getActiveSheet()->SetCellValue('F10', 'Total');
$objPHPExcel->getActiveSheet()->SetCellValue('G10', '%');




foreach ($journals as $journal): 
	$i++;
	$index++;
	
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,$index);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $journal['name']);

	//$objPHPExcel->getActiveSheet()->getStyle("B".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

endforeach; 


$objPHPExcel->getActiveSheet()->getStyle("B10:G10")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("B9:G9")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("B4:B6")->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);



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

$objPHPExcel->getActiveSheet()->getStyle("D9:D9")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("D10:G10")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("B9:B$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

$objPHPExcel->getActiveSheet()->getStyle("B$O:G".$i)->applyFromArray($styleArray);
unset($styleArray);

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', __FILE__));

$objWriter->save('php://output');


?>
