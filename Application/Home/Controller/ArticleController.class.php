<?php
namespace Home\Controller;
use Think\Controller;
/**
* 老白干资讯Controller
*/
class ArticleController extends Controller{
    
    public function index () {

        $seo_data['title']        = '老白干资讯';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';

        $map['article_type']      = 1;
        $data['list']             = M('ArticleCategory') -> where($map) -> select();
        //置空查询条件
        $map                      = array();
        $map['article_category_id'] = I('get.article_category_id',41,'intval');

        //所选ID是否存在
        $count                    = M('ArticleCategory') -> where($map) -> count();

        if (empty($count)) {
            $this -> assign('msg','抱歉该资讯不存在');
            $this -> display('Common/miss');
        }

        //查询相关信息
        $data['title']            = M('Article') -> page(intval($_GET['p']),1) ->where($map) -> select();
        $count                    = M('Article') -> where($map) -> count();
        $data['pages']            = new \Think\Page($count,1);

        //查询出相关导航
        $data['nav']              = M('ArticleCategory') -> where($map) -> find();
        $data['get_id']           = I('get.article_category_id',41,'intval');

        $this -> assign('data',$data);
        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }

    public function details () {

    	$seo_data['title']        = '资讯详情';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';

        $map['article_type']      = 1;
        $data['left']             = M('ArticleCategory') -> where($map) -> select();

        $map                      = array();
        $map['article_id']        = intval(I('get.article_id'));
        $count                    = M('Article') -> where($map) -> count();
        if (empty($count)) {
            $this->display('Common/miss');
        }

        $data['article']          = M('Article') -> where($map) -> find();

        $map                      = array();
        $map['article_category_id'] = $data['article_category_id'];
        $data['nav']              = M('ArticleCategory') -> where($map) -> find();

        $this -> assign('data',$data);
        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }


}



?>