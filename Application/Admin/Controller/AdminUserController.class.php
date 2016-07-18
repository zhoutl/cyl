<?php
namespace Admin\Controller;
use Think\Controller;
class AdminUserController extends AdminController {
	
	public function index(){
		$this->display();
	}
	
	//管理员角色列表
	public function adminRoleList(){
		$da = M('Admin_role');
		$data['list'] = $da->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	
	//新增管理员角色
	public function addAdminRole(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Admin_role')->addAdminRole($data);
			if($result['status']){
				 $this->success($result['msg'], U('AdminUser/adminRoleList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	//修改角色
	public function editAdminRole(){
		$admin_role_id = I('request.id',0,'intval');
		$map = array('admin_role_id'=>$admin_role_id);
		$list = M('Admin_role')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Admin_role')->editAdminRole($admin_role_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('AdminUser/adminRoleList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['list'] = $list;
				$admin_permission_list = M('Admin_permission')->where($map)->select();
				$data['permission'] = array();
				foreach($admin_permission_list as $v){
					$data['permission'][] = $v['module_name'].'/'.$v['controller_name'].'/'.$v['method_name'];
				}

				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//删除角色
	public function delAdminRole(){
		$result = D('Admin_role')->delAdminRole(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	//管理员列表
	public function adminUserList(){
		$da = M('Admin_user');
		$map['is_del'] = 0;
		$data['list'] = $da->where($map)->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增管理员
	public function addAdminUser(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Admin_user')->addAdminUser($data);
			if($result['status']){
				 $this->success($result['msg'], U('AdminUser/adminUserList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$data['admin_role_list'] = M('Admin_role')->select();
			$this->assign('data',$data);
			$this->display();
		}
	}
	
	//修改管理员
	public function editAdminUser(){
		$admin_user_id = I('request.id',0,'intval');
		$map = array('admin_user_id'=>$admin_user_id);
		$list = M('Admin_user')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Admin_user')->editAdminUser($admin_user_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('AdminUser/adminUserList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['admin_role_list'] = M('Admin_role')->select();
				$data['list'] = $list;
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//删除管理员
	public function delAdminUser(){
		$result = D('Admin_user')->delAdminUser(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	
}

?>