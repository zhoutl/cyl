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

    //验证码发送AJAX
    $(".regphone").click(function(){
        $.ajax({
            type:'POST',
            url:_URL+'/sendCode',
            data:{uname:$('#uname').text(),sendtype:'1'},
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
                    setTimeout(function(){
                       settime(); 
                    },2000);
                }
            }
        });
    });

    //AJAX提交
	$(".demoform").Validform({
		tiptype:3,
        btnSubmit:"#LFSubmit2",
        beforeSubmit:function(){
            $.ajax({
            	type : 'POST',
                url  :  _URL+'/passwordSecond',
                data : {uname:$('#uname').text(),code:$('#code').val()},
                cache: false,
                async: false,
                dataType:'Json',
                error:function(request){
                    layer.msg('连接超时，请检查您的网络');
                },
                success:function(data){
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

