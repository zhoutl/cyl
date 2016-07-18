<?php 
namespace Admin\Model;
use Think\Model;
class ItemSaleModel extends Model {
	protected $_validate = array(
		array('sale_price','is_numeric','请输入正确格式的促销价格',1,'function'), 
		array('start_time','strtotime','请选择正确格式的开始时间',1,'function'), 
		array('end_time','strtotime','请选择正确格式的结束时间',1,'function'), 
	);
	
	//新增促销商品
    public function addItemSale($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$data['item_id'] = intval($data['item_id']);
			//判断促销商品是否存在
			$list = M('Item')->where('item_id='.$data['item_id'])->find();
			
			if(empty($list)){
				$result = array('status'=>0,'msg'=>'商品不存在');
				break;
			}
			
			if($list['is_del']!='0' || $list['is_on_sale'] != '1'){
				$result = array('status'=>0,'msg'=>'该商品已下架或已被删除');
				break;
			}
			

			$data['start_time'] = strtotime($data['start_time']);
			$data['end_time'] = strtotime($data['end_time']);
			$data['pubdate']  = time();
		
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改促销商品
    public function editItemSale($item_sale_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['item_sale_id'] = intval($item_sale_id);
			
			$data['start_time'] = strtotime($data['start_time']);
			$data['end_time'] = strtotime($data['end_time']);
			
			
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除促销商品
	public function delItemSale($item_sale_id){
		$map['item_sale_id'] = intval($item_sale_id);
		$this->where($map)->delete();
		$result = array('status'=>1,'msg'=>'删除成功');
		return $result;
	}
	
}

?>