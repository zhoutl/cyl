<?php 
namespace Admin\Model;
use Think\Model;
class ItemCategoryAttributeModel extends Model {
	
	protected $_validate = array(
		array('attribute_name','1,20','属性名称为1-20个字',1,'length'), 
		array('item_category_id','/^[1-9][0-9]{0,}$/','请选择正确的所属分类',1,'regex',1),
		array('is_filter',array(0,1),'请选择是否作为检索条件',1,'in'), 
		array('orderno','is_numeric','排序必须为数字',1,'function'),
	);

	//新增分类属性
    public function addItemCategoryAttribute($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			//验证分类是否存在
			if(!(M('Item_category')->find($data['item_category_id']))){
				$result = array('status'=>0,'msg'=>'商品分类不存在或已被删除');
				break;
			}
		
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改分类属性
	public function editItemCategoryAttribute($item_category_attribute_id,$data){
		while(true){
			if(!($data = $this->create($data,2))){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			//修改属性信息
			$map['item_category_attribute_id'] = intval($item_category_attribute_id);
			$this->where($map)->save($data);
			
			//同步更新商品属性表 属性信息
			$extra_data['attribute_name'] = $data['attribute_name'];
			M('Item_extra')->where($map)->save($extra_data);
			
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除分类属性
	public function delItemCategoryAttribute($item_category_attribute_id){
		$map['item_category_attribute_id'] = intval($item_category_attribute_id);
		//删除该属性
		$this->where($map)->delete();
		//删除该属性下的所有属性值
		M('Item_category_attribute_value')->where($map)->delete();
		//删除含有该属性的商品信息
		M('Item_extra')->where($map)->delete();
		
		$result = array('status'=>1,'msg'=>'删除成功');
		return $result;
	}
	
	//获取分类属性HTML
	public function getItemCategoryAttributeHtml($item_category_id){
		$html = '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table add_from_table2">';
		//属性列表
		$list = $this->where('item_category_id='.$item_category_id)->select();
		
		foreach($list as $v){
			$html.='<tr><td align="left" valign="top" class="aft_l">'.$v['attribute_name'].'</td>';
			if($v['input_type'] == '1'){
				//固定值单选
				$html.='<td align="left" valign="middle" class="aft_r">';
				$html.='<select class="form-control the_text2 f_l" name="custom_attribute['.$v['item_category_attribute_id'].']">';
				
				//获取该属性的属性值列表
				$attribute_value_list = M('Item_category_attribute_value')->where('item_category_attribute_id='.$v['item_category_attribute_id'])->order('orderno ASC')->select();
				foreach($attribute_value_list as $v2){
					$tmp_key = $v['item_category_attribute_id'].'_'.$v['attribute_name'].'_'.$v2['item_category_attribute_value_id'].'_'.$v2['attribute_value'];
					$html.='<option value="'.$tmp_key.'">'.$v2['attribute_value'].'</option>';
				}
				$html.='</select></td>';
			}
			$html.='</tr>';
		}
		$html.='</table>';
		
		return $html;
	}
	
	
	
}

?>