<?php
namespace Home\Controller;
use Think\Controller;
/**
* 优惠券Controller
*/
class CouponController extends Controller{

    public function index () {

    	$seo_data['title']       = '优惠券';
        $seo_data['keywords']    = '衡水老白干官方商城';
        $seo_data['description'] = '衡水老白干官方商城';

        $var                     = I('get.coupon_id');
        $map['coupon_id']        = intval(base64_decode($var));

        $count                   = M('Coupon') -> where($map) -> count();

        if (empty($count)) {
            $this -> assign('msg','抱歉，没有该优惠券');
            $this -> display('Common/miss');
        }

        $data                    = M('Coupon') -> where($map) -> find();

        $this -> assign('data',$data);
        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }

}




?>