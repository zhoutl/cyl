<?php 
namespace Admin\Model;
use Think\Model;
class OrdersModel extends Model {
	
	//发货
	public function doShipping($orders_id,$data){
		$result = array('status'=>1,'msg'=>'操作成功');
		if($data['delivery_mode_id'] && $data['shipping_sn']){
			//验证物流是否存在
			$list = M('Delivery_mode')->where("delivery_mode_id='{$data['delivery_mode_id']}'")->find();
			if(empty($list)){
				$result = array('status'=>0,'msg'=>'所选物流不存在');
			}else{
				$data = array(
					'delivery_mode_id'=>$list['delivery_mode_id'],
					'delivery_mode_name'=>$list['name'],
					'shipping_sn'=>$data['shipping_sn'],
					'shipping_status'=>1,
				);
				$map['orders_id'] = $orders_id;
				$this->where($map)->save($data);
			}
		}
		return $result;
	}
}

?>