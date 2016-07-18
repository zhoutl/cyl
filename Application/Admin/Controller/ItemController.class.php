<?php
namespace Admin\Controller;
use Think\Controller;
class ItemController extends AdminController {
	
	public function index(){
		$this->display();
	}
	
	//品牌列表
	public function brandList(){
		$da = M('Brand');
		$data['list'] = $da->order('orderno ASC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增品牌
	public function addBrand(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Brand')->addBrand($data);
			if($result['status']){
				 $this->success($result['msg'], U('Item/brandList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	//修改品牌
	public function editBrand(){
		$brand_id = I('request.id',0,'intval');
		$map = array('brand_id'=>$brand_id);
		$list = M('Brand')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Brand')->editBrand($brand_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Item/brandList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['list'] = $list;
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//删除品牌
	public function delBrand(){
		$result = D('Brand')->delBrand(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	
	//用途列表
	public function itemPurposeList(){
		$da = M('Item_purpose');
		$data['list'] = $da->order('orderno ASC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增用途
	public function addItemPurpose(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Item_purpose')->addItemPurpose($data);
			if($result['status']){
				 $this->success($result['msg'], U('Item/itemPurposeList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	//修改用途
	public function editItemPurpose(){
		$item_purpose_id = I('request.id',0,'intval');
		$map = array('item_purpose_id'=>$item_purpose_id);
		$list = M('Item_purpose')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Item_purpose')->editItemPurpose($item_purpose_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Item/itemPurposeList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['list'] = $list;
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//删除用途
	public function delItemPurpose(){
		$result = D('Item_purpose')->delItemPurpose(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	//分类列表
	public function itemCategoryList(){
		$da = M('Item_category');
		$data['list'] = $da->order('orderno ASC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//更改类别状态
	public function changeItemCategoryState(){
		$item_category_id = I('request.id',0,'intval');
		$type = I('request.type',0,'intval');
		$result = D('Item_category')->changeItemCategoryState($item_category_id,$type);
		$this->ajaxReturn($result);
	}
	
	//新增分类
	public function addItemCategory(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Item_category')->addItemCategory($data);
			if($result['status']){
				 $this->success($result['msg'], U('Item/itemCategoryList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	//修改分类
	public function editItemCategory(){
		$item_category_id = I('request.id',0,'intval');
		$map = array('item_category_id'=>$item_category_id);
		$list = M('Item_category')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Item_category')->editItemCategory($item_category_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Item/itemCategoryList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['list'] = $list;
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//删除分类
	public function delItemCategory(){
		$result = D('Item_category')->delItemCategory(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	//分类属性列表
	public function itemCategoryAttributeList(){
		$da = M('Item_category_attribute');
		$map = array();
		$data['item_category_id'] = I('get.item_category_id','0','intval');
		if($data['item_category_id']){
			$map['item_category_id'] = $data['item_category_id'];
		}
		
		$data['list'] = $da->where($map)->order('item_category_id ASC,orderno ASC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);
		
		//分类列表
		$data['item_category_list'] = M('Item_category')->select();

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增分类属性
	public function addItemCategoryAttribute(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Item_category_attribute')->addItemCategoryAttribute($data);
			if($result['status']){
				 $this->success($result['msg'], U('Item/itemCategoryAttributeList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$data['item_category_list'] = M('Item_category')->select();
			$this->assign('data',$data);
			$this->display();
		}
	}
	
	//修改分类属性
	public function editItemCategoryAttribute(){
		$item_category_attribute_id = I('request.id',0,'intval');
		$map = array('item_category_attribute_id'=>$item_category_attribute_id);
		$list = M('Item_category_attribute')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Item_category_attribute')->editItemCategoryAttribute($item_category_attribute_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Item/itemCategoryAttributeList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['list'] = $list;
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//删除分类属性
	public function delItemCategoryAttribute(){
		$result = D('Item_category_attribute')->delItemCategoryAttribute(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	//分类属性值管理
	public function editItemCategoryAttributeValue(){
		$item_category_attribute_id = I('request.id','0','intval');
		$map = array('item_category_attribute_id'=>$item_category_attribute_id);
		if(IS_POST){
			$data = I('post.');
			$result = D('Item_category_attribute_value')->editItemCategoryAttributeValue($item_category_attribute_id,$data);
			if($result['status']){
				 $this->success($result['msg'], U('Item/itemCategoryAttributeList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			//属性值列表
			$data['list'] = M('Item_category_attribute_value')->where($map)->select();
			//属性名称
			$data['attribute_name'] = M('Item_category_attribute')->where($map)->getField('attribute_name');
			$this->assign('data',$data);
			$this->display();
		}

	}
	
	//商品列表
	public function itemList(){
		$da = M('Item');
		$map['is_del'] = 0;
		
		if(($data['item_category_id'] = I('get.item_category_id',0,'intval'))){
			$map['item_category_id'] = $data['item_category_id'];
		}
		
		if(($data['item_purpose_id'] = I('get.item_purpose_id',0,'intval'))){
			$map['item_purpose_id'] = $data['item_purpose_id'];
		}
		
		if(($data['brand_id'] = I('get.brand_id',0,'intval'))){
			$map['brand_id'] = $data['brand_id'];
		}
		
		if(($data['is_on_sale'] = I('get.is_on_sale',0,'intval'))){
			if($data['is_on_sale'] == '99'){
				$map['is_on_sale'] = 1;
			}else if($data['is_on_sale'] == '100'){
				$map['is_on_sale'] = 0;
			}
		}
		
		if(($data['artno'] = I('get.artno',''))){
			$map['artno'] = $data['artno'];
		}
		
		if(($data['name'] = I('get.name',''))){
			$map['name'] = array('LIKE','%'.$data['name'].'%');
		}
		
		
		
		$data['list'] = $da->where($map)->page(intval($_GET['p']).','.$this->limit)->select();
		
		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);
		
		//用途列表
		$data['purpose_list'] = M('Item_purpose')->order('orderno ASC')->select();
		//类别列表
		$data['category_list'] = M('Item_category')->order('orderno ASC')->select();
		//品牌列表
		$data['brand_list'] = M('Brand')->order('orderno ASC')->select();

		$this->assign('data',$data);
		$this->display();
	}
	
	
	//新增商品
	public function addItem(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Item')->addItem($data);
			if($result['status']){
				 $this->success($result['msg'], U('Item/itemList'));
			}else{
				$this->error($result['msg']);
			}
		}else{	
			//商品类别列表
			$data['category_list'] = M('Item_category')->order('orderno ASC')->select();
			//商品用途列表
			$data['purpose_list'] = M('Item_purpose')->order('orderno ASC')->select();
			//商品品牌列表
			$data['brand_list'] = M('Brand')->order('orderno ASC')->select();
			
			$this->assign('data',$data);
			
			$this->display();
		}
	}
	
	//修改商品
	public function editItem(){
		$item_id = I('request.id',0,'intval');
		$map = array('item_id'=>$item_id,'is_del'=>0);
		$list = M('Item')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Item')->editItem($item_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Item/itemList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['list'] = $list;
				//商品类别列表
				$data['category_list'] = M('Item_category')->order('orderno ASC')->select();
				//商品用途列表
				$data['purpose_list'] = M('Item_purpose')->order('orderno ASC')->select();
				//商品品牌列表
				$data['brand_list'] = M('Brand')->order('orderno ASC')->select();
				
				$map = array('item_id'=>$item_id);
				//商品详情
				$data['item_detail'] = M('Item_detail')->where($map)->getField('description');
				//商品图片
				$data['item_image_list'] = M('Item_image')->where($map)->select();
				
				//获取标签
				$tag_info_list = M('Item_tag_info')->where($map)->select();
				$data['list']['tag'] = '';
				foreach($tag_info_list as $v){
					$tag_name = M('Tag')->where("tag_id='{$v['tag_id']}'")->getField('tag_name');
					if($tag_name){
						$data['list']['tag'].=$tag_name.';';
					}
				}
				if($data['list']['tag']){
					$data['list']['tag'] = substr($data['list']['tag'],0,-1);
				}
				
				//获取属性
				$attribute_list = M('Item_category_attribute')->field('item_category_attribute_id,attribute_name,input_type')->
					where("item_category_id='{$data['list']['item_category_id']}'")->order('orderno ASC')->select();
				
				if(!empty($attribute_list)){
					foreach($attribute_list as $k=>$v){
						$attribute_list[$k]['value_list'] = M('Item_category_attribute_value')->field('item_category_attribute_value_id,attribute_value')->
							where("item_category_attribute_id='{$v['item_category_attribute_id']}'")->order('orderno ASC')->select();
					}
				}
				$data['attribute_list'] = $attribute_list;
				//商品额外信息数据列表
				$data['item_extra_list'] = M('Item_extra')->where($map)->select();
				
				//商品规格   目前暂无规格 统一取规格为0的数据
				$data['Item_spec_price'] = M('Item_spec_price')->where("item_id='{$item_id}' and item_spec_ids=0")->find();
				
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	
	//AJAX设置封面图片
	public function setDefaultImage(){
		$item_image_id = I('post.img_id',0,'intval');
		$item_id = I('post.item_id',0,'intval');
		
		$map = array('item_image_id'=>$item_image_id,'item_id'=>$item_id);
		$list = M('Item_image')->where($map)->find();
		if(!empty($list)){
			M('Item_image')->where("item_id='{$item_id}'")->save(array('is_default'=>0));
			M('Item_image')->where("item_image_id='{$item_image_id}'")->save(array('is_default'=>1));
			$result = array('status'=>1,'msg'=>'操作成功');
		}else{
			$result = array('status'=>0,'msg'=>'图片不存在或已被删除');
		}
		$this->ajaxReturn($result);
	}
	
	//AJAX删除商品图片
	public function delItemImage(){
		$item_image_id = I('post.img_id',0,'intval');
		
		$map = array('item_image_id'=>$item_image_id);
		$list = M('Item_image')->where($map)->find();
		if(!empty($list)){
			if($list['is_default'] == '1'){
				$result = array('status'=>0,'msg'=>'封面图片无法删除');
			}else{
				M('Item_image')->where($map)->delete();
				$result = array('status'=>1,'msg'=>'图片删除成功');
			}
		}else{
			$result = array('status'=>0,'msg'=>'图片不存在或已被删除');
		}
		$this->ajaxReturn($result);
	}
	
	//更改商品在售状态
	public function changeItemState(){
		$item_id = I('request.id',0,'intval');
		$type = I('request.type',0,'intval');
		$result = D('Item')->changeItemState($item_id,$type);
		$this->ajaxReturn($result);
	}
	
	//商品回收站
	public function recycleItem(){
		$result = D('Item')->recycleItem(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	//恢复商品
	public function recoveryItem(){
		$result = D('Item')->recoveryItem(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	//彻底删除商品
	public function delItem(){
		$result = D('Item')->delItem(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	
	//回收站商品列表
	public function recycleItemList(){
		$da = M('Item');
		$map['is_del'] = 1;
		
		if(($data['item_category_id'] = I('get.item_category_id',0,'intval'))){
			$map['item_category_id'] = $data['item_category_id'];
		}
		
		if(($data['item_purpose_id'] = I('get.item_purpose_id',0,'intval'))){
			$map['item_purpose_id'] = $data['item_purpose_id'];
		}
		
		if(($data['brand_id'] = I('get.brand_id',0,'intval'))){
			$map['brand_id'] = $data['brand_id'];
		}
		
		if(($data['is_on_sale'] = I('get.is_on_sale',0,'intval'))){
			if($data['is_on_sale'] == '99'){
				$map['is_on_sale'] = 1;
			}else if($data['is_on_sale'] == '100'){
				$map['is_on_sale'] = 0;
			}
		}
		
		if(($data['artno'] = I('get.artno',''))){
			$map['artno'] = $data['artno'];
		}
		
		if(($data['name'] = I('get.name',''))){
			$map['name'] = array('LIKE','%'.$data['name'].'%');
		}
		
		$data['list'] = $da->where($map)->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	
	//根据商品类别ID获取属性
	public function getItemCategoryAttributeHtml(){
		$item_category_id = I('post.item_category_id',0,'intval');
		$html = D('Item_category_attribute')->getItemCategoryAttributeHtml($item_category_id);
		$result = array('status'=>1,'msg'=>'获取成功','html'=>$html);
		$this->ajaxReturn($result);
	}
	

	
	
	
	
	
}

?>