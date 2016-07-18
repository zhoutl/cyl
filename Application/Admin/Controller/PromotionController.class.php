<?php
namespace Admin\Controller;
use Think\Controller;
class PromotionController extends AdminController {
	
	public function index(){
		$this->display();
	}
	
	//促销商品列表
	public function itemSaleList(){
		$da = M('Item_sale');
		$map = array();
		
		$data['list'] = $da->where($map)->order('item_sale_id DESC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增促销商品
	public function addItemSale(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Item_sale')->addItemSale($data);
			if($result['status']){
				 $this->success($result['msg'], U('Promotion/itemSaleList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
		
	//修改促销商品
	public function editItemSale(){
		$item_sale_id = I('request.id',0,'intval');
		$map = array('item_sale_id'=>$item_sale_id);
		$list = M('Item_sale')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Item_sale')->editItemSale($item_sale_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Promotion/itemSaleList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['list'] = $list;
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//删除促销商品
	public function delItemSale(){
		$result = D('Item_sale')->delItemSale(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	//订单满减列表
	public function ordersReductionList(){
		$da = M('Orders_reduction');
		$map = array('status'=>1);
		
		$data['list'] = $da->where($map)->order('orders_reduction_id DESC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增订单满减
	public function addOrdersReduction(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Orders_reduction')->addOrdersReduction($data);
			if($result['status']){
				 $this->success($result['msg'], U('Promotion/ordersReductionList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	//修改订单满减
	public function editOrdersReduction(){
		$orders_reduction_id = I('request.id',0,'intval');
		$map = array('orders_reduction_id'=>$orders_reduction_id);
		$list = M('Orders_reduction')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Orders_reduction')->editOrdersReduction($orders_reduction_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Promotion/ordersReductionList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['list'] = $list;
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//删除订单满减
	public function delOrdersReduction(){
		$result = D('Orders_reduction')->delOrdersReduction(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	
	
}

?>