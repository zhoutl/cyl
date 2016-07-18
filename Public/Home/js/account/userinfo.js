$(document).ready(function(){
	$(".demoform").Validform({
		btnSubmit:"#LFSubmit2",
        showAllError:true, 
		tiptype:3,
        beforeSubmit:function(curform){
            $.ajax({
                type :'POST',
                url  :_URL+'/userInfoSave',
                data :$('.demoform').serialize(),
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
                           location.reload();
                        });  
                    } else if(data.status == -1) {
                        layer.alert(data.msg,{
                           skin: 'layui-layer-molv',
                           closeBtn: 0
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
//省份AJAX
function choose_city () {
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



