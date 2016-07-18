<?php
namespace Home\Controller;
use Think\Controller;
class PasswordController extends Controller {

    //找回密码首页，即第一步
    public function index () {

        $val = session('lbg_account');
        if (!empty($val)) {
            $this -> redirect('Index/index');
        }

        $this -> display();
    }

    //AJAX验证第一步
    public function passwordFirst () {

        if (IS_AJAX) {
            $val = session('lbg_account');
            if (!empty($val)) {
                $this -> redirect('Index/index');
            }

            $data   = I('post.');
            $result = D('Account') -> dopwdFirst($data);
            if (empty($result['status'])) {
            	$this -> ajaxReturn($result);
            }

            //记录session
            session('lbg_back',array('name' =>$data['uname']));
            $result['url'] = U('Password/second');
            $this -> ajaxReturn($result);
        }    
    }

    //找回密码第二部页面
    public function second () {

        $val = session('lbg_account');
        if (!empty($val)) {
            $this -> redirect('Index/index');
        }

        $back = session('lbg_back');
        if (empty($back)) {
            $this -> redirect('Password/index');
        }

        $this -> display();
    }

    //AJAX发送验证码
    public function sendCode () {

        if (IS_AJAX) {

            $data = I('post.');
            $data['uname'] = trim($data['uname']);
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

    //AJAX验证第二部
    public function passwordSecond () {

        if (IS_AJAX) {

            $val = session('lbg_account');
            if (!empty($val)) {
                $result = array('status' => 0, 'msg' =>'用户信息错误','url' =>U('Index/index'));
                $this -> ajaxReturn($result);
            }

            $back = session('lbg_back');
            if (empty($back)) {
                $result = array('status' => 0, 'msg' =>'用户信息错误','url' =>U('Password/index'));
                $this -> ajaxReturn($result);
            }

            $data = I('post.');
            $data['uname'] = trim($data['uname']);
            $result = D('Account') -> dopwdSecond($data);
            if (empty($result['status'])) {
                $this -> ajaxReturn($result);
            }

            session('lbg_back',array('uid' =>$result['uid'],'name' => $data['uname']));
            $result['url'] = U('Password/third');
            $this -> ajaxReturn($result);
            
        }
    }

    //第三部显示页面
    public function third () {

        $val = session('lbg_account');
        if (!empty($val)) {
            $this -> redirect('Index/index');
        }

        $back = session('lbg_back');
        if (empty($back)) {
            $this -> redirect('Password/index');
        }

        $this -> display();
    }

    public function passwordThird () {

        if (IS_AJAX) {

            $val = session('lbg_account');
            if (!empty($val)) {
                $result = array('status' => 0, 'msg' =>'用户信息错误','url' =>U('Index/index'));
                $this -> ajaxReturn($result);
            }

            $back = session('lbg_back');
            if (empty($back)) {
                $result = array('status' => 0, 'msg' =>'用户信息错误','url' =>U('Password/index'));
                $this -> ajaxReturn($result);
            }

            $data   = I('post.');
            $data['uname'] = $back['name'];
            $data['account_id'] = $back['uid'];
            $result = D('Account') -> dopwdThird($data);
            if (empty($result['status'])) {
                $this -> ajaxReturn($result);
            }

            $result['url'] = U('Password/fourth');
            $this -> ajaxReturn($result);
        }  
    }

    //第四步显示页面
    public function fourth () {

        $val = session('lbg_account');
        if (!empty($val)) {
            $this -> redirect('Index/index');
        }

        $back = session('lbg_back');
        if (empty($back)) {
            $this -> redirect('Password/index');
        }
        
        session('lbg_back',NULL);
        $this -> display();
    }


}


?>