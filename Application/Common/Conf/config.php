<?php
return array(
	'MODULE_ALLOW_LIST'    =>    array('Home','Admin','Wap'),  //允许访问的模块
	'DEFAULT_MODULE'     => 'Wap', //默认模块
    'URL_MODEL'          => '2', //URL模式
	// 'LOAD_EXT_CONFIG' => 'alipay,unionpay,wxpay',    //扩展配置
	
	
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '120.27.127.77', // 服务器地址
	'DB_NAME'   => 'cheyouli', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '7428ebbd43', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'cyl_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
	
	'TMPL_ACTION_SUCCESS'=>'Common:success',//跳转成功提示配置
    'TMPL_ACTION_ERROR'=>'Common:error',//跳转失败提示配置
    'SESSION_OPTIONS'    => array('type'=> 'db','expire'=>3600*24,),//将session值存入数据库
    'SESSION_TABLE'=>'cyl_session',
	'POINTS'=>array(
		'USE_RATIO'=>0.2,
		'ADD_ORDER_POINT'=>3,
		'EXCHANGE_RATIO'=>100,
	),
	'GROWTH'=>array(
		'ADD_ORDER_GROWTH'=>3,
	),
);
?>