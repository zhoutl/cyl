<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
	private $admin_user_id;
	public $limit = 10;
    public function _initialize(){
		//验证是否登陆
		$admin_user = session('md_admin_user');
		if(empty($admin_user)){
			if(IS_AJAX){
				$result = array('status'=>-1,'msg'=>'请登录');
				$this->ajaxReturn($result);
			}else{
				$this->error('请登录',U('Index/index'));
				//redirect(U('Index/index'));
			}
		}else{
			$this->assign('admin_user_id',$admin_user['admin_user_id']);
			$this->admin_user_id = $admin_user['admin_user_id'];
		}
		
		//验证操作权限
		$permission = NULL;
		tag('check_permission',$permission);
		if(!$permission){
			if(IS_AJAX){
				$result = array('status'=>0,'msg'=>'您无权执行此操作');
				$this->ajaxReturn($result);
			}else{
				$this->error('您无权执行此操作');
				//redirect(U('Welcome/index'));
			}	
		}
	}
}

?>