<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>找回密码</title>
<link rel="stylesheet" href="__PUBLIC__/Home/css/public/reset.css" type="text/css" media="screen" />
<link rel="Stylesheet" href="__PUBLIC__/Common/css/bootstrap.min.css" type="text/css" />
<link rel="Stylesheet" href="__PUBLIC__/Home/css/public/font-awesome.min.css" type="text/css" />
<link rel="Stylesheet" href="__PUBLIC__/Home/css/style.css" type="text/css" />
<link rel="Stylesheet" href="__PUBLIC__/Home/css/login.css" type="text/css" />
<link rel="Stylesheet" href="__PUBLIC__/Home/css/jform.css" type="text/css" />
<!-- jQuery -->
<script type="text/javascript" src="__PUBLIC__/Common/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Common/js/jform.js"></script>
<script src="__PUBLIC__/Common/js/layer/layer.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/password/second.js"></script>
<script>
var _APP = "<?php echo "__APP__"; ?>";
var _URL = "<?php echo "__URL__"; ?>";
</script>
</head>

<body>

<div id="container" class="thewidth100">

<!--header-->
    <div class="top_bg clearfix thewidth100"> 
        <div class="top thewidth clearfix">
         <div class="f_l"><a href="<?php echo U('Index/index') ?>"><img src="__PUBLIC__/Home/images/logo.jpg"></a></div>
        
        <!--top_right-->
        <div class="f_r">返回<a href="<?php echo U('Login/index') ?>" class="red">登录</a></div>
         <!--/top_right--> 
        
       </div> 
    </div>
<!--------------------------------------[ header ]-------------------------------------->


<!--wrap-->
    <div class="thewidth100 bg_gray">    
        <div class="bg_fff thewidth clearfix pb40">
            <div class="regtop font-18 red">找回密码</div>
            <div class="password1 mt20 mb15">
                <ul>
                    <li>
                        <div class="password1-line password1-line2"></div>
                        <div class="center pasxz"><p class="password1-first current1">1</p><p class="blue">输入用户名</p></div>
                    </li>
                    <li>
                        <div class="password1-line"></div>
                        <div class="center pasxz"><p class="password1-first current1">2</p><p class="blue">验证身份</p></div>
                    </li>
                    <li>
                        <div class="password1-line"></div>
                        <div class="center pasxz"><p class="password1-first">3</p><p>重置密码</p></div>
                    </li>
                    <li>
                        <div class="center pasxz"><p class="password1-first">4</p><p>完成</p></div>
                    </li>
                    
                </ul>
            </div>
            <div class="registerForm passml">
                    <form method="post" class="demoform">
                        <div class="demoformbox">
                            <div class="form-control lo_text">
                            <?php if (is_phone($_SESSION['lbg_back']['name'])) {?>
                           
                                <label class="wb30 f_l">手 机 号</label>
                                <span class="regkk1 c333" id="uname">
                                     <?php echo $_SESSION['lbg_back']['name']?>
                                </span>
                            <?php }else{?>
                                <label class="wb30 f_l">邮 箱 号</label>
                                <span class="regkk1 c333" id="uname" >
                                     <?php echo $_SESSION['lbg_back']['name']?>
                                </span>
                            <?php } ?>
                            </div>
                            <div class="Validform_checktip"></div>
                        </div>

                        <div class="demoformbox pr">
                            <div class="form-control lo_text">
                                <label class="wb30 f_l">验证码</label>
                                <input type="text" id="code" class="regkk1 regkk2" name="code" altercss="gray" placeholder="请输入验证码" tip="请输入验证码" datatype="*4-6" errormsg="请输入验证码" nullmsg="请输入验证码">
                                <button type="button"  class="regphone">获取验证码</button>
                            </div>
                            <div class="Validform_checktip"></div>
                        </div>
                    
                        <div class="demoformbox">
                            <button type="button" id="LFSubmit2" id="btn_sub" class="btn btn-blue btn-lg font-16 mt10">下一步</button>
                        </div>
                    
                    </form>
               
                </div>
            
      
       
        
        </div>      
    </div>
<!--/wrap-->


<!--------------------------------------[ footer ]-------------------------------------->
    <div class="footer_bg thewidth100">
        <div class="thewidth">
            <div class="footer">
                <div class="footer2">
                    <ul>
                        <li>
                            <h4>购物指南</h4>
                            <a href="#">购物流程</a><br>
                            <a href="#">常见问题</a><br>
                            <a href="#">联系客服</a><br>
                            <a href="#">会员协议</a><br>
                        </li>
                        <li>
                            <h4>支付方式</h4>
                            <a href="#">在线支付</a><br>
                            <a href="#">货到付款</a><br>
                            <a href="#">余额支付</a><br>
                            <a href="#">支付宝支付</a><br>
                        </li>
                        <li>
                            <h4>配送方式</h4>
                            <a href="#">配送范围</a><br>
                            <a href="#">配送方式</a><br>
                            <a href="#">配送费用</a><br>
                            <a href="#">100免运费</a><br>
                        </li>
                        <li>
                            <h4>售后服务</h4>
                            <a href="#">服务承诺</a><br>
                            <a href="#">退款说明</a><br>
                            <a href="#">退换货政策</a><br>
                            <a href="#">退换货流程</a><br>
                        </li>
                        <li>
                            <h4>服务保障</h4>
                            <a href="#">积分制度</a><br>
                            <a href="#">会员制度</a><br>
                            <a href="#">充值优惠</a><br>
                            <a href="#">真品防伪</a><br>
                        </li>
                    </ul>
                </div>
                <div class="footer3 font-12">
                    <span class="f_l"><img src="__PUBLIC__/Home/images/login/login_09.jpg"><br>衡水老白干移动端</span>
                    <span class="f_r"><img src="__PUBLIC__/Home/images/login/login_09-04.jpg"><br>衡水老白干微信端</span>
                </div>
                <div class="width mt20 font-12">
                    <div class="center songti gray4">
                        <a href="#" target="_blank">关于我们</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" target="_blank">公司资质</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="#" target="_blank">诚聘英才</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" target="_blank">联系我们</a>&nbsp;&nbsp;
                        <p></p>
                    </div>
                    <div class="center songti mt10 c999">Copyright © 2016  河北衡水老白干酿酒(集团)有限公司版权所有   冀ICP备06000141号</div>
                    <div class="center mt10"><img src="__PUBLIC__/Home/images/login/login_16.jpg">&nbsp;&nbsp;<img src="__PUBLIC__/Home/images/login/login_18.jpg"></div>
                </div>
            </div>
            
        
        
        </div>
    </div>
<!--/footer-->

</div>


</body>
</html>