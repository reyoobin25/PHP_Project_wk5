<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set('memory_limit','-1');

require_once $_SERVER['DOCUMENT_ROOT'] . '/service/ProductService.php';

$aResult = array();

$oProductService = new ProductService();
$aResult['data'] = $oProductService->selectCategory();
if (null != $aResult['data'] && 0 < count($aResult['data'])) {
    // 성공
    $aResult['status'] = 200;
}else {
    $aResult['status'] = 204;
}

echo json_encode($aResult);
