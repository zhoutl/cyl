<?php 
namespace Admin\Model;
use Think\Model;
class ItemCategoryModel extends Model {
	
	protected $_validate = array(
		array('category_name','1,20','类别名称为1-20个字',1,'length'), 
		array('seo_title','1,50','seo标题为1-50个字',2,'length'), 
		array('seo_keywords','1,50','seo标题为1-50个字',2,'length'), 
		array('seo_description','1,200','seo描述为1-200个字',2,'length'), 
		array('is_show',array(0,1),'请选择是否显示',1,'in'), 
		array('orderno','is_numeric','排序必须为数字',1,'function'),
	);
	
	//新增类别
    public function addItemCategory($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			if(!file_exists('.'.$data['icon']) || empty($data['icon'])){
				$result = array('status'=>0,'msg'=>'请上传分类图片');
				break;
			}
		
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改类别
	public function editItemCategory($item_category_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			if(!file_exists('.'.$data['icon']) || empty($data['icon'])){
				$result = array('status'=>0,'msg'=>'请上传分类图片');
				break;
			}
			
			$map['item_category_id'] = intval($item_category_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除类别
	public function delItemCategory($item_category_id){
		$map['item_category_id'] = intval($item_category_id);
		$map['is_del'] = 0;
		while(true){
			//含有商品的分类无法删除
			if(M('Item')->where($map)->select()){
				$result = array('status'=>0,'msg'=>'该类别下还有商品，您无法删除');
				break;
			}
			unset($map['is_del']);
			//含有子分类的分类无法删除
			if($this->where("parent_id='{$item_category_id}'")->select()){
				$result = array('status'=>0,'msg'=>'该分类下含有子分类，请先删除子分类再删除该分类');
				break;
			}
			
			//获取属性列表
			$attribute_list = M('Item_category_attribute')->where($map)->select();
			
			//删除分类
			$this->where($map)->delete();
			//删除分类属性
			M('Item_category_attribute')->where($map)->delete();
			//删除分类属性值
			foreach($attribute_list as $k=>$v){
				M('Item_category_attribute_value')->where("item_category_attribute_id='{$v['item_category_attribute_id']}'")->delete();
			}
			
			$result = array('status'=>1,'msg'=>'删除成功');
			break;
		}
		
		return $result;
	}
	
	//更改类别状态
	public function changeItemCategoryState($item_category_id,$type){
		$map['item_category_id'] = intval($item_category_id);
		if($type == 1){
			$data = array('is_show'=>1);
		}else{
			$data = array('is_show'=>0);
		}
		
		$this->where($map)->save($data);
		$result = array('status'=>1,'msg'=>'修改成功');
		return $result;
	}
	
	
}


?>