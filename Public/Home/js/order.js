
$(".addForm").Validform({
	btnSubmit:"#addForm", 
	tiptype:3,
	showAllError:true,
	beforeSubmit:function(curform){
		$.ajax({
			cache: true,
			type: "POST",
			url:_APP+"/Account/addressAdd",
			data:$(".addForm").serialize(),// 你的formid
			async: false,
			error: function(request) {
			},
			success: function(data) {
				if(data.status == '-1'){
					window.location.href = _APP+'/Login/index';
				}else{
					if(data.status){
						window.location.reload();
					}else{
						layer.alert(data.msg);
					}
				}
			}
		});	
		return false;
	},
	callback:function(data){
	}
});

$(".editForm").Validform({
	btnSubmit:"#editForm", 
	tiptype:3,
	showAllError:true,
	beforeSubmit:function(curform){
		$.ajax({
			cache: true,
			type: "POST",
			url:_APP+"/Account/doEditor",
			data:$(".editForm").serialize(),// 你的formid
			async: false,
			error: function(request) {
			},
			success: function(data) {
				if(data.status == '-1'){
					window.location.href = _APP+'/Login/index';
				}else{
					if(data.status){
						window.location.reload();
					}else{
						layer.alert(data.msg);
					}
				}
			}
		});	
		return false;
	},
	callback:function(data){
	}
});