<?php
// Excel file Read Test - 협력사 데이터
// //ini_set('memory_limit', -1);
// //ini_set('max_execution_time', 1440);
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/service/ProductService.php';

$fFileName = $_SERVER['DOCUMENT_ROOT'] . '/resources/20191025_ttt.xlsx';

try {
    $oReader = PHPExcel_IOFactory::createReaderForFile($fFileName);
    $oPHPExcel = $oReader->load($fFileName);
    $oPHPExcel->setActiveSheetIndex(0);
    $oWorksheet = $oPHPExcel->getActiveSheet();
    $rowIterator = $oWorksheet->getRowIterator();

    foreach ($rowIterator as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        echo $cellIterator;
    }
    $maxRow = $oWorksheet->getHighestRow(); 

    //$oProductService = new ProductService();

     for ($i = 2; $i <= $maxRow; $i ++) { // 1라인 컬럼명
        $sCompanyName = $oWorksheet->getCell('A' . $i)->getValue();
        $sCompanyCode = $oWorksheet->getCell('B' . $i)->getValue();
        $sCompanyProductCode = $oWorksheet->getCell('C' . $i)->getValue();
        $nCompanyCategoryCode = $oWorksheet->getCell('D' . $i)->getValue();
        $sCompanyProductName = $oWorksheet->getCell('E' . $i)->getValue();
        $sCompanyUrl = $oWorksheet->getCell('F' . $i)->getValue();
        $nCompanyProductPrice = $oWorksheet->getCell('G' . $i)->getValue();
        $nCompanyProductMprice = $oWorksheet->getCell('H' . $i)->getValue();
        $dtCompanyRegisterDates = $oWorksheet->getCell('I' . $i)->getValue();
        $dtCompanyRegisterDate = PHPExcel_Style_NumberFormat::toFormattedString($dtCompanyRegisterDates, PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);

        echo "dtCompanyRegisterDate ::::::::" . $dtCompanyRegisterDate;
        echo $sCompanyCode . ' / ' . $sCompanyName . ' / ' . $sCompanyProductCode . ' / ' . $sCompanyProductName . ' / ' . $sCompanyUrl . ' / ' . $nCompanyProductPrice . ' / ' . $nCompanyProductMprice . ' / ' . $dtCompanyRegisterDate . ' / ' . $nCompanyCategoryCode . '<br>';
       // $oProductService->insertCompanyProduct($sCompanyCode, $sCompanyName, $sCompanyProductCode, $sCompanyProductName, $sCompanyUrl, (int)$nCompanyProductPrice, (int)$nCompanyProductMprice, $dtCompanyRegisterDate, (int)$nCompanyCategoryCode);
    }
    echo '<scrip>alert("cnt:".$cnt);</scrip>';
} catch (exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
}