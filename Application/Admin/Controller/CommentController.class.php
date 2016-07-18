<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class CommentController extends AdminController {
    
    public function index () {

        $this -> display();

    }

    public function commentList () {
        

        $map['parent_id']     = 0;
        $map['account_id']    = array('NEQ',0);
        //获取评论列表数据
        $data['list']         = M('ItemComment') -> order('reply_time desc') ->where($map) -> select();
        //将数据组装进data中
        foreach ($data['list'] as $key => $vo) {
        	$map['item_id']                 = $vo['item_id'];
            $data['list'][$key]['items']    = M('Item') -> field('name') -> where($map) -> find();
        }

        $this -> assign('data',$data);
        $this -> display();

    }

    //修改评论状态
    public function changeStatus () {

        if (IS_AJAX) {
        	
            $item_comment_id    = I('post.id');
            $type               = I('post.type');
            $result             = D('ItemComment') -> changeStatus($item_comment_id,$type);
            $this -> ajaxReturn($result);
        }
    }

    //回复页面
    public function reply () {


        //获取基本信息和图片信息
        $map['item_comment_id'] = intval(I('get.item_comment_id'));
        $data                   = M('ItemComment') -> where($map) -> find();
        $data['images']         = M('ItemCommentImage') -> field('img_uri') ->where($map) -> select();
        
        //获取订单号加入data中
        $map                    = array();
        $map['orders_id']       = $data['orders_id'];
        $var                    = M('Orders') -> where($map) -> field('order_no') -> find();
        $data['order_no']       = $var['order_no'];

        $map                    = array();
        $map['parent_id']       = intval(I('get.item_comment_id'));
        $var                    = array();
        $var                    = M('ItemComment') -> field('content') -> where($map) -> select();
        $data['comments']       = $var;
        //print_r($data);die;

        $this -> assign('data',$data);
        $this -> display();
    }

    //回复操作
    public function doReply () {

        $admin_id               = $this->admin_user_id;
        $data                   = I('post.');    
        $result                 = D('ItemComment') -> doReply($admin_id,$data);

        if (empty($result['status'])) {
            $this -> error($result['msg'], '');
        }
        $this -> success($result['msg'],U('Comment/CommentList'));
    }

    public function adminComment () {
        
        $map['parent_id']  = 0;
        $map['account_id'] = 0;
        $data['list']      = M('ItemComment') -> where($map) -> select();

        foreach ($data['list'] as $key => $vo) {
            $map['item_id'] = $vo['item_id'];
            $data['list'][$key]['items'] = M('Item') -> field('name') -> where($map) -> find();
        }

        $this -> assign('data',$data);
        $this -> display();
    }

    //新增商品评论
    public function addComment () {
        $this -> display();
    }

    public function doAddComent () {

        $data     = I('post.');
        $admin_id = $this->admin_user_id;
        $result   = D('ItemComment') -> setAddComent($admin_id,$data);
        if (empty($result['status'])) {
            $this -> error($result['msg'], '');
        }
        $this -> success($result['msg'],U('Comment/adminComment'));
    }


}



?>