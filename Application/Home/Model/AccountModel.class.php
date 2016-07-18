<?php
namespace Home\Model;
use Think\Model;
/**
* 
*/
class AccountModel extends Model {
        
    //数据自动验证
    protected $_validate = array(
        array('uname','is_uname','用户名格式错误',1,'function',1),
        array('email','','账号已经存在',1,'unique',1),
        array('mobile','','账号已经存在',1,'unique',1),
        array('password','/^[0-9a-zA-Z_]{6,16}$/','请输入正确格式的密码',1,'regex',1),
        array('detepassword','password','两次输入的账号密码不一致',0,'confirm',1),
        array('agreement','1','未同意协议',1,'equal',1),
        array('newpassword','/^[0-9a-zA-Z_]{6,16}$/','请输入正确格式的密码',1,'regex',2),
        array('detepassword','newpassword','两次输入的账号密码不一致',0,'confirm',2),
        array('uname','is_uname','用户名格式错误',1,'function',3),
        array('password','/^[0-9a-zA-Z_]{6,16}$/','请输入正确格式的密码',1,'regex',3),
        array('nickname','1,10','昵称请输入1-10位字符串',2,'length',4),
        array('real_name','is_letter','姓名格式错误',2,'function',4),
        array('newpassword','/^[0-9a-zA-Z_]{6,16}$/','请输入正确格式的密码',1,'regex',5),
    );

    /* 注册用户数据库操作 */
    public function doRegister ($data) {

        while (true) {

          //判断用户名是否符合正确格式
          if (is_email($data['uname'])) {
              $data['email']  = $data['uname'];
          } elseif (is_phone($data['uname'])) {
              $data['mobile'] = $data['uname'];
          } else {
              $result         = array('status' => 0,'msg' => '用户名格式错误');
              break;
          }
          //图片验证码验证
          if($data['source']!='wap'){
            $verify = new \Think\Verify();
            if (!$verify -> check($data['imgcode'])) {
                 $result = array('status' => 0,'msg' => '验证码错误');
                 break;
            }
          }
          
          //验证信息验证
          $map['uname']         = $data['uname'];
          $codeInfo             = M('Vericode') -> order('sendtime desc') ->where($map) -> find();

          if ($data['code'] != $codeInfo['code']) {
              $result = array('status' => 0,'msg' => '验证信息错误');
              break;
          }
          
          $map['code']          = $data['code'];
          
          //获得验证码的发送时间
          $sendInfo             = M('Vericode') -> where($map) -> find();
          //设置有效时间为600s即10min
          $endTime              = $sendInfo['sendtime']+600;
          $nowTime              = time();
          if ($nowTime>$endTime) {
              $result = array('status' => 0,'msg' => '验证码已无效请重新发送');
              break;
          }

          if (!$this -> create($data,1)) {
              $result = array('status' => 0,'msg' => $this -> getError());
              break;
          }

          //密码加密
          $data['salt']          = get_salt(6);
          $data['password']      = my_encrypt($data['password'], $data['salt']);

          //注册时间与注册IP
          $data['register_time'] = time();
          $data['register_ip']   = get_client_ip();

          //增加数据值至数据库
          $val                   = $this -> add($data);
          if (empty($val)) {
              $result = array('status' => 0,'msg' => '注册失败');
          }
          $result                = array('status' => 1,'msg' => '注册成功','uid' =>$val);
          break;
        }
        return $result;
    }


    /* 登录操作 */
    public function doLogin ($data) {

        while (true) {
          if (!$this -> create($data,3)) {
                $result = array('status' => 0,'msg' => $this -> getError());
                break;
            }
            //判断用户名类型
            if (is_email($data['uname'])) {
                $map['email']    = $data['uname'];
            }
            if (is_phone($data['uname'])) {
                $map['mobile']   = $data['uname'];
            }
            //获取salt
            $val                 = $this -> field('salt,status') -> where($map) -> find();

            if (empty($val['status'])) {
                $result = array('status' => 0,'msg' => '该用户已被禁用');
                break;
            }

            $salt                = $val['salt'];
            //验证登录信息
            $map['password']     = my_encrypt($data['password'],$salt);
            $res                 = $this -> field('account_id') ->where($map) -> find();
            if (empty($res['account_id'])) {
                $result = array('status' => 0,'msg' => '用户名或者密码错误');
                break;
            }
            $result              = array('status' => 1, 'msg' =>'','uid' => $res['account_id'],);
            break;
        }
        return $result;
    }


    /* 用户名验证方法 */
    public function checkUserName ($data) {

        while(true) {
            if (is_phone($data['uname'])) {
                $map['mobile'] = $data['uname'];
            }
            if (is_email($data['uname'])) {
                $map['email'] = $data['uname'];
            }
            $count = $this -> where($map) -> count();
            if ($count) {
                $result = array('status' => 'n','info' => '账号已经存在');
                break;
            }
            $result = array('status' => 'y','info' =>'');
            break;
        }
        return $result;
    }


    /* 重置密码用户名验证 */
    public function dopwdFirst ($data) {

        while (true) {
            //验证用户名是否存在
            $arr = $this -> checkUserName($data);
            if ($arr['status'] =='y') {
                $result = array('status' => 0, 'msg' => '用户名不存在');
                break;
            }
            //图片验证码验证
            $verify = new \Think\Verify();
            if (!$verify -> check($data['imgCode'])) {
                $result = array('status' => 0,'msg' => '验证码错误');
                break;
            }
            $result = array('status' => 1, 'msg' =>'');
            break;
        }
        return $result;
    }


    /*验证第二步，验证获得的验证码*/
    public function dopwdSecond ($data) {

        while (true) {

            $map['uname'] = $data['uname'];
            $map['code']  = $data['code'];
            $count        = M('Vericode') -> where($map) -> count();
            if (empty($count)) {
                $result = array('status' => 0,'msg' =>'验证信息错误');
                break;
            }

            //获得验证码的发送时间
            $sendInfo = M('Vericode') -> where($map) -> find();
            //设置有效时间为600s即10min
            $endTime  = $sendInfo['sendtime']+600;

            $nowTime  = time();
            if ($nowTime>$endTime) {
                $result = array('status' => 0,'msg' => '验证码已无效请重新发送');
                break;
            }

            //置空$map
            $map = array();
            if (is_email($data['uname'])) {
                $map['email']  = $data['uname'];
            }else{
                $map['mobile'] = $data['uname'];
            }
            //获取该用户名的ID
            $arr = $this -> field('account_id') ->where($map) -> find();
            $accountID = $arr['account_id'];
            $result = array('status' => 1,'msg' =>'' , 'uid' => $accountID);
            break;
        }
        return $result;
    }


    /*找回密码第三步，修改密码*/
    public function dopwdThird ($data) {
        
        while (true) {
            if (!$this -> create($data,5)) {
                $result = array('status' => 0,'msg' => $this->getError());
                break;
            }
          
          //对新密码进行加密
          $data['salt']          = get_salt(6);
          $data['password']      = my_encrypt($data['newpassword'], $data['salt']);

          //获取IP地址
          $data['register_ip']   = get_client_ip();
          $map['account_id']   = $data['account_id'];
          $val = $this -> where($map) ->save($data);
          if (empty($val)) {
              $result = array('status' =>0 ,'msg' => '修改失败');
              break;
          }
          $result = array('status' =>1 ,'msg' => '');
          break;
        }
        return $result;
    }
    
    /* 个人中心信息昵称,真是姓名的修改 */
    public function userInfoSave ($account_id,$data) {

        while (true) {
            if (!$this -> create($data,4)) {
                $result = array('status' => 0,'msg' => $this->getError() );
                break;
            }

            $map['account_id'] = $account_id;
            $this -> where($map) -> save($data);
            $result = array('status' => 1 ,'msg' => '');
            break;
            
        }
        return $result;
    }
    
    /* 修改密码 */
    public function passwordEditor ($account_id,$data) {

        while (true) {

           if (!$this -> create($data,2)) {
               $result = array('status' => 0,'msg' => $this->getError());
               break;
           }

           //验证旧密码是否正确
           $map['account_id'] = $account_id;
           $var = $this -> field('salt') -> where($map) -> find();
           $salt = $var['salt'];
           //对密码进行加密
           $map['password'] = my_encrypt($data['password'], $salt);
           $count = $this -> where($map) -> count();
           if (empty($count)) {
               $result = array('status' => 0,'msg' => '旧密码错误');
               break;
           }

           //对新密码进行加密
           $map = array();
           $map['account_id'] = $account_id;
           $data['salt']     = get_salt(6);
           $data['password'] = my_encrypt($data['newpassword'],$data['salt']);
           $val = $this -> where($map) ->save($data);
           if (empty($val)) {
               $result = array('status' => 0,'msg' => '保存失败');
               break;
           }
           $result = array('status' => 1,'msg' => '保存成功');
           break;
        }
        return $result;
    }



}


?>