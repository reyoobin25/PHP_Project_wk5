<!doctype html>
<html>
<head>
<script src="/lib/jquery/3.4.1/jquery.min.js"></script>
<script src="/lib/bootstrap/bootstrap.min.js"></script>
<link href="/lib/bootstrap/bootstrap.min.css" rel="stylesheet">

</head>
<body>
	<a href="http://lyb.danawa.com/index.php">엑셀 입력</a> &nbsp; / &nbsp;
	<a href="http://lyb.danawa.com/exlist.php">조회</a>
	<br />

	<form name="uploadForm" id="uploadForm">
		<select id="fileCategorySelect" name="fileCategorySelect">
			<option value="">선택</option>
			<option value="product" id="product">기준상품</option>
			<option value="company_product" id="company_product">협력사상품</option>
		</select> <input type="file" id="uploadFile" name="uploadFile" /> <input
			type="button" id="btnUpload" value="등록" class="btn btn-primary" />
	</form>
	
	<!-- index관련 자바스크립트 파일 -->
	<script src="/lib/js/index.js"></script>    
</body>
</html>