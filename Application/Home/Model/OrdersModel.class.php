<?php 
namespace Home\Model;
use Think\Model;
class OrdersModel extends Model {
	
	//创建订单
	public function addOrder($account_id,$data,$from='pc'){
		while(true){
			$now = time();
			//获取购物车的ID
			$cart_ids = $data['cart_id'];
			if(empty($cart_ids) || count($cart_ids)<1 || !is_array($cart_ids)){
				$result = array('status'=>0,'msg'=>'无商品信息');
				break;
			}
			//ID  整形化
			foreach($cart_ids as $k=>$v){
				$cart_ids[$k] = intval($v);
			}
			
			//获取购物车商品数据
			$map['shopping_cart_id'] = array('in',$cart_ids);
			$map['account_id'] = $account_id;
			$cart_list = M('Shopping_cart')->where($map)->select();
			if(empty($cart_list)){
				$result = array('status'=>0,'msg'=>'无商品信息');
				break;
			}
			
			//验证商品数据
			$res = D('Home/Item')->checkItem($cart_list);	
			if(!$res['status']){
				$result = $res;
				break;
			}
			
			$product_list = $res['products_list'];
			
			//根据订单来源计算价格
			switch($from){
				case 'pc':
					$order_data['amount'] = $res['count_info']['all_online_price'];  //订单总额
					$order_data['pay_amount'] = $res['count_info']['all_online_price'];  //支付总额
					$order_data['source'] = 1;  //订单来源
					$price_key = 'online_price';
					break; 
				case 'wap':
					$order_data['amount'] = $res['count_info']['all_online_price'];  //订单总额
					$order_data['pay_amount'] = $res['count_info']['all_online_price'];  //支付总额
					$order_data['source'] = 2;  //订单来源
					$price_key = 'online_price';
					break; 
				case 'app':
					$order_data['amount'] = $res['count_info']['all_app_price'];  //订单总额
					$order_data['pay_amount'] = $res['count_info']['all_app_price'];  //支付总额
					$order_data['source'] = 3;  //订单来源
					$price_key = 'app_price';
					break; 
			}
			
			//收货地址验证
			$map = array('account_id'=>$account_id,'account_address_id'=>intval($data['account_address_id']));
			$account_address = M('Account_address')->where($map)->find();
			if(empty($account_address)){
				$result = array('status'=>0,'msg'=>'请选择收货地址');
				break;
			}
			$order_data['consignee'] = $account_address['name'];
			$order_data['mobile'] = $account_address['phone'];
			$order_data['address'] = $account_address['address'];
			
			//支付方式
			$order_data['defray_id'] = 1;
			$order_data['defray_name'] = '线上支付';
			
			$map = array('account_id'=>$account_id,'delivery_mode_id'=>intval($data['delivery_mode_id']));
			$delivery_info = M('Delivery_mode')->where($map)->find();
			if(empty($delivery_info)){
				$result = array('status'=>0,'msg'=>'请选择配送方式');
				break;
			}
			$order_data['delivery_mode_id'] = $delivery_info['delivery_mode_id'];
			$order_data['delivery_mode_name'] = $delivery_info['name'];
			
			//运费
			$order_data['freight_amount'] = 0.00;
			
			//发票类型
			$order_data['invoice_type_id'] = intval($data['invoice_type_id']);
			if($order_data['invoice_type_id'] == 3){
				//公司发票  获取发票抬头
				$order_data['invo_cust_name'] = $data['invo_cust_name'];
				if(!preg_match ("/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u", $order_data['invo_cust_name'])){
					$result = array('status'=>0,'msg'=>'请输入正确格式的发票抬头');
					break;
				}
				if(mb_strlen($order_data['invo_cust_name'],'UTF-8' )<1 || mb_strlen($order_data['invo_cust_name'],'UTF-8' )>20){
					$result = array('status'=>0,'msg'=>'发票抬头为1-20个字');
					break;
				}
			}
			
			//订单备注
			if(!empty($data['desc'])){
				if(mb_strlen($data['desc'],'UTF-8' )>50){
					$result = array('status'=>0,'msg'=>'订单备注不能超过50个字');
					break;
				}
				$order_data['desc'] = $data['desc'];
			}
			
			//订单满减验证
			$order_reduction = D('Home/Orders_reduction')->getOrdersReduction($order_data['pay_amount'],$from);
			if($order_reduction){
				//若存在订单满减，则需支付金额减去满减金额
				$order_data['pay_amount'] = my_minus($order_data['pay_amount'],$order_reduction['reduction_amount']);
				$order_data['order_reduction_amount'] = $order_reduction['reduction_amount'];
			}
			
			//因积分与优惠券的可共存 此处记录当前的pay_amount
			$tmp_pay_amount = $order_data['pay_amount'];
			
			//优惠券，现金券验证 
			if(!empty($data['coupon_id'])){
				$data['coupon_id'] = intval($data['coupon_id']);
				//如果存在优惠券，判断该优惠券是否可用
				$coupon_info = D('Home/Coupon_bind')->checkCoupon($account_id,$data['coupon_id'],$order_data['pay_amount'],$from);
				if($coupon_info){
					$order_data['coupon_amount'] = $coupon_info['coupon_amount'];
					//现金支付金额减少
					$order_data['pay_amount'] = my_minus($order_data['pay_amount'],$coupon_info['coupon_amount']);
					
					//记录优惠券使用tag
					$coupon_bind_id = $coupon_info['coupon_bind_id'];
					$coupon_tag = 1;
				}
			}else if(!empty($data['voucher_code'])){
				//如果存在现金券，判断该现金券是否可用
				$res = D('Home/Cash_voucher')->checkVoucher($data['voucher_code'],$order_data['pay_amount'],$from);
				if($res['status']){
					$cash_voucher_info = $res['cash_voucher_info'];
					$order_data['cash_coupon_amount'] = $cash_voucher_info['voucher_amount'];
					//现金支付金额减少
					$order_data['pay_amount'] = my_minus($order_data['pay_amount'],$cash_voucher_info['voucher_amount']);
				
					//记录现金券使用SQL
					$cash_voucher_detail_id = $cash_voucher_info['cash_voucher_detail_id'];
					$voucher_tag = 1;
				}else{
					$result = $res;
					break;
				}
			}
			
			//积分使用
			$data['points'] = intval($data['points']);
			if(!empty($data['points']) && $data['points']>0){
				$pay_points = M('Account')->where("account_id=".$account_id)->getField('pay_points');
				
				if($data['points']>$pay_points){
					$result = array('status'=>0,'msg'=>'积分余额不足');
					break;
				}
				//计算最多可用积分
				$max_use_points = intval($tmp_pay_amount*C('POINTS.USE_RATIO'));
				
				if($data['points']>$max_use_points){
					$result = array('status'=>0,'msg'=>'您最多可使用'.$max_use_points.'积分');
					break;
				}
				
				$order_data['point_amount'] = $data['points']/C('POINTS.EXCHANGE_RATIO');
				//现金支付金额减少
				$order_data['pay_amount'] = my_minus($order_data['pay_amount'],$order_data['point_amount']);

				$points_tag = 1;
			}
			
			$res1 = $res2 = $res3 = $res4 = $res5 = $res6 = $res7 = true;
			
			M('')->startTrans();
			
			$order_data['add_time'] = $now;
			$order_data['account_id'] = $account_id;
			$account_info = session('lbg_account');
			$order_data['account_name'] = $account_info['name'];
			//订单号
			$order_data['order_no'] = get_order_no();
			$order_data['status'] = 1;
			
			$orders_id = $this->add($order_data);
			
			$db_prefix = C('DB_PREFIX');

			//订单关联商品SQL
			$order_item_sql = "insert into ".$db_prefix."orders_item values ";
			foreach($product_list as $k=>$v){
				$p_price = $v[$price_key];
				$order_item_sql.="(NULL,{$orders_id},{$v['item_id']},'{$v['item_spec_ids']}','{$v['item_name']}','{$p_price}','{$v['num']}',0,0),";
				//商品减去库存 与 增加销量
				$item_spec_sql = "update ".$db_prefix."item_spec_price set stock=stock-{$v['num']},sales_volume=sales_volume+{$v['num']}
								where item_id='{$v['item_id']}' and item_spec_ids='{$v['item_spec_ids']}'";
				$res1 = M('')->execute($item_spec_sql);
				if(!$res1) break;
			}
			$order_item_sql = substr($order_item_sql,0,-1);
			$res2 = M('')->execute($order_item_sql);
			
			//优惠券使用SQL
			if(isset($coupon_tag) && $coupon_tag == 1){
				$coupon_map = array(
					'coupon_bind_id'=>$coupon_bind_id,
					'account_id'=>$account_id,
				);
				$coupon_data = array(
					'is_use'=>1,
					'orders_id'=>$orders_id,
					'use_time'=>$now,
				);
				$res3 = M('Coupon_bind')->where($coupon_map)->save($coupon_data);
			}
			//现金券使用SQL
			if(isset($voucher_tag) && $voucher_tag == 1){
				$voucher_map = array(
					'cash_voucher_detail_id'=>$cash_voucher_detail_id,
					'account_id'=>$account_id,
				);
				$voucher_data = array(
					'is_use'=>1,
					'orders_id'=>$orders_id,
					'use_time'=>$now,
				);
				$res4 = M('Cash_voucher_detail')->where($voucher_map)->save($voucher_data);
			}

			//积分处理
			if(isset($points_tag) && $points_tag == 1){	
				//用户积分流水
				$account_points_data = array(
					'account_id'=>$account_id,
					'points_add_value'=>-$data['points'],
					'points_before_value'=>$pay_points,
					'points_after_value'=>$pay_points-$data['points'],
					'instructions'=>'购买抵扣',
					'orders_id'=>$orders_id,
					'pubdate'=>$now,
				);
				$res5 = M('Account_points_detailed')->add($account_points_data);
				//更新用户积分
				$res6 = M('Account')->where("account_id=".$account_id)->setDec('pay_points',$data['points']);
			}
			
			//清除购物车数据
			$map = array();
			$map['shopping_cart_id'] = array('in',$cart_ids);
			$map['account_id'] = $account_id;
			$res7 = M('Shopping_cart')->where($map)->delete();
			
			if($order_data['order_no'] && $orders_id && $res1 && $res2 && $res3 && $res4 && $res5 && $res6 && $res7){
				$result = array('status'=>1,'msg'=>'订单生成成功','order_info'=>array('orders_id'=>$orders_id,'order_no'=>$order_data['order_no'],'pay_amount'=>$order_data['pay_amount']));
				M('')->commit();
			}else{
				$result = array('status'=>0,'msg'=>'系统发生错误，请稍后再试');
				M('')->rollback();
			}

			break;

		}
		return $result;
	}
	
	
	
	
	//删除订单
	public function delOrder($account_id,$orders_id){
		$map = array('account_id'=>$account_id,'orders_id'=>$orders_id);
		$list = $this->where($map)->find();
		if(!empty($list)){
			if($list['status'] != '0' && $list['status'] != '3'){
				$result = array('status'=>0,'msg'=>'进行重的订单无法被删除');
			}else{
				$this->where($map)->save(array('is_account_del'=>1));
				$result = array('status'=>1,'msg'=>'删除成功');
			}
		}else{
			$result = array('status'=>0,'msg'=>'订单不存在或已被删除');
		}
		return $result;
	}
	
	//取消订单
	public function cancelOrder($account_id,$orders_id){
		while(true){
			$now = time();
			$map = array('account_id'=>$account_id,'orders_id'=>$orders_id);
			$list = $this->where($map)->find();
			
			if(empty($list)){
				$result = array('status'=>0,'msg'=>'订单不存在或已被删除');
				break;
			}
			
			if($list['status'] != '1'){
				$result = array('status'=>0,'msg'=>'非进行中订单，无法取消');
				break;
			}
			if($list['shipping_status'] == '1'){
				$result = array('status'=>0,'msg'=>'该订单中商品已发货，无法取消'); 
				break;
			}
			
			$res1 = $res2 = $res3 = $res4 = $res5 = $res6 = true;
			
			//开启事务
			M('')->startTrans();
			//设置订单状态为0
			$res1 = $this->where("orders_id=".$orders_id)->save(array('status'=>0,'cancel_time'=>$now));
			//返还消费积分
			if($list['point_amount']>0){
				$ponits = $list['point_amount']*100;
				//获取用户当前积分
				$account_ponits = M('Account')->where("account_id=".$account_id)->getField('pay_points');
				//积分流水入账记录
				$res2 = M('Account_points_detailed')->add(array(
					'account_id'=>$account_id,
					'points_add_value'=>$ponits,
					'points_before_value'=>$account_ponits,
					'points_after_value'=>$account_ponits+$ponits,
					'instructions'=>'退单返还',
					'orders_id'=>0,
					'pubdate'=>$now,
				));
				//用户积分增加
				$res3 = M('Account')->where("account_id=".$account_id)->setInc('pay_points',$ponits);
			}
			
			if($list['order_type'] == '2'){
				//如果是活动订单
				if($list['pay_status'] != '1'){
					//如果该活动订单未支付，释放秒杀摇号
					$res4 = M('Activity_seckill_no')->where("orders_id=".$orders_id)->save(array(
						'status'=>0,
						'account_id'=>0,
						'get_time'=>0,
						'add_order_time'=>0,
						'orders_id'=>0,
					));
				}
			}else{
				//增加库存  减去销量
				$item_list = M('orders_item')->where("orders_id=".$orders_id)->select();
				foreach($item_list as $v){
					$item_spec_data['sales_volume'] = array('exp','sales_volume-'.$v['quantity']);
					$item_spec_data['stock'] = array('exp','stock+'.$v['quantity']);
					$item_spec_map = array('item_id'=>$v['item_id'],'item_spec_ids'=>$v['item_spec_ids']);
					$res5 = M('Item_spec_price')->where($item_spec_map)->save($item_spec_data);
					if(!$res5) break;
				}
			}
			
			$succ_msg = '订单取消成功';
			//如果订单已支付且实付金额大于0 生成退款单
			if($list['pay_status'] == '1' && $list['pay_amount'] > 0){
				$res6 = M('Orders_cancel')->add(array(
					'orders_id'=>$list['orders_id'],
					'order_no'=>$list['order_no'],
					'account_id'=>$list['account_id'],
					'account_name'=>$list['account_name'],
					'serial_no'=>$list['serial_no'],
					'payment_id'=>$list['payment_id'],
					'payment_name'=>$list['payment_name'],
					'pay_time'=>$list['pay_time'],
					'order_type'=>$list['order_type'],
					'status'=>1,
					'refund_amount'=>$list['pay_amount'],
				));
				$succ_msg = '订单取消成功，支付的款项将于3个工作日内退还给您，请注意查收';
			}
			
			if($res1 && $res2 && $res3 && $res4 && $res5 && $res6){
				$result = array('status'=>1,'msg'=>$succ_msg);
				M('')->commit();
			}else{
				$result = array('status'=>0,'msg'=>'系统发生错误，请稍后再试');
				M('')->rollback();
			}
			
			break;
		}
		
		return $result;

	}
	
	//确认收货
	public function finishOrder($account_id,$orders_id){
		while(true){
			$now = time();
			$map = array('account_id'=>$account_id,'orders_id'=>$orders_id);
			$list = $this->where($map)->find();
			
			if(empty($list)){
				$result = array('status'=>0,'msg'=>'订单不存在或已被删除');
				break;
			}
			
			if($list['status']!='1' || $list['pay_status']!='1' || $list['shipping_status']!='1'){
				$result = array('status'=>0,'msg'=>'无法结束此订单');
				break;	
			}
			
			//获取该订单退货信息
			$map = array('account_id'=>$account_id,'orders_id'=>$orders_id,'status'=>4);
			$orders_refund_list = M('Orders_refund')->where($map)->find();
			if($orders_refund_list){
				$pay_amount = my_minus($list['pay_amount'],$orders_refund_list['refund_amount']);
				if($pay_amount > 0){
					//获得的成长值
					$add_growth = intval($pay_amount)+C('GROWTH.ADD_ORDER_GROWTH');
					//获得的积分
					$add_points = intval($pay_amount)+C('POINTS.ADD_ORDER_POINT');
				}else{
					$add_growth = $add_points = 0;
				}
				/*
				//如果存在退货单，获取退货单列表
				$refund_item_list = M('Orders_refund_item')->where("orders_refund_id=".$orders_refund_list['orders_refund_id'])->select();
				//获取订单商品
				$order_item_list = M('Orders_item')->where("orders_id=".$orders_id)->select();
				//商品匹配
				foreach($order_item_list as $k=>$v){
					foreach($refund_item_list as $k2=>$v2){
						
					}
				}
				*/
			}else{
				//获得的成长值
				$add_growth = intval($list['pay_amount'])+C('GROWTH.ADD_ORDER_GROWTH');
				//获得的积分
				$add_points = intval($list['pay_amount'])+C('POINTS.ADD_ORDER_POINT');
			}
			
			$res1 = $res2 = $res3 = $res4 = $res5 = true;
			//开启事务
			M('')->startTrans();
			//获得积分
			if($add_points>0){
				//获取用户当前积分
				$account_ponits = M('Account')->where("account_id=".$account_id)->getField('pay_points');
				//积分流水入账记录
				$res1 = M('Account_points_detailed')->add(array(
					'account_id'=>$account_id,
					'points_add_value'=>$add_points,
					'points_before_value'=>$account_ponits,
					'points_after_value'=>$account_ponits+$add_points,
					'instructions'=>'完成购物（订单号：'.$list['order_no'].'）',
					'orders_id'=>0,
					'pubdate'=>$now,
				));
				//用户积分增加
				$res2 = M('Account')->where("account_id=".$account_id)->setInc('pay_points',$add_points);
			}
			
			//获得成长值
			if($add_growth){
				//获取用户当前成长值
				$account_growth = M('Account')->where("account_id=".$account_id)->getField('growth_value');
				//成长值流水入账记录
				$res3 = M('Account_growth_detailed')->add(array(
					'account_id'=>$account_id,
					'growth_add_value'=>$add_growth,
					'growth_before_value'=>$account_growth,
					'growth_after_value'=>$account_growth+$add_growth,
					'instructions'=>'完成购物（订单号：'.$list['order_no'].'）',
					'orders_id'=>0,
					'pubdate'=>$now,
				));
				//用户成长值增加
				$res4 = M('Account')->where("account_id=".$account_id)->setInc('growth_value',$add_growth);
			}
			
			//订单状态改变
			$res5 = $this->where("orders_id=".$orders_id)->save(array('status'=>3,'over_time'=>$now));
			
			if($res1 && $res2 && $res3 && $res4 && $res5){
				$result = array('status'=>1,'msg'=>'操作成功');
				M('')->commit();
			}else{
				$result = array('status'=>0,'msg'=>'系统发生错误，请稍后再试');
				M('')->rollback();
			}
			
			break;
		}
		return $result;
	}
	
}

?>