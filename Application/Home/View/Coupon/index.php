<?php W('Home/head',array('seo_data'=>$seo_data));?>
<script type="text/javascript" src="__PUBLIC__/Home/js/account/coupon.js" ></script>
<script type="text/javascript" src="__PUBLIC__/Common/js/layer/layer.js" ></script>
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
            <div class="thewidth clearfix">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>>优惠券领取
                </div>
                <div class="width bg_fff mt15 yhq_box">
                    <div class="yhq-pic">
                        <div class="width">
                            <div class="width center font-35 white">￥<span class="font-60"><?php echo intval($data['coupon_amount']) ?></span></div>
                            <div class="width font-18 white center">
                                满<?php echo intval($data['limit_amount']) ?>元可用
                            </div>
                        </div>
                        <a href="javascript:;" class="ljlq mt5" onclick="getCoupon(<?php echo $data['coupon_id'] ?>)" >立即领取</a>
                    </div>
                    <div class="yhq-text c666">
                        <p class="font-16"><b>优惠券规则</b></p>
                        <p>1.领取优惠券后，优惠券会绑定到个人账户，在个人中心 → 我的优惠券中可以进行查看；</p>
                        <p>2.每张券只可以领取<?php echo $data['coupon_limit'] ?>次，结算时，优惠券不可叠加使用；</p>
                        <p>
                           3.适用于
                           <?php $pc  = empty($data['is_pc'])?'':'PC端、' ;echo $pc; ?>
                             <?php $wap = empty($data['is_wap'])?'':'WAP端、';echo $wap; ?>
                             <?php $app = empty($data['is_app'])?'':'APP端';echo $app; ?>
                           ；
                           </p>
                        <p>4.优惠券过期作废；</p>
                        <p>本活动最终解释权归衡水老白干官方商城所有。</p>
                    </div>
                </div>
            </div>
                
          
             
    </div>
<!--/wrap-->

<script type="text/javascript">
$(function(){
     // 下拉
    $(".allSortOuterbox").mouseover(function(){
        $("#left_child_menu").css('display','block');
    })
    $(".allSortOuterbox").mouseout(function(){
        $("#left_child_menu").css('display','none');
    })
})
</script>

<?php W('Home/foot');?>