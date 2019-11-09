<?php
$pdo = new PDO('mysql:host=localhost;dbname=dbProduct;', 'lyb', '21910054');
?>
<!doctype html>
<html>
<head>
<script src="/lib/jquery/3.4.1/jquery.min.js"></script>
<script src="/lib/bootstrap/bootstrap.min.js"></script>
<link href="/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="overflow-x:hidden">
	<h3>두번째 화면</h3>
	<br />
	<!-- 카테고리 선택 부분 -->
		카테고리 : 
		<select id='fileCategorySelect' name='fileCategorySelect'>
			<option value=''>선택</option>
        <?php
        $sQuery = ' SELECT nCategoryCode, sCategoryName FROM tCategory ';
        $stmt = $pdo->prepare($sQuery);
        $stmt->execute();
        
        while ($categoryList = $stmt->fetch()) {
            $nCategoryCodeId = $categoryList['nCategoryCode'];
            $sCategoryNameId = $categoryList['sCategoryName'];
        ?>
    		<option value="<?=$nCategoryCodeId?>"> <?=$sCategoryNameId?> </option>
        <?php
        }
        ?>
        </select> 
      <input type="submit" id="btnCategory" name="btnCategory" value="찾기" class="btn btn-primary" />


	<!-- 기준상품 리스트 부분 -->
	<div class="row">
		<div class="col-6" >
			기준 상품
			<button type='button' id='product_btn' name='product_btn' href="http://localhost/tests/downloadExcel">엑셀 다운로드</button>
			<br /> <br />
			<div id='productList'>
				<table class="table table-bordered" ><tbody><tr><td style="width: 20;" align="center"><strong>상품코드</strong></td><td style="width: 40;" align="center"><strong>카테고리</strong></td><td style="width: 100;" align="center"><strong>상품명</strong></td><td style="width: 20;" align="center"><strong>최저가</strong></td><td style="width: 20;" align="center"><strong>모바일최저가</strong></td><td style="width: 20;" align="center"><strong>평균가</strong></td><td style="width: 20;" align="center"><strong>업체수</strong></td></tr><tr><td width="20px" align="center">163941</td><td width="40px" align="center">57905</td><td width="100px">뱀구슬끼우기</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">165828</td><td width="40px" align="center">57905</td><td width="100px">동물 자동차 퍼즐</td><td width="20px" align="center">33250</td><td width="20px" align="center">0</td><td width="20px" align="center">33250</td><td width="20px" align="center">1</td></tr></tbody><tbody><tr><td width="20px" align="center">167565</td><td width="40px" align="center">57905</td><td width="100px">멜로디 화장거울</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">170857</td><td width="40px" align="center">57905</td><td width="100px">인형자동차</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">174701</td><td width="40px" align="center">57905</td><td width="100px">증기기관차</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">178897</td><td width="40px" align="center">57905</td><td width="100px">플레이도 칼라도우 4팩</td><td width="20px" align="center">3260</td><td width="20px" align="center">3260</td><td width="20px" align="center">5035</td><td width="20px" align="center">136</td></tr></tbody><tbody><tr><td width="20px" align="center">195761</td><td width="40px" align="center">57905</td><td width="100px">노래하는 영어 이야기책</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">209228</td><td width="40px" align="center">57905</td><td width="100px">원목교구 도미노놀이</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">209285</td><td width="40px" align="center">57905</td><td width="100px">페브릭 쿠션 라디오 </td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">213454</td><td width="40px" align="center">57905</td><td width="100px">동물퍼즐코끼리 원숭이</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">213574</td><td width="40px" align="center">57905</td><td width="100px">숫자 퍼즐 대</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">215245</td><td width="40px" align="center">57905</td><td width="100px">도미노게임 200pcs</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">215263</td><td width="40px" align="center">57905</td><td width="100px">도형 막대 실 꿰기</td><td width="20px" align="center">24420</td><td width="20px" align="center">24420</td><td width="20px" align="center">28008</td><td width="20px" align="center">21</td></tr></tbody><tbody><tr><td width="20px" align="center">215275</td><td width="40px" align="center">57905</td><td width="100px">동물퍼즐돼지 부엉이</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">215305</td><td width="40px" align="center">57905</td><td width="100px">점보셈판</td><td width="20px" align="center">27060</td><td width="20px" align="center">27310</td><td width="20px" align="center">33141</td><td width="20px" align="center">39</td></tr></tbody><tbody><tr><td width="20px" align="center">215316</td><td width="40px" align="center">57905</td><td width="100px">한글퍼즐 대</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">215327</td><td width="40px" align="center">57905</td><td width="100px">ABC퍼즐 대</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">221532</td><td width="40px" align="center">57905</td><td width="100px">이유식세트 웨인</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">225188</td><td width="40px" align="center">57905</td><td width="100px">감각볼 (대)</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody><tbody><tr><td width="20px" align="center">225717</td><td width="40px" align="center">57905</td><td width="100px">낚시놀이</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td><td width="20px" align="center">0</td></tr></tbody></table>
			</div>
    	</div>
        <!-- 협력사상품 리스트 부분 -->
    	<div class="col-6" >
    		협력사 상품
    		<button type='button' id='company_btn' name='company_btn' href="http://localhost/tests/downloadExcel">엑셀 다운로드</button>
    		<br/><br/>
    		<div id='companyList'>
				<table class="table table-bordered">
    				<tr>
    					<th style="width: 50;">협력사명</th>
    					<th style="width: 30;">협력사 코드</th>
    					<th style="width: 200;">협력사 상품명</th>
    					<th style="width: 10;">협력사 URL</th>
    					<th style="width: 20;">가격</th>
    					<th style="width: 20;">모바일 가격</th>
    					<th style="width: 20;">입력일</th>
    				</tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    				<tr><td style="width: 50;">G마켓</td><td style="width: 30;">EE128</td><td style="width: 200;">클라쎄 대우 클라쎄큐브 FR L832PRFW 양문형냉장고 무료설치z</td><td style="width: 10;"><a href="http://www.gmarket.co.kr/challenge/neo_jaehu/jaehu_goods_gate.asp?goodscode=754116607&GoodsSale=Y&jaehuid=200002657">ⓤ</a></td><td style="width: 20;">1093390</td><td style="width: 20;">1093390</td><td style="width: 20;">2015-12-22</td></tr>
    			</table>
    		</div>
    		</div>
    	</div>
    </body>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnCategory').click(function(){
			productList();
		});
	});

	function productList() {
		var selectedValue = $("#fileCategorySelect option:selected").val();
		console.log(selectedValue);
		$.ajax({
			type:"GET",
			url:"http://localhost/tests/selectProcessControllerTest.php",
			data: {"nCategorySeq" : selectedValue},
			dataType:"json",
			contentType:"json",
			success:function(data) {
				var sListResult = "";
				if (200 == data["status"]) {
					sListResult = "<table class='table table-bordered'>"
						+"<tr>"
							+"<td style=\"width: 20;\" align=\"center\"><strong>상품코드</strong></td>"
							+"<td style=\"width: 50;\" align=\"center\"><strong>카테고리</strong></td>"
							+"<td style=\"width: 120;\" align=\"center\"><strong>상품명</strong></td>"
							+"<td style=\"width: 20;\" align=\"center\"><strong>최저가</strong></td>"
							+"<td style=\"width: 60;\" align=\"center\"><strong>모바일최저가</strong></td>"
							+"<td style=\"width: 20;\" align=\"center\"><strong>평균가</strong></td>"
							+"<td style=\"width: 20;\" align=\"center\"><strong>업체수</strong></td>"
						+"</tr>";
						+"<tbody>"; 
					console.log(data);
            		$.each(data["data"], function(index, item) {
            			if (null != item) {
            				sListResult +="<tr><td width=\"20px\" align=\"center\">" + item['nProductCode'] 
            			       		  +"<td width=\"50px\" align=\"center\">" + item['nProductCategoryCode']
            			       		  +"<td width=\"120px\">" + item['sProductName']
            			       		  +"<td width=\"20px\" align=\"center\">" + item['nProductLowPrice']
            			       		  +"<td width=\"20px\" align=\"center\">" + item['nProductMlowPrice']
            			       		  +"<td width=\"20px\" align=\"center\">" + item['nProductAvgPrice']
            			       		  +"<td width=\"20px\" align=\"center\">" + item['nProductCompanyNum']
            			       +"</td></tr>";
            			       sListResult += "</tbody>";
            			}
            		});
				} else if (403 == data["status"]) {
					sListResult = "파라미터가 잘못 되었습니다.";
				} else {
					sListResult = "알수없는 오류가 발생하였습니다.";
				}
				
				$("#productList").html(sListResult);
			}	
		});
	}

	
// 	function searchCategory() {
// 		 var nCategoryCodeId = $('nCategoryCodeId');
// 		 var sCategoryNameId = $('sCategoryNameId');

// 		 var data = {
// 				"nCategoryCodeId" : $('nCategoryCodeId').val(),
// 				"sCategoryNameId" : $('sCategoryNameId').val()
// 				 };
// 		 $.ajax({
// 				type : 'POST',
// 				url : "http://localhost/tests/selectProcessControllerTest.php",
// 				data : data,
// 				dataType : 'jason',
// 				contentType: "application/json; charset=utf-8",
// 				success : function(data) {
// 					console.log("data$$"+data);
// 					if(data){
// 						alert("성공");
// 					} else {
// 						alert("실패");
// 					}	
// 				},
// 				error : function(jqXHR, textStatus, errorThrown) {
// 					alert("에러");
// 				},
// 			});
		
// 	}

</script>


</html>

