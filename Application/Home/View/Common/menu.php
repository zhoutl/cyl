                    <!-- left -->
                    <div class="leftsidebar">
                        <ul>
                            <li>
                                <div class="sidetop font-18 c000 
                                <?php if (in_array(CONTROLLER_NAME,array('Order','Refund'))) {
                                    echo current2;
                                } ?> ">
                                    <em class="side-icon1 mr17 
                                    <?php if (in_array(CONTROLLER_NAME,array('Order','Refund'))) {
                                    echo 'side-icon1 side-icon11';
                                } ?> ">
                                    </em>订单中心
                                </div>
                                <div class="width side-title mp">
                                    <p><a href="<?php echo U('Order/myOrders') ?>" 
                                    class="<?php $var = CONTROLLER_NAME.'/'.ACTION_NAME =='Order/myOrders'?'current3':'';echo $var ?>" >我的订单</a></p>
                                    <p><a href="<?php echo U('Refund/index') ?>" 
                                    class="<?php $var = CONTROLLER_NAME.'/'.ACTION_NAME =='Refund/index'?'current3':'';echo $var ?>">我的退货</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="sidetop font-18 c000 
                                <?php $val = CONTROLLER_NAME =='Account'?'current2':'';echo $val ?> ">
                                    <em class="
                                    <?php $val = CONTROLLER_NAME =='Account'?'side-icon2':'side-icon2 side-icon22';echo $val; ?>
                                    mr17">
                                    </em>个人中心
                                </div>
                                <div class="width side-title mp">
                                    <p>
                                    <a href="<?php echo U('Account/index')?>" class="
                                    <?php $var = CONTROLLER_NAME.'/'.ACTION_NAME == 'Account/index'?'current3':'';echo $var ?>">个人主页</a></p>
                                    <p>
                                    <a href="<?php echo U('Account/userInfo')?>" class="<?php $var = ACTION_NAME == 'userInfo'?'current3':'';echo $var ?>" >个人资料</a></p>
                                    <p><a href="<?php echo U('Account/address') ?>" 
                                    class="
                                    <?php if (in_array(ACTION_NAME, array('address','editor'))) {
                                        echo 'current3';
                                    } ?>" >收货地址</a></p>
                                    <p><a href="<?php echo U('Account/myScore') ?>" class="<?php $var = ACTION_NAME == 'myScore'?'current3':'';echo $var ?>" >我的积分</a></p>
                                    <p><a href="<?php echo U('Account/favorite') ?>" class="<?php $var = ACTION_NAME == 'favorite'?'current3':'';echo $var ?>" >我的收藏</a></p>
                                    <p><a href="<?php echo U('Account/myCoupon') ?>"  class="<?php $var = ACTION_NAME == 'myCoupon'?'current3':'';echo $var ?>" >我的优惠券</a></p>
                                    <!-- <p><a href="<?php echo U('Account/message') ?>" class="<?php $var = ACTION_NAME == 'message'?'current3':'';echo $var ?>" >消息提醒</a></p> -->
                                    <p><a href="<?php echo U('Account/password') ?>" class="<?php $var = ACTION_NAME == 'password'?'current3':'';echo $var ?>" >修改密码</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="sidetop font-18 c000 
                                <?php $val = CONTROLLER_NAME =='ItemComment'?'current2':'';echo $val ?> ">
                                    <em class="<?php $val = CONTROLLER_NAME =='ItemComment'?'side-icon3 side-icon33':'side-icon3';echo $val; ?> mr17"></em>评价管理
                                </div>
                                <div class="width side-title mp">
                                    <p><a href="<?php echo U('ItemComment/index') ?>" class="<?php $var = CONTROLLER_NAME.'/'.ACTION_NAME == 'ItemComment/index'?'current3':'';echo $var ?>" >我的评价</a></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /left -->