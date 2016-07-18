<?php W('Home/head',array('seo_data'=>$seo_data));?> 
<script type="text/javascript" src="__PUBLIC__/Home/js/account/editor.js"></script>


<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Account/index')?>">个人中心 </a>><a href="<?php echo U('Account/address') ?>">收货地址 </a>>修改收货地址
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
                            <div class="width order-top"><span class="f_l font-20">收货地址</span></div>
                            <div class="data-box mt30 xgmm2">
                                <div class="width c666 font-16 mb25">修改收货地址</div>
                                <form method="post" class="demoform">
                                    <div class="demoformbox demoformbox4">
                                        <label class="f_l c666 mr10"><em class="red">* </em>收货人姓名：</label>
                                        <input type="text" id="username" class="form-control data-kk4" name="name" value="<?php echo $data['name'] ?>"  placeholder="长度不超过10个字" datatype="*1-10" errormsg="请输入1-10位任意字符" nullmsg="请输入1-10位任意字符">
                                        <span class="Validform_checktip"></span>
                                    </div>
                                    <div class="demoformbox demoformbox4">
                                        <label class="f_l c666 mr10 sjkd"><em class="red">* </em>收货人手机号码：</label>
                                        <input type="text" id="username" class="form-control data-kk4" name="phone" value="<?php echo $data['phone'] ?>" placeholder="请输入11位手机号" datatype="m" errormsg="请输入11位手机号" nullmsg="请输入11位手机号">
                                        <span class="Validform_checktip"></span>
                                    </div>  
                                    <div class="demoformbox adrheight">
                                        <label class="f_l c666 mr10"><em class="red">* </em>收货人地址：</label>
                                        <select name="province_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择省份" errormsg="请选择省份" 
                                        onchange="choose_city();" id="province" >
                                        <option value="0">请选择省份</option>
                                        <?php foreach ($province as $key => $vo) { ?>
                                            <option value="<?php echo $vo['area_id'] ?>" 
                                            <?php $val = $data['province_id']== $vo['area_id'] ?'selected':''; echo $val; ?> >
                                                <?php echo $vo['title'] ?>
                                            </option>
                                        <?php } ?>
                                            
                                        </select>
                                        <span class="f_l line30 mr10 ml5"> 省</span>

                                        <select name="city_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择城市" errormsg="请选择城市" 
                                        onchange="choose_area();" id="city" >
                                        <option value="0">请选择城市</option>
                                        <?php foreach ($city as $key => $vo) { ?>
                                            <option value="<?php echo $vo['area_id'] ?>" 
                                            <?php $val = $data['city_id']== $vo['area_id'] ?'selected':''; echo $val; ?> >
                                               <?php echo $vo['title'] ?>
                                            </option>
                                        <?php } ?>
                                            
                                            
                                        </select>
                                        <span class="f_l line30 mr10 ml5"> 市</span>

                                        <select name="area_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择区域" errormsg="请选择区域" id="area" >
                                        <option value="0">请选择区域</option>
                                        <?php foreach ($area as $key => $vo) { ?>
                                            <option value="<?php echo $vo['area_id'] ?>" 
                                            <?php $val = $data['area_id']== $vo['area_id'] ?'selected':''; echo $val; ?> >
                                               <?php echo $vo['title'] ?>
                                            </option>
                                        <?php } ?>
                                            
                                            
                                        </select>
                                        <span class="f_l line30 mr10 ml5"> 区</span>
                                        <span class="Validform_checktip"></span>
                                    </div>
                                    <div class="demoformbox">
                                        <label class="f_l c666 mr10"><em class="red">* </em>详细地址：</label>
                                        <input type="text" id="address" name="detail_address" class="form-control data-kk4 data-kk5" value="<?php echo $data['detail_address'] ?>" placeholder="请输入不超过1-50个字的详细地址" datatype="*1-50" errormsg="请输入1-50位任意字符" nullmsg="请输入1-50位任意字符">
                                    </div>
                                
                                    <div class="demoformbox demoformbox3">
                                        <button type="button" id="LFSubmit2" id="btn_sub" class="btn btn-blue save f_r mr17">保存</button>
                                        <div class="f_r mt8">
                                        <span class="f_r c666 font-12 mr17 ml5">设为默认</span>
                                        <input type="hidden" name="account_address_id" value="<?php echo $data['account_address_id'] ?>" />
                                        <input type="checkbox" name="is_default" value="1" class="f_r" 
                                        <?php $val = $data['is_default']?'checked':'';echo $val ?> >
                                        </div>

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
    $(function(){
        $(".approve").click(function() {
    clear();
    $(this).addClass("active");
});
function clear() {
    $(".approve").each(function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        }
    });
}
    })
</script>
<?php W('Home/foot');?>