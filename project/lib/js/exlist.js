$(document).ready(function(){
	// 카테고리 리스트 조회
	getCategoryList();

	$("#btnCategory").click(function(){
		productList(1);
		companyProductList(1);
	});

	// 로딩 화면 구성
	$(document).ajaxStart(function(){
     	loadingStart();
 	})
 	.ajaxStop(function(){
     	loadingStop();
     });
	
	// 기준상품 엑셀 다운로드
	$("#btnProductExcelDownload").click(function() {
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#productList').html()));
	});
 
	//협력사 상품 엑셀 다운로드
	$("#btnCompanyProductExcelDownload").click(function() {
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#companyProductList').html()));
	});
});
    
   // 카테고리 리스트 조회
   function getCategoryList() {
   	$.ajax({
   		type:"GET",
   		url:"http://localhost/controller/selectCategory.php",
   		dataType:"json",
   		contentType:"json",
   		success:function(data) {
   			var sListResult = "";
   			if (200 == data["status"]) {
   				sListResult ="<select id=\"fileCategorySelect\" name=\"fileCategorySelect\"><option value=\" \">선택</option>"
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
   	$.ajax({
   		type:"GET",
   		url:"http://localhost/controller/selectProduct.php",
   		data: {"nCategorySeq" : selectedValue,
   			   "nPage": nPage,
   			   "nLimit": 20,
			   "sOrder": $("#hdnProductOrder").val(), 
			   "sSort": $("#hdnProductSort").val(), 
			  },
   		dataType:"json",
   		contentType:"json",
   		success:function(data) {
   			var sListResult = "";
   			if (200 == data["status"]) {
   				sListResult = "<table id=\"productTable\" class=\"table table-bordered\">"
   					+"<tr>"
   						+"<th style=\"width: 20px; text-align: center; cursor: pointer;\" onclick=\"sortProductTable(0)\">상품코드 <span id=\"spnArrowProductCode\">▼</span></th>"
   						+"<th style=\"width: 50px;\" align=\"center\">카테고리</th>"
   						+"<th style=\"width: 120px; text-align: center; cursor: pointer;\" onclick=\"sortProductTable(2)\">상품명 <span id=\"spnArrowProductName\">▼</span></th>"
   						+"<th style=\"width: 20px; text-align: center; cursor: pointer;\" onclick=\"sortProductTable(3)\">최저가 <span id=\"spnArrowProductLowPrice\">▼</span></th>"
   						+"<th style=\"width: 60px; text-align: center; cursor: pointer;\" onclick=\"sortProductTable(4)\">모바일최저가 <span id=\"spnArrowProductMlowPrice\">▼</span></th>"
   						+"<th style=\"width: 20px;\" align=\"center\">평균가</th>"
   						+"<th style=\"width: 20px; text-align: center; cursor: pointer;\" onclick=\"sortProductTable(6)\">업체수 <span id=\"spnArrowProductCompanyNum\">▼</span></th>"
   					+"</tr>";
   					+"<tbody>"; 
   				var totalCount = data["count"];
            		$.each(data["data"], function(index, item) {
            			if (null != item) {
            				sListResult +="<tr>"
                					  +"<td align=\"center\">" + item['nProductCode'] 
            			       		  +"<td align=\"center\">" + item['nProductCategoryCode']
            			       		  +"<td>" + item['sProductName']
            			       		  +"<td align=\"center\">" + item['nProductLowPrice']
            			       		  +"<td align=\"center\">" + item['nProductMlowPrice']
            			       		  +"<td align=\"center\">" + item['nProductAvgPrice']
            			       		  +"<td align=\"center\">" + item['nProductCompanyNum']
            			       +"</td></tr>";
            			       sListResult += "</tbody>";
            			}
            		});
   				// 페이징 관련 처리
   				paging(productList, nPage, totalCount, "productListPaging");

   			} else if (403 == data["status"]) {
   				sListResult = "카테고리를 선택하여 주세요.";
   			} else {
   				sListResult = "알수없는 오류가 발생하였습니다.";
   			}
   			
   			$("#productList").html(sListResult);
   			arrowProductPrint(); // 정렬 화살표 표시
   		}	
   	});
   }
   
   // 협력사 상품 리스트 조회
   function companyProductList(nPage) {
   	var selectedValue = $("#fileCategorySelect option:selected").val();
   	$.ajax({
   		type:"GET",
   		url:"http://localhost/controller/selectCompanyProduct.php",
   		data: { "nCategorySeq" : selectedValue,
   				"nPage": nPage,
   				"nLimit": 20, 
   				"sOrder": $("#hdnCompanyProductOrder").val(), 
 			    "sSort": $("#hdnCompanyProductSort").val() 
   			  },
   		dataType:"json",
   		contentType:"json",
   		success:function(data) {
   			var sListResult = "";
   			if (200 == data["status"]) {
   				sListResult = "<table id=\"companyProductTable\" class=\"table table-bordered\">"
   					+"<tr>"
   						+"<th style=\"width: 50px; align: center;\">협력사명</th>"
   						+"<th style=\"width: 30px;\" align=\"center\">협력사 코드</th>"
   						+"<th style=\"width: 120px; align: center; cursor: pointer;\" onclick=\"sortCompanyProductTable(2)\">협력사 상품명 <span id=\"spnArrowCompanyProductName\">▼</span> </th>"
   						+"<th style=\"width: 10px;\" align=\"center\">협력사 URL</th>"
   						+"<th style=\"width: 20px;\" align=\"center\">가격</th>"
   						+"<th style=\"width: 20px;\" align=\"center\">모바일 가격</th>"
   						+"<th style=\"width: 120px; align: center; cursor: pointer;\" onclick=\"sortCompanyProductTable(6)\">입력일 <span id=\"spnArrowCompanyProductRegisterDate\">▼</span></th>"
   					+"</tr>";
   					+"<tbody>";
    
   				console.log(data);
   				var totalCount = data["count"];
   				console.log(totalCount);
            		$.each(data["data"], function(index, item) {
            			if (null != item) {
            				sListResult +="<tr>"
                					  +"<td align=\"center\">" + item['sCompanyName'] 
            			       		  +"<td align=\"center\">" + item['sCompanyCode']
            			       		  +"<td>" + item['sCompanyProductName']
            			       		  +"<td align=\"center\"> <a href= " + item['sCompanyUrl'] +" target=\"_blank\">ⓤ</a>" 
            			       		  +"<td align=\"center\">" + item['nCompanyProductPrice']
            			       		  +"<td align=\"center\">" + item['nCompanyProductMprice']
            			       		  +"<td align=\"center\">" + item['dtCompanyRegisterDate']
            			       +"</td></tr>";
            			       sListResult += "</tbody>";
            			}
            		});
            		paging(companyProductList, nPage, totalCount, "companyProductListPaging");
   			} else if (403 == data["status"]) {
   				sListResult = "카테고리를 선택하여 주세요.";
   			} else {
   				sListResult = "알수없는 오류가 발생하였습니다.";
   			}
   			
   			$("#companyProductList").html(sListResult);
   			arrowCompanyProductPrint(); // 협력사 상품 화살표
   		}	
   	});
   }
    
   // 페이징 관련 부분	
   function paging(fncList, nPage, nTotal, target) {
   	nPage = parseInt(nPage);
   	nTotal = parseInt(nTotal);
    	var nStart = (Math.ceil(nPage / 10) - 1) * 10 + 1;
    	var nLast = Math.ceil(nTotal / 20);
    	var sPaginghtml = "";
    	if (1 < nTotal) {
    		if (1 < nStart) {
    			sPaginghtml += "<a href=\"#\" id=\"1\">[처음]</a> ";
    			sPaginghtml += "<a href=\"#\" id=\"" + ((nPage == 1) ? 1 : (nPage - 10)) + "\"> < </a> ";
    		}
    		for (var i=1; i<=10; i++) {
    			var nNum = i + ((nStart <= 10) ? 0 : (parseInt((nStart-1) / 10) * 10));
    			if (nNum == nPage) { 
    				sPaginghtml += "<a class=\"on\" href=\"#\" id=\"" + nNum + "\">" + nNum + "</a> ";
    			} else { 
    				sPaginghtml += "<a href=\"#\" id=\"" + nNum + "\">" + nNum + "</a>  ";
    			}
    			if (nNum == nLast) {
    				break;
    			}
    		}
    		if (nStart < nLast) {
        		if(nPage == nLast){
            		nPage = nLast; 
        		} else {
            		if((nPage > nLast-10) && (nPage <= nLast)){
            			sPaginghtml += "<a href=\"#\" id=\"\">  </a> "; 
            		} else {
            			sPaginghtml += "<a href=\"#\" id=\"" + (nPage + 10) + "\"> > </a> ";
            			sPaginghtml += "<a href=\"#\" id=\"" + nLast + "\">[끝]</a>";
                	}
        		}	
    		}
    	}
    	$("#" + target).html(sPaginghtml);
    	$("#" + target + " a").click(function (e) {
    		fncList($(this).attr("id"));
    	});
    } 
   
   // 기준 상품 테이블 정렬
   function sortProductTable(n) {
    	var firstProductOrderSelect = $("#hdnProductOrder").val();
    	
	switch (n) {
    		case 0:
    			 $("#hdnProductOrder").val("nProductCode");
   			break;
    		case 2:
    			$("#hdnProductOrder").val("sProductName");
        		break;
    		case 3:
    			$("#hdnProductOrder").val("nProductLowPrice");
        		break;
    		case 4:
    			$("#hdnProductOrder").val("nProductMlowPrice");
        		break;
    		case 6:
    			$("#hdnProductOrder").val("nProductCompanyNum");
        		break;
   	}
   	var nowProductOrderSelect = $("#hdnProductOrder").val();
    	 		
	if(firstProductOrderSelect == nowProductOrderSelect) {
    		if ("DESC" == $("#hdnProductSort").val()) {
        		$("#hdnProductSort").val("ASC");
        	} else {
        		$("#hdnProductSort").val("DESC");
        	}
	} else {
		$("#hdnProductSort").val("DESC");
	}
   	productList(1);
   }

   // 협력사 상품 테이블 정렬
   function sortCompanyProductTable(n) {
    		var firstProductCompanyOrderSelect = $("#hdnCompanyProductOrder").val();
        	switch (n) {
            	case 2:
            		$("#hdnCompanyProductOrder").val("sCompanyProductName");
                break;
            	case 6:
            		$("#hdnCompanyProductOrder").val("dtCompanyRegisterDate");
                	break;
    		}
        	var nowProductCompanyOrderSelect = $("#hdnCompanyProductOrder").val();

            if(firstProductCompanyOrderSelect == nowProductCompanyOrderSelect) {
        		if ("DESC" == $("#hdnCompanyProductSort").val()) {
        			$("#hdnCompanyProductSort").val("ASC");
        		} else {
        			$("#hdnCompanyProductSort").val("DESC");
        		}
            } else {
            	$("#hdnCompanyProductSort").val("DESC");
            }
    		companyProductList(1);
   	}

   // 기준 상품 화살표 방향 표시 
function arrowProductPrint() {
	var arrow = "";
	if ("DESC" == $("#hdnProductSort").val()) {
		arrow = "▼";
	} else {
		arrow = "▲";
	}

	if ("nProductCode" == $("#hdnProductOrder").val()) {
		$("#spnArrowProductCode").html(arrow);
	}
	
	if("sProductName" == $("#hdnProductOrder").val()) {
		$("#spnArrowProductName").html(arrow);
	}

	if("nProductLowPrice" == $("#hdnProductOrder").val()) {
		$("#spnArrowProductLowPrice").html(arrow);
	}

	if("nProductMlowPrice" == $("#hdnProductOrder").val()) {
		$("#spnArrowProductMlowPrice").html(arrow);
	}

	if("nProductCompanyNum" == $("#hdnProductOrder").val()) {
		$("#spnArrowProductCompanyNum").html(arrow);
	}
	
}

// 협력사 상품 화살표 방향 표시 
function arrowCompanyProductPrint() {
	var arrow = "";
	if ("DESC" == $("#hdnCompanyProductSort").val()) {
		arrow = "▼";
	} else {
		arrow = "▲";
	}

	if ("sCompanyProductName" == $("#hdnCompanyProductOrder").val()) {
		$("#spnArrowCompanyProductName").html(arrow);
	}
	
	if("dtCompanyRegisterDate" == $("#hdnCompanyProductOrder").val()) {
		$("#spnArrowCompanyProductRegisterDate").html(arrow);
	}
	
}

// 로딩 화면 시작
    function loadingStart() {
        if("undefined" == typeof ($("#mask").val())) {
    		loadingPrint();
    	}
        $("#divLoadingWrap").css("display", "block");
    }

// 로딩 화면 끝내기
    function loadingStop() {
    	$("#divLoadingWrap").css("display", "none");
    }		

// 로딩 화면 그리기
    function loadingPrint() {
	$("body").append("<div id=\"divLoadingWrap\" class=\"wrap-loading\" style=\"display: none;\"><div><img src=\"/lib/img/Progress_loading_img.gif\"/></div></div>");
	$(".wrap-loading").css({"position": "fixed", "left": "0px", "right": "0px", "top": "0px", "bottom": "0px", "background": "rgba(0,0,0,0.2)", "filter": "progid:DXImageTransform.Microsoft.Gradient(startColorstr='#20000000', endColorstr='#20000000')"});
	$(".wrap-loading div").css({"position": "fixed", "top": "50%", "left": "50%", "margin-left": "-21px", "margin-top": "-21px"}); 
}
