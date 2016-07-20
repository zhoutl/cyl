<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CheckController {
	
    public function index(){
    
        $seo_data['title']         = '首页';
        $seo_data['keywords']      = '衡水老白干官方商城';
        $seo_data['description']   = '衡水老白干官方商城';

        // $data['coupon']            = M('Coupon') -> select();
        // $map['account_id']         = $_SESSION['lbg_account']['uid'];
        
        // $orders                    = M('Orders') -> where($map) -> select();

        // foreach ($orders as $key => $vo) {
        //     $map                   = array();
        //     $map['orders_id']      = $vo['orders_id'];
        //     $items                 = M('OrdersItem') -> where($map) -> select();
        //     $orders[$key]['items'] = $items;
        // }
        
        // $data['orders']            = $orders;
        //print_r($data);die;
        $this -> assign('data',$data);
        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }
}