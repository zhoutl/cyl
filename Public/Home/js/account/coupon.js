function getCoupon (id) {
    $.ajax({
        type:'POST',
        url :_APP+'/Account/getCoupon',
        data:{coupon_id:id},
        cache:false,
        async:false,
        dataType:'Json',
        error:function(result) {
            alert('连接超时，请检查您的网络');
        },
        success:function(data) {
            if (data.status == 1) {
                layer.alert(data.msg,{
                
                },function(){
                    window.location.href = _APP+'/Account/myCoupon';
                });  
            } else if(data.status == -1) {
                      layer.alert(data.msg,{
                      
                },function(){
                    window.location.href = _APP+'/Login/index';
                  }); 
            }else{
                   layer.alert(data.msg,{
                   
                   },function(){
                       window.location.href = _APP+'/Account/myCoupon';
                   });
            }
        }
    });
}