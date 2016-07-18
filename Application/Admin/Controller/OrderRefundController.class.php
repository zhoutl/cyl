<?php
namespace Admin\Controller;
use Think\Controller;
class OrderRefundController extends AdminController {
	
	public function index(){
		$this->display();
	}
	
	//退货列表
	public function orderRefundList(){
		$da = M('Orders_refund');
		$map = array();
		
		$data['list'] = $da->where($map)->order('orders_refund_id DESC')->page(intval($_GET['p']).','.$this->limit)->select();
	
		$count     = $da->where($map)->count();

		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	
}

?>