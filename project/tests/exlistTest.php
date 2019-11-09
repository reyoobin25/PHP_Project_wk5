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
<style type="text/css">
.paging {width:100%; text-align:center; vertical-align:middle;}
.paging a.on{font-weight: bold; color: red;}</style>
</head>
<body style="overflow-x:hidden">
	<h3>두번째 화면</h3>
	<br />
	<!-- 카테고리 선택 부분 -->
		카테고리 : 
		<div id='categoryList'></div>
		<!-- 여기!! -->
      <input type="submit" id="btnCategory" name="btnCategory" value="찾기" class="btn btn-primary" />


	<!-- 기준상품 리스트 부분 -->
	<div class="row">
		<div class="col-6" >
			기준 상품
			<a href="http://localhost/tests/downloadTest.php"><button type='button' id='product_btn' name='product_btn'>엑셀 다운로드</button></a>
			<br /> <br />
			<div id='productList'></div>
			<div id='productListPaging' class="paging"></div>
    	</div>
        <!-- 협력사상품 리스트 부분 -->
    	<div class="col-6" >
    		협력사 상품
    		<a href="http://localhost/tests/downloadTest.php"><button type='button' id='companyPrduct_btn' name='companyPrduct_btn' >엑셀 다운로드</button></a>
    		<br/><br/>
    		<div id="companyProductList"></div>
    		<div id="companyProductListPaging" class="paging"></div>
		</div>
	</div>
</body>

<script type="text/javascript">
	$(document).ready(function(){
		// 카테고리 리스트 조회
		getCategoryList();

		// 찾기
		$('#btnCategory').click(function(){
			productList(1);
			companyProductList(1);
		});
	});

	// 카테고리 리스트 조회
	function getCategoryList() {
		$.ajax({
			type:"GET",
			url:"http://localhost/controller/selectCategoryController.php",
			dataType:"json",
			contentType:"json",
			success:function(data) {
				var sListResult = "";
				if (200 == data["status"]) {
					sListResult ="<select id='fileCategorySelect' name='fileCategorySelect'><option value=''>선택</option>"
            		$.each(data["data"], function(index, item) {
            			if (null != item) {
            				sListResult += "<option value="+item['nCategoryCode']+">"+item['sCategoryName'] +"</option>"
		            		}
            		});
					sListResult += "</select>";
				} else {
					sListResult = "알수없는 오류가 발생하였습니다.";
				}
				
				$("#categoryList").html(sListResult);
			}	
		});
	}

	// 기준상품 리스트 조회
	function productList(nPage) {
		var selectedValue = $("#fileCategorySelect option:selected").val();
		console.log(selectedValue);
		$.ajax({
			type:"GET",
			url:"http://localhost/controller/selectProductController.php",
			data: {"nCategorySeq" : selectedValue,
				   "nPage": nPage,
				   "nLimit": 20},
			dataType:"json",
			contentType:"json",
			success:function(data) {
				var sListResult = "";
				if (200 == data["status"]) {
					sListResult = "<table id='productTable' class='table table-bordered'>"
						+"<tr>"
							+"<th style=\"width: 20px;\" align=\"center\" onclick=\"sortTable(0)\"><strong>상품코드</strong></th>"
							+"<th style=\"width: 50px;\" align=\"center\">카테고리</th>"
							+"<th style=\"width: 120px;\" align=\"center\" onclick=\"sortTable(2)\"><strong>상품명</strong></th>"
							+"<th style=\"width: 20px;\" align=\"center\">최저가</th>"
							+"<th style=\"width: 60px;\" align=\"center\">모바일최저가</th>"
							+"<th style=\"width: 20px;\" align=\"center\">평균가</th>"
							+"<th style=\"width: 20px;\" align=\"center\">업체수</th>"
						+"</tr>";
						+"<tbody>"; 
					console.log("====");
					var totalCount = data["count"];
            		$.each(data["data"], function(index, item) {
            			if (null != item) {
            				sListResult +="<tr>"
                					  +"<td width=\"20px\" align=\"center\">" + item['nProductCode'] 
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
            		sListResult += "</table>";
					paging(productList, nPage, totalCount, "productListPaging");
				} else if (403 == data["status"]) {
					sListResult = "파라미터가 잘못 되었습니다.";
				} else {
					sListResult = "알수없는 오류가 발생하였습니다.";
				}
				
				$("#productList").html(sListResult);
			}	
		});
	}

	// 협력사 상품 리스트 조회
	function companyProductList(nPage) {
		var selectedValue = $("#fileCategorySelect option:selected").val();
		console.log(selectedValue);
		$.ajax({
			type:"GET",
			url:"http://localhost/controller/selectCompanyProductController.php",
			data: { "nCategorySeq" : selectedValue,
					"nPage": nPage,
					"nLimit": 20 },
			dataType:"json",
			contentType:"json",
			success:function(data) {
				var sListResult = "";
				if (200 == data["status"]) {
					sListResult = "<table id='CompanyProductTable' class='table table-bordered'>"
						+"<tr>"
							+"<th style=\"width: 50px;\" align=\"center\" onclick=\"sortTable(0)\"><strong>협력사명</strong></th>"
							+"<th style=\"width: 30px;\" align=\"center\">협력사 코드</th>"
							+"<th style=\"width: 200px;\" align=\"center\" onclick=\"sortTable(2)\"><strong>협력사 상품명</strong></th>"
							+"<th style=\"width: 10px;\" align=\"center\">협력사 URL</th>"
							+"<th style=\"width: 20px;\" align=\"center\">가격</th>"
							+"<th style=\"width: 20px;\" align=\"center\">모바일 가격</th>"
							+"<th style=\"width: 20px;\" align=\"center\">입력일</th>"
						+"</tr>";
						+"<tbody>"; 

					console.log(data);
					var totalCount = data["count"];
					console.log(totalCount);
            		$.each(data["data"], function(index, item) {
            			if (null != item) {
            				sListResult +="<tr><td width=\"50px\" align=\"center\">" + item['sCompanyName'] 
            			       		  +"<td width=\"30px\" align=\"center\">" + item['sCompanyCode']
            			       		  +"<td width=\"200px\">" + item['sCompanyProductName']
            			       		  +"<td width=\"10px\" align=\"center\"> <a href= " + item['sCompanyUrl'] +">ⓤ</a>" 
            			       		  +"<td width=\"20px\" align=\"center\">" + item['nCompanyProductPrice']
            			       		  +"<td width=\"20px\" align=\"center\">" + item['nCompanyProductMprice']
            			       		  +"<td width=\"20px\" align=\"center\">" + item['dtCompanyRegisterDate']
            			       +"</td></tr>";
            			       sListResult += "</tbody>";
            			}
            		});
            		paging(companyProductList, nPage, totalCount, "companyProductListPaging");
				} else if (403 == data["status"]) {
					sListResult = "파라미터가 잘못 되었습니다.";
				} else {
					sListResult = "알수없는 오류가 발생하였습니다.";
				}
				
				$("#companyProductList").html(sListResult);
			}	
		});
	}

	// 페이징 처리	
	function paging(fncList, nPage, nTotal, target) {
		nPage = parseInt(nPage);
		nTotal = parseInt(nTotal);
    	var nStart = (Math.ceil(nPage / 10) - 1) * 10 + 1;
    	var nLast = Math.ceil(nTotal / 20);
    	var sPagingHtml = "";
    	if (1 < nTotal) {
    		if (1 < nStart) {
    			sPagingHtml += "<a href=\"#\" id=\"1\">◀◀</a> ";
    			sPagingHtml += "<a href=\"#\" id=\"" + ((nPage == 1) ? 1 : (nPage-1)) + "\">◀</a> ";
    		}
    		for (var i=1; i<=10; i++) {
    			var nNum = i + ((nStart <= 10) ? 0 : (parseInt((nStart-1) / 10) * 10));
    			if (nNum == nPage) { 
    				sPagingHtml += "<a class=\"on\" href=\"#\" id=\"" + nNum + "\">" + nNum + "</a> ";
    			} else { 
    				sPagingHtml += "<a href=\"#\" id=\"" + nNum + "\">" + nNum + "</a>  ";
    			}
    			if (nNum == nLast) {
    				break;
    			}
    		}
    		if (nStart < nLast) {
    			sPagingHtml += "<a href=\"#\" id=\"" + ((nPage == nLast) ? nLast : (nPage + 10)) + "\">▶</a> ";
    			sPagingHtml += "<a href=\"#\" id=\"" + nLast + "\">▶▶</a>";
    		}
    	}
    	$("#" + target).html(sPagingHtml);
    	$("#" + target + " a").click(function (e) {
    		fncList($(this).attr("id"));
    	});
    } 
	
	// 기준 상품 테이블 정렬
	function sortTable(n) {
		  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		  table = document.getElementById("productTable");
		  switching = true;
		  dir = "asc";
		  while (switching) {
		    switching = false;
		    rows = table.rows;
		    for (i = 1; i < (rows.length - 1); i++) {
		      shouldSwitch = false;
		      x = rows[i].getElementsByTagName("td")[n];
		      y = rows[i + 1].getElementsByTagName("td")[n];
		      if (dir == "asc") {
		        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
		          shouldSwitch = true;
		          break;
		        }
		      } else if (dir == "desc") {
		        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
		         
		          shouldSwitch = true;
		          break;
		        }
		      }
		    }
		    if (shouldSwitch) {
		      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		      switching = true;
		      switchcount ++;
		    } else {
		     
		      if (switchcount == 0 && dir == "asc") {
		        dir = "desc";
		        switching = true;
		      }
		    }
		  }
		}

	// 협력사 상품 테이블 정렬
	function sortTable(n) {
		  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		  table = document.getElementById("CompanyProductTable");
		  switching = true;
		  dir = "asc";
		  while (switching) {
		    switching = false;
		    rows = table.rows;
		    for (i = 1; i < (rows.length - 1); i++) {
		      shouldSwitch = false;
		      x = rows[i].getElementsByTagName("td")[n];
		      y = rows[i + 1].getElementsByTagName("td")[n];
		      if (dir == "asc") {
		        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
		          shouldSwitch = true;
		          break;
		        }
		      } else if (dir == "desc") { //|| Number(x.innerHTML) > Number(y.innerHTML)
		        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
		          shouldSwitch = true;
		          break;
		        }
		      }
		    }
		    if (shouldSwitch) {
		      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		      switching = true;
		      switchcount ++;
		    } else {
		     
		      if (switchcount == 0 && dir == "asc") {
		        dir = "desc";
		        switching = true;
		      }
		    }
		  }
		}
</script>
</html>