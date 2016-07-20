<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	
	//后台登陆页
    public function index(){
		if(session('md_admin_user')){
			redirect(U('Admin/Welcome/index'));
		}
		$this->display();
	}
	
	//登陆操作
	public function doLogin(){
		$result = D('Admin_user')->doLogin(I('post.'));
		if($result['status']){
			//登陆成功，设置session
			session('md_admin_user',$result['data']); 
		}
		$this->ajaxReturn($result);
	}
	
	//退出登陆
	public function logout(){
		session('md_admin_user',NULL);
		redirect(U('Admin/Index/index'));
	}
}

?>