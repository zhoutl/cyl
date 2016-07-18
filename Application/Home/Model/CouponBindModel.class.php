<?php
namespace Home\Model;
use Think\Model;
/**
* 优惠券绑定Model
*/
class CouponBindModel extends Model{
    
    /* 领取优惠券的方法 */
    public function getCoupon ($account_id,$data) {

        while (true) {

            $data['account_id'] = $account_id;
            //查询优惠券的全部信息
            $map['coupon_id']   = $data['coupon_id'];
            $val                = M('Coupon') -> where($map) -> find();

            //判断优惠券是否存在
            if (empty($val['coupon_id'])) {
                $result = array('status' => 0,'msg' => '该优惠券不存在');
				break;
            }

            //判断优惠券的状态
            if ($val['status'] != '1') {
                $result = array('status' => 0,'msg' => '该优惠券已经下架');
                break;
            }

            //判断该优惠券是否还有存量
            if ($val['coupon_remaining_quantity'] < 1) {
                $result = array('status' => 0,'msg' => '该优惠券已经被领光了');
                break;
            }

            //查询当前用户是否已经将该优惠券领取超过限定数量
            $map['account_id']  = $account_id;
            $count              = $this -> where($map) -> count();

            if ($count >= $val['coupon_limit']) {
                $result = array('status' => 0,'msg' => '该优惠券最多领取'.$val['coupon_limit'].'张');
                break;
            }
            
            //将数据插入数据库
            $data['bind_time']  = time();
            $var = $this -> add($data);
            if (empty($var)) {
                $result = array('status' => 0,'msg' => '领取失败');
                break;
            }

            //减少其存量
            $map              = array();
            $map['coupon_id'] = $data['coupon_id'];
            $var = M('Coupon') -> where($map) -> setDec('coupon_remaining_quantity',1);
            if (empty($var)) {
                $result = array('status' => 0,'msg' => '领取错误');
                break;
            }
            $result = array('status' =>0,'msg' =>'领取成功');
            break;
        }

        return $result;

    }
	
	//获取用户可用优惠券
	public function getAllowCoupon($account_id,$amount,$from){
		$db_prefix = C('DB_PREFIX');
		$now = time();
		
		$sql = "select t1.coupon_id,t1.coupon_name,t1.coupon_amount from ".$db_prefix."coupon t1 inner join ".$db_prefix."coupon_bind t2 
			on t1.coupon_id=t2.coupon_id where t1.status=1 and t2.is_use=0 and t1.start_time<=".$now." and t1.end_time>=".$now." and t2.account_id=".$account_id."
			and (t1.limit_amount=0 or t1.limit_amount<=".$amount.") and ".change_map($from);
		
		return M('')->query($sql);
	}
	
	//验证优惠券是否可用
	public function checkCoupon($account_id,$coupon_id,$amount,$from){
		$db_prefix = C('DB_PREFIX');
		$now = time();
		
		$sql = "select t1.coupon_id,t1.coupon_name,t1.coupon_amount,t2.coupon_bind_id from ".$db_prefix."coupon t1 inner join ".$db_prefix."coupon_bind t2 
		on t1.coupon_id=t2.coupon_id where t1.status=1 and t2.is_use=0 and t1.start_time<=".$now." and t1.end_time>=".$now." and t2.account_id=".$account_id."
		and (t1.limit_amount=0 or t1.limit_amount<=".$amount.") and ".change_map($from)." and t1.coupon_id=".$coupon_id;

		$list = M('')->query($sql);
		
		return $list?$list[0]:false;
	}
	




}

?>