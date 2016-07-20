<?php
namespace Admin\Controller;
use Think\Controller;
class HomeController extends AdminController {
	
	//banner列表
	public function bannerList(){
		$da = M('Banner');
		$data['list'] = $da->order('orderno DESC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增banner
	public function addBanner(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Banner')->addBanner($data);
			if($result['status']){
				$this->success($result['msg'], U('Home/bannerList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	//修改banner
	public function editBanner(){
		$banner_id = I('request.id',0,'intval');
		$map = array('banner_id'=>$banner_id);
		$list = M('Banner')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Banner')->editBanner($banner_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Home/bannerList'));
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

	//删除banner
	public function delBanner(){
		$result = D('Banner')->delBanner(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
}

?>