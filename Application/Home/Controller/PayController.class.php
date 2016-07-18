<?php
namespace Home\Controller;
use Think\Controller;

class PayController extends HomeController{
    
    public function index () {
        $seo_data['title']        = '确认支付';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';
		$this -> assign('seo_data',$seo_data);
		
		$map = array('orders_id'=>I('get.orders_id',0,'intval'),'status'=>1,'pay_stauts'=>0);
		$data['list'] = M('orders')->where($map)->find();
		if($data['list']){
			$this->assign('data',$data);
			$this -> display();
		}else{
			$this->assign('msg','此订单已关闭或已支付，请勿重复操作');
			$this->display('Common/miss');
		}
    }
}