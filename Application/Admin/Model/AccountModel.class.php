<?php 
namespace Admin\Model;
use Think\Model;
class AccountModel extends Model {
	
	protected $_validate = array(
		array('email','email','请输入正确格式的邮箱',2), 
		array('mobile','is_phone','请输入正确格式的手机号',2,'function'),
		array('password','/^[0-9a-zA-Z_]{6,16}$/','登录密码由6-16位数字字母下划线组成',1,'regex',1),
		array('password','/^[0-9a-zA-Z_]{6,16}$/','登录密码由6-16位数字字母下划线组成',2,'regex',2),
	);
	
	//新增会员
    public function addAccount($data){
		while(true){
			if(!$this->create($data,1)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			if(!empty($data['email'])){
				//验证邮箱是否被注册
				if(!($this->checkEmailRegister($data['email']))){
					$result = array('status'=>0,'msg'=>'该邮箱已被注册');
					break;
				}
			}
			
			if(!empty($data['mobile'])){
				//验证手机号是否被注册
				if(!($this->checkMobileRegister($data['mobile']))){
					$result = array('status'=>0,'msg'=>'该手机号已被注册');
					break;
				}
			}

			//邮箱手机号必须存在一个
			if(empty($data['email']) && empty($data['mobile'])){
				$result = array('status'=>0,'msg'=>'邮箱和手机号必须填写一个');
				break;
			}
			
			
			$data['salt'] = get_salt(6);
			$data['password'] = my_encrypt($data['password'],$data['salt']);
			
			$data['register_time'] = time();
			$data['register_ip'] = get_client_ip();;
			//插入用户表
			$account_id = $this->add($data);
			//生成用户额外信息
			$extra_data['account_id'] = $account_id;
			M('Account_extra')->add($extra_data);
			
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	
	//修改会员
	public function editAccount($account_id,$data){
		while(true){
			if(!$this->create($data,2)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			if(!empty($data['email'])){
				//验证邮箱是否被注册
				if(!($this->checkEmailRegister($data['email'],$account_id))){
					$result = array('status'=>0,'msg'=>'该邮箱已被注册');
					break;
				}
			}
			if(!empty($data['mobile'])){
				//验证手机号是否被注册
				if(!($this->checkMobileRegister($data['mobile'],$account_id))){
					$result = array('status'=>0,'msg'=>'该手机号已被注册');
					break;
				}
			}
			
			//邮箱手机号必须存在一个
			if(empty($data['email']) && empty($data['mobile'])){
				$result = array('status'=>0,'msg'=>'邮箱和手机号必须填写一个');
				break;
			}
			
			//如果存在密码则修改密码
			if(!empty($data['password'])){
				$data['salt'] = get_salt(6);
				$data['password'] = my_encrypt($data['password'],$data['salt']);
			}else{
				unset($data['password']);
			}
			
			$map['account_id'] = intval($account_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//更改会员状态
	public function changeAccountState($account_id,$type){
		$map['account_id'] = intval($account_id);
		if($type == 1){
			$data = array('status'=>1);
		}else{
			$data = array('status'=>0);
		}
		
		$this->where($map)->save($data);
		$result = array('status'=>1,'msg'=>'修改成功');
		return $result;
	}
	
	
	
	//验证邮箱是否被注册
	public function checkEmailRegister($email,$account_id=0){
		$map['email'] = $email;
		if($account_id){
			$map['account_id'] = array('neq',$account_id);
		}
		
		if($this->where($map)->find()){
			return false;
		}else{
			return true;
		}
	}
	
	//验证手机号是否被注册
	public function checkMobileRegister($mobile,$account_id=0){
		$map['mobile'] = $mobile;
		if($account_id){
			$map['account_id'] = array('neq',$account_id);
		}
		
		if($this->where($map)->find()){
			return false;
		}else{
			return true;
		}
	}
	
	
}


?>