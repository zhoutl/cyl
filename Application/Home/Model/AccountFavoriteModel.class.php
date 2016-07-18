<?php
namespace Home\Model;
use Think\Model;
/**
* 
*/
class AccountFavoriteModel extends Model{
     
    public function favoriteDetail ($account_id,$page,$limit=5) {

        //组装join条件
        $item     = 'md_item ON md_item.item_id = md_account_favorite.item_id';
        $itemspec = 'md_item_spec_price ON md_item_spec_price.item_id = md_account_favorite.item_id';
        $itemimg  = 'LEFT JOIN md_item_image ON md_item_image.item_id = md_account_favorite.item_id AND md_item_image.is_default = 1';
        $join     = array($item,$itemspec,$itemimg);
        
        //组装查询条件
        $map['md_account_favorite.account_id'] = $account_id;

        //组装查询字段
        $field    = array(
        	        'md_account_favorite.account_favorite_id',
        	        'md_account_favorite.pubdate',
                    'md_account_favorite.item_id',
        	        'md_item.name',
        	        'md_item_spec_price.online_price',
        	        'md_item_image.img_uri',
        );

        return $this-> field($field) -> join($join) -> where($map) -> page(intval($page),$limit) -> select();
    }


    public function favoriteAdd($account_id,$item_id){
        while (ture) {

            $ins_data['item_id']=intval($item_id);
            $item_info=D('Item')->where('is_on_sale=1 and is_del=0 and item_id='.$item_id)->find();
            if(empty($item_info)){
                 $result = array('status'=>0,'msg'=>'不存在此商品或商品下架');
                 break;
            }
            $ins_data['account_id']=$account_id;
            $ins_data['pubdate']=time();
            $favorite=$this->where(array('item_id'=> $ins_data['item_id'] ,'account_id'=>$ins_data['account_id']))->find();
            if(!empty($favorite)){
               $result =array('status'=>0,'msg'=>'您已收藏过该商品，请勿重复收藏');
               break;
            }
             $this->add($ins_data);
             $result = array('status'=>1,'msg'=>'收藏成功');
            break;
        }
 
        return $result;
    }


    public function setDelete ($account_id,$data) {

        while (ture) {

            $map['account_id'] = $account_id;
            
            if (!is_array($data) && !is_numeric($data) ) {
                $result = array('status' => 0,'msg' => '取消收藏失败');
                break;
            }

            if (is_array($data)) {
                $map['account_favorite_id'] = array('in',$data);
            }

            if (is_numeric($data)) {
                $map['account_favorite_id'] = $data;
            }

            $this -> where($map) -> delete();
            $result = array('status' => 1,'msg' => '您已取消收藏');
            break;
        }
        return $result;
    }

}



?>