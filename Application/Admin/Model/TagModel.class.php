<?php 
namespace Admin\Model;
use Think\Model;
class TagModel extends Model {
	
	//根据tag名称获取tag_id
	public function get_tag_id($tag_name){
		$map = array('tag_name'=>$tag_name);
		$list = $this->where($map)->find();
		
		if(!empty($list)){
			$tag_id = $list['tag_id'];
		}else{
			$tag_id = $this->add(array('tag_name'=>$tag_name));
		}
		return $tag_id;
	}
}

?>