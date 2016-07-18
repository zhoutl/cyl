<?php 
namespace Admin\Model;
use Think\Model;
class OrdersReductionModel extends Model {
	protected $_validate = array(
		array('name','1,20','活动名称为1-20个字',1,'length'), 
		array('is_pc',array(1),'请选择正确的使用平台',2,'in'), 
		array('is_wap',array(1),'请选择正确的使用平台',2,'in'), 
		array('is_app',array(1),'请选择正确的使用平台',2,'in'), 
		array('limit_orders_amount','is_numeric','请输入正确的满额金额',1,'function'), 
		array('reduction_amount','is_numeric','请输入正确的优惠金额',1,'function'), 
		array('start_time','strtotime','请选择正确格式的开始时间',1,'function'), 
		array('end_time','strtotime','请选择正确格式的结束时间',1,'function'), 
	);
	
	//新增订单满减
    public function addOrdersReduction($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}

			$data['start_time'] = strtotime($data['start_time']);
			$data['end_time'] = strtotime($data['end_time']);
		
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改订单满减
    public function editOrdersReduction($orders_reduction_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['orders_reduction_id'] = intval($orders_reduction_id);
			
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
	
	
	
	//删除订单满减
	public function delOrdersReduction($orders_reduction_id,$type){
		$map['orders_reduction_id'] = intval($orders_reduction_id);
		
		$data = array('status'=>0);
		
		$this->where($map)->save($data);
		$result = array('status'=>1,'msg'=>'删除成功');
		return $result;
	}
	
}

?>