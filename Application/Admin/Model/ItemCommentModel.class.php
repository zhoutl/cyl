<?php 
namespace Admin\Model;
use Think\Model;
/**
* 
*/
class ItemCommentModel extends Model {

    protected $_validate = array(
        array('content','1,200','请输入1-200位字符串',1,'length',1),
        array('content','/^.+$/','请输入1-200位字符串',1,'regex',1),
        array('score',array(1,2,3,4,5),'请选择正确的评分',1,'in',2),
    );
    
    public function changeStatus ($item_comment_id,$type) {

        while (true) {

        	$map['item_comment_id'] = $item_comment_id;

            if ($type == 2) {

                $this -> where($map) -> setField('is_show','0');
                $result = array('status' => 1,'msg' =>'');
                break;

            }

            $this -> where($map) -> setField('is_show','1');
            $result                 = array('status' => 1,'msg' =>'');
            break;
        }

        return $result;

    }

    public function doReply ($admin_id,$data) {

        while (true) {

            //进行自动验证
            if (!$this -> create($data)) {
                $result = array('status' => 0,'msg' => $this -> getError());
                break;
            }

            //查找出相关数据
            $map['item_comment_id'] = $data['parent_id'];
            $var                    = $this -> field('orders_id,item_id') -> where($map) -> find();

            //组装data数据
            $data['account_id']     = 0;
            $data['admin_id']       = $admin_id;
            $data['reply_time']     = time();
            $data['orders_id']      = $var['orders_id'];
            $data['item_id']        = $var['item_id'];
            $data['name']           = 'admin';
            $data['source']         = '1';
            $data['content']        = trim($data['content']);

            //将data插入数据库
            $this -> add($data);
            $result = array('status' => 1,'msg' =>'回复成功');
            break;
        }
        
        return $result;

    }
    
    public function setAddComent ($admin_id,$data) {

        while (true) {

            if (!$this -> create($data,2)) {
                $result = array('status' => 0,'msg' => $this -> getError());
                break;
            }
            $data['reply_time'] = time();
            $data['source']     = 1;
            $data['content']    = trim($data['content']);
            $data['name']       = trim($data['name']);
            $data['admin_id']   = $admin_id;
            $data['parent_id']  = 0;
            $data['account_id'] = 0;
            $data['orders_id']  = 0;

            $item_comment_id = $this -> add($data);

            if (empty($item_comment_id)) {
                $result = array('status' => 0,'msg' => '评论失败');
                break;
            }

            D('ItemCommentImage') -> setCommentImage($item_comment_id,$data['filename']);
            $result = array('status' => 1,'msg' => '评论成功');
            break;
        }
        return $result;

    }







}

?>