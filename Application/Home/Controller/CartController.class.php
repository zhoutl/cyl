<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends HomeController {
	
	//我的购物车列表
	public function myCart(){
		$seo_data['title']        = '我的购物车';
		$this -> assign('seo_data',$seo_data);
		//我的购物车列表
		$data['cart_list'] = D('Shopping_cart')->getCartInfo($this->mid);
		$this->assign('data',$data);
		$this->display();
	}
	
	//加入购物车成功页面
	public function addToCart(){
		$seo_data['title']       = '加入购物车';
		$this -> assign('seo_data',$seo_data);
		//我的购物车列表
		$data['cart_list'] = D('Shopping_cart')->getCartInfo($this->mid);
		$this->assign('data',$data);
		$this->display();
	}
	
	//加入购物车
	public function addCart(){
		if(IS_AJAX){
			$item_id = I('post.item_id',0,'intval');
			$num = I('post.num',0,'intval');
			$item_spec_ids = 0;
			$result = D('Shopping_cart')->addCart($this->mid,$item_id,$num,$item_spec_ids);
			$this->ajaxReturn($result);
		}
	}
	
	//更新购物车
	public function updateCart(){
		if(IS_AJAX){
			$shopping_cart_id = I('post.shopping_cart_id',0,'intval');
			$num = I('post.num',0,'intval');
			$result = D('Shopping_cart')->updateCart($this->mid,$shopping_cart_id,$num);
			if($result['status']){
				$cart_list = D('Shopping_cart')->getCartInfo($this->mid);
				$result['data'] = array(
					'all_num' => $cart_list['count_info']['all_num'],
					'all_online_price'=> $cart_list['count_info']['all_online_price'],
				);
			}
			$this->ajaxReturn($result);
		}
	}
	
	//删除购物车
	public function delCart(){
		if(IS_AJAX){
			$shopping_cart_id = I('post.shopping_cart_id');
			$result = D('Shopping_cart')->delCart($this->mid,$shopping_cart_id);
			if($result['status']){
				$cart_list = D('Shopping_cart')->getCartInfo($this->mid);
				$result['data'] = array(
					'all_num' => $cart_list['count_info']['all_num'],
					'all_online_price'=> $cart_list['count_info']['all_online_price'],
				);
			}
			$this->ajaxReturn($result);
		}
	}
	
	//清空购物车
	public function delMyCart(){
		if(IS_AJAX){
			$result = D('Shopping_cart')->delMyCart($this->mid);
			$this->ajaxReturn($result);
		}
	}
	
	//立即购买
	public function buyNow(){
		if(IS_AJAX){
			$item_id = I('post.item_id',0,'intval');
			$num = I('post.num',0,'intval');
			$item_spec_ids = 0;
			$result = D('Shopping_cart')->addCart($this->mid,$item_id,$num,$item_spec_ids);
			$this->ajaxReturn($result);
		}
	}
	
}


?>