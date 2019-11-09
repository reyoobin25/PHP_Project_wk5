<?php
// Excel file Read Test - 협력사 데이터
ini_set('memory_limit', -1);
ini_set('max_execution_time', 1440);
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/service/ProductService.php';

$fFileName = $_SERVER['DOCUMENT_ROOT'] . '/resources/20191025_협력사 상품 정보.xlsx';

try {
    // echo $fFileName;
    $oReader = PHPExcel_IOFactory::createReaderForFile($fFileName);
    $oPHPExcel = $oReader->load($fFileName);
    $oPHPExcel->setActiveSheetIndex(0);
    $oWorksheet = $oPHPExcel->getActiveSheet();
    $rowIterator = $oWorksheet->getRowIterator();
    print_r($rowIterator);
    foreach ($rowIterator as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
    }
    $maxRow = $oWorksheet->getHighestRow();
    echo "maxRow**".$maxRow."<br/>";
    
    $oProductService = new ProductService();

    for ($i = 2; $i <= $maxRow; $i ++) { // 1라인 컬럼명
        $sCompanyName = $oWorksheet->getCell('A' . $i)->getValue();
        $sCompanyCode = $oWorksheet->getCell('B' . $i)->getValue();
        $sCompanyProductCode = $oWorksheet->getCell('C' . $i)->getValue();
        $nCompanyCategoryCode = $oWorksheet->getCell('D' . $i)->getValue();
        $sCompanyProductName = $oWorksheet->getCell('E' . $i)->getValue();
        $sCompanyUrl = $oWorksheet->getCell('F' . $i)->getValue();
        $nCompanyProductPrice = $oWorksheet->getCell('G' . $i)->getValue();
        $nCompanyProductMprice = $oWorksheet->getCell('H' . $i)->getValue();
        $dtCompanyRegisterDate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($oWorksheet->getCell('I' . $i)->getValue()));
       
       echo $sCompanyName . ' / ' . $sCompanyCode . ' / ' . $sCompanyProductCode . ' / ' . $nCompanyCategoryCode . ' / ' . $sCompanyUrl . ' / ' . $nCompanyProductPrice . ' / ' . $nCompanyProductMprice . ' / ' . $dtCompanyRegisterDate . ' / ' . $sCompanyProductName . '<br>';
        $oProductService->insertCompanyProduct($sCompanyCode, $sCompanyName, $sCompanyProductCode, $sCompanyProductName, $sCompanyUrl, (int) $nCompanyProductPrice, (int) $nCompanyProductMprice, $dtCompanyRegisterDate, (int) $nCompanyCategoryCode);
        if(10 == $i){
            break;
        }
    }
} catch (exception $e) {
    echo '<pre>';
    print_r($e);
    echo '</pre>';
}