<?php 
namespace Admin\Model;
use Think\Model;
class ArticleCategoryModel extends Model {
	
	protected $_validate = array(
		array('article_category_name','1,10','分类名称为1-10个字',1,'length'), 
		array('article_type','/^[1|2]{1}$/','请选择正确的所属类别',1,'regex'), 
		array('orderno','is_numeric','排序必须为数字',1,'function'),
	);
	
	//新增文章分类
    public function addArticleCategory($data){
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
	
	//修改文章分类
	public function editArticleCategory($article_category_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			$map['article_category_id'] = intval($article_category_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除文章分类
	public function delArticleCategory($article_category_id){
		$map['article_category_id'] = intval($article_category_id);
		$article_list = M('Article')->field('article_id')->where($map)->select();
		if(empty($article_list)){
			$this->where($map)->delete();
			$result = array('status'=>1,'msg'=>'删除成功');
		}else{
			$result = array('status'=>0,'msg'=>'该分类下还有文章，您无法删除');
		}
		return $result;
	}
	
	//根据category_id 获取list
	public function getCategoryList($article_category_id){
		//获取articel_type
		$article_type = $this->where("article_category_id='{$article_category_id}'")->getField('article_type');
		
		return $this->where("article_type='{$article_type}'")->select();
	}
	
	
}


?>