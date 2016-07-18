<?php 
namespace Admin\Model;
use Think\Model;
class AdminRoleModel extends Model {
	
	protected $_validate = array(
		array('role_name','1,10','角色名称为1-10个字',1,'length'), 
	);
	
	//新增角色
    public function addAdminRole($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			$admin_role_id = $this->add($data);
			
			//保存节点数据
			D('Admin_permission')->savePermission($data['permission'],$admin_role_id);	
			
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改角色
	public function editAdminRole($admin_role_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['admin_role_id'] = intval($admin_role_id);
			$this->where($map)->save($data);
			
			//清空该角色节点数据
			M('Admin_permission')->where($map)->delete();
			//保存节点数据
			D('Admin_permission')->savePermission($data['permission'],$admin_role_id);	
			
			
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除角色
	public function delAdminRole($admin_role_id){
		$map['admin_role_id'] = intval($admin_role_id);
		
		if(M('Admin_user')->where($map)->find()){
			$result = array('status'=>0,'msg'=>'该角色下还有管理员账号，您无法删除！');
		}else{
			//删除节点
			M('Admin_permission')->where($map)->delete();
			//删除角色数据
			$this->where($map)->delete();
			$result = array('status'=>1,'msg'=>'删除成功');
		}
		
		return $result;
	}
	
	
}


?>