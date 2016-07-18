$(document).ready(function(){
	$(".demoform").Validform({
		tiptype:3,
        btnSubmit:"#LFSubmit2",
        showAllError:true,
        beforeSubmit:function(curform){
            $.ajax({
                type:'POST',
                url :_URL+'/passwordEditor',
                data:$('.demoform').serialize(),
                cache:false,
                async:false,
                dataType:'Json',
                error:function(result) {
                    layer.msg('连接超时，请检查您的网络');
                },
                success:function(data) {
                	if (data.status == 1) {
                        layer.alert(data.msg,{
                           
                        },function(){
                            window.location.href = _URL+'/index';
                           //location.reload();
                        });  
                    } else if(data.status == -1) {
                        layer.alert(data.msg,{
                           
                        },function(){
                           window.location.href = _APP+'/Login/index';
                        }); 
                    }else{
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
