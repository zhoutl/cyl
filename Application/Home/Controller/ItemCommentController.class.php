<?php
namespace Home\Controller;
use Think\Controller;
/**
* 商品评论Conyroller
*/

class ItemCommentController extends HomeController {
    
    public function index () {

        $seo_data['title']                   = '我的评价';
        $seo_data['keywords']                = '衡水老白干官方商城';
        $seo_data['description']             = '衡水老白干官方商城';

        //订单数据查询
        $map                                 = array('account_id' => $this->mid);
        $limit                               = 5;
        $data['list']                        = M('ItemComment') -> page(intval(I('get.p')),$limit) -> where($map) -> order('item_comment_id DESC') -> select();

        //相关数据加入data数组
        foreach ($data['list'] as $key => $vo) {

           $data['list'][$key]['img_list']   = M('ItemCommentImage') -> field('img_uri') ->where('item_comment_id='.$vo['item_comment_id']) -> select();

           $data['list'][$key]['orderno']    = M('Orders') -> where('orders_id='.$vo['orders_id']) -> getField('order_no');

           $data['list'][$key]['reply_list'] = M('ItemComment') -> field('content') -> where('parent_id='.$vo['item_comment_id']) -> select();

           $data['list'][$key]['img_item']   = M('ItemImage') -> field('img_uri') -> where('item_id='.$vo['item_id'])-> where('is_default = 1')-> find();

           $data['list'][$key]['items']      = M('OrdersItem') -> field('item_name,quantity') -> where('orders_id='.$vo['orders_id']) -> where('item_id='.$vo['item_id']) -> find();
        }

        //置空$map
        $map                                 = array();
        //设置分页
        $map['account_id']                   = $this ->mid;
        $count                               = M('ItemComment') -> where($map) -> count();
        $data['pages']                       = new \Think\Page($count,$limit);
        

        $this -> assign('data',$data);
        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }

    /* 商品评价页面 */
    public function itemComment () {

        //获取相关订单ID和商品ID
        $map['orders_id']                = intval(I('get.orders_id'));

        //根据订单ID查找出该订单的status的状态
        $val                             = M('Orders') -> field('status') ->where($map) -> find();
        
        if ($val['status'] != 3) {
            $this -> assign('msg','抱歉该订单尚未完成，不能评论');
            $this -> display('Common/miss');
        }
        

        $map['item_id']                  = intval(I('get.item_id'));
        $count                           = M('OrdersItem') -> where($map) -> count();

        //判断是该商品是否属于该订单 
        if (empty($count)) {
            $this -> assign('msg','抱歉该商品不在此订单内');
            $this -> display('Common/miss');
        }

        $var                             = M('OrdersItem') -> field('is_comment') -> where($map) -> find();

        //判断该商品是否已经被评论过
        if ($var['is_comment'] == 1) {
            $this -> assign('msg','抱歉您已经对该商品评论过了');
            $this -> display('Common/miss');
        }
        
        //置空$map重新设置条件进行两表查询
        $map                             = array();
        $map['md_orders_item.item_id']   = intval(I('get.item_id'));
        $map['md_orders_item.orders_id'] = intval(I('get.orders_id'));

        //组装join语句
        $join                            = 'LEFT JOIN md_item_image ON md_item_image.item_id = md_orders_item.item_id AND is_default = 1';

        //获取items数据
        $data['items']                   = M('OrdersItem') -> join($join) -> where($map) -> find();
        $data['items']['item_id']        = intval(I('get.item_id'));

        $this -> assign('data',$data);
        $this -> display();
    }

    public function setItemComment () {

        if (IS_AJAX) {
            $data = I('post.');
            $result = D('ItemComment') -> setItemComment($this ->mid,$data);
            $this -> ajaxReturn($result);
        }
    }
    






}