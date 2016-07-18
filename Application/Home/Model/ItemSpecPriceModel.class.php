<?php
namespace Home\Model;
use Think\Model;

class ItemSpecPriceModel extends Model{
	
	//判断库存是否充足
	public function checkStock($item_id,$item_spec_ids,$num){
		$map = array('item_id'=>$item_id,'item_spec_ids'=>$item_spec_ids);
		$list = $this->where($map)->find();
		if($list['stock']>=$num){
			$result = array('status'=>1,'msg'=>'OK');
		}else{
			$result = array('status'=>0,'msg'=>'库存不足','stock'=>$list['stock']);
		}
		return $result;
	}
	
	
}

?>