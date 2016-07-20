<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<title>码动电商管理平台</title>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link rel="stylesheet" href="/cyl/Public/Common/css/bootstrap.min.css" />
<link rel="stylesheet" href="/cyl/Public/Admin/css/font-awesome.min.css" />
<link rel="stylesheet" href="/cyl/Public/Admin/css/style_new.css" />
<link rel="stylesheet" href="/cyl/Public/Admin/css/page.css" />
<!--[if IE 7]>
<link rel="stylesheet" href="/cyl/Public/Admin/css/font-awesome-ie7.min.css">
<![endif]-->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<script src="/cyl/Public/Common/js/jquery-1.8.2.min.js"></script>
<!--ADD FROM-->

<script src="/cyl/Public/Common/js/layer/layer.js"></script>

<script src="/cyl/Public/Common/js/laydate/laydate.js"></script>


  <!--dashboard-->
<script type="text/javascript" src="/cyl/Public/Admin/src/highcharts/highcharts.js"></script>
<script type="text/javascript" src="/cyl/Public/Admin/src/highcharts/exporting.js"></script>

<!--ADD FROM-->
<script src="/cyl/Public/Common/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/cyl/Public/Common/js/jform.css">
<script src="/cyl/Public/Common/js/jform.js"></script>
<script>
$(document).ready(function(e) {
    
	$("#adminForm").Validform({
		tiptype:3,
		showAllError:true
	});

});
//删除数据
function delete_data(id,url){
	var id = id;
	layer.confirm('确定要执行此操作？', {
		btn: ['确定','取消'] //按钮
		}, function(){
		  	$.post(url,{id:id},function(data){
				if(data.status == -1){
					window.location.href="<?php echo U('Index/index'); ?>";
				}else{
					if(data.status){
						$("tr[name=data_"+id+"]").remove();
					}
					layer.alert(data.msg);
				}

			},"JSON");
		}, function(){
		  
		}
	);
}

//ajax 更改状态   1显示  2隐藏
function change_state(id,type,url,obj){
	var s;
	var obj = $(obj);
	if(type == '1'){
		s = "change_state('"+id+"','2','"+url+"',this)";
	}else{
		s = "change_state('"+id+"','1','"+url+"',this)";
	}
	
	$.post(url,{id:id,type:type},function(data){
		if(data.status == -1){
			window.location.href="<?php echo U('Index/index'); ?>";
		}else{
			obj.attr('onclick',s);
		}
	},"JSON");
}
</script>
<script src="/cyl/Public/Admin/js/admin.js"></script>
</head>
<body>


<div class="">
    
    <!-- top_fixed_head -->
    <div class="top_fixed_head clearfix">
        <div class="logo f_l"><a href="<?php echo U('Admin/Welcome/index'); ?>"><img src="/cyl/Public/Admin/images/logo.png" alt="码动电商管理平台"></a></div>
        <div class="top_right f_r clearfix">
            <ul>
                <li><a href="<?php echo U('Wap/Index/index'); ?>" data-toggle="tooltip" data-placement="bottom" title="前台浏览"><i class="icon-desktop"></i></a></li>
                <li><a href="<?php echo U('Admin/Welcome/index'); ?>" data-toggle="tooltip" data-placement="bottom" title="管理首页"><i class="icon-dashboard"></i></a></li>
                <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="账号设置"><i class="icon-user"></i></a></li>
                <li><a href="<?php echo U('Admin/System/systemConfig'); ?>" data-toggle="tooltip" data-placement="bottom" title="系统设置"><i class="icon-wrench"></i></a></li>
                <li><a href="<?php echo U('Admin/Index/logout'); ?>" data-toggle="tooltip" data-placement="bottom" title="退出"><i class="icon-off"></i></a></li>
            </ul>
        </div>
    </div>
    <!-- /top_fixed_head -->

    <div class="HeadMenu">
        <div class="clearfix">
        <ul>
			<li><a href="<?php echo U('Welcome/index'); ?>" <?php if(CONTROLLER_NAME == 'Welcome'){ echo 'class="checked"';} ?>><i class="icon-home"></i>管理首页</a></li>
			<?php foreach($data['main_menu'] as $v): ?>
				<li><a href="<?php echo U($v['url']); ?>" <?php if($data['hover'] == $v['hover']){ echo 'class="checked"';} ?>><i class="<?php echo $v['icon']; ?>"></i><?php echo $v['name']; ?></a></li>
			<?php endforeach; ?>
        </ul>
        </div>
    </div>


</div>