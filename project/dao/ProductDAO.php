<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/const.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

class ProductDAO {

    private $oDbo = null;

    public function __construct() {
        $this->oDbo = new PDO(DATABASE_DSN, DATABASE_USER, DATABASE_PASSWORD);
    }

    // start transaction
    public function begin() {
        $this->oDbo->beginTransaction();
    }

    // commit
    public function commit() {
        $this->oDbo->commit();
    }

    // disoDboect
    public function disoDboect() {
        $this->oDbo = null;
    }

    /**
     * 기존 상품 엑셀파일 SAVE
     * @param int $nProductCode
     * @param string $sProductName
     * @param int $nProductLowPrice
     * @param int $nProductMlowPrice
     * @param int $nProductAvgPrice
     * @param int $nProductCompanyNum
     * @param int $nProductCategoryCode
     * @return number|boolean
     */
    function insertProduct($nProductCode, $sProductName, $nProductLowPrice, $nProductMlowPrice, $nProductAvgPrice, $nProductCompanyNum, $nProductCategoryCode) {
        $aResult = array();
        try {
            $sQuery = ' INSERT INTO tProduct (nProductCode, sProductName, nProductLowPrice, nProductMlowPrice, nProductAvgPrice, nProductCompanyNum, nProductCategoryCode)
                        VALUES (:nProductCode, :sProductName, :nProductLowPrice, :nProductMlowPrice, :nProductAvgPrice, :nProductCompanyNum, :nProductCategoryCode)
                        ON DUPLICATE KEY UPDATE
                        sProductName = :sProductName, 
                        nProductLowPrice = :nProductLowPrice,
                        nProductMlowPrice = :nProductMlowPrice,
                        nProductAvgPrice = :nProductAvgPrice,
                        nProductCompanyNum = :nProductCompanyNum,
                        nProductCategoryCode = :nProductCategoryCode ';
            
            $oStmt = $this->oDbo->prepare($sQuery);
            $oStmt->bindParam(':nProductCode', $nProductCode, PDO::PARAM_INT);
            $oStmt->bindParam(':sProductName', $sProductName, PDO::PARAM_STR);
            $oStmt->bindParam(':nProductLowPrice', $nProductLowPrice, PDO::PARAM_INT);
            $oStmt->bindParam(':nProductMlowPrice', $nProductMlowPrice, PDO::PARAM_INT);
            $oStmt->bindParam(':nProductAvgPrice', $nProductAvgPrice, PDO::PARAM_INT);
            $oStmt->bindParam(':nProductCompanyNum', $nProductCompanyNum, PDO::PARAM_INT);
            $oStmt->bindParam(':nProductCategoryCode', $nProductCategoryCode, PDO::PARAM_INT);
            $aResult = $oStmt->execute();

        } catch (Exception $e) {
            $aResult = 0;
        }
        return $aResult;
    }

    /** 
     * 협력 상품 엑셀파일 SAVE
     * @param string $sCompanyCode
     * @param string $sCompanyName
     * @param string $sCompanyProductCode
     * @param string $sCompanyProductName
     * @param string $sCompanyUrl
     * @param int $nCompanyProductPrice
     * @param int $nCompanyProductMprice
     * @param string $dtCompanyRegisterDate
     * @param int $nCompanyCategoryCode
     */
    function insertCompayProduct($sCompanyCode, $sCompanyName, $sCompanyProductCode, $sCompanyProductName, $sCompanyUrl, $nCompanyProductPrice, $nCompanyProductMprice, $dtCompanyRegisterDate, $nCompanyCategoryCode) {
        $aResult = array();
        try {
            $sQuery = ' INSERT INTO tCompanyProduct(sCompanyCode, sCompanyName, sCompanyProductCode, sCompanyProductName, sCompanyUrl, nCompanyProductPrice, nCompanyProductMprice, dtCompanyRegisterDate, nCompanyCategoryCode) 
                        VALUES(:sCompanyCode, :sCompanyName, :sCompanyProductCode, :sCompanyProductName, :sCompanyUrl, :nCompanyProductPrice, :nCompanyProductMprice, :dtCompanyRegisterDate, :nCompanyCategoryCode) 
                        ON DUPLICATE KEY UPDATE 
                        sCompanyName = :sCompanyName,
                        sCompanyProductCode = :sCompanyProductCode,
                        sCompanyProductName = :sCompanyProductName,
                        sCompanyUrl = :sCompanyUrl,
                        nCompanyProductPrice = :nCompanyProductPrice,
                        nCompanyProductMprice = :nCompanyProductMprice,
                        dtCompanyRegisterDate = :dtCompanyRegisterDate,
                        nCompanyCategoryCode = :nCompanyCategoryCode ';

            $oStmt = $this->oDbo->prepare($sQuery);
            $oStmt->bindParam(':sCompanyCode', $sCompanyCode, PDO::PARAM_STR);
            $oStmt->bindParam(':sCompanyName', $sCompanyName, PDO::PARAM_STR);
            $oStmt->bindParam(':sCompanyProductCode', $sCompanyProductCode, PDO::PARAM_STR);
            $oStmt->bindParam(':sCompanyProductName', $sCompanyProductName, PDO::PARAM_STR);
            $oStmt->bindParam(':sCompanyUrl', $sCompanyUrl, PDO::PARAM_STR);
            $oStmt->bindParam(':nCompanyProductPrice', $nCompanyProductPrice, PDO::PARAM_INT);
            $oStmt->bindParam(':nCompanyProductMprice', $nCompanyProductMprice, PDO::PARAM_INT);
            $oStmt->bindParam(':dtCompanyRegisterDate', $dtCompanyRegisterDate, PDO::PARAM_STR);
            $oStmt->bindParam(':nCompanyCategoryCode', $nCompanyCategoryCode, PDO::PARAM_INT);
            $aResult = $oStmt->execute();

        } catch (Exception $e) {
            $aResult = 0;
        }
        return $aResult;
    }

    /** 
     * 기준 상품 total 카운트
     * @param int $category
     * @return number|mixed
     */
    function selectProductCount($category) {
        $nResult = 0;
        try {
            $sQuery = ' SELECT COUNT(nProductCode) AS CNT
                        FROM tProduct';
            if (null != $category && 0 < $category) {
                $sQuery .= ' WHERE nProductCategoryCode= :nProductCategoryCode ';
            }
            $oStmt = $this->oDbo->prepare($sQuery);
            if ((null != $category) && (0 < $category)) {
                $oStmt->bindParam(':nProductCategoryCode', $category, PDO::PARAM_INT);
            }
            $oStmt->execute();
            $aResult = $oStmt->fetch();
            $nResult = $aResult['CNT'];
        } catch (Exception $e) {
            $nResult = 0;
        }
        return $nResult;
    }
    
    /** 
     * 기준 상품 리스트
     * @param int $category
     * @param int $nPage
     * @param int $nLimit
     * @param string $sOrder
     * @param string $sSort
     * @return boolean|mixed[]
     */
    function selectProduct($category, $nPage, $nLimit, $sOrder, $sSort) {
        $arResult = array();
        try {
            $sQuery = ' SELECT nProductCode, sProductName, nProductLowPrice, nProductMlowPrice, nProductAvgPrice, nProductCompanyNum, nProductCategoryCode
                        FROM tProduct';
            if (null != $category && 0 < $category) {
                $sQuery .= ' WHERE nProductCategoryCode= :nProductCategoryCode ';
            }
            $sQuery .= ' ORDER BY ' . $sOrder . ' ' . $sSort;
            $sQuery .= ' LIMIT ' . (($nPage-1) * $nLimit) . ', ' . $nLimit;
            $oStmt = $this->oDbo->prepare($sQuery);
            if ((null != $category) && (0 < $category)) {
                $oStmt->bindParam(':nProductCategoryCode', $category, PDO::PARAM_INT);
            }
            $oStmt->execute();
            while ($aRows = $oStmt->fetch()) {
                $arResult[] = $aRows;
            }
        } catch (Exception $e) {
            $arResult = false;
        }
        return $arResult;
    }

    /** 
     * 협력사 상품 리스트 
     * @param int $category
     * @param int $nPage
     * @param int $nLimit
     * @param string $sOrder
     * @param string $sSort
     * @return boolean|mixed[]
     */
    function selectCompanyProduct($category, $nPage, $nLimit, $sOrder, $sSort) {
        $arrResult = array();
        try {
            $sQuery = ' SELECT sCompanyCode, sCompanyName, sCompanyProductCode, sCompanyProductName, sCompanyUrl, nCompanyProductPrice, nCompanyProductMprice, dtCompanyRegisterDate, nCompanyCategoryCode
                        FROM tCompanyProduct';
            if(null != $category && 0 < $category){
                $sQuery .= ' WHERE nCompanyCategoryCode= :nCompanyCategoryCode ';
            }
            $sQuery .= ' ORDER BY ' . $sOrder . ' ' . $sSort;
            $sQuery .= ' LIMIT ' . (($nPage-1) * $nLimit) . ', ' . $nLimit;
            $oStmt = $this->oDbo->prepare($sQuery);
            if ((null != $category) && (0 < $category)) {
                $oStmt->bindParam(':nCompanyCategoryCode', $category, PDO::PARAM_INT);
            }
            $oStmt->execute();
            while ($aRows = $oStmt->fetch()) {
                $arrResult[] = $aRows;
            }
        } catch (Exception $e) {
            $arrResult = false;
        }
        return $arrResult;
    }
    
    /** 
     * 협력사 상품 total 카운트
     * @param int $category
     * @return number|mixed
     */
    function selectCompanyProductCount($category) {
        $nResult = 0;
        try {
            $sQuery = ' SELECT COUNT(sCompanyCode) AS CNT
                        FROM tCompanyProduct';
            if (null != $category && 0 < $category) {
                $sQuery .= ' WHERE nCompanyCategoryCode= :nCompanyCategoryCode ';
            }
            $oStmt = $this->oDbo->prepare($sQuery);
            if ((null != $category) && (0 < $category)) {
                $oStmt->bindParam(':nCompanyCategoryCode', $category, PDO::PARAM_INT);
            }
            $oStmt->execute();
            $aResult = $oStmt->fetch();
            $nResult = $aResult['CNT'];
        } catch (Exception $e) {
            $nResult = 0;
        }
        return $nResult;
    }
    
    
    /**
     * 카테고리 select 
     * @return boolean|mixed[]
     */
    function selectCategory() {
        try{
        $arrResult = array();
            $sQuery = ' SELECT nCategoryCode, sCategoryName FROM tCategory ';
            $oStmt = $this->oDbo->prepare($sQuery);
            
            $oStmt->execute();
            while ($aRows = $oStmt->fetch()) {
                $arrResult[] = $aRows;
            }
        }catch(Exception $e){
            $arrResult = false;
        }
        return $arrResult;
    }
}

