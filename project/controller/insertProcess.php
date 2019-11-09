<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
header("Content-Type:text/html; charset=utf-8");

require_once $_SERVER['DOCUMENT_ROOT'] . '/service/ProductService.php';

// 업로드할 디렉토리
$sUploadDir = $_SERVER['DOCUMENT_ROOT'] . '/resources';

$name = $_FILES['uploadFile']['name'];

//기준상품 / 협력사 상품인지 확인
$sSelectBox = $_POST['fileCategorySelect'];

$oPHPExcel = new PHPExcel();
/* 기존상품 SAVE */
// SELECT BOX별 폴더에 저장 및 원하는 경로로 파일 이동
if ($sSelectBox == 'product') {
    move_uploaded_file($_FILES['uploadFile']['tmp_name'], $sUploadDir . '/' . $name);
    // 엑셀파일 DB에 SAVE 기존상품
    $fFileName = $_SERVER['DOCUMENT_ROOT'] . '/resources/' . $name;

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
        $maxRow = $oWorksheet->getHighestRow(); // 1(1라인 컬럼명 제외 : 20000rows)

        $oProductService = new ProductService();
        $aResult = array();
        
        for ($i = 2; $i <= $maxRow; $i ++) { // 1라인 컬럼명
            $nProductCode = $oWorksheet->getCell('A' . $i)->getValue();
            $nProductCategoryCode = $oWorksheet->getCell('B' . $i)->getValue();
            $sProductName = $oWorksheet->getCell('C' . $i)->getValue();
            $nProductLowPrice = $oWorksheet->getCell('D' . $i)->getValue();
            $nProductMlowPrice = $oWorksheet->getCell('E' . $i)->getValue();
            $nProductAvgPrice = $oWorksheet->getCell('F' . $i)->getValue();
            $nProductCompanyNum = $oWorksheet->getCell('G' . $i)->getValue();

            if (true == $oProductService->insertProduct((int) $nProductCode, $sProductName, (int) $nProductLowPrice, (int) $nProductMlowPrice, (int) $nProductAvgPrice, (int) $nProductCompanyNum, (int) $nProductCategoryCode)) {
                // 파일 insert 성공
                $aResult['status'] = 201;
            } else {
                // no content
                $aResult['status'] = 204;
            }
        }
    } catch (exception $e) {
        $aResult['status'] = 403;
    }
    echo json_encode($aResult);

    /* 협력사 상품 SAVE */
} else if ($sSelectBox == 'company_product') {
    move_uploaded_file($_FILES['uploadFile']['tmp_name'], $sUploadDir . '/' . $name);
    // 엑셀파일 DB에 SAVE 기존상품
    $fFileName = $_SERVER['DOCUMENT_ROOT'] . '/resources/' . $name;

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
        $maxRow = $oWorksheet->getHighestRow();
        $oProductService = new ProductService();
        $aResult = array();

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

            if (true == $oProductService->insertCompanyProduct($sCompanyCode, $sCompanyName, $sCompanyProductCode, $sCompanyProductName, $sCompanyUrl, (int) $nCompanyProductPrice, (int) $nCompanyProductMprice, $dtCompanyRegisterDate, (int) $nCompanyCategoryCode)){
                // 성공
                $aResult['status'] = 201;
            } else {
                // no content
                $aResult['status'] = 204;
            }
        }
    } catch (exception $e) {
        $aResult['status'] = 403;
    }
    echo json_encode($aResult);
} else {
    return $aResult['status'] = 403;
}
