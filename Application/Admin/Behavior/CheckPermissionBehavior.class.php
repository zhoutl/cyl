<?php
namespace Admin\Behavior;
//后台操作权限验证
class CheckPermissionBehavior{
    public function run(&$permission){
		$admin_user = D('Admin_user')->getAdminUserInfo(session('md_admin_user.admin_user_id'));
		
		if($admin_user['admin_role_id'] == '0'){
			//超级管理员具有所有权限
			$permission = true;
		}else if(CONTROLLER_NAME == 'Welcome' && ACTION_NAME == 'index'){
			//默认后台首页无权限控制
			$permission = true;
		}else{
			//获取权限数据
			unset($map);
			$map['admin_role_id'] = $admin_user['admin_role_id'];
			$map['module_name'] = strtolower(MODULE_NAME);
			$map['controller_name'] = strtolower(CONTROLLER_NAME);
			$map['method_name'] = strtolower(ACTION_NAME);
			if(M('Admin_permission')->where($map)->find()){
				$permission = true;
			}else{
				$permission = false;
			}
		}
    }
}

 ?>