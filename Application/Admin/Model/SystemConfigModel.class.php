<?php 
namespace Admin\Model;
use Think\Model;
class SystemConfigModel extends Model {
	protected $_validate = array(
		array('title','1,50','网站标题为1-50个字',2,'length'), 
		array('keywords','1,50','网站关键字为1-50个字',2,'length'), 
		array('copyright','1,50','网站版权为1-50个字',2,'length'), 
		array('description','1,200','网站描述为1-200个字',2,'length'), 
	);
	
	//保存系统配置
	public function saveSystemConfig($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['system_config_id'] = 1;
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
}

?>