<?php 
namespace Admin\Model;
use Think\Model;
class BrandModel extends Model {
	protected $_validate = array(
		array('brand_name','1,20','品牌名称为1-20个字',1,'length'), 
		array('orderno','is_numeric','排序必须为数字',1,'function'),
	);
	
	//新增品牌
    public function addBrand($data){
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
	
	//修改品牌
	public function editBrand($brand_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['brand_id'] = intval($brand_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	
	//删除品牌
	public function delBrand($brand_id){
		$map['brand_id'] = intval($brand_id);
		$map['is_del'] = 0;
		
		//判断该品牌下是否有商品
		if(!(M('Item')->where($map)->find())){		
			$this->where($map)->delete();
			$result = array('status'=>1,'msg'=>'删除成功');
		}else{
			$result = array('status'=>0,'msg'=>'该品牌下还有商品，您无法删除');
		}

		return $result;
	}
}

?>