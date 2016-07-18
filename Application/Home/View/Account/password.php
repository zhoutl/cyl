<?php W('Home/head',array('seo_data'=>$seo_data));?>
<!-- 独有JS -->
<script type="text/javascript" src="__PUBLIC__/Home/js/account/password.js" ></script>
<!-- 独有JS -->
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Account/index') ?>">个人中心 </a>>修改密码
                </div>
                </div>
                </div> 
                <div  class="thewidth">
                <div class="mainbox mt15">
                    <!-- left -->
                    <?php W('Home/menu');?>
                    <!-- /left -->
                    <!-- right -->
                    <div class="mainright">
                        <div class="width pdl20">
                            <div class="width order-top"><span class="f_l font-20">修改密码</span></div>
                            <div class="data-box mt30 xgmm">
                                <form method="post" class="demoform">
                                    <div class="demoformbox demoformbox3">
                                        <label class="wb15 f_l c666 mr17">旧密码：</label>
                                        <input type="password" id="password" class="form-control data-kk1" name="password" placeholder="请输入旧密码" datatype="*6-20" errormsg="请输入旧密码" nullmsg="请输入旧密码">
                                        <span class="Validform_checktip"></span>
                                    </div> 
                                    <div class="demoformbox demoformbox3">
                                        <label class="wb15 f_l c666 mr17">新密码：</label>
                                        <input type="password" id="password2" class="form-control data-kk1" name="newpassword" placeholder="请输入新密码" datatype="*6-20" errormsg="请输入新密码" nullmsg="请输入新密码">
                                        <span class="Validform_checktip"></span>
                                    </div>
                                    <div class="demoformbox demoformbox3">
                                        <label class="wb15 f_l c666 mr17">重复新密码：</label>
                                        <input type="password" id="password3" class="form-control data-kk1" name="detepassword" recheck="newpassword" placeholder="请再次输入新密码"  datatype="*" errormsg="您两次输入的账号密码不一致" nullmsg="请重新输入密码">
                                        <span class="Validform_checktip"></span>
                                    </div>
                                
                                    <div class="demoformbox demoformbox3">
                                        <label class="wb15 f_l c666 mr17">&nbsp;</label>
                                        <button type="button" id="LFSubmit2" id="btn_sub" class="btn btn-blue save">保存</button>
                                    </div>
                    
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /right -->
                </div>
            </div>
          
             
    </div>
<!--/wrap-->


<?php W('Home/foot');?>