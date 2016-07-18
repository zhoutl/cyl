<?php
namespace Home\Model;
use Think\Model;

/**
* 
*/
class VericodeModel extends Model{

     //数据自动验证
     protected $_validate = array(
         array('uname','is_uname','请输入手机号/邮箱',1,'function',3),
    );

	 //数据自动增加
	 protected $_auto = array(
	 	 array('sendtime','time',1,'function'),
	 );
     
     /* 发送账户验证码 */
     public function sendCode ($data) {

        while (true) {
            
            $data['send_ip']           = get_client_ip();
            if (!$this->create($data)) {
                $result = array('status'=>0,'msg'=>$this->getError());
                break;
            }


            if (is_email($data['uname'])) {
                //判断是否是找回密码发送
                if (empty($data['sendtype'])) {
                    $map['email']      = $data['uname'];
                    $count             = M('Account') -> where($map) -> count();
                    if (!empty($count)) {
                        $result = array('status' => 0,'msg' => '账号已经存在');
                        break;
                    }
                }
                $data['type']          = 'email';
            }

            //判断电话号码今天发送验证码是否超过3次
            if (is_phone($data['uname'])) {

                //判断是否是找回密码发送
                if (empty($data['sendtype'])) {
                    $map['mobile']     = $data['uname'];
                    $count             = M('Account') -> where($map) -> count();
                    if (!empty($count)) {
                        $result = array('status' => 0,'msg' => '账号已经存在');
                        break;
                    }
                }
                
                //获取今天开始时间
                $starttime             = date('Y-m-d',time()).'00:00:00';
                $starttime             = strtotime($starttime);
                //获取今天结束时间
                $endtime               = date('Y-m-d',time()).'23:59:59';
                $endtime               = strtotime($endtime);
                //组装今天范围的查询语句
                $map['uname']          = $data['uname'];
                $map['sendtime']       = array(between,array($starttime,$endtime));
                $count                 = $this -> where($map) -> count();
                if ($count>=3) {
                    $result = array('status'=>0,'msg'=>'该号码今天发送了三次验证码');
                    break;
                }
                $data['type']      ='phone';
            }

            //获得code随机数
            $data['code'] = randnumer();

            //将验证码加入数据库
            $codeID = $this -> add($this -> create($data));
            if (empty($codeID)) {
                $result = array('status' => 0,'msg' => '验证码发送失败');
                break;
            }
            $result = array('status' => 1,'msg' => $data['code']);
            break;
        }
        return $result;
     }




}




?>