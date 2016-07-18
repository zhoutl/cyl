<?php
namespace Home\Model;
use Think\Model;

class OrdersReductionModel extends Model{
	
	//获取可用的订单满减
	public function getOrdersReduction($amount,$from){
		$now = time();
		$map['status'] = 1;
		$map['start_time'] = array('elt',$now);
		$map['end_time'] = array('egt',$now);
		$map['limit_orders_amount'] = array('elt',$amount);
		
		$map = array_merge($map,change_map($from,2));
		
		$orders_reduction_list = $this->field('name,orders_reduction_id,limit_orders_amount,reduction_amount')->where($map)->order('limit_orders_amount DESC,reduction_amount DESC')->find();
		
		return $orders_reduction_list;
	}
}
?>