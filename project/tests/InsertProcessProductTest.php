<?php
// Excel file Read Test - 기준 데이터

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/service/ProductService.php';
$fFileName = $_SERVER['DOCUMENT_ROOT'] . '/resources/20191025_product_test.xlsx';

$aResult = array();
try {
    $oReader = PHPExcel_IOFactory::createReaderForFile($fFileName);
    $oPHPExcel = $oReader->load($fFileName);
    $oPHPExcel->setActiveSheetIndex(0);
    $oWorksheet = $oPHPExcel->getActiveSheet();
    $rowIterator = $oWorksheet->getRowIterator();

    foreach ($rowIterator as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
    }
    $maxRow = $oWorksheet->getHighestRow(); //119 (1라인 컬럼명 제외 : 118)
    
    $oProductService = new ProductService();
    for ($i = 2; $i <= $maxRow; $i ++) {    // 1라인 컬럼명
        $nProductCode = $oWorksheet->getCell('A' . $i)->getValue();
        $nProductCategoryCode = $oWorksheet->getCell('B' . $i)->getValue();
        $sProductName = $oWorksheet->getCell('C' . $i)->getValue();
        $nProductLowPrice = $oWorksheet->getCell('D' . $i)->getValue();
        $nProductMlowPrice = $oWorksheet->getCell('E' . $i)->getValue();
        $nProductAvgPrice = $oWorksheet->getCell('F' . $i)->getValue();
        $nProductCompanyNum = $oWorksheet->getCell('G' . $i)->getValue();

//         echo $nProductCode . ' / ' . $sProductName . ' / ' . $nProductLowPrice . ' / ' . $nProductMlowPrice . ' / ' . $nProductAvgPrice . ' / ' . $nProductCompanyNum . ' / ' . $nProductCategoryCode . '<br>';
        if (true == $oProductService->insertProduct((int) $nProductCode, $sProductName, (int) $nProductLowPrice, (int) $nProductMlowPrice, (int) $nProductAvgPrice, (int) $nProductCompanyNum, (int) $nProductCategoryCode)) {
            $aResult['status'] = 201; 
        } else {
            $aResult['status'] = 204;
        }
    }
} catch (exception $e) {
    $aResult['status'] = 403;
}
echo json_encode($aResult);
