<?php
namespace Wap\Controller;
use Think\Controller;
/**
* 
*/
class LoginController extends Controller{
    
    public function index () {
        //判断是否已经登录
        $val                = session('lbg_account');
        if (!empty($val)) {
            $this -> redirect('Index/index');
        }
        //判断是已经记住账号
        if ($_COOKIE['name']) {
            $this -> assign('cookname',$_COOKIE['name']);
        }

        $data['reffer_url'] = $_SERVER['HTTP_REFERER']?$_SERVER['HTTP_REFERER']:U('Index/index');
        $this -> assign('data',$data);
        $this -> display();   
    }

    public function login () {

        if (IS_AJAX) {

            $data           = I('post.');
            //实例化Account
            $result         = D('Account') -> doLogin($data);
            if (!$result['status']) {
                $this -> ajaxReturn($result);
            }
            //判断是否需要记住用户名
            if ($data['terms']) {
                $uname      = $data['uname'];
                //存储cookie
                cookie('name',$uname,3600*24*30);
            }
            //存储session
            session('lbg_account',array('uid' => $result['uid'],'name' => $data['uname']));
           
            $this -> ajaxReturn($result);
        }    
    }

    public function loginOut () {
        //清除session
        session('lbg_account',null);
        redirect(U('Index/index'));
    }

    public function checkUserName () {

        $data             = I('post.');
        $data['uname']    = $data['param'];
        $result           = D('Account') -> checkUserName($data);

        if ($result['status'] =='y') {

            $result = array('status' => 'n','info' =>'该用户不存在');
            $this -> ajaxReturn($result);
        }

        $result           = array('status' => 'y','info' =>'');
        $this -> ajaxReturn($result);
    }
}


?>