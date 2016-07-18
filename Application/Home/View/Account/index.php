<?php W('Home/head',array('seo_data'=>$seo_data));?>
<!--独有JS-->
<script type="text/javascript" src="__PUBLIC__/Home/js/validform.js"></script>
<!--独有JS-->

<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Account/index') ?>">个人中心 </a>>个人主页
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
                        <div class="width pad20">
                            <div class="headphoto img100">
                            <?php 
                               $file = "Public/upload/avatar/".$data['account']['account_id']."/avatar.jpg";
                               if (file_exists($file)) { ?>
                               <img src="__PUBLIC__/upload/avatar/<?php echo $data['account']['account_id'] ?>/avatar.jpg">
                            <?php } else{ ?>
                               <img src="__PUBLIC__/Home/images/user/user_03.jpg">
                            <?php } ?>
                              
                            </div>
                            <div class="headright">
                                <div class="wb30 f_l mp">
                                <?php if (!empty($data['account']['nickname'])) { ?>
                                    <p class="font-16">
                                      <?php echo $data['account']['nickname'] ?>
                                    </p>
                                <?php }else{ ?>
                                     <?php echo  $_SESSION['lbg_account']['name'] ?>
                                <?php } ?>
                                    <p class="font-12 c666 line26">欢迎您回来！</p>
                                    <div class="mt8"><a href="<?php echo U('Account/userInfo') ?>" class="red font-12">修改个人信息 ></a></div>
                                </div>
                                <div class="wb30 f_l mp">
                                <?php if (is_phone($_SESSION['lbg_account']['name'])) { ?>
                                    <p>
                                    <span class="c999">绑定手机号：</span>
                                    <?php echo  $_SESSION['lbg_account']['name'] ?>
                                    </p>
                                <?php }else{ ?>
                                    <p>
                                    <span class="c999">绑定邮箱号：</span>
                                    <?php echo  $_SESSION['lbg_account']['name'] ?><!-- <em class="state font-12 ml10">绑定</em> -->
                                    </p>
                                <?php } ?>
                                    <!-- <p><span class="c999">账户安全：</span>普通</p> -->
                                </div>
                                <div class="wb30 f_r mp">
                                    <p><span class="c999">VIP等级：</span>酒仙 <span class="blue">VIP权利</span></p>
                                    <p><span class="c999">我的积分：</span><?php echo $data['account']['pay_points'] ?>分</p>
                                </div>
                            </div>
                        </div>
                        <div class="width order-line">
                            <div class="width order-top"><span class="f_l font-18">我的订单</span><span class="f_r"><a href="#" class="c999">查看详情 ></a></span></div>
                            <div class="order-list mt30">
                                <ul>
                                    <li>
                                        <div class="userpic img100 pr">
                                            <a href="#"><img src="__PUBLIC__/Home/images/user/user_03-02.jpg" class="img-circle"></a>
                                            <em class="ordericon1">2</em>
                                        </div>
                                        <div class="wb65 f_r line30 mp">
                                            <p class="font-16"><a href="#">待付款订单：<span class="yellow">2</span></a></p>
                                            <p class="font-12 c999">查看全部待付款订单</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="userpic img100 pr">
                                            <a href="#"><img src="__PUBLIC__/Home/images/user/user_03-03.jpg" class="img-circle"></a>
                                            <em class="ordericon2">3</em>
                                        </div>
                                        <div class="wb65 f_r line30 mp">
                                            <p class="font-16"><a href="#">待发货订单：<span class="green">3</span></a></p>
                                            <p class="font-12 c999">查看全部待发货订单</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="userpic img100 pr">
                                            <a href="#"><img src="__PUBLIC__/Home/images/user/user_03-04.jpg" class="img-circle"></a>
                                            <em class="ordericon3">5</em>
                                        </div>
                                        <div class="wb65 f_r line30 mp">
                                            <p class="font-16"><a href="#">交易成功订单：<span class="blue">5</span></a></p>
                                            <p class="font-12 c999">查看全部待发货订单</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="width order-top"><span class="f_l font-18">我的酒味人生</span></div>
                            <div class="order-list mt30 font-16">
                                <ul>
                                    <li>
                                        <div class="userpic2 img100">
                                            <a href="javascript:;"><img src="__PUBLIC__/Home/images/user/user_16.jpg" class="img-circle"></a>
                                        </div>
                                        <div class="wb65 f_r line30 mp mt8">
                                            <p class="c666"><a href="javascript:;">注册纪念日</a></p>
                                            <p><?php echo date('Y年m月d日',$data['account']['register_time']) ?></p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="userpic2 img100">
                                            <a href="<?php echo U('Account/myScore') ?>"><img src="__PUBLIC__/Home/images/user/user_16-06.jpg" class="img-circle"></a>
                                        </div>
                                        <div class="wb65 f_r line30 mp mt8">
                                            <p class="c666"><a href="<?php echo U('Account/myScore') ?>">我的积分</a></p>
                                            <p><?php echo $data['account']['pay_points'] ?>分</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="userpic2 img100">
                                            <a href="javascript:;"><img src="__PUBLIC__/Home/images/user/user_16-07.jpg" class="img-circle"></a>
                                        </div>
                                        <div class="wb65 f_r line30 mp mt8">
                                            <p class="c666"><a href="javascript:;">最爱的酒</a></p>
                                            <p>小青花</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="userpic2 img100">
                                            <a href="javascript:;"><img src="__PUBLIC__/Home/images/user/user_16-08.jpg" class="img-circle"></a>
                                        </div>
                                        <div class="wb65 f_r line30 mp mt8">
                                            <p class="c666"><a href="javascript:;">VIP等级</a></p>
                                            <p>酒仙</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="userpic2 img100">
                                            <a href="<?php echo U('Account/myCoupon') ?>"><img src="__PUBLIC__/Home/images/user/user_16-09.jpg" class="img-circle"></a>
                                        </div>
                                        <div class="wb65 f_r line30 mp mt8">
                                            <p class="c666">
                                              <a href="<?php echo U('Account/myCoupon') ?>">我的优惠券</a>
                                            </p>
                                            <p><?php echo $data['account']['coupon_count'] ?>张</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="userpic2 img100">
                                            <a href="javascript:;"><img src="__PUBLIC__/Home/images/user/user_16-10.jpg" class="img-circle"></a>
                                        </div>
                                        <div class="wb65 f_r line30 mp mt8">
                                            <p class="c666"><a href="javascript:;">我的订单</a></p>
                                            <p>2单</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>


                        </div>
                    </div>
                    <!-- /right -->
                </div>
            </div>
          
             
    </div>
<!--/wrap-->


<?php W('Home/foot');?>