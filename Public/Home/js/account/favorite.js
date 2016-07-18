//删除函数
function choose_delete(id) {
    layer.confirm('确定取消该收藏?',{
        time:0,
        btn: ['同意', '取消'],
        yes:function(index){
            $.ajax({
                type:'POST',
                url :_URL+'/favoriteDelete',
                data:{account_favorite_id:id},
                cache:false,
                async:false,
                dataType:'Json',
                error:function(result) {
                    layer.msg('连接超时，请检查您的网络');
                },
                success:function(data){
                    if (data.status == 1) {
                        $("tr[name=data_"+id+"]").remove();
                          layer.closeAll();
                    } else if (data.status == -1) {
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

function choose_deletes() {
	var active_id = new Array();
	var i=0;
    $('.choose').each(function(){
        if($(this).hasClass('active')){
           active_id[i] = $(this).attr('id');
           //$("tr[name=data_"+active_id[i]+"]").remove();
           i++;
        }
    })

    if (active_id.length <= 0) {
        layer.alert('还没有选择你要移出的收藏',{
        
        });
        return false;
    }

    layer.confirm('确定移除收藏?',{
        time:0,
        btn: ['同意', '取消'],
        yes:function(index){
        	$.ajax({
        	    type:'POST',
                url :_URL+'/favoriteDelete',
                data:{account_favorite_id:active_id},
                cache:false,
                async:true,
                dataType:'Json',
                error:function(result) {
                   layer.msg('连接超时，请检查您的网络');
                },
                success:function(data) {
                   if (data.status == 1) {
                   	   for (var i = active_id.length - 1; i >= 0; i--) {
                   	   	    $("tr[name=data_"+active_id[i]+"]").remove();
                   	   }
                       layer.closeAll();
                    } else if (data.status == -1) {
                        layer.alert(data.msg,{
                        skin: 'layui-layer-molv',
                        closeBtn: 0
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
    })
}