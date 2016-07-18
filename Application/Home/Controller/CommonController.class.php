<?php
namespace Home\Controller;
use Think\Controller;
/**
* 
*/
class CommonController extends Controller{
	
    public function Verify () {
    	//配置验证码格式
        $config = array(    
            'fontSize'    =>    22,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数    
            'useNoise'    =>    false, // 关闭验证码杂点
            'imageW'      =>    165,
            'imageH'      =>    45,
            'useCurve'    =>    false, //曲线开关
            'useImgBg'    =>    false, //背景开关
        );
        //实例化验证码插件
        $Verify = new \Think\Verify($config);
        $Verify -> entry();
    }

        /* 三级联动城市选择AJAX */
    public function city () {

        if (IS_AJAX) {
            $data   = I('post.');
            $str    = '城市';
            $result = D('Area') -> chooseArea($data,$str);
            $this -> ajaxReturn($result);
        }
    }


    /* 三级联动区域选择AJAX */
    public function area () {

        if (IS_AJAX) {
            $data   = I('post.');
            $str    = '区域';
            $result = D('Area') -> chooseArea($data,$str);
            $this -> ajaxReturn($result);
        }
    }

    /* 图片上传 */
    public function uploadify () {
        
        $verifyToken = md5('hslbg_unique_salt' . $_POST['timestamp']);
        
        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

            //获取临时文件夹地址
            $tempFile   = $_FILES['Filedata']['tmp_name'];
            //获取用户ID
            $session    = session('lbg_account');

            //重新组装文件夹地址字符串
            $targetPath = './Public/upload/avatar/'.intval($session['uid']);

            //创建文件夹
            create_dir($targetPath);

            $res = check_file($_FILES['Filedata'],1024,array('jpg','jpeg','gif','png'),'jpg、jpeg、png、gif');

            if ($res['status']) {
                //将文件名重命名
                $newFile    = substr_replace($_FILES['Filedata']['name'],'avatar.jpg',0);

                //获取新的地址
                $targetFile = $targetPath.'/'.$newFile;
                
                move_uploaded_file($tempFile,$targetFile);
                $result     = array('status' => 1,'msg' =>'','url' => substr($targetFile,1));
            }else{
               $result = $res;
            }
            
            $this -> ajaxReturn($result);
        }
    }

    /* 退货申请图片上传 */
    public function refundUploadify () {
        
        $verifyToken = md5('hslbg_unique_salt' . $_POST['timestamp']);
        
        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

            //获取临时文件夹地址
            $tempFile   = $_FILES['Filedata']['tmp_name'];

            //重新组装文件夹地址字符串
            $targetPath = './Public/upload/refund/'.date("Ymd",time());

            //创建文件夹
            create_dir($targetPath);

            $res = check_file($_FILES['Filedata'],1024,array('jpg','jpeg','gif','png'),'jpg、jpeg、png、gif');

            if ($res['status']) {
                //将文件名重命名
                $ext = get_suffix($_FILES['Filedata']['name']);
                $newFile    = rename_file($_FILES['Filedata']['name']);

                //获取新的地址
                $targetFile = $targetPath.'/'.$newFile;
                
                move_uploaded_file($tempFile,$targetFile);
                $result     = array('status' => 1,'msg' =>'','url' => substr($targetFile,1));
            }else{
               $result = $res;
            }

            $this -> ajaxReturn($result);
        }
    }

    //删除图片
    public function delImg(){
        $filename=I('post.filename');
		$a = strstr($filename, '/Public/upload/refund/');
		$b = strstr($filename, '/Public/upload/itemComment/');
        //图片路径
        if(!empty($a) || !empty($b)){
            
            $filename='.'.$filename;
            unlink($filename);
        }
        
    }
 
    //商品评论图片上传
    public function itemCommentUploadify () {

        $verifyToken        = md5('hslbg_unique_salt' . $_POST['timestamp']);

        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

            //获取临时文件夹地址
            $tempFile       = $_FILES['Filedata']['tmp_name'];

            //重新组装文件夹地址字符串
            $targetPath     = './Public/upload/itemComment/'.date('Ymd',time());

            create_dir($targetPath);

            //检查文件格式
            $var            = check_file($_FILES['Filedata'],2048,array('jpg','jpeg','gif','png'),'jpg、jpeg、png、gif');

            if ($var['status']) {
                //将文件名重命名
                $ext        = get_suffix($_FILES['Filedata']['name']);
                $newFile    = rename_file($_FILES['Filedata']['name']);

                //获取新的地址
                $targetFile = $targetPath.'/'.$newFile;

                move_uploaded_file($tempFile,$targetFile);
                $result     = array('status' => 1,'msg' =>'','url' => substr($targetFile,1));
            }else{
                $result     = $val;
            }

            $this -> ajaxReturn($result);
        }
    }
   
    
}
?>