<?php
//DAO테스트
require_once $_SERVER['DOCUMENT_ROOT'] . '/dao/ProductDAO.php';

$nProductCode = 3498184;
$sProductName = '1/43 HINO 500 SERIES DAKAR RALLY 2012 (AA612981DE)';
$nProductLowPrice = 144000;
$nProductMlowPrice = 144000;
$nProductAvgPrice = 157556;
$nProductCompanyNum = 9;
$nProductCategoryCode = 57905;

$oProductDAO = new ProductDAO();
$oProductDAO->insertProduct($nProductCode, $sProductName, $nProductLowPrice, $nProductMlowPrice, $nProductAvgPrice, $nProductCompanyNum, $nProductCategoryCode);