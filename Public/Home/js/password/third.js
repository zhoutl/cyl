$(document).ready(function(){
	$(".demoform").Validform({
		tiptype:3,
        btnSubmit:"#LFSubmit2",
        beforeSubmit:function(){
            $.ajax({
                type:'POST',
                url :_URL+'/passwordThird',
                data:$(".demoform").serialize(),
                dataType:'Json',
                cache:false,
                async:false,
                error:function (result) {
                   layer.msg('连接超时，请检查您的网络');
                },
                success:function (data) {
                	if(data.status){
                        window.location.href = data.url;
                    } else {
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

