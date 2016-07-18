<?php
return array(
	//PC支付配置
	'ALIPAY'=>array(
		'PARTNER'     		=> '2088511788474022', 					//合作身份者id，以2088开头的16位纯数字
		'KEY'          		=> '4qr2yeglkbahqc014xpdndmjp57fi111',  //安全检验码，以数字和字母组成的32位字符
		'SELLER_EMAIL'      => 'gujinggfsc@126.com',                //签约支付宝账号或卖家支付宝帐户
		'RETURN_URL'		=> '',									//PC同步回调地址
		'NOTIFY_URL'		=> '',									//PC异步回调地址
		'REFUND_NOTIFY_URL' => '',									//退款回调地址
		'SIGN_TYPE'			=> 'MD5',								//签名方式 不需修改
		'INPUT_CHARSET'		=> 'utf-8',								//字符编码格式 目前支持 gbk 或 utf-8
		'TRANSPORT'			=> 'http',								//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
	),
	//WAP版支付配置
	'MALIPAY'=>array(
		
	),

	
);
?>