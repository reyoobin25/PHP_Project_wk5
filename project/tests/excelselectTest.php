<?php
// update Test
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel-1.8/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/service/ProductService.php';
$fFileName = $_SERVER['DOCUMENT_ROOT'] . '/resources/20191025_product_test.xlsx';


// 기존 상품 select 부분
function selectProduct($nProductCode, $sProductName, $nProductLowPrice, $nProductMlowPrice, $nProductAvgPrice, $nProductCompanyNum, $nProductCategoryCode) {
    // nProductCode = :nProductCode
    $sQuery = ' UPDATE tProduct
                SET sProductName=:sProductName, nProductLowPrice=:nProductLowPrice, nProductLowPrice=:nProductLowPrice, nProductMlowPrice=:nProductMlowPrice, nProductAvgPrice=:nProductAvgPrice, nProductCompanyNum=:nProductCompanyNum, nProductCategoryCode=:nProductCategoryCode
                WHERE nProductCode=:nProductCode ';
    try {
        $oStmt = $this->oDbo->prepare($sQuery);

        $oStmt->bindParam(':sProductName', $sProductName, PDO::PARAM_STR);
        $oStmt->bindParam(':nProductLowPrice', $nProductLowPrice, PDO::PARAM_INT);
        $oStmt->bindParam(':nProductMlowPrice', $nProductMlowPrice, PDO::PARAM_INT);
        $oStmt->bindParam(':nProductAvgPrice', $nProductAvgPrice, PDO::PARAM_INT);
        $oStmt->bindParam(':nProductCompanyNum', $nProductCompanyNum, PDO::PARAM_INT);
        $oStmt->bindParam(':nProductCategoryCode', $nProductCategoryCode, PDO::PARAM_INT);
        $aResult = $oStmt->execute();

        var_dump($aResult);
        
    } catch (Exception $e) {
        print_r($e);
    }    
}
