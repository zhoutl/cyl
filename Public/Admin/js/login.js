$(document).ready(function(){
	$("#loginfrom").Validform({
		btnSubmit:"#login", 
		tiptype:3,
		beforeSubmit:function(curform){
			$.ajax({
				cache: true,
				type: "POST",
				url:_URL+"/doLogin",
				data:$("#loginfrom").serialize(),
				async: false,
				error: function(request) {
					layer.msg('连接超时，请检查您的网络');
				},
				success: function(data) {
					if(data.status){
						window.location.href=_APP+"/Admin/Welcome/index";
					}else{
						change_verify();
						layer.msg(data.msg);
					}
				}
			});	
			return false;
		},
		callback:function(data){
		}
	});		
});


function change_verify(){
	$("#code_img").attr("src",_APP+"/Admin/Common/verify/id/1?n="+Math.random());
}

