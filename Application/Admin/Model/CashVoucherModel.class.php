<?php 
namespace Admin\Model;
use Think\Model;
class CashVoucherModel extends Model {
	protected $_validate = array(
		array('voucher_name','1,20','现金券名称为1-20个字',1,'length'), 
		array('is_pc',array(1),'请选择正确的使用平台',2,'in'), 
		array('is_wap',array(1),'请选择正确的使用平台',2,'in'), 
		array('is_app',array(1),'请选择正确的使用平台',2,'in'), 
		array('voucher_amount','is_numeric','请输入正确的现金券金额',1,'function'), 
		array('limit_amount','is_numeric','请输入正确的最低使用条件',1,'function'), 
		array('voucher_quantity','is_numeric','请输入正确的现金券总数',1,'function'), 
		array('start_time','strtotime','请选择正确格式的开始时间',1,'function'), 
		array('end_time','strtotime','请选择正确格式的结束时间',1,'function'), 
		array('status',array(0,1),'请选择是否启用',1,'in'), 
		array('security_code','/^[0-9A-Za-z]{3}$/','现金券安全码由3位数字字母组成',1,'regex'),
	);
	
	//新增现金券
    public function addCashVoucher($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}

			$data['is_pc'] = $data['is_pc']=='1'?1:0;
			$data['is_wap'] = $data['is_wap']=='1'?1:0;
			$data['is_app'] = $data['is_app']=='1'?1:0;
			
			$data['start_time'] = strtotime($data['start_time']);
			$data['end_time'] = strtotime($data['end_time']);
			$data['pubdate']  = time();
		
			$cash_voucher_id = $this->add($data);
			for($i=1;$i<=$data['voucher_quantity'];$i++){
				$cash_voucher_detail_data = array(
					'cash_voucher_id' => $cash_voucher_id,
					'voucher_code'=>strtolower($data['security_code'].get_rand_str()),
				);
				M('Cash_voucher_detail')->add($cash_voucher_detail_data);
			}
			
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	
	//更改现金券状态
	public function changeCashVoucherState($cash_voucher_id,$type){
		$map['cash_voucher_id'] = intval($cash_voucher_id);
		if($type == 1){
			$data = array('status'=>1);
		}else{
			$data = array('status'=>0);
		}
		
		$this->where($map)->save($data);
		$result = array('status'=>1,'msg'=>'修改成功');
		return $result;
	}
	
}

?>