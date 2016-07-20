<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo ($message); ?></title>

</head>

<body style="box-sizing: border-box; font: 14px 'Microsoft YaHei', '黑体', '宋体', Arial, Lucida Grande, Tahoma, sans-serif;">
    <div style="width:100%;text-align: center; padding:18% 0;">
        <div style="width:84px; height:65px; background:url(/cyl/Public/Admin/images/xz.jpg) no-repeat; background-size:100%; display:inline-block;">
        	
        </div>
        <div style="font-size:2em; color:#333; line-height: 1.6em; margin-top:1.3em;">       <?php echo ($message); ?>
        </div>
        <div style="color:#666; font-size: 0.9em;">
            页面自动<a id="href" href="<?php echo ($jumpUrl); ?>">跳转</a>等待时间：&nbsp;&nbsp;&nbsp;&nbsp;
            
            <span id="wait"><?php echo ($waitSecond); ?></span>
        </div>
    </div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>