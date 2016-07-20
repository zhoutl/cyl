<?php
namespace Admin\Service;
use Think\Model;
/**
* 
*/
class InformService extends Model{



    //数据正则验证过滤
     protected $_validate = array(
         array('inform_title','/[a-zA-Z\x{4e00}-\x{9fa5}]/u','请输入正确标题',1,'regex'), 
         array('inform_content','/[a-zA-Z\x{4e00}-\x{9fa5}]/u','请输入正确格式的通知内容',1,'regex'),
         array('inform_orderno','/^[0-9]*$/','请输入数字',1,'regex'),
     );



	 //封装验证过滤和去空格方法
     public function dataProce ($data) {
        if (!$this->create($data)) {
            exit($this->getError());
         }
         $procedArr = array();
         foreach ($data as $key => $vo) {
                $procedArr[$key] = trim($vo);
         }
         return $procedArr;
     }
}
?>