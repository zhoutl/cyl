<?php 
namespace Admin\Model;
use Think\Model;
class AdminUserModel extends Model {
	
	protected $_validate = array(
		array('account','/^[0-9a-zA-Z]{1,10}$/','请输入正确格式的用户名',1,'regex'), 
		array('password','/^[0-9a-zA-Z_]{6,16}$/','请输入正确格式的密码',1,'regex',1),
		array('password','/^[0-9a-zA-Z_]{6,16}$/','请输入正确格式的密码',2,'regex',2),
		array('admin_role_id','/^[1-9][0-9]{0,}$/','请选择所属角色',0,'regex'), 
		array('real_name','1,20','真实姓名为1-10个字',2,'length'), 
		array('sex',array(1,2),'请选择性别',0,'in'), 
		array('email','email','请输入正确格式的邮箱',2), 
		array('telphone','is_phone','请输入正确格式的手机号',2,'function'),
	);
	
	//后台登陆
    public function doLogin($data){
		while(true){
			if(!$this->create($data,1)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			//验证码验证
			$verify = new \Think\Verify();
			if(!$verify->check($data['code'],1)){
				$result = array('status'=>0,'msg'=>'验证码错误');
				break;
			}
			
			
			//验证是否有该admin用户
			$map['account'] = $data['account'];
			$map['is_del'] = 0;
			
			$admin_user = $this->where($map)->find();
			if(empty($admin_user)){
				$result = array('status'=>0,'msg'=>'无该管理员账户');
				break;
			}
			
			//验证密码是否正确
			if(my_encrypt($data['password'],$admin_user['salt']) != $admin_user['password']){
				$result = array('status'=>0,'msg'=>'密码错误');
				break;
			}
			
			$result = array('status'=>1,'msg'=>'登陆成功','data'=>$admin_user);
			break;
		}
		
		return $result;
	}
	
	
	//新增管理员
    public function addAdminUser($data){
		while(true){
			if(!$this->create($data,1)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			if(!empty($data['admin_role_id'])){
				//验证角色是否存在
				if(!(M('Admin_role')->where("admin_role_id='{$data['admin_role_id']}'")->find())){
					$result = array('status'=>0,'msg'=>'角色不存在或已被删除');
					break;
				}
			}else{
				$data['admin_role_id'] = 0;
			}
			
			//验证用户名是否被注册
			if(M('Admin_user')->where("account='{$data['account']}'")->find()){
				$result = array('status'=>0,'msg'=>'该用户名已被注册');
				break;
			}
			
			$data['salt'] = get_salt(6);
			$data['password'] = my_encrypt($data['password'],$data['salt']);
			
			$data['register_time'] = time();
			
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改管理员
	public function editAdminUser($admin_user_id,$data){
		while(true){
			if(!$this->create($data,2)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			if(!empty($data['admin_role_id'])){
				//验证角色是否存在
				if(!(M('Admin_role')->where("admin_role_id='{$data['admin_role_id']}'")->find())){
					$result = array('status'=>0,'msg'=>'角色不存在或已被删除');
					break;
				}
			}else{
				$data['admin_role_id'] = 0;
			}
			
			//验证用户名是否被注册
			if(M('Admin_user')->where("account='{$data['account']}' and admin_user_id!='{$admin_user_id}'")->find()){
				$result = array('status'=>0,'msg'=>'该用户名已被注册');
				break;
			}
			
			//如果存在密码则修改密码
			if(!empty($data['password'])){
				$data['salt'] = get_salt(6);
				$data['password'] = my_encrypt($data['password'],$data['salt']);
			}else{
				unset($data['password']);
			}
			
			$map['admin_user_id'] = intval($admin_user_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
		
	//删除管理员
	public function delAdminUser($admin_user_id){
		$map['admin_user_id'] = intval($admin_user_id);
		
		$this->where($map)->save(array('is_del'=>1));
		$result = array('status'=>1,'msg'=>'删除成功');
		
		return $result;
	}
	
	
	//获取用户权限列表
	public function getAdminUserInfo($admin_user_id){
		//获取用户 角色ID
		$map = array('admin_user_id'=>$admin_user_id);
		$admin_user = $this->where($map)->find();
		return $admin_user;
	}
	
	
}


?>