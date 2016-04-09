<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');


/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

$inputFileType = 'Excel2007';
$inputFileName = 'templates/32readwriteDonutChartJJ1.xlsx';

$inputFileNameShort = basename($inputFileName);

$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objReader->setIncludeCharts(TRUE);
$objPHPExcel = $objReader->load($inputFileName);
$objWorksheet = $objPHPExcel->getActiveSheet();

$row = 8;
$objWorksheet->insertNewRowBefore($row ,1);
$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, 12)
							  ->setCellValue('C'.$row, 12)
							  ->setCellValue('D'.$row, 12)
							  ->setCellValue('E'.$row, 12)
							  ->setCellValue('F'.$row, 12)
							  ->setCellValue('G'.$row, 12)
							  ->setCellValue('H'.$row, 12)
							  ->setCellValue('I'.$row, 12)
							  ->setCellValue('J'.$row, 12)
							  ->setCellValue('K'.$row, 12)
							  ->setCellValue('L'.$row, 12)
							  ->setCellValue('M'.$row, 12);

$outputFileName = basename($inputFileName);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save($outputFileName);

$objPHPExcel->disconnectWorksheets();
unset($objPHPExcel);