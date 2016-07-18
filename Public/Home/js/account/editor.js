$(document).ready(function(){
    $(".demoform").Validform({
        btnSubmit:"#LFSubmit2", 
        tiptype:3,
        beforeSubmit:function(curform){
            $.ajax({
                type :'POST',
                url  :_URL+'/doEditor',
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
                          
                        },function(){
                           window.location.href = _APP+'/Login/index';
                        }); 
                    }else{
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

//省份AJAX
function choose_city () {
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