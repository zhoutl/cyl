$(document).ready(function(){
	$(".demoform").Validform({
		tiptype:3,
        btnSubmit:"#LFSubmit2",
        showAllError:true,
        beforeSubmit:function(curform){
            $.ajax({
                cache: true,
                type: "POST",
                url:_URL+"/addressAdd",
                data:$('.demoform').serialize(),
                async: false,
                error: function(request) {
                    layer.msg('连接超时，请检查您的网络');
                },
                success: function(data) {
                    if (data.status == 1) {
                        layer.alert(data.msg,{
                           
                        },function(){
                           location.reload();
                        });  
                    } else if(data.status == -1) {
                        layer.alert(data.msg,{
                           
                        },function(){
                           window.location.href = _APP+'Login/index';
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
//省份AJAX
function choose_city () {
    //将area置空
    $('#city').html('<option value="">请选择城市</option>');
    $('#area').html('<option value="">请选择区域</option>');
    $.ajax({
        type:'POST',
        url :_APP+'/Common/city',
        data:{pid:$('#province').val()},
        cache:false,
        async:false,
        dataType:'Json',
        error:function(result) {
            layer.msg('连接超时，请检查您的网络');
        },
        success:function(data) {
            $('#city').html(data.html);
        }
    });
}
//区域AJAX
function choose_area () {
    $('#area').html('<option value="">请选择区域</option>');
    $.ajax({
        type:'POST',
        url :_APP+'/Common/area',
        data:{pid:$('#city').val()},
        cache:false,
        async:false,
        dataType:'Json',
        error:function(result) {
            layer.msg('连接超时，请检查您的网络');
        },
        success:function(data) {
            $('#area').html(data.html);
        }
    });
}
//设置默认
function choose_default (id) {
    $.ajax({
        type:'POST',
        url :_URL+"/setDefault",
        data:{account_address_id:id,is_default:1},
        cache:false,
        async:false,
        dataType:'Json',
        error:function(result) {
            layer.alert('连接超时，请检查您的网络');
        },
        success:function(data) {
            if (data.status == -1) {
                layer.alert(data.msg,{
                
                },function(){
                  window.location.href = _APP+'/Login/index';
                });
            }
        }
    });
}
 
//删除地址
    function choose_delete(id){
        layer.confirm("确定删除该收货地址？", {
            time: 0, //不自动关闭
            btn: ['同意', '取消'],
            yes: function(index){
                $.ajax({
                    type:'POST',
                    url :_URL+"/setDelete",
                    data:{account_address_id:id},
                    cache:false,
                    async:false,
                    dataType:'Json',
                    error:function(result) {
                        layer.msg('连接超时，请检查您的网络');
                    },
                    success:function(data) {
                       if (data.status == 1) {
                           $("tr[name=data_"+id+"]").remove();
                           layer.closeAll();
                       } else if(data.status == -1) {
                           layer.alert(data.msg,{
                           
                        },function(){
                           window.location.href = _APP+'/Login/index';
                        });
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
    }

