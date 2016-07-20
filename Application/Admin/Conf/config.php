<?php
return array(
	//name 导航名称  url 导航链接地址   hover 子菜单外键and选择状态(控制器名称) 
	'MAIN_MENU'=>array(
		array('name'=>'首页配置','url'=>'Home/index','hover'=>'Home','icon'=>'icon-home'),
		array('name'=>'管理员管理','url'=>'AdminUser/index','hover'=>'AdminUser','icon'=>'icon-home'),
		array('name'=>'会员管理','url'=>'Account/index','hover'=>'Account','icon'=>'icon-home'),
		array('name'=>'文章管理','url'=>'Article/index','hover'=>'Article','icon'=>'icon-home'),
	
	),
	
	//name 导航名称  url 导航链接地址  hover 选择状态  current 当前方法名  icon 图标class
	'CHILD_MENU'=>array(

		'Home'=>array(
			array('name'=>'BANNER管理','url'=>'Home/bannerList','hover'=>'bannerList,addBanner,editBanner','current'=>'bannerList','icon'=>'icon-wrench'),
			
		),
		'Article'=>array(
			array('name'=>'文章管理','url'=>'Article/articleList','hover'=>'articleList,addArticle,editArticle','current'=>'articleList','icon'=>'icon-wrench'),
		),
		
		
		'Account'=>array(
			array('name'=>'会员管理','url'=>'Account/accountList','hover'=>'accountList,addAccount,editAccount','current'=>'accountList','icon'=>'icon-wrench'),
			 array('name'=>'会员等级管理','url'=>'Account/accountLevelList','hover'=>'accountLevelList,addAccountLevel,editAccountLevel','current'=>'accountLevelList','icon'=>'icon-wrench'),
		),
		
		'AdminUser'=>array(
			array('name'=>'管理员管理','url'=>'AdminUser/adminUserList','hover'=>'adminUserList,addAdminUser,editAdminUser','current'=>'adminUserList','icon'=>'icon-wrench'),
			array('name'=>'角色管理','url'=>'AdminUser/adminRoleList','hover'=>'adminRoleList,addAdminRole,editAdminRole','current'=>'adminRoleList','icon'=>'icon-wrench'),
		),
		
	
		
	),
);
?>