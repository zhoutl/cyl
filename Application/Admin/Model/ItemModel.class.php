<?php 
namespace Admin\Model;
use Think\Model;
class ItemModel extends Model {
	
	protected $_validate = array(
		array('item_category_id','check_item_category','商品分类不存在或已被删除',1,'function'),
		array('brand_id','check_brand','品牌不存在或已被删除',1,'function'),
		array('item_purpose_id','check_item_purpose','用途不存在或已被删除',1,'function'),
		array('artno','1,30','商品货号为1-30个字',1,'length'), 
		array('name','1,80','商品名称为1-80个字',1,'length'), 
		array('conversion_num','is_numeric','换算数量必须为数字',1,'function'),
		array('shop_price','is_numeric','请输入正确的门店价',1,'function'),
		array('online_price','is_numeric','请输入正确的商城价',1,'function'),
		array('app_price','is_numeric','请输入正确的APP专享价',1,'function'),
		array('stock','is_numeric','请输入正确的库存数量',1,'function'),
		array('short_name','1,40','商品简称为1-40个字',2,'length'), 
		array('subheading','1,50','商品副标题为1-50个字',2,'length'), 
		array('seo_title','1,50','seo标题为1-50个字',2,'length'), 
		array('seo_keywords','1,50','seo标题为1-50个字',2,'length'), 
		array('seo_description','1,200','seo描述为1-200个字',2,'length'), 
		array('is_on_sale',array(0,1),'请选择是否在售',1,'in'), 
	);
	
	
	//新增商品
	public function addItem($data){
		while(true){
			//基本信息验证
			if(!($item_data = $this->create($data))){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			//商品基本信息插入
			$item_id = $this->add($item_data);
			
			//商品标签处理
			if(!empty($data['tags'])){
				$tags = explode(';',$data['tags']);
				foreach($tags as $v){
					if($v){
						$tag_id = D('Tag')->get_tag_id($v);
						M('Item_tag_info')->add(array(
							'item_id'=>$item_id,
							'tag_id'=>$tag_id,
						));
					}
				}
			}
			
			//商品详情处理
			M('Item_detail')->add(array(
				'item_id'=>$item_id,
				'description'=>$data['description'],
			));
			
			//图形相册处理
			if(isset($data['item_image'])){
				foreach ($data['item_image'] as $key=>$val){
					if(file_exists('.'.$val)){
						$item_image_data = array('item_id'=>$item_id,'img_uri'=>$val);
						if(in_array('1',$data['first_img'])){
							$item_image_data['is_default']=$data['first_img'][$key];
						}else{
							if($key==0) $item_image_data['is_default']=1;
						}
						M('Item_image')->add($item_image_data);
					}
				}
			}
			
			//属性  暂时只处理一级分类的属性 后期完善
			$item_attr_data = $data['custom_attribute'];
			$item_extra_data = array();
			if(!empty($item_attr_data)){
				foreach ($item_attr_data as $key=>$attr_val){
					if(!is_array($attr_val)){
						$temp_attr = explode('_', $attr_val);
						$item_category_attribute_id = $temp_attr[0];
						$item_category_attribute_value_id = $temp_attr[2];
						$attribute_name = $temp_attr[1];
						$attribute_value = $temp_attr[3];

						$item_extra_data = array(
							'item_category_attribute_id'=>$item_category_attribute_id,
							'item_category_attribute_value_id'=>$item_category_attribute_value_id,
							'attribute_name'=>$attribute_name,
							'attribute_value'=>$attribute_value,
							'input_type'=>1,
							'item_id'=>$item_id
						);
						M('Item_extra')->add($item_extra_data);
					}
				}
			}
			
			//处理价格数据   暂时只有规格为0的  后期完善
			$item_spec_price_data = array(
				'shop_price'=>$data['shop_price'],
				'online_price'=>$data['online_price'],
				'app_price'=>$data['app_price'],
				'stock'=>$data['stock'],
				'item_spec_ids'=>0,
				'item_id'=>$item_id,			
			);
			M('Item_spec_price')->add($item_spec_price_data);
			
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		return $result;
	}
	
	//修改商品
	public function editItem($item_id,$data){
		while(true){
			//基本信息验证
			if(!($item_data = $this->create($data))){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			$map = array('item_id'=>$item_id); 
			
			//基本信息更新
			$this->where($map)->save($item_data);
			
			//获取标签
			$tag_list = M('Item_tag_info')->where($map)->select();
			$tags = '';
			foreach($tag_list as $v){
				$tag_name = M('Tag')->where("tag_id='{$v['tag_id']}'")->getField('tag_name');
				if($tag_name){
					$tags.=$tag_name.';';
				}
			}
			if($tags){
				$tags = substr($tags,0,-1);
			}
			if($data['tags'] != $tags){
				//如果标签有修改 更新标签信息
				//删除商品旧标签信息
				M('Item_tag_info')->where($map)->delete();
				//重新生成标签信息
				$new_tags = explode(';',$data['tags']);
				foreach($new_tags as $v){
					if($v){
						$tag_id = D('Tag')->get_tag_id($v);
						M('Item_tag_info')->add(array(
							'item_id'=>$item_id,
							'tag_id'=>$tag_id,
						));
					}
				}
			}
			
			//商品详情更新
			M('Item_detail')->where($map)->save(array('description'=>$data['description']));
			
			//更新商品图片
			if(isset($data['item_image'])){
				if(in_array('1',$data['first_img'])){
					//如果新增图片存在设定封面图片，则取消之前的封面图片
					M('Item_image')->where($map)->save(array('is_default'=>0));
				}
				foreach ($data['item_image'] as $key=>$val){
					$item_image_data = array('item_id'=>$item_id,'img_uri'=>$val);
					
					if(file_exists('.'.$val)){
						if(in_array('1',$data['first_img'])){
							$item_image_data['is_default']=$data['first_img'][$key];
						}
						M('Item_image')->add($item_image_data);
					}
				}
			}
			
			
			//删除商品旧属性
			M('Item_extra')->where($map)->delete();
			//重新生成属性数据
			$item_attr_data = $data['custom_attribute'];
			$item_extra_data = array();
			if(!empty($item_attr_data)){
				foreach ($item_attr_data as $key=>$attr_val){
					if(!is_array($attr_val)){
						$temp_attr = explode('_', $attr_val);
						$item_category_attribute_id = $temp_attr[0];
						$item_category_attribute_value_id = $temp_attr[2];
						$attribute_name = $temp_attr[1];
						$attribute_value = $temp_attr[3];

						$item_extra_data = array(
							'item_category_attribute_id'=>$item_category_attribute_id,
							'item_category_attribute_value_id'=>$item_category_attribute_value_id,
							'attribute_name'=>$attribute_name,
							'attribute_value'=>$attribute_value,
							'input_type'=>1,
							'item_id'=>$item_id
						);
						M('Item_extra')->add($item_extra_data);
					}
				}
			}
			
			
			//更新规格信息
			$item_spec_price_data = array(
				'shop_price'=>$data['shop_price'],
				'online_price'=>$data['online_price'],
				'app_price'=>$data['app_price'],
				'stock'=>$data['stock'],
				'item_id'=>$item_id,			
			);
			M('Item_spec_price')->where("item_id='{$item_id}' and item_spec_ids=0")->save($item_spec_price_data);
			
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		return $result;
	}
	
	
	
	//更改商品在售状态
	public function changeItemState($item_id,$type){
		$map['item_id'] = intval($item_id);
		if($type == 1){
			$data = array('is_on_sale'=>1);
		}else{
			$data = array('is_on_sale'=>0);
		}
		
		$this->where($map)->save($data);
		$result = array('status'=>1,'msg'=>'修改成功');
		return $result;
	}
	
	//商品回收站
	public function recycleItem($item_id){
		$map['item_id'] = intval($item_id);
		$this->where($map)->save(array('is_del'=>1));
		$result = array('status'=>1,'msg'=>'商品回收成功');
		return $result;
	}
	
	//恢复商品
	public function recoveryItem($item_id){
		$map['item_id'] = intval($item_id);
		$this->where($map)->save(array('is_del'=>0));
		$result = array('status'=>1,'msg'=>'商品恢复成功');
		return $result;
	}
	
	//彻底删除商品
	public function delItem($item_id){
		$map['item_id'] = intval($item_id);
		$this->where($map)->save(array('is_del'=>2));
		$result = array('status'=>1,'msg'=>'删除成功');
		return $result;
	}
	
}
	
	
?>