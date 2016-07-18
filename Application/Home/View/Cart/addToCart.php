<?php W('Home/head',array('seo_data'=>$seo_data));?>
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div  class="thewidth">
            <div class="width font-12 c666">
                <a href="<?php echo U('Index/index'); ?>">首页 </a>>加入购物车
            </div>

            <!-- shopcar -->
            <div class="paybox mt20">
                <div class="paycg">
                    <div class="f_l"><img src="__PUBLIC__/Home/images/user/pay-success_03.jpg"></div>
                    <div class="f_l ml25">
                        <p class="font-30 c666">加入购物车成功</p>
                        <p class="c666">购物车共有<span class="red"><?php echo $data['cart_list']['count_info']['all_num']; ?>件</span>商品 <span class="red">小计：￥<?php echo $data['cart_list']['count_info']['all_online_price']; ?></span> </p>
                    </div>
                </div>
                <div class="paycg2 font-16">
                    <a href="javascript:window.history.back(-1);" class="f_l paybtn2 paybtn3 mr17">返回商品详情</a>
                    <a href="<?php echo U('Cart/myCart'); ?>" class="f_l paybtn">去购物车结算</a>
                </div>

            </div>
            

        </div>  
    </div>
<!--/wrap-->

<?php W('Home/foot');?>