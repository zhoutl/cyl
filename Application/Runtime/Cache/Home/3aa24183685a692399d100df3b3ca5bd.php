<?php if (!defined('THINK_PATH')) exit();?><!--------------------------------------[ footer ]-------------------------------------->
    <div class="footer_bg thewidth100">
        <div class="thewidth clearfix">
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
                    <span class="f_l"><img src="/cyl/Public/Home/images/login/login_09.jpg"><br>衡水老白干移动端</span>
                    <span class="f_r"><img src="/cyl/Public/Home/images/login/login_09-04.jpg" ><br>衡水老白干微信端</span>
                </div>
                <div class="width mt20 font-12">
                    <div class="center songti gray4">
                        <a href="#" target="_blank">关于我们</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" target="_blank">公司资质</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="#" target="_blank">诚聘英才</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" target="_blank">联系我们</a>&nbsp;&nbsp;
                        <p></p>
                    </div>
                    <div class="center songti mt10 c000">Copyright © 2016  河北衡水老白干酿酒(集团)有限公司版权所有   冀ICP备06000141号</div>
                    <div class="center mt10"><img src="/cyl/Public/Home/images/login/login_16.jpg">&nbsp;&nbsp;<img src="/cyl/Public/Home/images/login/login_18.jpg"></div>
                </div>
            </div>
            
        
        
        </div>
    </div>
<!--/footer-->

</div>

<!-- 元素钉在某段文本旁边jquery.pin -->
<script type="text/javascript" src="/cyl/Public/Home/js/backtop.js"></script>
<script type="text/javascript">
$(function(){
    // 下拉
    $(".allSortOuterbox").mouseover(function(){
        $("#left_child_menu").css('display','block');
    })
    $(".allSortOuterbox").mouseout(function(){
        $("#left_child_menu").css('display','none');
    })
    //enter提交表单
   
    $("#submit_btn").click(function(){
        if($("input[name='keyword']").val()){
            $("#item_search").submit();
        }else{
            layer.alert('搜索内容不能为空！');
        }
    });
    
});
</script>


</body>