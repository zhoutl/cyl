<?php 
namespace Admin\Model;
use Think\Model;
class AdminPermissionModel extends Model {
	
	public function getPermissionList($admin_role_id){
		$map['admin_role_id'] = $admin_role_id;
		$map['module_name'] = 'admin';
		return $this->where($map)->select();
	}
	
	//根据前端数据保存节点
	public function savePermission($permission_info,$admin_role_id){
		foreach($permission_info as $v){
			if(!empty($v)){
				$tmp = explode('/',$v);
				$admin_permission_data = array(
					'admin_role_id'=>$admin_role_id,
					'module_name'=>strtolower($tmp[0]),
					'controller_name'=>strtolower($tmp[1]),
					'method_name'=>strtolower($tmp[2]),
				);
				$this->add($admin_permission_data);
			}
		}
	}
}



?>