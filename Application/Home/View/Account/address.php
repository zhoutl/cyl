<?php W('Home/head',array('seo_data'=>$seo_data));?> 
<!-- 独有JS --> 
<script type="text/javascript"src="__PUBLIC__/Home/js/account/address.js" ></script> 

<!-- 独有JS -->

<!--wrap-->
    <div class="thewidth100 bg_gray clearfix">
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Account/index') ?>">个人中心 </a>>收货地址
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
                                <div class="width c666 font-16 mb25">新增收货地址</div>
                                <form method="post" class="demoform">
                                    <div class="demoformbox demoformbox4">
                                        <label class="f_l c666 mr10"><em class="red">* </em>收货人姓名：</label>
                                        <input type="text" id="username" class="form-control data-kk4" name="name" placeholder="请输入收货人姓名" datatype="*2-12" errormsg="收货人姓名为2-12个字" nullmsg="请输入收货人姓名">
                                        <span class="Validform_checktip"></span>
                                    </div>
                                    <div class="demoformbox demoformbox4">
                                        <label class="f_l c666 mr10 sjkd"><em class="red">* </em>收货人手机号码：</label>
                                        <input type="text" id="username" class="form-control data-kk4" name="phone" placeholder="请输入手机号" datatype="m" errormsg="请输入正确格式的手机号" nullmsg="请输入手机号">
                                        <span class="Validform_checktip"></span>
                                    </div>  
                                    <div class="demoformbox adrheight">
                                        <label class="f_l c666 mr10"><em class="red">* </em>收货人地址：</label>
                                        <select name="province_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择省份" errormsg="请选择省份" onchange="choose_city();" id="province" >
                                            <option value="">请选择省份</option>
                                         <?php foreach ($province as $key => $vo) { ?>
                                             <option value="<?php echo $vo['area_id'] ?>">
                                               <?php echo $vo['title'] ?>
                                             </option>
                                          <?php } ?>
                                            
                                        </select>
                                        <span class="f_l line30 mr10 ml5"> 省</span>

                                        <select name="city_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择城市" errormsg="请选择城市" 
                                        onchange="choose_area();" id="city" >
                                            <option value="">请选择城市</option>
                                            
                                        </select>
                                        <span class="f_l line30 mr10 ml5"> 市</span>

                                        <select name="area_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择区域" errormsg="请选择区域" 
                                        id="area" >
                                            <option value="">请选择区域</option>
                                            
                                        </select>
                                        <span class="f_l line30 mr10 ml5"> 区</span>
                                        <span class="Validform_checktip" style="" ></span>
                                    </div>
                                    <div class="demoformbox">
                                        <label class="f_l c666 mr10"><em class="red">* </em>详细地址：</label>
                                        <input type="text" id="address" name="detail_address" class="form-control data-kk4 data-kk5" placeholder="请输入详细地址" datatype="*1-50" errormsg="详细地址为1-50个字" nullmsg="请输入详细地址">
                                    </div>
                                
                                    <div class="demoformbox demoformbox3">
                                        <button type="button" id="LFSubmit2" id="btn_sub" class="btn btn-blue save f_r mr17">保存</button>
                                        <div class="f_r mt8">
                                        <span class="f_r c666 font-12 mr17 ml5">设为默认</span>
                                        <input type="checkbox" name="is_default" value="1" class="f_r">
                                        </div>

                                    </div>
                    
                                </form>
                            </div>
                        
                        <!-- 已有地址 -->
                        <div class="width">
                            <div class="width c666 font-16">已有地址</div>
                            <table class="jftable center mt20 f_l" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>收货人姓名</th>
                                            <th>收货人地址</th>
                                            <th>收货人手机号</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data as $key => $vo) { ?>
                                        <tr class="c333" name="data_<?php echo $vo['account_address_id']; ?>" >
                                            <td>
                                            <?php echo $vo['name'] ?>
                                            </td>
                                            <td class="wb40">
                                                <?php echo $vo['address'] ?>
                                            </td>
                                            <td><?php echo $vo['phone'] ?></td>
                                            <td class="wb25">
                                            <a href="
                                            <?php echo U('Account/editor',array('account_address_id'=>$vo['account_address_id'])) ?>">修改
                                            </a>&nbsp;&nbsp;
                                            <a href="javascript:;" class="c999" onclick="choose_delete(<?php echo $vo['account_address_id'] ?>)" >删除</a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            
                                            <a href="javascript:;" class="approve 
                                            <?php $val = empty($vo['is_default'])?'':'active'; echo $val ?>" onclick="choose_default(<?php echo $vo['account_address_id'] ?>)" >设为默认
                                            </a>
                                            
                                            </td>
                                        </tr>
                                    <?php } ?>
                                        
                                    </tbody>
                                </table>
                                <?php if (empty($data)) { ?>
                                <div class="width center font-18 mt30 c666">你还没有收货地址~~~~</div>
                                <?php } ?>
                        </div>
                        <!-- /已有地址 -->

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