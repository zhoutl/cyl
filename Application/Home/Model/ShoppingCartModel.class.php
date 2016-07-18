<?php
namespace Home\Model;
use Think\Model;

class ShoppingCartModel extends Model{
	
	//获取购物车信息
	public function getCartInfo($account_id,$cart_ids = array()){
		//判断是否有购物车ID选择
		if(!empty($cart_ids)){
			$where = " and t1.shopping_cart_id in (".implode(',',$cart_ids).")";
		}else{
			$where = '';
		}
		$db_prefix = C('DB_PREFIX');
		$sql = "select t1.shopping_cart_id,t1.num,t2.item_id,t2.name,t2.short_name,t3.online_price,t3.app_price,t4.img_uri from 
		((".$db_prefix."shopping_cart t1 inner join ".$db_prefix."item t2 on t1.item_id=t2.item_id) inner join ".$db_prefix."item_spec_price t3 on t1.item_id=t3.item_id) 
		 left join ".$db_prefix."item_image t4 on t1.item_id=t4.item_id and t4.is_default=1 where t1.account_id='{$account_id}' and t2.is_on_sale=1 and t2.is_del=0 and t3.item_spec_ids=0".$where;
		
		$list = M('')->query($sql);
		$all_online_price = $all_app_price = $all_num =  0;
		$now = time();
		foreach($list as $k=>$v){
			//获取促销信息
			$map['item_id'] = $v['item_id'];
			$map['start_time'] = array('elt',$now);
			$map['end_time'] = array('egt',$now);
			$item_sale_info = M('Item_sale')->field('sale_price')->where($map)->order('start_time ASC')->find();
			//如果存在商品促销
			if(!empty($item_sale_info)){
				$list[$k]['online_price'] = $list[$k]['app_price'] = $item_sale_info['sale_price'];
				$list[$k]['has_sale'] = 1;
			}else{
				$list[$k]['has_sale'] = 0;
			}
			
			$all_online_price+=$list[$k]['online_price']*$list[$k]['num'];
			$all_app_price+=$list[$k]['app_price']*$list[$k]['num'];
			$all_num+=$v['num']; 
		}
		
		if($list){
			$list['count_info'] = array(
				'all_online_price'=>number_format($all_online_price,2,'.',''),
				'all_app_price'=>number_format($all_app_price,2,'.',''),
				'all_num'=>$all_num,
			);
		}
		
		return $list;
	}
	
	//加入购物车
	public function addCart($account_id,$item_id,$num,$item_spec_ids){
		while(true){
			if($num<1){
				$result = array('status'=>0,'msg'=>'请输入正确的数量');
				break;
			}
			
			//判断商品是否存在
			$item_list = D('Home/Item')->isItemExists($item_id,$item_spec_ids);
			if(empty($item_list)){
				$result = array('status'=>0,'msg'=>'商品不存在或已下架');
				break;
			}
			
			//获取该商品在购物车中已存的数量
			$map = array('item_id'=>$item_id,'account_id'=>$account_id,'item_spec_ids'=>$item_spec_ids);
			$shopping_cart_list = $this->where($map)->find();
			$cart_num = $shopping_cart_list['num']?$shopping_cart_list['num']:0;
		
			//判断库存是否充足
			$res = D('Home/Item_spec_price')->checkStock($item_id,$item_spec_ids,$cart_num+$num);
			if(!$res['status']){
				$result = $res;
				break;
			}
			
			//判断该商品是否在购物车中，在购物车中更新数量，不在购物车中添加
			if(!empty($shopping_cart_list)){
				$data['num'] = $num + $cart_num;
				$map = array('shopping_cart_id'=>$shopping_cart_list['shopping_cart_id']);
				$this->where($map)->save($data);
				$shopping_cart_id = $shopping_cart_list['shopping_cart_id'];
			}else{
				$data = array(
					'account_id'=>$account_id,
					'item_id'=>$item_id,
					'item_spec_ids'=>$item_spec_ids,
					'num'=>$num,
					'pubdate'=>time(),
				);
				$shopping_cart_id = $this->add($data);
			}
			
			$result = array('status'=>1,'msg'=>'加入购物车成功','shopping_cart_id'=>$shopping_cart_id);
			
			break;
		}
		return $result;
	}
	
	//更新购物车
	public function updateCart($account_id,$shopping_cart_id,$num){
		while(true){
			if($num<1){
				$result = array('status'=>0,'msg'=>'请输入正确的数量');
				break;
			}
			//获取是否存在该购物车
			$map = array('shopping_cart_id'=>$shopping_cart_id,'account_id'=>$account_id);
			$shopping_cart_list = $this->where($map)->find();
			
			if(empty($shopping_cart_list)){
				$result = array('status'=>0,'msg'=>'购物车中无此商品','error_do'=>'reload');
				break;
			}
			
			//判断商品是否存在
			$item_list = D('Home/Item')->isItemExists($shopping_cart_list['item_id'],$shopping_cart_list['item_spec_ids']);
			if(empty($item_list)){
				$result = array('status'=>0,'msg'=>'商品不存在或已下架','error_do'=>'reload');
				break;
			}
			
			//判断库存是否充足
			$res = D('Home/Item_spec_price')->checkStock($shopping_cart_list['item_id'],$shopping_cart_list['item_spec_ids'],$num);
			if(!$res['status']){
				$result = array('status'=>0,'msg'=>'库存不足，当前库存：'.$res['stock'],'error_do'=>'reload');
				break;
			}	
			
			$this->where($map)->save(array('num'=>$num));
			$result = array('status'=>1,'msg'=>'更新购物车成功');
			break;
		}
		return $result;
		
	}
	
	//删除购物车
	public function delCart($account_id,$shopping_cart_id){
		$map['account_id'] = $account_id;
		if(is_array($shopping_cart_id)){
			foreach($shopping_cart_id as $k=>$v){
				$shopping_cart_id[$k] = intval($v);
			}
			$map['shopping_cart_id'] = array('in',$shopping_cart_id);
		}else{
			$map['shopping_cart_id'] = intval($shopping_cart_id);
		}
		$this->where($map)->delete();
		$result = array('status'=>1,'msg'=>'删除成功');
		return $result;
	}
	
	//情况购物车
	public function delMyCart($account_id){
		$map['account_id'] = $account_id;
		$this->where($map)->delete();
		$result = array('status'=>1,'msg'=>'清空购物车成功');
		return $result;
	}
	
}

?>