<?php
namespace Home\Model;
use Think\Model;
/**
* 
*/
class AreaModel extends Model{

      public function chooseArea ($data,$str) {
          while (true) {

              if (empty($data['pid'])) {
                  $html   = "<option value='0' >请选择".$str."</option>";
                  $result = array('status' => 0 ,'html' => $html);
                  break;
              }

              $map['pid'] = $data['pid'];
              $city       = M('Area') -> where($map) -> select();
              $html       ="<option value='0' >请选择".$str."</option>";

              foreach ($city as $key => $vo) {
                    $html.="<option value='".$vo['area_id']."'>".$vo['title']."</option>";
              }

              $result     = array('status' => 1 ,'html' => $html);
              break;
          }
          
          return $result;  
      }
}
?>