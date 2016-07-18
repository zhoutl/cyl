<?php
return array(
	//name 导航名称  url 导航链接地址   hover 子菜单外键and选择状态(控制器名称) 
	'MAIN_MENU'=>array(
		array('name'=>'系统配置','url'=>'System/index','hover'=>'System','icon'=>'icon-home'),
		array('name'=>'管理员管理','url'=>'AdminUser/index','hover'=>'AdminUser','icon'=>'icon-home'),
		array('name'=>'会员管理','url'=>'Account/index','hover'=>'Account','icon'=>'icon-home'),
		array('name'=>'文章管理','url'=>'Article/index','hover'=>'Article','icon'=>'icon-home'),
		// array('name'=>'商品管理','url'=>'Item/index','hover'=>'Item','icon'=>'icon-home'),
		// array('name'=>'券类管理','url'=>'Vouchers/index','hover'=>'Vouchers','icon'=>'icon-home'),
		// array('name'=>'促销管理','url'=>'Promotion/index','hover'=>'Promotion','icon'=>'icon-home'),
		// array('name'=>'订单管理','url'=>'Order/index','hover'=>'Order','icon'=>'icon-home'),
		// array('name'=>'退货管理','url'=>'OrderRefund/index','hover'=>'OrderRefund','icon'=>'icon-home'),
		// array('name'=>'评论管理','url'=>'Comment/index','hover'=>'Comment','icon'=>'icon-home'),
	),
	
	//name 导航名称  url 导航链接地址  hover 选择状态  current 当前方法名  icon 图标class
	'CHILD_MENU'=>array(
		'System'=>array(
			array('name'=>'系统配置','url'=>'System/systemConfig','hover'=>'systemConfig','current'=>'systemConfig','icon'=>'icon-wrench'),
			array('name'=>'友情链接','url'=>'System/linkList','hover'=>'linkList,addLink,editLink','current'=>'linkList','icon'=>'icon-laptop'),
			array('name'=>'配送管理','url'=>'System/deliveryModeList','hover'=>'deliveryModeList,addDeliveryMode,editDeliveryMode','current'=>'deliveryModeList','icon'=>'icon-laptop'),
		),
		'Article'=>array(
			array('name'=>'文章管理','url'=>'Article/articleList','hover'=>'articleList,addArticle,editArticle','current'=>'articleList','icon'=>'icon-wrench'),
			array('name'=>'分类管理','url'=>'Article/articleCategoryList','hover'=>'articleCategoryList,addArticleCategory,editArticleCategory','current'=>'articleCategoryList','icon'=>'icon-wrench'),
		),
		'Item'=>array(
			array('name'=>'商品管理','url'=>'Item/itemList','hover'=>'itemList,addItem,editItem','current'=>'itemList','icon'=>'icon-wrench'),
			array('name'=>'商品回收站','url'=>'Item/recycleItemList','hover'=>'recycleItemList','current'=>'recycleItemList','icon'=>'icon-wrench'),
			//array('name'=>'商品价格管理','url'=>'#','hover'=>'','current'=>'#','icon'=>'icon-wrench'),
			array('name'=>'分类管理','url'=>'Item/itemCategoryList','hover'=>'itemCategoryList,addItemCategory,editItemCategory','current'=>'itemCategoryList','icon'=>'icon-wrench'),
			array('name'=>'分类属性管理','url'=>'Item/itemCategoryAttributeList','hover'=>'itemCategoryAttributeList,addItemCategoryAttribute,editItemCategoryAttribute','current'=>'itemCategoryAttributeList','icon'=>'icon-wrench'),
			array('name'=>'品牌管理','url'=>'Item/brandList','hover'=>'brandList,addBrand,editBrand','current'=>'brandList','icon'=>'icon-wrench'),
			array('name'=>'用途管理','url'=>'Item/itemPurposeList','hover'=>'itemPurposeList,addItemPurpose,editItemPurpose','current'=>'itemPurposeList','icon'=>'icon-wrench'),
		),
		
		'Account'=>array(
			array('name'=>'会员管理','url'=>'Account/accountList','hover'=>'accountList,addAccount,editAccount','current'=>'accountList','icon'=>'icon-wrench'),
			array('name'=>'会员等级管理','url'=>'Account/accountLevelList','hover'=>'accountLevelList,addAccountLevel,editAccountLevel','current'=>'accountLevelList','icon'=>'icon-wrench'),
		),
		
		'AdminUser'=>array(
			array('name'=>'管理员管理','url'=>'AdminUser/adminUserList','hover'=>'adminUserList,addAdminUser,editAdminUser','current'=>'adminUserList','icon'=>'icon-wrench'),
			array('name'=>'角色管理','url'=>'AdminUser/adminRoleList','hover'=>'adminRoleList,addAdminRole,editAdminRole','current'=>'adminRoleList','icon'=>'icon-wrench'),
		),
		
		'Vouchers'=>array(
			array('name'=>'优惠券管理','url'=>'Vouchers/couponList','hover'=>'couponList,addCoupon,editCoupon,couponBindList','current'=>'couponList','icon'=>'icon-wrench'),
			array('name'=>'现金券管理','url'=>'Vouchers/cashVoucherList','hover'=>'cashVoucherList,addCashVoucher,cashVoucherDetailList','current'=>'cashVoucherList','icon'=>'icon-wrench'),
		),
		
		'Promotion'=>array(
			array('name'=>'商品促销','url'=>'Promotion/itemSaleList','hover'=>'itemSaleList,addItemSale,editItemSale','current'=>'itemSaleList','icon'=>'icon-wrench'),
			array('name'=>'订单满减','url'=>'Promotion/ordersReductionList','hover'=>'ordersReductionList,addOrdersReduction,editOrdersReduction','current'=>'ordersReductionList','icon'=>'icon-wrench'),
			array('name'=>'订单满赠','url'=>'Promotion/index3','hover'=>'index3','current'=>'index','icon'=>'icon-wrench'),
			array('name'=>'抢购管理','url'=>'Promotion/index3','hover'=>'index3','current'=>'index','icon'=>'icon-wrench'),
		),
		
		'Order'=>array(
			array('name'=>'订单列表','url'=>'Order/orderList','hover'=>'orderList,orderDetail','current'=>'orderList','icon'=>'icon-wrench'),
			array('name'=>'待发货订单','url'=>'Order/shippingOrderList','hover'=>'shippingOrderList,doShipping','current'=>'shippingOrderList','icon'=>'icon-wrench'),
		),
		
		'OrderRefund'=>array(
			array('name'=>'退货列表','url'=>'OrderRefund/orderRefundList','hover'=>'orderRefundList,orderRefundDetail','current'=>'orderRefundList','icon'=>'icon-wrench'),
		),
		
		'Comment'=>array(
			array('name'=>'评论列表','url'=>'Comment/commentList','hover'=>'commentList','current'=>'index','icon'=>'icon-wrench'),
			array('name'=>'后台评论','url'=>'Comment/adminComment','hover'=>'adminComment','current'=>'index','icon'=>'icon-wrench'),
		),
		
	),
);
?>