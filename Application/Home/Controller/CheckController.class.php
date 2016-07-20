<?php
namespace Home\Controller;
use Think\Controller;
/**
* 
*/
class CheckController extends Controller{
	
	public function _initialize(){
		if(check_wap()){
			if(IS_AJAX){
				$result = array('status'=>0,'msg'=>'请使用手机打开此网页');
				$this->ajaxReturn($result);
			}else{
				redirect(U('Wap/Index/index'));
			}
		}
	}
	
}

?>