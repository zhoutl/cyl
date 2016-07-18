<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends AdminController {
	
	public function index(){
		$this->display();
	}
	
	//系统配置
	public function systemConfig(){
		if(IS_POST){
			$data = I('post.');
			$result = D('System_config')->saveSystemConfig($data);
			if($result['status']){
				 $this->success($result['msg'], U('Admin/System/systemConfig'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$data['list'] = M('System_config')->where("system_config_id=1")->find();
			$this->assign('data',$data);
			$this->display();
		}
	}
	
	//友情链接
	public function linkList(){
		$da = M('Link');
		$data['list'] = $da->order('orderno ASC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增友情链接
	public function addLink(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Link')->addLink($data);
			if($result['status']){
				 $this->success($result['msg'], U('System/linkList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
		
	}
	
	//修改友情链接
	public function editLink(){
		$link_id = I('request.id',0,'intval');
		$map = array('link_id'=>$link_id);
		$list = M('Link')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Link')->editLink($link_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('System/linkList'));
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
	
	//删除友情链接
	public function delLink(){
		$result = D('Link')->delLink(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	
	//配送列表
	public function deliveryModeList(){
		$da = M('Delivery_mode');
		$data['list'] = $da->order('delivery_mode_id ASC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增配送
	public function addDeliveryMode(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Delivery_mode')->addDeliveryMode($data);
			if($result['status']){
				 $this->success($result['msg'], U('System/deliveryModeList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	
	//修改配送
	public function editDeliveryMode(){
		$delivery_mode_id = I('request.id',0,'intval');
		$map = array('delivery_mode_id'=>$delivery_mode_id);
		$list = M('Delivery_mode')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Delivery_mode')->editDeliveryMode($delivery_mode_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('System/deliveryModeList'));
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
	
	//删除配送
	public function delDeliveryMode(){
		$result = D('Delivery_mode')->delDeliveryMode(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	
}

?>