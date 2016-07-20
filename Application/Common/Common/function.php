<?php

//加密函数
function my_encrypt($password,$salt=NULL){
	if($salt){
		return md5(md5($password).$salt);
	}else{
		return md5($password);
	}
}


//获取随机字符
function get_salt($length, $numeric = 0) {  
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);  
    if($numeric) {  
        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));  
    } else {  
        $hash = '';  
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';  
        $max = strlen($chars) - 1;  
        for($i = 0; $i < $length; $i++) {  
            $hash .= $chars[mt_rand(0, $max)];  
        }  
    }  
    return $hash;  
    exit;  
}

 //判断是否是微信浏览器
function is_weixin(){
	if(strpos( $_SERVER["HTTP_USER_AGENT"], 'MicroMessenger')){
		return true;
	}else{
		return false;
	}
}

//验证是否为邮件
function is_email($email){
	return preg_match ( "/[_a-zA-Z\d\-\.]+@[_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+$/i", $email ) !== 0;
}

//验证是否为手机号
function is_phone($phone){
	return preg_match ( "/1[34578]{1}\d{9}$/", $phone ) !== 0;
}

//创建文件夹
function create_dir($dir){
	if(!file_exists($dir)){
		mkdir($dir,0777);
	}
}

//获取文件后缀
function get_suffix($filename){
	$file_arr = pathinfo($filename);
	$ext = $file_arr['extension'];
	return strtolower($ext);
}

//重命名文件
function rename_file($file){
	$ext = get_suffix($file);
	return md5(microtime().get_salt(6)).'.'.$ext;
}
//验证用户名
function is_uname($uname){
    if (is_email($uname) || is_phone($uname)) {
        return true;    
    }
    return false;
}

//验证随机数
function randnumer(){
     $arr = range(1,6);
     shuffle($arr);
     return implode("",$arr);
}

//验证是否是中文或者英文
function is_letter($var){
    return preg_match ( "/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u", $var ) !== 0;   
}


//获取随机码
function get_rand_str($length=9){
	$code = '';
	$str = 'abcdefghijklmnopqrstuvwxyz';
	for($i=1;$i<=$length;$i++){
		if ($i%2 == 1)
			$code.= rand(0,9);
		else
			$code.= $str[rand(0,25)];
	}
	return $code;
}

//文件上传检测
function check_file($file,$limit_size,$limit_type,$type_des){
	if(!empty($file['error'])){
		switch($file['error'])
		{
			case '1':
				$err = '文件大小超过了系统设置的最大值';
				break;
			case '2':
				$err = '文件大小超过了系统设置的最大值';
				break;
			case '3':
				$err = '文件上传不完全';
				break;
			case '4':
				$err = '无文件上传';
				break;
			case '6':
				$err = '缺少临时文件夹';
				break;
			case '7':
				$err = '写文件失败';
				break;
			case '8':
				$err = '上传被其它扩展中断';
				break;
			case '999':
			default:
				$err = '无有效错误代码';
		}
		$result = array('status'=>0,'msg'=>$err);
	}else{
		if(empty($file['tmp_name']) || $file['tmp_name'] == 'none'){
			$result = array('status'=>0,'msg'=>'无文件上传');
		}else{
			$ext = get_suffix($file['name']);
			if (in_array($ext,$limit_type)) {
				if($file['size'] > ($limit_size*1024)){ 
					$result = array('status'=>0,'msg'=>'文件'.$file['name'].'超过系统限制的'.$limit_size.'KB大小');
				}else{
					$result = array('status'=>1,'msg'=>'');
				}		
			}else{
				$result = array('status'=>0,'msg'=>'文件'.$file['name'].'不符合系统限制的'.$type_des.'格式的文件');
			}
		}	
	}
	return $result;
}

//转换查询条件
function change_map($str,$type=1){
	$map = '';
	if($type == 1){
		switch($str){
			case 'pc':
				$map = 'is_pc=1';break;
			case 'wap':
				$map = 'is_wap=1';break;
			case 'app':
				$map = 'is_app=1';break;
			default:
				$map = 'is_pc=1';break;
		}
	}else if($type == 2){
		switch($str){
			case 'pc':
				$map = array('is_pc'=>1);break;
			case 'wap':
				$map = array('is_wap'=>1);break;
			case 'app':
				$map = array('is_app'=>1);break;
			default:
				$map = array('is_pc'=>1);break;
		}
	}
	return $map;
}

//生成订单号
function get_order_no(){
	$orders_record_id = M('Orders_record')->add(array('orders_record_id'=>NULL));
	return $orders_record_id?date('Ymd').str_pad($orders_record_id,5,'0',STR_PAD_LEFT).rand(0,9):false;
}

//PHP二位小数减法
function my_minus($a,$b){
	return ($a*100-$b*100)/100;
}

//判断商品类别是否存在
function check_item_category($var){
	return M('Item_category')->where("item_category_id=".intval($var))->find()?true:false;
}

//判断商品品牌是否存在
function check_brand($var){
	return M('Brand')->where("brand_id=".intval($var))->find()?true:false;
}

//判断用途是否存在
function check_item_purpose($var){
	return M('Item_purpose')->where("item_purpose_id=".intval($var))->find()?true:false;
}

	function check_wap() {  
	 if (isset($_SERVER['HTTP_VIA'])) return true;  
	 if (isset($_SERVER['HTTP_X_NOKIA_CONNECTION_MODE'])) return true;  
	 if (isset($_SERVER['HTTP_X_UP_CALLING_LINE_ID'])) return true;  
	 if (strpos(strtoupper($_SERVER['HTTP_ACCEPT']),"VND.WAP.WML") > 0) {  
	  // Check whether the browser/gateway says it accepts WML.  
	  $br = "WML";  
	 } else {  
	  $browser = isset($_SERVER['HTTP_USER_AGENT']) ? trim($_SERVER['HTTP_USER_AGENT']) : '';  
	  if(empty($browser)) return true;
	  $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');  

	  $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');  

	  $found_mobile=checkSubstrs($mobile_os_list,$browser) ||  
		   checkSubstrs($mobile_token_list,$browser); 
	 if($found_mobile)
	  $br ="WML";
	 else $br = "WWW";
	 }  
	 if($br == "WML") {  
	  return true;  
	 } else {  
	  return false;  
	 }  
	}
	
	
	function checkSubstrs($list,$str){
	 $flag = false;
	 for($i=0;$i<count($list);$i++){
	  if(strpos($str,$list[$i]) > 0){
	   $flag = true;
	   break;
	  }
	 }
	 return $flag;
	}


?>