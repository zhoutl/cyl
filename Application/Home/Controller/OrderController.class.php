<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends HomeController {
	
	//确认订单
	public function confirmOrder(){
		if(IS_POST){
			$cart_ids = I('post.shopping_cart_id');
		}else{
			$cart_ids = (array) I('get.shopping_cart_id',0,'intval');
		}

		//判断是否选择了商品
		if(!empty($cart_ids) && count($cart_ids)>0){
			//ID  整形化
			foreach($cart_ids as $k=>$v){
				$cart_ids[$k] = intval($v);
			}
			//获取商品信息
			$data['cart_list'] = D('Shopping_cart')->getCartInfo($this->mid,$cart_ids);
			if(empty($data['cart_list'])){
				$this->assign('msg','无购买的商品信息');
				$this->display('Common/miss');
			}else{
				//收货地址列表
				$data['address'] = M('Account_address')->where('account_id='.$this->mid)->order('is_default DESC')->select();
				
				//配送方式列表
				$data['delivery'] = M('Delivery_mode')->select();
				
				//当前应付总额
				$data['pay_amount'] = $data['cart_list']['count_info']['all_online_price'];
				
				//订单满减
				$data['order_reduction'] = D('Orders_reduction')->getOrdersReduction($data['pay_amount'],'pc');
				
				if($data['order_reduction']){
					//若存在订单满减，则需支付金额减去满减金额
					$data['pay_amount'] = my_minus($data['pay_amount'],$data['order_reduction']['reduction_amount']);
				}
				
				//可用的优惠券列表
				$data['my_coupon_list'] = D('Coupon_bind')->getAllowCoupon($this->mid,$data['pay_amount'],'pc');
				
				//计算最多可用积分
				$max_use_points = intval($data['pay_amount']*C('POINTS.USE_RATIO'));
				//获取用户当前积分数
				$account_points = M('Account')->where("account_id='{$this->mid}'")->getField('pay_points');
				if($account_points>=$max_use_points){
					$data['pay_points'] = $max_use_points;
				}else{
					$data['pay_points'] = $account_points;
				}
				
				$data['one_points'] = C('POINTS.ADD_ORDER_POINT');
				$data['one_growth'] = C('GROWTH.ADD_ORDER_GROWTH');
				$data['exchange_ratio'] = C('POINTS.EXCHANGE_RATIO');
				//本次购买能够获得的积分数
				$data['add_points'] = intval($data['pay_amount'])+$data['one_points'];
				//本次购买能够获得的成长值
				$data['add_growth'] = intval($data['pay_amount'])+$data['one_growth'];
				
				
				$this->assign('data',$data);
				$this->display();
			}
			
		}else{
			$this->assign('msg','无购买的商品信息');
			$this->display('Common/miss');
		}
			
	}
	
	public function addOrder(){
		exit;
		if(IS_AJAX){
			$data = I('post.');
			$result = D('Orders')->addOrder($this->mid,$data,'pc');
			$this->ajaxReturn($result);
		}
	}
	
	//AJAX 获取现金券信息
	public function checkVoucher(){
		if(IS_AJAX){
			$voucher_code = I('post.voucher_code');
			$limit_amount = I('post.limit_amount');
			$result = D('Cash_voucher')->checkVoucher($voucher_code,$limit_amount,'pc');
			$this->ajaxReturn($result);
		}
	}
	
	//AJAX获取新增地址
	public function ajaxAddAddress(){
		if(IS_AJAX){
			$result = D('Account_address')->getAddAddressForm();
			$this->ajaxReturn($result);
		}
	}
	
	//AJAX修改地址
	public function ajaxEditAddress(){
		if(IS_AJAX){
			$account_address_id = I('post.account_address_id',0,'intval');
			$result = D('Account_address')->getEditAddressForm($this->mid,$account_address_id);
			$this->ajaxReturn($result);
		}
	}
	
	
	//我的订单
	public function myOrders(){
		$seo_data['title']        = '我的订单';
		$this -> assign('seo_data',$seo_data);
		
		$da = M('Orders');
		$map = array('account_id'=>$this->mid,'is_account_del'=>0);
		$data['count'] = $da->where($map)->count();
		
		$data['type'] = I('get.type',1,'intval');
		if(!in_array($data['type'],array(1,2,3,4))){
			$data['type'] = 1;
		}
		
		switch($data['type']){
			case 2:
				$map['status'] = 1;
				$map['pay_status'] = 0;
				break;
			case 3:
				$map['status'] = 1;
				$map['pay_status'] = 1;
				$map['shipping_status'] = 0;
			case 4:
				$map['status'] = 1;
				$map['pay_status'] = 1;
				$map['shipping_status'] = 1;
		}
		
		//下单时间
		if($data['add_time'] = $_GET['add_time']){
			$map['add_time'] = array('egt',strtotime($data['add_time']));
			$map['add_time'] = array('elt',strtotime($data['add_time'])+86400);
		}
		
		//订单号
		if($data['order_num'] = $_GET['order_num']){
			$map['order_no'] = $data['order_num'];
		}
		
		
		$data['list'] = $da->where($map)->order('add_time DESC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);
		
		$db_prefix = C('DB_PREFIX');
		//获取订单商品
		foreach($data['list'] as $k=>$v){
			$sql = "select t1.*,t2.img_uri from ".$db_prefix."orders_item t1 left join ".$db_prefix."item_image t2
			 on t1.item_id=t2.item_id and t2.is_default=1 where t1.orders_id={$v['orders_id']}";
			$item_list = M('')->query($sql);
			$data['list'][$k]['item_list']  = $item_list;
		}

		$this->assign('data',$data);
		$this->display();
	}
	
	//订单详情
	public function orderDetail(){
		$seo_data['title']        = '订单明细';
		$this -> assign('seo_data',$seo_data);
		
		$map = array('account_id'=>$this->mid,'is_account_del'=>0);
		$map['orders_id'] = I('get.orders_id',0,'intval');
		$data['list'] = M('Orders')->where($map)->find();
		if($data['list']){
			$data['item_list'] = M('Orders_item')->where("orders_id=".$map['orders_id'])->select();
			foreach($data['item_list'] as $k=>$v){
				$data['item_list'][$k]['img_uri'] = M('Item_image')->where("item_id='{$v['item_id']}' and is_default=1")->getField('img_uri');
			}
			
			$this->assign('data',$data);
			if($data['list']['status'] == '3'){
				$this->display('jywc');
			}else if($data['list']['status'] == '0'){
				$this->display('jygb');
			}else if($data['list']['status'] == '2'){
				$this->display('thz');
			}else{
				if($data['list']['status'] == '1' && $data['list']['pay_status'] == '0'){
					$this->display('dfk');
				}
				
				if($data['list']['status'] == '1' && $data['list']['pay_status'] == '1' && $data['list']['shipping_status'] == '0'){
					$this->display('dfh');
				}
				
				if(($data['list']['status'] == '1' && $data['list']['pay_status'] == '1' && $data['list']['shipping_status'] == '1') || $data['list']['status']=='2'){
					$this->display('dsh');
				}
			}
		}else{
			$this->assign('msg','订单不存在或已被删除');
			$this->display('Common/miss');
		}
	}
	
	
	//ajax删除订单
	public function delOrder(){
		if(IS_AJAX){
			$orders_id = I('post.orders_id',0,'intval');
			$result = D('Orders')->delOrder($this->mid,$orders_id);
			$this->ajaxReturn($result);
		}
	}
	
	//ajax 取消订单
	public function cancelOrder(){
		if(IS_AJAX){
			$orders_id = I('post.orders_id',0,'intval');
			$result = D('Orders')->cancelOrder($this->mid,$orders_id);
			$this->ajaxReturn($result);
		}
	}
	
	//AJAX确认收货
	public function finishOrder(){
		if(IS_AJAX){
			$orders_id = I('post.orders_id',0,'intval');
			$result = D('Orders')->finishOrder($this->mid,$orders_id);
			$this->ajaxReturn($result);
		}
	}
	
}
?>