<?php
namespace Home\Model;
use Think\Model;
/**
* 
*/
class ItemCommentModel extends Model {

    protected $_validate = array(
        array('content','1,200','请输入1-200位字符串',1,'length',1),
        array('content','/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u','请输入正确格式',1,'regex',1),
        array('score',array(1,2,3,4,5),'评分错误',1,'in',1)
    );

    protected $_auto = array(
    	  array('parent_id','0'),
    	  array('admin_id','0'),
        array('is_show','1'),
        array('reply_time','time',1,'function'),
        array('source','1'),
    );
    
    public function setItemComment ($account_id,$data) {

        while (true) {
            
            //判断该订单是否存在且属于该用户
            $map['orders_id'] = $data['orders_id'];
            $map['account_id']= $account_id;

            $count            = M('Orders') -> where($map) -> count();

            if (empty($count)) {
                $result = array('status' => 0,'msg' => '订单不存在或不属于当前用户');
                break;
            }

            //判断订单是否已经完成交易
            $var              = M('Orders') -> field('status') -> where($map) -> find();

            if ($var['status'] != 3) {
                $result = array('status' => 0,'msg' => '订单没有完成交易');
                break;
            }

            //判断该商品是否存在、在售、删除
            $map              = array();
            $map['item_id']   = $data['item_id'];

            $count            = M('Item') -> where($map) -> count();

            if (empty($count)) {
                $result = array('status' => 0,'msg' => $data['item_id']);
                break;
            }

            $var              = M('Item') -> field('is_on_sale,is_del') -> where($map) -> find();

            if (empty($var['is_on_sale'])) {
                $result = array('status' => 0,'msg' => '该商品已经下架');
                break;
            }

            if (!empty($var['is_del'])) {
                $result = array('status' => 0,'msg' => '该商品已经删除');
                break;
            }
            
            //获取该用户的item_spec_ids
            $map['orders_id'] = $data['orders_id'];
            $var              = M('OrdersItem') -> field('item_spec_ids,is_comment') -> where($map) -> find();

            //判断商品属于该订单
            $count            = M('OrdersItem') -> where($map) -> count();

            if (empty($count)) {
                $result = array('status' => 0,'msg' => '订单中没有该商品');
                break;
            }
             
            //判断该商品是否已经被评论了
            if (!empty($var['is_comment'])) {
                $result = array('status' => 0,'msg' => '该商品已经被评论了');
                break;
            }
            
            //对评论内容和评分进行验证
            if (!$this -> create($data)) {
                $result = array('status' => 0,'msg' => $this -> getError());
                break;
            }

            //验证晒单图片的数量
            if (count($data['filename'])>5) {
                $result = array('status' => 0,'msg' => '最多可以晒5张照片');
                break;
            }

            //将评论数据插入数据库主表中
            $data['item_spec_ids'] = $var['item_spec_ids'];
            $data['account_id']    = $account_id;
            $data['name']          = session('lbg_account')['name'];
            //对相关数据进行处理
            $comment_data          = $this -> create($data);
            //获取已经插入成功的id
            $item_comment_id       = $this -> add($comment_data);

            if (empty($item_comment_id)) {
                $result = array('status' => 0,'msg' =>'评论失败');
                break;
            }

            //验证是否有上传图片
            if (!empty($data['filename'])) {
                $val = D('ItemCommentImage') -> setCommentImage($item_comment_id,$data['filename']);
                if(empty($val['status'])) {
                   $result = array('status' => 0,'msg' => $val['msg']);
                   break;
                }
            }

            //修改订单商品的评论状态
            M('OrdersItem') -> where($map) -> setField('is_comment','1');
            $result = array('status' => 1,'msg' => '评论成功');
            break;
        }
        return $result;
    }


    //AJAX分页
    public function ajax_page($item_id,$data){

            $map['item_id']=$item_id;
            $tab=intval($data['tab'])?intval($data['tab']):1;
            $page=intval($data['p'])?intval($data['p']):1;
            $map['is_show']=1;
            $map['parent_id']=0;
            if($tab==1){
              $one=M('Item_comment')->where($map)->field('item_comment_id')->select();
               foreach ($one as $k => $v) {
                 $comment_image=M('Item_comment_image') ->where(array('item_comment_id'=>$v['item_comment_id']))->field('img_uri')->select();
                 if(!empty($comment_image)){
                     $img_map[]=$v['item_comment_id'];
                 }
               }
               $map['item_comment_id']=array('in',$img_map);
            }elseif($tab==2){
             //好评
             $map['score']=5;
            }else if($tab==3){
             //中评
             $map['score']=array('in','3,4');
            }else if($tab==4){
             //差评
             $map['score']=array('in','1,2');
            }
           $count=M('Item_comment')->where($map)->count();
           $item_comment= M('Item_comment') ->where($map) -> page($page,10) -> select();
           foreach ($item_comment as $key => $value) {
              $item_comment[$key]['img']= M('Item_comment_image') ->where(array('item_comment_id'=>$value['item_comment_id']))->select();
              //回复
              $item_comment[$key]['parent']= M('Item_comment') ->where(array('parent_id'=>$value['item_comment_id']))->select();
           }
          $comment_pages = new \Think\Page($count,10,array('p'=>$page));
          $comment_pages->setConfig('link','Product/commentPage');
          $comment_pages->setConfig('tab',$tab);
          $data['comment_pages']=$comment_pages->show_ajax();
          if(empty($item_comment)){
             $info['html']='<div class="width border mt15 pad34"><div class="width center font-18">暂无评论</div></div>';
          }else{
              $info['html']='<ol>';
              foreach ($item_comment as $key1 => $value1) {
                  $info['html'].='<li><div class="wb15 f_l center pl-tx mp">';
                  $file = "./Public/upload/avatar/".$value1['account_id']."/avatar.jpg";
                  if (file_exists($file)) {
                    $info['html'].='<img src="/Public/upload/avatar/'.$value1['account_id'].'/avatar.jpg">';    
                  }else{
                    $info['html'].='<img src="/Public/Home/images/user/user_03.jpg">';
                  }
                  $info['html'].='<p>'.$value1['name'].'</p></div><div class="wb60 f_l mt10"><div class="width">';
                  for($i=1;$i<=5;$i++){
                    if($i>$value1['score']){
                        $info['html'].='<img src="/Public/Home/images/user/star-off.png">';
                    }else{
                        $info['html'].='<img src="/Public/Home/images/user/star-on.png">';
                    }
                  }
                  $info['html'].='</div><div class="width mt15">'.$value1['content'].'</div>';
                  if(!empty($value1['img'])){
                    $info['html'].='<div class="photo img100 mt15"><ul>';
                    foreach($value1['img'] as $k1=>$v1 ){
                        if(!empty($v1['img_uri'])){
                            $info['html'].='<li><a a rel="group" href="'.$v1['img_uri'].'" title="晒图" ><img src="'.$v1['img_uri'].'"></a></li>';
                        }else{
                            $info['html'].='<li><a><img src="/Public/upload/watermark.jpg"></a></li>';
                        }
                    }
                    $info['html'].='</ul></div>';

                  }

                  foreach ($value1['parent'] as $k2 => $v2) {
                     $info['html'].='<div class="width border-t mt20 padt15"><span class="red f_l">'.$v2['name'].'：'.$v2['content'].'</span><br><span class="f_l mr10 c999">回复</span><span class="c999 f_l">'.date('Y-m-n H:i:s',$v2['reply_time']).'</span></div>';
                  }
                  $info['html'].='</div>';
                  $info['html'].='<div class="wb15 f_r c999 tx-r mt15">'.date('Y-m-n H:i:s',$value1['reply_time']).'</div></li>';                                           
              }

              $info['html'].= '</ol>';
          }
          
          $info['page_info']='<div class="page" >'.$data['comment_pages'].'</div>';
          $result=array('status'=>1,'info'=>$info);  
          return $result; 
    }



}







?>