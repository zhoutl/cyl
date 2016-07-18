<?php
namespace Home\Service;
use Think\Model;
/**
* 
*/
class VericodeService extends Model{

     //短信post传值方法
     private function yp_sock_post($url,$query){  
         $data = "";
         $info=parse_url($url);
         $fp=fsockopen($info["host"],80,$errno,$errstr,30);
         if(!$fp){
            return $data;
         }
         $head="POST ".$info['path']." HTTP/1.0\r\n";
         $head.="Host: ".$info['host']."\r\n";
         $head.="Referer: http://".$info['host'].$info['path']."\r\n";
         $head.="Content-type: application/x-www-form-urlencoded\r\n";
         $head.="Content-Length: ".strlen(trim($query))."\r\n";
         $head.="\r\n";
         $head.=trim($query);
         $write=fputs($fp,$head);
         $header = "";
         while ($str = trim(fgets($fp,4096))) {
                $header.=$str;
         }
         while (!feof($fp)) {
                $data .= fgets($fp,4096);
         }
         return $data;
     }

     //发送邮箱方法
     public function emailSend ($add_email,$body,$file="") {
         Vendor("PHPMailer.class#phpmailer");      //引入PHPMailer文件
         Vendor("PHPMailer.class#smtp");           //引入PHPMailer文件
         $mail = new \PHPMailer();                 //实例化核心对象
         $mail->IsSMTP();                          //设置通过smtp协议发送邮件
         $mail->Port       = '994';                //设置邮箱系统的端口号
         $mail->SMTPSecure = 'ssl';                //开启ssl协议
         $mail->ChaeSet    = "utf-8";              //设置邮件信息使用的编码
         $mail->SMTPAuth   = true;                 //设置开启SMTP服务器的验证
         $mail->Host       = "smtp.163.com";       //设置主机服务器
         $mail->Username   = "hslbg_67man@163.com";//系统使用的发件人的账户
         $mail->Password   = "hslbg123";           //163授权码
         $mail->From       = "hslbg_67man@163.com";//发件的地址
         $mail->FromName   = "衡水老白干官方商城"; //发件的名称
         $mail->AddAddress($add_email);            //设置收件人的地址
         $mail->Subject    = "衡水老白干官方商城验证码"; //设置邮件标题
         $mail->IsHTML();                          //解析邮件
         $mail->Body       = "验证码是:".$body;    //设置邮件内容
         $mail->SMTPDebug  = false;                //开启见识错误,可以做发送成功与否的判断
         $mail->AddAttachment($file);              //插入附件信息

         while (true) {                            //判断是否邮件发送成功
             if (!$mail->send()) {
             	 $result = array('status' => '0','msg' => $mail->ErrorInfo);
             	 break;
             }
             $result = array('status' => '1','msg' => '发送成功');
             break;
         }
         return $result;
     }
     
     //短信发送方法
     public function messageSend ($data) {
         $phone = $data['uname'];
         $url ="http://yunpian.com/v1/sms/send.json";
         $apikey = '4deed6e02292f35ebfe3c757904ab2ae';
         $code = $data['code'];
         $encoded_text = '【衡水老白干商城】您的验证码是'.$code;
         $encoded_text = urlencode($encoded_text);
         $post_string="apikey={$apikey}&text={$encoded_text}&mobile={$phone}";
         $res = $this->yp_sock_post($url, $post_string);
         $res = json_decode($res);
         while (true) {
             if ($res->code == '0') {
                 $result = array('status'=>1,'msg'=>'短信发送成功');
                 break;
             }
             $result = array('status'=>0,'msg'=>$res->detail);
             break;
         }
        return  $result;
     }



}


?>