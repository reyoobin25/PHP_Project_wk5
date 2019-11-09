<!doctype html>
<html>
<head>
<script src="/lib/jquery/3.4.1/jquery.min.js"></script>
<script src="/lib/bootstrap/bootstrap.min.js"></script>
<link href="/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
.paging {
	width: 100%;
	text-align: center;
	vertical-align: middle;
}

.paging a.on {
	font-weight: bold;
	color: red;
}
</style>
</head>
<body style="overflow-x: hidden">
	<a href="http://lyb.danawa.com/index.php">엑셀 입력</a> &nbsp; / &nbsp;
	<a href="http://lyb.danawa.com/exlist.php">조회</a>
	<br />

	<!-- 카테고리 선택 부분 -->
	카테고리 :
	<div id="categoryList" style="display: inline;"></div>
	<input type="submit" id="btnCategory" name="btnCategory" value="찾기" class="btn btn-primary" />
	<div class="row">

		<!-- 기준상품 리스트 부분 -->
		<div class="col-6">
			기준 상품
			<button type="button" id="btnProductExcelDownload"
				name="btnProductExcelDownload">엑셀 다운로드</button>
			<input type="hidden" id="hdnProductOrder" value="nProductCode" /> 
			<input type="hidden" id="hdnProductSort" value="DESC" /> <br /> <br />
			<div id="productList"></div>
			<div id="productListPaging" class="paging"></div>
		</div>

		<!-- 협력사상품 리스트 부분 -->
		<div class="col-6">
			협력사 상품
			<button type="button" id="btnCompanyProductExcelDownload"
				name="btnCompanyProductExcelDownload">엑셀 다운로드</button>
			<br />
			<br />
			<div id="companyProductList"></div>
			<div id="companyProductListPaging" class="paging"></div>
			<input type="hidden" id="hdnCompanyProductOrder" value="sCompanyCode" />
			<input type="hidden" id="hdnCompanyProductSort" value="DESC" />
		</div>
	</div>
	
	<!-- exlist 관련 자바스크립트 파일 -->
    <script src="/lib/js/exlist.js?id=3"></script>
</body>
</html>