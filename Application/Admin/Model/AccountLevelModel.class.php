<?php 
namespace Admin\Model;
use Think\Model;
class AccountLevelModel extends Model {
	
	protected $_validate = array(
		array('name','1,10','会员等级名称为1-10个字',1,'length'), 
		array('mark','1,200','备注为1-200个字',2,'length'), 
		array('conditions','is_numeric','最低成长值必须为数字',1,'function'),
	);
	
	//新增会员等级
    public function addAccountLevel($data){
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
	
	//修改会员等级
	public function editAccountLevel($account_level_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['account_level_id'] = intval($account_level_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除会员等级
	public function delAccountLevel($account_level_id){
		$map['account_level_id'] = intval($account_level_id);
		
		$this->where($map)->delete();
		$result = array('status'=>1,'msg'=>'删除成功');
		
		return $result;
	}
	
	
}


?>