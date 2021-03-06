<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>码动电商管理平台-登录</title>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link rel="stylesheet" href="__PUBLIC__/Common/css/bootstrap.min.css">
<link rel="stylesheet" href="__PUBLIC__/Admin/css/login.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<script src="__PUBLIC__/Common/js/jquery-1.8.2.min.js"></script>
<script>
var _APP = "<?php echo "__APP__"; ?>";
var _URL = "<?php echo "__URL__"; ?>";
</script>
<script src="__PUBLIC__/Common/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="__PUBLIC__/Common/js/jform.css">
<script src="__PUBLIC__/Common/js/jform.js"></script>
<script src="__PUBLIC__/Common/js/layer/layer.js"></script>
<script src="__PUBLIC__/Admin/js/login.js"></script>
</head>
<body>
<div class="container">

  <div id="login_box">
    <div class="login">
	<form class="form-signin" id="loginfrom">
        <h2 class="form-signin-heading"><img src="__PUBLIC__/Admin/images/login_logo.jpg" alt="码动电商管理平台"></h2>
		<div class="width">
			<input type="text" name="account" class="form-control" placeholder="用户名" datatype="/^[0-9a-zA-Z]{1,10}$/" nullmsg="请输入用户名" errormsg="请输入正确格式的用户名" ajaxurl="<?php U('Index/checkUserName'); ?>" />	
		</div>
		<div class="width">
			<input type="password" name="password" class="form-control" placeholder="密码" datatype="/^[0-9a-zA-Z_]{6,16}$/" nullmsg="请输入密码" errormsg="请输入正确格式的密码"  />
		</div>
        <div class="width">
          <input type="text" name="code" class="form-control user_yzm" placeholder="验证码" datatype="s4-4"  nullmsg="请输入验证码" errormsg="验证码错误" />
          <div class="yzm"><img src="<?php echo U('Admin/Common/verify',array('id'=>1)); ?>" id="code_img" onclick="change_verify();" /></div>
        </div>
  
        <button class="btn btn-lg btn-primary btn-block" type="button" id="login">立即登录</button>
      </form>

    </div>
  </div>
  
</div>
</body>
</html>