<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends AdminController {
	
	public function _initialize(){
		parent::_initialize();
		
	}
	
	public function index(){
		$this->display();
	}
	

	

	
	//文章列表
	public function articleList(){
		$da = M('Article');
		$map = array();
		
		$data['keywords'] = I('get.keywords','');
		if($data['keywords']){
			$map['title'] = array('LIKE','%'.$data['keywords'].'%');
		}
		
		
		$data['list'] = $da->where($map)->order('pubdate DESC')->page(intval($_GET['p']).','.$this->limit)->select();

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