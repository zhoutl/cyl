<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller {

    public function index () {
        $val = session('lbg_account');
        if (!empty($val)) {
            $this -> redirect('Index/index');
        }
        $this -> display();
    }


    /* 验证码，用户注册 */
    public function register () {

        if (IS_AJAX) {
            $data = I('post.');
            $result = D('Account') -> doRegister($data);
             if (!$result['status']) {
                $this -> ajaxReturn($result);
            }
            $result = D('AccountExtra') -> userExtraAdd($result['uid']);

            //设置首页url
            $result['url'] = U('Index/index');
            //存储session
            session('lbg_account',array('uid' => $result['uid'],'name' => $data['uname']));
            $this -> ajaxReturn($result);
        }
    }

    /* AJAX发送验证码并存入数据库 */
    public function sendCode () {

        if (IS_AJAX) {
            $data   = I('post.');
            //将随机验证码插入数据库
            $result = D('Vericode') -> sendCode($data);

            if (empty($result['status'])) {
                $this -> ajaxReturn($result);
            }
            //使用email接口发送给用户
            if (is_email($data['uname'])) {
                $add_email = $data['uname'];
                $body      = $result['msg'];
                $result    = D('Vericode','Service') -> emailSend($add_email,$body,$file="");
                $this -> ajaxReturn($result);
            }

            //使用短信接口发送验证码
            if (is_phone($data['uname'])) {
                $data['code'] = $result['msg'];
                $result = D('Vericode','Service') -> messageSend($data);
                $this -> ajaxReturn($result);
            }
         }   
    }

    /* AJAX验证用户名是否唯一 */
    public function checkUserName () {

        if (IS_AJAX) {
        	//获取用户名信息
            $unameinfo = I('post.');
            $data['uname'] = $unameinfo['param']; 
            //调用用户检验方法
            $result = D('Account')->checkUserName($data);
            $this -> ajaxReturn($result);
        }
    }



}


?>