<?php
//SERVICE 테스트
require_once $_SERVER['DOCUMENT_ROOT'] . '/service/ProductService.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

$sCompanyName = '홈플러스';
$sCompanyCode = 'TK316';
$sCompanyProductCode = '1.00001E+12';
$nCompanyCategoryCode = 1;
$sCompanyProductName = '전국LG물류배송 디오스 F957SA35 매직스페이스 4도어 냉장고 950L';
$sCompanyUrl = 'http://direct.homeplus.co.kr/app.partner.Partner.ghs?comm=usr.partner.redirect&PartnerID=DANAWA_56010&page=/app.product.Product.ghs?comm=usr.product.detail&value=193038&i_style=989633114';
$nCompanyProductPrice = 0;
$nCompanyProductMprice = 0;
$dtCompanyRegisterDate = 42185;
$dtCompanyRegisterDate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($dtCompanyRegisterDate));
//$dtCompanyRegisterDate = $dtCompanyRegisterDates;
//$dtCompanyRegisterDate = "'".$dtCompanyRegisterDates."'";

$oProductService = new ProductService();
$oProductService->insertCompanyProduct($sCompanyCode, $sCompanyName, $sCompanyProductCode, $sCompanyProductName, $sCompanyUrl, (int)$nCompanyProductPrice, (int)$nCompanyProductMprice, $dtCompanyRegisterDate, (int)$nCompanyCategoryCode);
