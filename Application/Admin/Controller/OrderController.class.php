<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends AdminController {
	
	public function index(){
		$this->display();
	}
	
	//全部订单列表
	public function orderList(){
		$da = M('Orders');
		$map = array();
		
		//订单号检索
		if($data['order_no'] = $_GET['order_no']){
			$map['order_no'] = $data['order_no'];
		}
        //收货人姓名检索
        if($data['consignee'] = $_GET['consignee']){
			$map['consignee'] = $data['consignee'];
        }
        //收货人电话检索
        if($data['mobile'] = $_GET['mobile']){
           $map['mobile'] = $data['mobile'];
        }
        //商品名称检索
        if($data['item_name'] = $_GET['item_name']){
			$orders_item_map['item_name'] = array('LIKE','%'.$data['item_name'].'%');
			$orders_item_list = M('Orders_item')->where($orders_item_map)->group('orders_id')->select();
			$tmp_orders_id = array();
            foreach($orders_item_list as $v){
               $tmp_orders_id[] = $v['orders_id'];
            }
			$map['orders_id'] = array('IN',$tmp_orders_id);
        }
		
		//订单状态
		if($data['status'] = $_GET['status']){
			switch($data['status']){
				//未付款 交易关闭
				case '1':
					$map['status'] = 0;
					$map['pay_status'] = 0;
					break;
				//已付款 交易关闭
				case '2':
                   	$map['status'] = 0;
					$map['pay_status'] = 1;
					break;
				//待付款
				case '3':
                   	$map['status'] = 1;
					$map['pay_status'] = 0;
					break;
				//待发货
				case '4':
					$map['status'] = 1;
					$map['pay_status'] = 1;
					$map['shipping_status'] = 0;
					break;
				//待收货
				case '5':
					$map['status'] = 1;
					$map['pay_status'] = 1;
					$map['shipping_status'] = 1;
					break;
				//交易完成
				case '6':
					$map['status'] = 3;
					break;
				//商品退货中
				case '7':
                    $map['status'] = 2;
					break;
				//已付款
				case '8':
					$map['pay_status'] = 1;
					break;
                //未付款
                case '9':
					$map['pay_status'] = 0;
					break;
                //未发货
                case '10':
					$map['shipping_status'] = 0;
                    break;
                //已发货
                case '11':
                    $map['shipping_status'] = 1;
                    break;
			}
		}
		
		//最小总金额
		if($data['min_amount'] = $_GET['min_amount']){
			$map['amount'][0] = array('egt',$data['min_amount']);
		}
		
		//最大总金额
		if($data['max_amount'] = $_GET['max_amount']){
			$map['amount'][1] = array('elt',$data['max_amount']);
		}
		
		//下单开始时间
		if($data['start_add_time'] = $_GET['start_add_time']){
			$map['add_time'][0] = array('egt',strtotime($data['start_add_time']));
		}
		
		//下单结束时间
		if($data['end_add_time'] = $_GET['end_add_time']){
			$map['add_time'][1] = array('elt',strtotime($data['end_add_time']));
		}
		
		//付款开始时间
		if($data['start_pay_time'] = $_GET['start_pay_time']){
			$map['pay_time'][0] = array('egt',strtotime($data['start_pay_time']));
		}
		
		//付款结束时间
		if($data['end_pay_time'] = $_GET['end_pay_time']){
			$map['pay_time'][1] = array('elt',strtotime($data['end_pay_time']));
		}
		
		//订单类型
		if($data['order_type'] = $_GET['order_type']){
			$map['order_type'] = $data['order_type'];
		}
		//订单来源
		if($data['source'] = $_GET['source']){
			$map['source'] = $data['source'];
		}
		
		$data['list'] = $da->where($map)->order('add_time DESC')->page(intval($_GET['p']).','.$this->limit)->select();
	
		$count     = $da->where($map)->count();

		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//订单明细
	public function orderDetail(){
		$map['orders_id'] = I('get.id','0','intval');
		$data['list'] = M('Orders')->where($map)->find();
		if(!empty($data['list'])){
			$data['item_list'] = M('Orders_item')->where($map)->select();
			
			//优惠券名称
			if($data['list']['coupon_amount'] >0){
				$data['list']['coupon_name'] = M('Coupon_bind')->field('coupon_name')->join('md_coupon ON md_coupon.coupon_id = md_coupon_bind.coupon_id')->where($map)->getField('coupon_name');
			}
			
			//现金券名称
			if($data['list']['cash_voucher_amount'] >0){
				$data['list']['voucher_name'] = M('Cash_voucher_detail')->field('voucher_name')->join('md_cash_voucher ON md_cash_voucher.cash_voucher_id = md_cash_voucher_detail.cash_voucher_id')->where($map)->getField('voucher_name');
			}
			
			$this->assign('data',$data);
			$this->display();
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//待发货订单列表
	public function shippingOrderList(){
		$da = M('Orders');
		$map = array('status'=>1,'pay_status'=>1,'shipping_status'=>0);
		
		$data['list'] = $da->where($map)->order('add_time DESC')->page(intval($_GET['p']).','.$this->limit)->select();
	
		$count     = $da->where($map)->count();

		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//发货
	public function doShipping(){
		$orders_id = I('request.id',0,'intval');
		$map = array('orders_id'=>$orders_id,'status'=>1,'pay_status'=>1,'shipping_status'=>0);
		$data['list'] = M('Orders')->where($map)->find();
		if(!empty($data['list'])){
			if(IS_POST){
				$data = I('post.');
				$result = D('Orders')->doShipping($orders_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Order/shippingOrderList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['item_list'] = M('Orders_item')->where($map)->select();
				$data['delivery'] = M('Delivery_mode')->select();
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
}

?>