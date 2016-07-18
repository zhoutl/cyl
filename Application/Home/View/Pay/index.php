<?php W('Home/head',array('seo_data'=>$seo_data));?>

<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div  class="thewidth">
            <div class="width payheight">
                <div class="f_l font-20 mt15"><b>确认支付</b></div>
                <div class="shoptop">
                    <ul>
                        <li>
                            <div class="password1-line password1-line2"></div>
                            <div class="center pasxz1"><p class="password1-first current1">1</p><p class="blue">购物车</p></div>
                        </li>
                        <li>
                            <div class="password1-line password1-line2"></div>
                            <div class="center pasxz"><p class="password1-first current1">2</p><p class="blue">订单信息</p></div>
                        </li>
                        <li>
                            <div class="password1-line password1-line2"></div>
                            <div class="center pasxz"><p class="password1-first current1">3</p><p class="blue">确认支付</p></div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- shopcar -->
            <div class="paybox mt40">
                <div class="width pad34 border-b">
                    <div class="wb65 f_l">
                        <p>订单提交成功，请您尽快付款！ 订单号：<?php echo $data['list']['order_no']; ?></p>
                        <p class="red">请您在提交订单后24小时内完成支付，否则订单会自动取消</p>
                    </div>
                    <div class="f_r">应付金额：<span class="red font-20">¥<?php echo $data['list']['pay_amount']; ?></span></div>
                </div>
                <div class="width pad34 pay1 mb40">
                    <p>选择支付方式</p>
                    <ul>
                        <li>
                            <span  class="f_l mt20"><input type="radio" name="money" value=""></span>
                            <div class="pay2">
                                <img src="__PUBLIC__/Home/images/user/shopcar-pay_03.jpg" class="f_l mr10">
                                <span class="f_l font-18">支付宝支付</span>
                            </div>
                        </li>
                        <li>
                            <span  class="f_l mt20"><input type="radio" name="money" value=""></span>
                            <div class="pay2">
                                <img src="__PUBLIC__/Home/images/user/shopcar-pay_05.jpg" class="f_l mr10">
                                <span class="f_l font-18">支付宝支付</span>
                            </div>
                        </li>
                        <li>
                            <span  class="f_l mt20"><input type="radio" name="money" value=""></span>
                            <div class="pay2">
                                <img src="__PUBLIC__/Home/images/user/shopcar-pay_08.jpg" class="f_l mr10">
                                <span class="f_l font-18">支付宝支付</span>
                            </div>
                        </li> 
                    </ul>
                    <button type="button" class="btn ljzf f_l mt40">立即支付</button>
                </div>

            </div>
            

        </div>  
    </div>
<!--/wrap-->


<?php W('Home/foot');?>