<?php W('Home/head',array('seo_data'=>$seo_data));?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/page.css">
<!-- 独有JS -->
<!-- 独有JS -->
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Account/index') ?>">个人中心 </a>>我的优惠券
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
                            <div class="width order-top"><span class="f_l font-20">我的优惠券</span></div>
                            <div class="integral center mb25 yhq">
                                <em><img src="__PUBLIC__/Home/images/user/user-yhj_03.png"></em>
                                <span class="f_l c666 ml15">我的优惠券：</span>
                                <span class="f_l c666 yellow font-20">
                                <?php $val = empty($count)? 0 : $count; echo $val; ?>张
                                </span>
                            </div>
                            <!-- 积分记录 -->
                            <div class="width">
                                <div class="width c666 font-16">优惠券明细</div>
                                <table class="jftable center mt20 f_l" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>优惠券</th>
                                            <th>使用条件 </th>
                                            <th>有效期</th>
                                            <th>状态</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data as $key => $vo) { ?>
                                        <tr>
                                            <td class="wb30">
                                                <div class="yhjpic pr mp">
                                                    <em>
                                           <?php if ( $vo['start_time']<$time && $time< $vo['end_time']) { ?>
                                                     <img src="__PUBLIC__/Home/images/user/user-yhj_10.png">
                                                    <?php } else { ?>
                                                      <img src="__PUBLIC__/Home/images/user/user-yhj_13.png">
                                                     <?php } ?> 
                                                    </em>
                                                    <p class="font-35 line30">
                                                      ¥<?php echo intval($vo['coupon_amount']) ?>
                                                    </p>
                                                    <p class="font-12">
                                                       满<?php echo intval($vo['limit_amount']) ?>元可用
                                                    </p>
                                                    <p class="yhj-color font-12">
                                                    <?php echo date('Y-m-d',$vo['start_time'])?>
                                                    --
                                                    <?php echo date('Y-m-d',$vo['end_time'])?>
                                                    </p>
                                                </div>
                                            </td>
                                            <td>满<?php echo intval($vo['limit_amount']) ?>元可用</td>
                                            <td>
                                            <?php echo date('Y-m-d',$vo['start_time'])?>
                                            --
                                            <?php echo date('Y-m-d',$vo['end_time'])?>
                                            </td>
                                        <?php if (empty($vo['is_use'])) { ?>
                                            <td class="green">未使用</td>
                                        <?php } else{ ?>
                                            <td class="red">已使用</td>
                                        <?php } ?>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                                <?php if (empty($data)) { ?>
                                <div class="width center font-18 mt30 c666">你还没有领取优惠券~~~~</div>
                                <?php } ?>
                            </div>
                            <!-- /积分记录 -->
                             <div class="list_box_bottom">
                                <div class="page">
                                    <?php echo $pages->show();?>
                                </div>
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