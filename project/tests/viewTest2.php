<!doctype html>
<html>
<head>
<script src="/lib/jquery/3.4.1/jquery.min.js"></script>
<script src="/lib/bootstrap/bootstrap.min.js"></script>
<link href="/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h3>두번째 화면</h3>
<!-- http://localhost/controller/selectProcessController.php' -->
<form id='listForm' name='listForm' method='post' action='http://localhost/controller/selectProcessController.php'>
          카테고리 : 
       <select id='fileCategorySelect' name='fileCategorySelect'>
           <option value=''>선택</option>
    			<?php 
    			    //$sCategoryNameId == 카테고리 이름 
    			    //$nCategoryCodeId == 카테고리 코드
    			    $sQuery = ' SELECT nCategoryCode, sCategoryName FROM tCategory ';
    			    $stmt = $pdo->prepare($sQuery);
    			    $stmt->execute();
    			    while($categoryList = $stmt->fetch()) {
    			        $nCategoryCodeId = $categoryList['nCategoryCode'];
    			        $sCategoryNameId = $categoryList['sCategoryName'];
    			?>
			<option value="<?=$sCategoryNameId?>"> <?=$sCategoryNameId?> </option>
    			<?php 				        
    			    }
                ?>
       </select>
       <input type='submit'  value='검색' />	
</form>
    
