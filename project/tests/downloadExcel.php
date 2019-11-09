<?php 
    header( "Content-type: application/vnd.ms-excel" );
    header( "Content-type: application/vnd.ms-excel; charset=utf-8");
    header( "Content-Disposition: attachment; filename = invoice.xls" );
    header( "Content-Description: PHP4 Generated Data" );

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
       
    	<br/>
    	<div class="row">
    		<div class="col-5" width = "50%">
    		기준 상품 <button type='button' id='product_btn' name='product_btn'>엑셀 다운로드</button><br/><br/>
    		
    		$EXCEL_STR = "
    		<table class="table table-bordered">
        			<tr>
        				<td width="20px" align="center"><strong>상품코드</strong></td>
        				<td width="40px" align="center"><strong>카테고리</strong></td>
        				<td width="100px" align="center"><strong>상품명</strong></td>
        				<td width="20px" align="center"><strong>최저가</strong></td>
        				<td width="20px" align="center"><strong>모바일최저가</strong></td>
        				<td width="20px" align="center"><strong>평균가</strong></td>
        				<td width="20px" align="center"><strong>업체수</strong></td>
        			</tr> ";
    		<!--  
    		<div id='firstList'></div>
    		-->
             <?php
                $category = $_POST['fileCategorySelect'];
                
                $pageNum = 20; //보여줄 row갯수
                $pQuery = ' SELECT COUNT(*) FROM tProduct ';
                
                $result = $pdo->prepare($pQuery);
                $result->execute();
                
                 while ($fileList = $stmt->fetch()) {
                    ?>
                    $EXCEL_STR = "
                	<tr>
                		<td width="20px" align="center"><?php echo $fileList['nProductCode']?></td>
                		<td width="40px" align="center"><?php echo $fileList['nProductCategoryCode']?></td>
                		<td width="100px"><?php echo $fileList['sProductName']?></td>
                		<td width="20px" align="center"><?php echo $fileList['nProductLowPrice']?></td>
                		<td width="20px" align="center"><?php echo $fileList['nProductMlowPrice']?></td>
                		<td width="20px" align="center"><?php echo $fileList['nProductAvgPrice']?></td>
                		<td width="20px" align="center"><?php echo $fileList['nProductCompanyNum']?></td>
               		</tr>
               		";
			<?php 
                }
                $EXCEL_STR .= "</table>";
                echo "<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'> ";
                echo $EXCEL_STR;
            ?>
            </table>
            
    		</div>
    		<div class="col-7" width="60%">
    			협력사 상품 <button type='button' id='company_btn' name='company_btn'>엑셀 다운로드</button><br/><br/>
				<table class="table table-bordered">
        		<thead align="center">
        			<tr>
        				<td style="width: 10;" align="center"><strong>협력사명</strong></td>
        				<td style="width: 10;" align="center"><strong>협력사코드</strong></td>
        				<td style="width: 120;" align="center"><strong>협력사상품명</strong></td>
        				<td style="width: 10;" align="center"><strong>협력사URL</strong></td>
        				<td style="width: 10;" align="center"><strong>가격</strong></td>
        				<td style="width: 10;" align="center"><strong>모바일가격</strong></td>
        				<td style="width: 10;" align="center"><strong>입력일</strong></td>
        			</tr>
        		</thead>
    			<tbody>
    			
    		<?php
                $stmt = $pdo->prepare($sQuery);
                $stmt->execute();
                while ($fileList = $stmt->fetch()) { ?>
                	<tr>
                		<td style="width: 10;" align="center"><?php echo $fileList['sCompanyName']?></td>
                		<td style="width: 10;" align="center"><?php echo $fileList['sCompanyCode']?></td>
                		<td style="width: 120;"><?php echo $fileList['sCompanyProductName']?></td>
                		<td style="width: 5;"  align="center"><a href="<?= $fileList['sCompanyUrl']?>" >ⓤ</a></td>
                		<td style="width: 10;" align="center"><?php echo $fileList['nCompanyProductPrice']?></td>
                		<td style="width: 10;" align="center"><?php echo $fileList['nCompanyProductMprice']?></td>
                		<td style="width: 10;" align="center"><?php echo $fileList['dtCompanyRegisterDate']?></td>
					</tr>
			<?php 
                }
             ?>
             </tbody>
             </table>


</html>

