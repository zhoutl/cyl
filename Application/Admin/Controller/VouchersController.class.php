<?php
namespace Admin\Controller;
use Think\Controller;
class VouchersController extends AdminController {
	
	public function index(){
		$this->display();
	}
	
	//优惠券列表
	public function couponList(){
		$da = M('Coupon');
		$map = array();
		
		if(is_numeric($_GET['status'])){
			$map['status'] = intval($_GET['status']);
			$data['status'] = $map['status'];
		}
		$data['keywords'] = I('get.keywords','');
		if($data['keywords']){
			$map['coupon_name'] = array('LIKE','%'.$data['keywords'].'%');
		}
		
		$data['list'] = $da->where($map)->order('coupon_id DESC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	
	//新增优惠券
	public function addCoupon(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Coupon')->addCoupon($data);
			if($result['status']){
				 $this->success($result['msg'], U('Vouchers/couponList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	//修改优惠券
	public function editCoupon(){
		$coupon_id = I('request.id',0,'intval');
		if(IS_POST){
			$data = I('post.');
			$result = D('Coupon')->editCoupon($coupon_id,$data);
			if($result['status']){
				 $this->success($result['msg'], U('Vouchers/couponList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$map = array('coupon_id'=>$coupon_id);
			$list = M('Coupon')->where($map)->find();
			if(!empty($list)){
				$data['list'] = $list;
				$this->assign('data',$data);
				$this->display();				
			}else{
				$this->error('数据不存在或已被操作过！');
			}
		}

	}
	
	//更改状态
	public function changeCouponState(){
		$coupon_id = I('request.id',0,'intval');
		$type = I('request.type',0,'intval');
		$result = D('Coupon')->changeCouponState($coupon_id,$type);
		$this->ajaxReturn($result);
	}
	
	//优惠券领取列表
	public function couponBindList(){
		$coupon_id = I('request.id',0,'intval');
		$map = array('coupon_id'=>$coupon_id);
		
		$coupon_list = M('Coupon')->where($map)->find();
		
		if(!empty($coupon_list)){
			$da = M('Coupon_bind');
			
			$data['list'] = $da->where($map)->order('coupon_bind_id DESC')->page(intval($_GET['p']).','.$this->limit)->select();

			$count     = $da->where($map)->count();
			
			$data['pagetion']  = new \Think\Page($count,$this->limit);
			
			//优惠券名称
			$data['coupon_name'] = $coupon_list['coupon_name'];

			$this->assign('data',$data);
			$this->display();				
		}else{
			$this->error('优惠券不存在或已被删除！');
		}
	}
	
	//现金券列表
	public function cashVoucherList(){
		$da = M('Cash_voucher');
		$map = array();
		
		if(is_numeric($_GET['status'])){
			$map['status'] = intval($_GET['status']);
			$data['status'] = $map['status'];
		}
		$data['keywords'] = I('get.keywords','');
		if($data['keywords']){
			$map['voucher_name'] = array('LIKE','%'.$data['keywords'].'%');
		}
		
		$data['list'] = $da->where($map)->order('cash_voucher_id DESC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增现金券
	public function addCashVoucher(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Cash_voucher')->addCashVoucher($data);
			if($result['status']){
				 $this->success($result['msg'], U('Vouchers/cashVoucherList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	
	
	//更改现金券状态
	public function changeCashVoucherState(){
		$cash_voucher_id = I('request.id',0,'intval');
		$type = I('request.type',0,'intval');
		$result = D('Cash_voucher')->changeCashVoucherState($cash_voucher_id,$type);
		$this->ajaxReturn($result);
	}
	
	//现金券使用详情
	public function cashVoucherDetailList(){
		$cash_voucher_id = I('request.id',0,'intval');
		$map = array('cash_voucher_id'=>$cash_voucher_id);
		
		$cash_voucher_list = M('Cash_voucher')->where($map)->find();
		
		if(!empty($cash_voucher_list)){
			$da = M('Cash_voucher_detail');
			
			$data['list'] = $da->where($map)->order('cash_voucher_detail_id DESC')->page(intval($_GET['p']).','.$this->limit)->select();

			$count     = $da->where($map)->count();
			
			$data['pagetion']  = new \Think\Page($count,$this->limit);
			
			//现金券名称
			$data['voucher_name'] = $cash_voucher_list['voucher_name'];

			$this->assign('data',$data);
			$this->display();				
		}else{
			$this->error('现金券不存在或已被删除！');
		}
	}
	
	

	
}

?>