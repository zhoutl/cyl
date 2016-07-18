<?php
namespace Home\Model;
use Think\Model;

class CashVoucherModel extends Model{
	
	//检测现金券是否可用
	public function checkVoucher($voucher_code,$limit_amount,$from){
		while(true){
			if(empty($voucher_code) || !preg_match ("/^[A-Za-z0-9]+$/u", $voucher_code)){
				$result = array('status'=>0,'msg'=>'请输入正确格式的现金券码');
				break;
			}
			
			$db_prefix = C('DB_PREFIX');
			$now = time();
			$sql = "select t1.cash_voucher_id,t1.voucher_amount,t1.limit_amount,t1.status,t1.is_pc,t1.is_wap,t1.is_app,t2.is_use,t2.cash_voucher_detail_id from ".$db_prefix."cash_voucher t1 
			inner join ".$db_prefix."cash_voucher_detail t2 on t1.cash_voucher_id=t2.cash_voucher_id where t2.voucher_code='".$voucher_code."' and 
			t1.start_time<=".$now." and t1.end_time>=".$now;
			
			$list = M('')->query($sql);
			$list = $list[0];
			
			if(empty($list)){
				$result = array('status'=>0,'msg'=>'现金券不存在或已过期');
				break;
			}
			
			if($list['status'] == '0'){
				$result = array('status'=>0,'msg'=>'该现金券已被禁用');
				break;
			}

			if($list['is_use'] == '1'){
				$result = array('status'=>0,'msg'=>'该现金券已使用过');
				break;
			}
			
			if($list['limit_amount']>(float) $limit_amount){
				$result = array('status'=>0,'msg'=>'订单金额未满足该现金券的最低限定金额');
				break;
			}
			
			$condition = change_map($from,2);
			$key = 0;
			foreach($condition as $k=>$v){
				$key = $k;
			}
			
			if($list[$key] != '1'){
				$str='';
				if($list['is_pc'] == '1') $str.='PC端、';
				if($list['is_wap'] == '1') $str.='Wap端、';
				if($list['is_app'] == '1') $str.='App端、';
				$result = array('status'=>0,'msg'=>'该现金券仅'.$str.'可用');
				break;
			}
				 
			$result = array('status'=>1,'msg'=>'OK','cash_voucher_info'=>$list);
			break;			
		}
		return $result;
	}
	
	
}
?>