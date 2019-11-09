<?php
// PHPExcel파일 라이브러리
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('memory_limit','-1');

require_once $_SERVER['DOCUMENT_ROOT'] . '/service/ProductService.php';

$nCategorySeq = $_GET['nCategorySeq'];

$aResult = array();
if (null != $nCategorySeq && 0 < $nCategorySeq) {
    $oProductService = new ProductService();
    // echo "cate:::"+$category;
    $aResult['data'] = $oProductService->selectProduct($nCategorySeq);
    if ((null != $aResult) && (0 < count($aResult))) {
        $aResult['status'] = 200;
    } else {
        // 조회는 성공, 결과 값 없음.
        $aResult['status'] = 206;
    }
} else {
    // 파라미터 오류.
    $aResult['status'] = 403;
}

echo json_encode($aResult);