<?php
namespace Admin\Controller;
use Think\Controller;
class AccountController extends AdminController {
	
	public function index(){
		$this->display();
	}
	
	//会员等级列表
	public function accountLevelList(){
		$da = M('Account_level');
		$data['list'] = $da->order('conditions ASC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增会员等级
	public function addAccountLevel(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Account_level')->addAccountLevel($data);
			if($result['status']){
				 $this->success($result['msg'], U('Account/accountLevelList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	//修改会员等级
	public function editAccountLevel(){
		$account_level_id = I('request.id',0,'intval');
		$map = array('account_level_id'=>$account_level_id);
		$list = M('Account_level')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Account_level')->editAccountLevel($account_level_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Account/accountLevelList'));
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
	
	//删除会员等级
	public function delAccountLevel(){
		$result = D('Account_level')->delAccountLevel(I('request.id',0,'intval'));
		$this->ajaxReturn($result);
	}
	
	
	//会员列表
	public function accountList(){
		$da = M('Account');
		$data['list'] = $da->order('account_id DESC')->page(intval($_GET['p']).','.$this->limit)->select();

		$count     = $da->count();
		
		$data['pagetion']  = new \Think\Page($count,$this->limit);

		$this->assign('data',$data);
		$this->display();
	}
	
	//新增会员
	public function addAccount(){
		if(IS_POST){
			$data = I('post.');
			$result = D('Account')->addAccount($data);
			if($result['status']){
				 $this->success($result['msg'], U('Account/accountList'));
			}else{
				$this->error($result['msg']);
			}
		}else{
			$this->display();
		}
	}
	
	
	//修改会员
	public function editAccount(){
		$account_id = I('request.id',0,'intval');
		$map = array('account_id'=>$account_id);
		$list = M('Account')->where($map)->find();
		if(!empty($list)){
			if(IS_POST){
				$data = I('post.');
				$result = D('Account')->editAccount($account_id,$data);
				if($result['status']){
					 $this->success($result['msg'], U('Account/accountList'));
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
	
	
	
	//更改会员状态
	public function changeAccountState(){
		$account_id = I('request.id',0,'intval');
		$type = I('request.type',0,'intval');
		$result = D('Account')->changeAccountState($account_id,$type);
		$this->ajaxReturn($result);
	}
	
}

?>