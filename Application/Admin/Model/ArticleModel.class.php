<?php 
namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model {
	
	protected $_validate = array(
		array('title','1,50','文章标题为1-50个字',1,'length'), 
		array('article_category_id','/^[1-9][0-9]{0,}$/','请选择正确的所属分类',1,'regex'),
		array('seo_title','1,50','seo标题为1-50个字',2,'length'), 
		array('seo_keywords','1,50','seo标题为1-50个字',2,'length'), 
		array('seo_description','1,200','seo描述为1-200个字',2,'length'), 
		array('is_show',array(0,1),'请选择是否显示',1,'in'), 
		array('content','/^.+$/','文章内容不能为空',1,'regex'),
		array('orderno','is_numeric','排序必须为数字',1,'function'),
	);
	
	//新增文章
    public function addArticle($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			//验证分类是否存在
			if(!(M('Article_category')->find($data['article_category_id']))){
				$result = array('status'=>0,'msg'=>'文章分类不存在或已被删除');
				break;
			}
			
			$data['pubdate'] = time();
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//更改文章状态
	public function changeArticleState($article_id,$type){
		$map['article_id'] = intval($article_id);
		if($type == 1){
			$data = array('is_show'=>1);
		}else{
			$data = array('is_show'=>0);
		}
		
		$this->where($map)->save($data);
		$result = array('status'=>1,'msg'=>'修改成功');
		return $result;
	}
	
	//修改文章
	public function editArticle($article_id,$data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			//验证分类是否存在
			if(!(M('Article_category')->find($data['article_category_id']))){
				$result = array('status'=>0,'msg'=>'文章分类不存在或已被删除');
				break;
			}
			
			$map['article_id'] = intval($article_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除文章
	public function delArticle($article_id){
		$map['article_id'] = intval($article_id);
		
		$this->where($map)->delete();
		$result = array('status'=>1,'msg'=>'删除成功');
		
		return $result;
	}
	
	
}


?>