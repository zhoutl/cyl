<?php
namespace Wap\Controller;
use Think\Controller;
class WapController extends Controller {
   	private $mid = 0;

    public function _initialize(){
		//验证是否登陆
		$account_user = session('lbg_account');
		if(empty($account_user)){
			if(IS_AJAX){
				$result = array('status'=>-1,'msg'=>'请登录');
				$this->ajaxReturn($result);
			}else{
				redirect(U('Login/index'));
			}
		}else{
			$this->assign('mid',$account_user['uid']);
			$this->mid = $account_user['uid'];
		}
		
	}
}