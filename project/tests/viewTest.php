<?php 
    $pdo = new PDO('mysql:host=localhost;dbname=dbProduct;', 'lyb', '21910054');
?>
<!doctype html>
<html>
<head>
<script src="/lib/jquery/3.4.1/jquery.min.js"></script>
<script src="/lib/bootstrap/bootstrap.min.js"></script>
<link href="/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h3>두번째 화면</h3>
<br/>
<!-- controller/selectProcessController.php -->
	<form id='listForm' name='listForm' method='post' action='http://localhost/tests/viewTest.php'>
      카테고리 : 
       <select id='fileCategorySelect' name='fileCategorySelect'>
           <option value=''>선택</option>
    			<?php 
    			    $sQuery = ' SELECT nCategoryCode, sCategoryName FROM tCategory ';
    			    $stmt = $pdo->prepare($sQuery);
    			    $stmt->execute();
    			    while($categoryList = $stmt->fetch()) {
    			        $nCategoryCodeId = $categoryList['nCategoryCode'];
    			        $sCategoryNameId = $categoryList['sCategoryName'];
    			?>
			<option value="<?=$nCategoryCodeId?>"> <?=$sCategoryNameId?> </option>
    			<?php 				        
    			    }
                ?>
       </select>
       <input type="submit" id="btnCategory" value="찾기" class="btn btn-primary"/>	
	</form>
       
    	<br/>
    	<div class="row">
    		<div class="col-5">
    		기준 상품 <button type='button' id='product_btn' name='product_btn'>엑셀 다운로드</button><br/><br/>
    		<!--  
    		<div id='firstList'></div>
    		-->
             <?php
                 $pQuery = ' SELECT COUNT(*) FROM board_tbl ';
                 $result = $pdo->prepare($pQuery);
                 $result->execute();
                 
                $category = $_POST['fileCategorySelect'];
                $sQuery;
                if($category == null){
                    $sQuery = " SELECT * 
                                FROM tProduct 
                                LIMIT 20 ";
                }else{
                    $sQuery = " SELECT * 
                                FROM  tProduct 
                                WHERE nProductCategoryCode = ". $category . " LIMIT 20";
                }
                
                $stmt = $pdo->prepare($sQuery);
                $stmt->execute();
                while ($fileList = $stmt->fetch()) {
                    echo $fileList['nProductCode'].", ".$fileList['nProductCategoryCode'].", ".$fileList['nProductLowPrice'].", ".$fileList['nProductMlowPrice'].", ".$fileList['nProductAvgPrice'].", ".$fileList['nProductCompanyNum'].", ".$fileList['sProductName']."<br/>";
                }
                
            ?>
    		</div>
    		<div class="col-7">
    		협력사 상품 <button type='button' id='company_btn' name='company_btn'>엑셀 다운로드</button><br/><br/>
    		<?php
        		$sQuery;
        		if($category == null){
        		    $sQuery = " SELECT * FROM tCompanyProduct LIMIT 20 ";
        		}else{
        		    $sQuery = " SELECT *
                                 FROM  tCompanyProduct
                                 WHERE nCompanyCategoryCode = ". $category . " LIMIT 20";
        		}
    		
                $stmt = $pdo->prepare($sQuery);
                $stmt->execute();
                while ($fileList = $stmt->fetch()) {
                    echo $fileList['sCompanyCode'].", ". $fileList['sCompanyName'].", ".$fileList['sCompanyProductCode'].", ".$fileList['sCompanyProductName'].", ".$fileList['sCompanyUrl'].", ".$fileList['nCompanyProductPrice'].", ".$fileList['nCompanyProductMprice'].", ".$fileList['dtCompanyRegisterDate'].", ".$fileList['$nCompanyCategoryCode']."<br/>";
                }
            ?>
    		</div>
    	</div>
</body>
<!-- 
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnCategory').click(function(){
			searchCategory();	
		});
	});

	function searchCategory(){
		
	}
</script> 
 -->
</html>

