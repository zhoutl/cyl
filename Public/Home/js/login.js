$(document).ready(function(){
    $("#loginfrom").Validform({
        btnSubmit:"#LFSubmit2", 
        tiptype:3,
        showAllError:true,
        beforeSubmit:function(curform){
            $.ajax({
                cache: true,
                type: "POST",
                url:_URL+"/login",
                data:$("#loginfrom").serialize(),
                async: false,
                error: function(request) {
                    layer.msg('连接超时，请检查您的网络');
                },
                success: function(data) {
                    if(data.status){
                        window.location.href = reffer_url;
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
$(document).keyup(function(event){
  if(event.keyCode ==13){
    $("#LFSubmit2").trigger("click");
  }
  });

