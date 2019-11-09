<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('memory_limit','-1');

require_once $_SERVER['DOCUMENT_ROOT'] . '/service/ProductService.php';

$nCategorySeq = $_GET['nCategorySeq'];
$nPage = $_GET['nPage'];
$nLimit = $_GET['nLimit'];
$sOrder = $_GET['sOrder'];
$sSort = $_GET['sSort'];

$aResult = array();
if (null != $nCategorySeq && 0 < $nCategorySeq) {
    $oProductService = new ProductService();
    $aResult['count'] = $oProductService->selectCompanyProductCount($nCategorySeq);
    $aResult['data'] = $oProductService->selectCompanyProduct($nCategorySeq, $nPage, $nLimit,$sOrder, $sSort);
    if ((null != $aResult) && (0 < count($aResult))) {
        $aResult['status'] = 200;
    } else {
        // 조회는 성공, 결과 값 없음 / no content
        $aResult['status'] = 204;
    }
} else {
    // 파라미터 오류.
    $aResult['status'] = 403;
}

echo json_encode($aResult);