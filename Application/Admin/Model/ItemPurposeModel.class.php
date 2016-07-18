<?php 
namespace Admin\Model;
use Think\Model;
class ItemPurposeModel extends Model {
	
	protected $_validate = array(
		array('purpose_name','1,20','用途名称为1-20个字',1,'length'), 
		array('seo_title','1,50','seo标题为1-50个字',2,'length'), 
		array('seo_keywords','1,50','seo标题为1-50个字',2,'length'), 
		array('seo_description','1,200','seo描述为1-200个字',2,'length'), 
		array('orderno','is_numeric','排序必须为数字',1,'function'),
	);
	
	//新增用途
    public function addItemPurpose($data){
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
	
	//修改用途
	public function editItemPurpose($item_purpose_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['item_purpose_id'] = intval($item_purpose_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除用途
	public function delItemPurpose($item_purpose_id){
		$map['item_purpose_id'] = intval($item_purpose_id);
		$map['is_del'] = 0;
		if(!(M('Item')->where($map)->select())){
			$this->where($map)->delete();
			$result = array('status'=>1,'msg'=>'删除成功');
		}else{
			$result = array('status'=>0,'msg'=>'该用途下还有商品，您无法删除');
		}
		
		return $result;
	}
	
	
}


?>