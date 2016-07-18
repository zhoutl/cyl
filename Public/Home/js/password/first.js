$(document).ready(function(){
	$(".demoform").Validform({
		tiptype:3,
		btnSubmit:"#LFSubmit2",
		beforeSubmit:function(curform){
		    $.ajax({
		        type : 'POST',
		        url  : _URL+"/passwordFirst",
		        data : $(".demoform").serialize(),
		        cache: false,
		        async: false,
		        dataType:'Json',
		        error: function(request){
		            layer.msg('连接超时，请检查您的网络');
		        },
		        success:function(data){
		            if(data.status){
                        window.location.href = data.url;
                    }else{
                        change_verify();
                        layer.alert(data.msg);
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
    $("#code_img").attr("src",_APP+"/Common/verify/id/1?n="+Math.random());
}