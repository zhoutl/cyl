//验证码倒计时
var countdown=10; 
function settime() { 
    if (countdown == 0) {    
        countdown = 10; 
        $('.regphone').html('重新获取');
        $(".regphone").removeAttr("disabled").css('color','#333');
        return;
    } else { 
        countdown--; 
        $('.regphone').html(countdown+'\' 后重新获取').css('color','#979494');
    } 
setTimeout(function() {settime() },1000) 
}

$(document).ready(function(){
    //获得焦点置空
    $("#uname").focus(function(){
        $('#erorrmsg').attr('class','Validform_checktip').html('');
    });
    //验证码发送AJAX
    $(".regphone").click(function(){
        $.ajax({
            type:'POST',
            url:_URL+'/sendCode',
            data:{uname:$('#uname').val()},
            cache:false,
            async:false,
            dataType:'Json',
            error:function(result) {
                layer.msg('连接超时，请检查您的网络');
            },
            success:function(data) {
               if (data.status == 0) {
                    layer.alert(data.msg);
                } else {
                    $(".regphone").attr("disabled","");
                    $('.regphone').html('发送中~~');
                    $(".regphone").css('color','#333'); 
                    setTimeout(function() {
                        settime();
                    },2000);   
                }
            }
        });
    });
    //用户注册协议
    $('#registr_protocol_btn').on('click',function(){
        layer.open({
            type: 1,
            title: '《用户注册协议》',
            move: ['.xubox_title', true],
            area : ['680px' , '500px'],
            content: $('.registr_protocol')
        });
        return false;

    })
    
    //注册跳转AJAX
    $("#registerform").Validform({
        btnSubmit:"#LFSubmit2", 
        tiptype:3,
        showAllError:true,
        beforeSubmit:function(curform){
            $.ajax({
                cache: false,
                type: "POST",
                url:_URL+"/register",
                data:$("#registerform").serialize(),
                async: false,
                error: function(request) {
                    layer.msg('连接超时，请检查您的网络');
                },
                success: function(data) {
                    if(data.status){
                        window.location.href= data.url;
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