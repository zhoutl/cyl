<?php 
namespace Admin\Model;
use Think\Model;
class DeliveryModeModel extends Model {
	
	protected $_validate = array(
		array('name','1,20','配送名称为1-20个字',1,'length'), 
		array('description','1,200','配送描述为1-200个字',2,'length'), 
	);
	
	//新增配送
    public function addDeliveryMode($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改配送
	public function editDeliveryMode($delivery_mode_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['delivery_mode_id'] = intval($delivery_mode_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成1功');
			break;
		}
		
		return $result;
	}
	
	//删除配送
	public function delDeliveryMode($delivery_mode_id){
		$map['delivery_mode_id'] = intval($delivery_mode_id);
		
		$this->where($map)->delete();
		$result = array('status'=>1,'msg'=>'删除成功');
		
		return $result;
	}
	
	
}


?>