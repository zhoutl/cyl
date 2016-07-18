<?php
namespace Home\Model;
use Think\Model;
/**
* 
*/
class ItemCommentImageModel extends Model{

    public function setCommentImage ($item_comment_id,$data) {

        foreach ($data as $key => $vo) {
        	//判断路径是否为空
            if (empty($vo)) {
                $result = array('status' => 0,'msg' => '图片路径存在错误');
                break;
            }

            //判断该路径的图片是否真实存在
            if (!file_exists('.'.$vo)) {
                $result = array('status' => 0,'msg' => '图片不存在');
                break;
            }

            //插入数据库
            $var['item_comment_id'] = $item_comment_id;
            $var['img_uri']         = $vo;
            $this -> add($var);
        }

        $result = array('status' => 1,'msg' => '晒单成功');
        return $result;

    }
    
}







?>