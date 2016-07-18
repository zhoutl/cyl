<?php 
namespace Admin\Model;
use Think\Model;
class ItemCategoryAttributeValueModel extends Model {
	

	//编辑属性分类
	public function editItemCategoryAttributeValue($item_category_attribute_id,$data){
		//属性值列表
		$attribute_value_list = M('Item_category_attribute_value')->where("item_category_attribute_id=".$item_category_attribute_id)->select();
		
		//处理旧属性的值修改删除
		foreach($attribute_value_list  as $k=>$v){
			//处理旧属性
			if(!empty($data['attr_value_'.$v['item_category_attribute_value_id']])){
				//旧属性的值未被删除
				
				//判断属性值名称是否被修改
				if($data['attr_value_'.$v['item_category_attribute_value_id']] != $v['attribute_value']){
					//属性值名称被修改，修改属性值
					$map = array('item_category_attribute_value_id'=>$v['item_category_attribute_value_id']);
					$this->where($map)->save(array(
							'attribute_value'=>$data['attr_value_'.$v['item_category_attribute_value_id']],
							'orderno'=>$data['orderno_'.$v['item_category_attribute_value_id']],
					));
					//同时修改带有该属性值的商品extra
					M('Item_extra')->where($map)->save(array(
						'attribute_value'=>$data['attr_value_'.$v['item_category_attribute_value_id']],
					));
					
				}else{
					//属性名称未被修改，判断排序是否被修改
					if($data['orderno_'.$v['item_category_attribute_value_id']] != $v['orderno']){
						$map = array('item_category_attribute_value_id'=>$v['item_category_attribute_value_id']);
						$this->where($map)->save(array('orderno'=>$data['orderno_'.$v['item_category_attribute_value_id']]));
					}
				}
				
			}else{
				//旧属性的值被删除，处理属性值删除操作
				$map = array('item_category_attribute_value_id'=>$v['item_category_attribute_value_id']);
				//删除属性值
				$this->where($map)->delete();
				//同时删除带有该属性值的商品extra
				M('Item_extra')->where($map)->delete();
			}	
		}
		
					
		//处理新增属性值的插入
		if(!empty($data['attr_value'])){
			foreach($data['attr_value'] as $k=>$v){
				$this->add(array(
					'item_category_attribute_id'=>$item_category_attribute_id,
					'attribute_value'=>$v,
					'orderno'=>$data['orderno'][$k],
				));	
			}
		}
		
		
		$result = array('status'=>1,'msg'=>'修改成功');
		return $result;
	}
	
	
	
}

?>