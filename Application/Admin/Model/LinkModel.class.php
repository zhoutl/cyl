<?php 
namespace Admin\Model;
use Think\Model;
class LinkModel extends Model {
	
	protected $_validate = array(
		array('link_name','1,20','链接名称为1-20个字',1,'length'), 
		array('link_url','url','请输入正确格式的URL地址',1),
		array('orderno','is_numeric','排序必须为数字',1,'function'),
	);
	
	//新增友情链接
    public function addLink($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改友情链接
	public function editLink($link_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['link_id'] = intval($link_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除友情链接
	public function delLink($link_id){
		$map['link_id'] = intval($link_id);
		$this->where($map)->delete();
		$result = array('status'=>1,'msg'=>'删除成功');
		return $result;
	}
	
	
}


?>