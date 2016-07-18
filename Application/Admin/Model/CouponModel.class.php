<?php 
namespace Admin\Model;
use Think\Model;
class CouponModel extends Model {
	protected $_validate = array(
		array('coupon_name','1,20','优惠券名称为1-20个字',1,'length'), 
		array('is_pc',array(1),'请选择正确的使用平台',2,'in'), 
		array('is_wap',array(1),'请选择正确的使用平台',2,'in'), 
		array('is_app',array(1),'请选择正确的使用平台',2,'in'), 
		array('coupon_amount','is_numeric','请输入正确的优惠券金额',1,'function'), 
		array('limit_amount','is_numeric','请输入正确的最低使用条件',1,'function'), 
		array('coupon_quantity','is_numeric','请输入正确的优惠券总数',1,'function'), 
		array('coupon_limit','is_numeric','请输入正确的限领数量',1,'function'), 
		array('start_time','strtotime','请选择正确格式的开始时间',1,'function'), 
		array('end_time','strtotime','请选择正确格式的结束时间',1,'function'), 
		array('is_item_show',array(0,1),'请选择是否商品详情显示',1,'in'), 
		array('status',array(0,1),'请选择是否启用',1,'in'), 
	);
	
	//新增优惠券
    public function addCoupon($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			$data['is_pc'] = $data['is_pc']=='1'?1:0;
			$data['is_wap'] = $data['is_wap']=='1'?1:0;
			$data['is_app'] = $data['is_app']=='1'?1:0;
			
			$data['coupon_remaining_quantity'] = $data['coupon_quantity'];
			$data['start_time'] = strtotime($data['start_time']);
			$data['end_time'] = strtotime($data['end_time']);
			$data['pubdate']  = time();
		
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改优惠券
    public function editCoupon($coupon_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['coupon_id'] = intval($coupon_id);
			$list = $this->where($map)->find();
			
			if(empty($list)){
				$result = array('status'=>0,'msg'=>'数据不存在或已被操作过！');
				break;
			}
			
			//优惠券数量不能向下减少
			if($data['coupon_quantity'] < $list['coupon_quantity']){
				$result = array('status'=>0,'msg'=>'优惠券总数不能小于之前的数量');
				break;
			}
			
			//如果数量有修改 同时更新剩余数量
			if($data['coupon_quantity'] != $list['coupon_quantity']){
				$data['coupon_remaining_quantity'] = $list['coupon_remaining_quantity']+($data['coupon_quantity']-$list['coupon_quantity']);
			}
			
			$data['is_pc'] = $data['is_pc']=='1'?1:0;
			$data['is_wap'] = $data['is_wap']=='1'?1:0;
			$data['is_app'] = $data['is_app']=='1'?1:0;
			
			$data['start_time'] = strtotime($data['start_time']);
			$data['end_time'] = strtotime($data['end_time']);
			
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
		
	}
	
	
	
	//更改优惠券状态
	public function changeCouponState($coupon_id,$type){
		$map['coupon_id'] = intval($coupon_id);
		if($type == 1){
			$data = array('status'=>1);
		}else{
			$data = array('status'=>0);
		}
		
		$this->where($map)->save($data);
		$result = array('status'=>1,'msg'=>'修改成功');
		return $result;
	}
	
}

?>