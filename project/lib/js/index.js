$(document).ready(function() {
        	$("#btnUpload").click(function(){
        		fileUpload();
        	});

        	// 로딩 화면 구성
        	$(document).ajaxStart(function(){
            	loadingStart();
        	})
        	.ajaxStop(function(){
            	loadingStop();
            });
                        
        });

		// 파일 업로드 부분
        function fileUpload() {
        	var form = $("#uploadForm")[0];
        	var formData = new FormData(form);
        	formData.append('uploadFile', $("#uploadFile")[0].files[0]);
        
        	$.ajax({
        		type : "POST",
        		url : "http://localhost/controller/insertProcess.php",
        		data : formData,
        		dataType : "json",
        		mimeType: "multipart/form-data",
        		contentType: false,
                processData: false,
                cache: false,
                success : function(data) {
        					console.log(data);
        					console.log(data['status']);
            		if(201 == parseInt(data['status'])){
                			alert("데이터 업로드 성공!");
                	} else if(204 == parseInt(data['status'])) {
                		alert("파일 데이터가 맞지 않습니다. 다시 확인해주세요.");
                    } else {
					 	aler("파일 데이터 업로드에 실패하였습니다.");	
                    }
        		},
        		error : function(data, status, xhr) {
        			alert("알수없는 에러가 났습니다.");
        		}
        	});
        }
     
        // 로딩 화면 시작
        function loadingStart() {
	        if("undefined" == typeof($("#mask").val())) {
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
