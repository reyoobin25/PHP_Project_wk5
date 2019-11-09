<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dao/ProductDAO.php';

class ProductService {
    
    private $oProductdao;
    
    public function __construct() {
        $this->oProductdao = new ProductDAO();
    }
    
    // start transaction
    public function begin() {
        $this->oProductdao->begin();
    }
    
    // commit
    public function commit() {
        $this->oProductdao->commit();
    }
    
    //disconnect
    public function disconnect() {
        $this->oProductdao->disconnect();
    }
    
    /** 기존상품 SAVE 
     * @param int $nProductCode
     * @param string $sProductName
     * @param int $nProductLowPrice
     * @param int $nProductMlowPrice
     * @param int $nProductAvgPrice
     * @param int $nProductCompanyNum
     * @param int $nProductCategoryCode
     * @return number|boolean
     */
    function insertProduct ($nProductCode, $sProductName, $nProductLowPrice, $nProductMlowPrice, $nProductAvgPrice, $nProductCompanyNum, $nProductCategoryCode) {
            return $this->oProductdao->insertProduct($nProductCode, $sProductName, $nProductLowPrice, $nProductMlowPrice, $nProductAvgPrice, $nProductCompanyNum, $nProductCategoryCode);
    }
    
       
    /**
     * 협력사 상품 SAVE
     * @param string $sCompanyCode
     * @param string $sCompanyName
     * @param string $sCompanyProductCode
     * @param string $sCompanyProductName
     * @param string $sCompanyUrl
     * @param int $nCompanyProductPrice
     * @param int $nCompanyProductMprice
     * @param string $dtCompanyRegisterDate
     * @param int $nCompanyCategoryCode
     * @return boolean
     */
    function insertCompanyProduct($sCompanyCode, $sCompanyName, $sCompanyProductCode, $sCompanyProductName, $sCompanyUrl, $nCompanyProductPrice, $nCompanyProductMprice, $dtCompanyRegisterDate, $nCompanyCategoryCode) {
           return $this->oProductdao->insertCompayProduct($sCompanyCode, $sCompanyName, $sCompanyProductCode, $sCompanyProductName, $sCompanyUrl, $nCompanyProductPrice, $nCompanyProductMprice, $dtCompanyRegisterDate, $nCompanyCategoryCode);
    }
    
    
    /** 
     * 기존 상품 총 카운트
     * @param  int $category
     * @return number|mixed
     */
    function selectProductCount ($category) {
        return $this->oProductdao->selectProductCount($category);
    }
    
    
    /**
     * 기존 상품 SELECT
     * @param int $category
     * @param int $nPage
     * @param int $nLimit
     * @param string $sOrder
     * @param string $sSort
     * @return boolean|mixed[]
     */
    function selectProduct ($category, $nPage, $nLimit, $sOrder, $sSort) {
        return $this->oProductdao->selectProduct($category, $nPage, $nLimit, $sOrder, $sSort);
    }
    
    
    /**
     * 협력사 상품 총 카운트
     * @param int $category
     * @return number|mixed
     */
    function selectCompanyProductCount($category) {
        return $this->oProductdao->selectCompanyProductCount($category);
    }
    
    
    /** 
     * 협력사 상품 SELECT
     * @param int $category
     * @param int $nPage
     * @param int $nLimit
     * @param string $sOrder
     * @param string $sSort
     * @return boolean|mixed[]
     */
    function selectCompanyProduct($category, $nPage, $nLimit, $sOrder, $sSort) {
        return $this->oProductdao->selectCompanyProduct($category, $nPage, $nLimit, $sOrder, $sSort);
    }
    
    
    /**
     * 카테고리 SELECT
     * @return boolean|mixed[]
     */
    function selectCategory() {
        return $this->oProductdao->selectCategory();
    }
}