<?php
namespace Home\Model;
use Think\Model;
/**
* 
*/
class ItemModel extends Model{

	//商品详情
	public function productDetail($item_id){
       $item['item_info']=$this->field('md_item.*,md_item_spec_price.online_price,md_item_spec_price.shop_price,md_item_detail.description,md_item_spec_price.stock,md_item_spec_price.sales_volume')->join('md_item_spec_price ON md_item_spec_price.item_id = md_item.item_id')->join(' LEFT JOIN md_item_detail ON md_item_detail.item_id = md_item.item_id')->where(array('md_item.item_id'=>$item_id,'md_item.is_on_sale'=>1,'md_item.is_del'=>0))->find();
       
	   //商品图片
	    $item['item_image']=D('ItemImage')->where(array('item_id'=>$item_id))->select();
	    foreach ($item['item_image'] as $key => $value) {
	    	if($value['is_default']==1){
                $item['default_image']=$value['img_uri'];
	    	}
	    }
	    if(empty($item['default_image'])){
            $item['default_image']='/Public/upload/watermark.jpg';
	    }

        $account_user = session('lbg_account');
            if(!empty($account_user)){
                $where['account_id']= $account_user['uid'];
                $where['item_id']= $item_id;
                $item['favorite']=D('AccountFavorite')->where($where)->find();
                $item['item_total']=M('ShoppingCart')->where(array('account_id'=>$account_user['uid']))->sum('num');
            }
	    //商品分类信息
        $item['cate_info']=D('ItemCategory')->find($item_info['item_category_id']);

        return $item;
	}
	
	
	//判断商品是否存在
	public function isItemExists($item_id,$item_spec_ids){
		$db_prefix = C('DB_PREFIX');
		$sql = "select t1.* from ".$db_prefix."item t1 inner join ".$db_prefix."item_spec_price t2 on t1.item_id=t2.item_id 
				where t1.item_id='{$item_id}' and t1.is_on_sale=1 and t1.is_del=0 and t2.item_spec_ids='{$item_spec_ids}'";
		return M('')->query($sql);
	}

	
	//检测商品
	public function checkItem($products_list){
		$all_online_price = $all_app_price =  0;
		$db_prefix = C('DB_PREFIX');
		$now = time();
		$result = array('status'=>1,'msg'=>'OK');
		foreach($products_list as $k=>$v){
			$sql = "select t1.name,t2.online_price,t2.app_price,t2.stock from ".$db_prefix."item t1 
			inner join ".$db_prefix."item_spec_price t2 on t1.item_id=t2.item_id where 
			t1.is_on_sale=1 and t1.is_del=0 and t1.item_id='{$v['item_id']}' and t2.item_spec_ids='{$v['item_spec_ids']}'";
			
			$list = M('')->query($sql);
			$list = $list[0];
			if(empty($list)){
				$result = array('status'=>0,'msg'=>'含有下架或已被删除的商品，请重新结算');
				break;
			}
			
			if($v['num'] > $list['stock']){
				$result = array('status'=>0,'msg'=>'商品【'.$list['name'].'】库存不足，当前库存：'.$list['stock']);
				break;
			}

			//获取促销信息
			$map['item_id'] = $v['item_id'];
			$map['start_time'] = array('elt',$now);
			$map['end_time'] = array('egt',$now);
			$item_sale_info = M('Item_sale')->field('sale_price')->where($map)->order('start_time ASC')->find();
			
			if(!empty($item_sale_info)){
				$list['online_price'] = $list['app_price'] = $item_sale_info['sale_price'];
				$products_list[$k]['has_sale'] = 1;
			}else{
				$products_list[$k]['has_sale'] = 0;
			}
			
			
			$all_online_price+=$list['online_price']*$v['num'];
			$all_app_price+=$list['app_price']*$v['num'];
			$products_list[$k]['item_name'] = $list['name'];
			$products_list[$k]['online_price'] = $list['online_price'];
			$products_list[$k]['app_price'] = $list['app_price'];
		}
		$count_info = array(
			'all_online_price'=>$all_online_price,
			'all_app_price'=>$all_app_price,
		);
		if($result['status']){
			$result = array('status'=>1,'products_list'=>$products_list,'count_info'=>$count_info);
		}
		return $result;
	}

}