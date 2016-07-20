<?php
namespace Wap\Controller;
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
            $result = D('Home/Account') -> doRegister($data);
             if (!$result['status']) {
                $this -> ajaxReturn($result);
            }
            $result = D('Home/AccountExtra') -> userExtraAdd($result['uid']);

            //设置首页url
            $result['url'] = U('Account/index');
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
            $result = D('Home/Vericode') -> sendCode($data);

             //图片验证码验证
            $verify = new \Think\Verify();
            if (!$verify -> check($data['imgcode'])) {
                $result = array('status' => 0,'msg' => '验证码错误');
            }
            if ($result['status']==1) {
                //使用email接口发送给用户
                if (is_email($data['uname'])) {
                    $add_email = $data['uname'];
                    $body      = $result['msg'];
                    $result    = D('Home/Vericode','Service') -> emailSend($add_email,$body,$file="");
                    $this -> ajaxReturn($result);
                }

                //使用短信接口发送验证码
                if (is_phone($data['uname'])) {
                    $data['code'] = $result['msg'];
                    $result = D('Home/Vericode','Service') -> messageSend($data);
                    $this -> ajaxReturn($result);
                }
            }
             $this -> ajaxReturn($result);
            
         }   
    }

    /* AJAX验证用户名是否唯一 */
    public function checkUserName () {

        if (IS_AJAX) {
        	//获取用户名信息
            $unameinfo = I('post.');
            $data['uname'] = $unameinfo['param']; 
            //调用用户检验方法
            $result = D('Home/Account')->checkUserName($data);
            $this -> ajaxReturn($result);
        }
    }



}


?>