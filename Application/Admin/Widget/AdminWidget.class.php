<?php 
namespace Admin\Widget;
use Think\Controller;
class AdminWidget extends Controller {
	
	//公共头部
    public function head($data = array()){
		$data['main_menu'] = C('MAIN_MENU');
		$data['hover'] = CONTROLLER_NAME;
		
		//获取管理员信息
		$admin_user = D('Admin_user')->getAdminUserInfo($data['admin_user_id']);
		
		//如果不是超级管理员，进行菜单过滤
		if($admin_user['admin_role_id'] != '0'){
			//获取用户权限列表
			$permission_list = D('Admin_permission')->getPermissionList($admin_user['admin_role_id']);
			
			//菜单过滤
			foreach($data['main_menu'] as $k=>$v){
				$tmp_flag = 0;
				foreach($permission_list as $k2=>$v2){
					if(strtolower($v['hover']) == strtolower($v2['controller_name'])){
						$tmp_flag = 1;
						break;
					}
				}
				if(!$tmp_flag) unset($data['main_menu'][$k]);
			}
		}
		
		$this->assign('data',$data);
        $this->display('Common/head');
    }
	
	//公共尾部
	public function foot($data = array()){
		$this->assign('data',$data);
        $this->display('Common/foot');
	}
	
	//侧边导航
	public function menu($data = array()){
		$hover = CONTROLLER_NAME;
		$data['child_menu'] = C('CHILD_MENU.'.$hover);
		$data['hover'] = ACTION_NAME;
		
		//获取管理员信息
		$admin_user = D('Admin_user')->getAdminUserInfo($data['admin_user_id']);

		//如果不是超级管理员，进行菜单过滤
		if($admin_user['admin_role_id'] != '0'){
			//获取用户权限列表
			$permission_list = D('Admin_permission')->getPermissionList($admin_user['admin_role_id']);
			//菜单过滤
			foreach($data['child_menu'] as $k=>$v){
				$tmp_flag = 0;
				foreach($permission_list as $k2=>$v2){
					if(strtolower($v['current']) == strtolower($v2['method_name'])){
						$tmp_flag = 1;
						break;
					}
				}
				if(!$tmp_flag) unset($data['child_menu'][$k]);
			}
		}
		
		$this->assign('data',$data);
		$this->display('Common/menu');
	}
	
	//商品属性信息
	public function itemAttributeInfo($data = array()){
		$this->assign('data',$data);
		$this->display('itemAttributeInfo');
	}
	
}

?>