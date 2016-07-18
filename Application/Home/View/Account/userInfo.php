<?php W('Home/head',array('seo_data'=>$seo_data));?>
<script type="text/javascript" src="__PUBLIC__/Home/js/account/userinfo.js"></script>
<script type="text/javascript" src="__PUBLIC__/Common/uploadify/jquery.uploadify.min.js" ></script>

<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Account/index')?>">个人中心 </a>>个人主页
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
                            <div class="width order-top"><span class="f_l font-20">个人资料</span></div>
                            <div class="data-box mt30">
                                <form class="demoform">
                                    <div class="demoformbox mb25">
                                        <label class="wb15 f_l c666 mr17"></label>
                                        <div class="headphoto img100 pr">
                                        <?php 
                                          $file = "Public/upload/avatar/".$_SESSION['lbg_account']['uid']."/avatar.jpg";
                                           if (file_exists($file)) { ?>
                                               <img src="__PUBLIC__/upload/avatar/<?php echo $_SESSION['lbg_account']['uid'] ?>/avatar.jpg" id="img_list" >
                                        <?php }else{ ?>
                                               <img src="__PUBLIC__/Home/images/user/user_03.jpg" id="img_list">
                                        <?php } ?>
                                            
                                            <a href='####' id="inputFileContainer" class="input_file_container">  
                 <input type=file id='file_upload' name='file1' class='input_file' onchange='this.form.submit()' hidefocus="true" />  
                       编辑头像  
                  </a> 
                                        </div>
                                        <div class="f_l mt80 ml15 c666">亲爱的 <span class="blue">
                                        <?php echo $userInfo['nickname'] ?>
                                        </span>，欢迎您来到衡水老白干官方商城</div>
                                    </div>
                                    <div class="demoformbox">
                                        <label class="wb15 f_l c666 mr17"><em class="red">*</em>昵称：</label>
                                        <input type="text" id="username" class="form-control data-kk1" name="nickname" datatype="*2-16" errormsg="请输入2-16位任意字符" nullmsg="请输入2-16位任意字符" value="<?php echo $userInfo['nickname'] ?>" >
                                        <span class="Validform_checktip"></span>
                                    </div>
                                    <div class="demoformbox">
                                        <label class="wb15 f_l c666 mr17"><em class="red">*</em>真实姓名：</label>
                                        <input type="text" id="username2" class="form-control data-kk1" name="real_name" placeholder="" datatype="s2-16" errormsg="请输入2-16位字符串" nullmsg="请输入2-16位字符串" value="<?php echo $userInfo['real_name'] ?>" >
                                        <span class="Validform_checktip"></span>
                                    </div>
                                    <div class="demoformbox">
                                        <label class="wb15 f_l c666 mr17">性别：</label>
                                        <span class="f_l mr17">       
                                        <input type="radio" value="1" name="sex" 
                                        <?php $val = $userExtra['sex']==1?'checked':''; echo $val; ?>> 
                                        男
                                        </span>
                                        <span class="f_l">
                                        <input type="radio" value="2" name="sex"
                                         <?php $val= $userExtra['sex']==2?'checked':''; echo $val; ?>> 
                                         女
                                        </span>
                                    </div>
                                    <div class="demoformbox">
                                        <label class="wb15 f_l c666 mr17">生日：</label>
                                        <input class="laydate-icon data-kk1" name="birthday" onclick="laydate()" style="height: 34px;" 
                                        value="<?php 
                                        $val = $userExtra['birthday']?date('Y-m-d',$userExtra['birthday']):'';echo $val; 
                                        ?>" >
                                        
                                    </div>
                                    <?php if (is_phone($_SESSION['lbg_account']['name'])) {?>
                                    <div class="demoformbox">
                                        <label class="wb15 f_l c666 mr17">手机号码：</label>
                                        <span class="data-kk1 c666">
                                            <?php echo $_SESSION['lbg_account']['name'] ?>
                                        </span>
                                    </div>
                                    <?php }else{ ?>
                                    
                                    <div class="demoformbox">
                                        <label class="wb15 f_l c666 mr17">邮箱：</label>
                                        <span class="data-kk1 c666">
                                            <?php echo $_SESSION['lbg_account']['name'] ?>
                                        </span>
                                    </div>
                                    <?php } ?>
                                    <div class="demoformbox">
                                        <label class="wb15 f_l c666 mr17">联系地址：</label>
                                        <select name="province_id" class="form-control data-kk1 data-kk2 f_l" onchange="choose_city();" id="province"  >
                                            <option value="0">请选择省份</option>
                                        <?php foreach ($province as $key => $vo) { ?>
                                            <option value="<?php echo $vo['area_id'] ?>"
                                            <?php $val = $userExtra['province_id']== $vo['area_id'] ?'selected':''; echo $val;?>
                                            >
                                               <?php echo $vo['title'] ?>
                                            </option>
                                        <?php } ?>   
                                        </select>
                                        <span class="f_l line30 mr10 ml5"> 省</span>
                                        <select name="city_id" class="form-control data-kk1 data-kk2 f_l"  onchange="choose_area();" id="city"  >
                                            <option value="0">请选择城市</option>
                                          <?php foreach ($city as $key => $vo) { ?>
                                            <option value="<?php echo $vo['area_id'] ?>"
                                            <?php $val = $userExtra['city_id']==$vo['area_id'] ?'selected':'';echo $val ?>
                                            >
                                            <?php echo $vo['title'] ?>
                                            </option>   
                                           <?php } ?>
                                            
                                        </select>
                                        <span class="f_l line30 mr10 ml5"> 市</span>
                                        <select name="area_id" class="form-control data-kk1 data-kk2 f_l" id="area"  >
                                            <option value="0">请选择区域</option>
                                          <?php foreach ($area as $key => $vo) { ?>
                                             <option value="<?php echo $vo['area_id'] ?>" 
                                             <?php $val = $userExtra['area_id'] ==$vo['area_id'] ?'selected':'';echo $val ?>
                                             >
                                             <?php echo $vo['title'] ?>
                                             </option>
                                          <?php } ?>
                                            
                                        </select>
                                        <span class="f_l line30 mr10 ml5"> 区</span>
                                        <span class="Validform_checktip"></span>
                                    </div>
                                    <div class="demoformbox">
                                        <label class="wb15 f_l c666 mr17">详细地址：</label>
                                        <textarea altercss="gray" class="data-kk3" name="home_address" ignore="ignore" datatype='*1-10000' errormsg='请输入1-200位字符串' >  <?php echo $userExtra['home_address'] ?>
                                        </textarea>
                                    </div>
                                
                                    <div class="demoformbox">
                                        <label class="wb15 f_l c666 mr17">&nbsp;</label>
                                        <button type="button" id="LFSubmit2" id="btn_sub" class="btn btn-blue mt10 save">
                                        保存
                                        </button>
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
<script type="text/javascript">
        <?php $timestamp = time();?>
        $(function() {
            $('#file_upload').uploadify({
                'formData'       : {
                    'timestamp'  : '<?php echo $timestamp;?>',
                    'token'      : '<?php echo md5('hslbg_unique_salt' . $timestamp);?>',

                },
                'fileSizeLimit'  : '2048KB',
                'width'          : 120,
                'swf'            : _APP+'/Public/Common/uploadify/uploadify.swf',
                'uploader'       : _APP+'/Common/uploadify',
                'buttonText'     : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编辑头像',
                'fileTypeExts'   : '*.jpg;*.jpeg;*.png;*.gif;',
                'auto'           : true,
                'multi'          : true,
                'onUploadSuccess': function(file, data,response){
                    var data = eval('('+data+')');
                    if (data.status) {
                        var url  = _APP+data.url+"?n="+Math.random();
                        $('#img_list').attr('src',url);
                    }else{
                        layer.alert(data.msg);
                    }
                    
                }
            });
        });
</script>
<?php W('Home/foot');?>