<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends AdminController {
	
	public function _initialize(){
		parent::_initialize();
		$article_type = array(
			1=>'企业资讯',
			2=>'帮助中心',
		);
		$this->assign('article_type',$article_type);
	}
	
	public function index(){
		$this->display();
	}
	
	//文章分类列表
	public function articleCategoryList(){
		$da = M('Article_category');
		$data['list'] = $da->order('orderno ASC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增文章分类
	public function addArticleCategory(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Article_category')->addArticleCategory($data);
			if($result['status']){
				 $this->success($result['msg'], U('Article/articleCategoryList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	//修改文章分类
	public function editArticleCategory(){
		$article_category_id = I('request.id',0,'intval');
		$map = array('article_category_id'=>$article_category_id);
		$list = M('Article_category')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Article_category')->editArticleCategory($article_category_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Article/articleCategoryList'));
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
	
	//删除文章分类
	public function delArticleCategory(){
		$result = D('Article_category')->delArticleCategory(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	//文章列表
	public function articleList(){
		$da = M('Article');
		$map = array();
		
		$data['keywords'] = I('get.keywords','');
		$data['article_type'] = I('get.article_type',0,'intval');
		if($data['keywords']){
			$map['title'] = array('LIKE','%'.$data['keywords'].'%');
		}
		
		if($data['article_type']){
			$category_list = M('Article_category')->where("article_type='{$data['article_type']}'")->select();
			$ids = array();
			foreach($category_list as $v){
				$ids[] = $v['article_category_id'];
			}
			if(!empty($ids)){
				$map['article_category_id'] = array('in',$ids);
			}
		}
		
		$data['list'] = $da->where($map)->order('orderno ASC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->where($map)->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//更改文章状态
	public function changeArticleState(){
		$article_id = I('request.id',0,'intval');
		$type = I('request.type',0,'intval');
		$result = D('Article')->changeArticleState($article_id,$type);
		$this->ajaxReturn($result);
	}
	
	//新增文章
	public function addArticle(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Article')->addArticle($data);
			if($result['status']){
				 $this->success($result['msg'], U('Article/articleList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$type = isset($_GET['type']) && $_GET['type'] == 2?2:1;
			$data['category_list'] = M('Article_category')->where("article_type='{$type}'")->select();
			$this->assign('data',$data);
			$this->display();
		}
	}
	
	//修改文章
	public function editArticle(){
		$article_id = I('request.id',0,'intval');
		$map = array('article_id'=>$article_id);
		$list = M('Article')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Article')->editArticle($article_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Article/articleList'));
				}else{
					$this->error($result['msg']);
				}
			}else{
				$data['list'] = $list;
				//获取所属分类的list
				$data['category_list'] = D('Article_category')->getCategoryList($list['article_category_id']);
				
				$this->assign('data',$data);
				$this->display();
			}
		}else{
			$this->error('数据不存在或已被操作过！');
		}
	}
	
	//删除文章
	public function delArticle(){
		$result = D('Article')->delArticle(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	
	
}

?>