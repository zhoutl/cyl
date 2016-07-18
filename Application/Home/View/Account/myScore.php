<?php W('Home/head',array('seo_data'=>$seo_data));?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/page.css">
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Account/index') ?>">个人中心 </a>>我的积分
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
                            <div class="width order-top"><span class="f_l font-20">我的积分</span></div>
                            <div class="integral center mb25">
                                <em><img src="__PUBLIC__/Home/images/user/user-wdjf_03.png"></em>
                                <span class="f_l c666 ml15">我的积分：</span>
                                <span class="f_l c666 green font-20"><?php $val = empty($data['pay_points'])?0:$data['pay_points'];echo $val;  ?>分</span>
                            </div>
                            <!-- 积分记录 -->
                            <div class="width">
                                <div class="width c666 font-16">积分记录</div>
                                <table class="jftable center mt20 f_l" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>操作说明</th>
                                            <th>积分明细</th>
                                            <th>操作后积分余额</th>
                                            <th>时间</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data['score'] as $key => $vo) { ?>
                                        <tr>
                                            <td><?php echo $vo['instructions'] ?></td>
                                            <td class="
                                            <?php $val = $vo['points_add_value']>0? 'red':'green';echo $val; ?>">
                                            <?php 
                                            $val = $vo['points_add_value']>0? '+'.$vo['points_add_value']:$vo['points_add_value'];echo $val; 
                                            ?>
                                            </td>
                                            <td><?php echo $vo['points_after_value']?></td>
                                            <td><?php echo date('Y-m-d',$vo['pubdate'])?></td>
                                        </tr>
                                   <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /积分记录 -->
                            <div class="list_box_bottom">
                               <div class="page">
                                 <?php echo $data['pages']->show();?>
                               </div>
                            </div> 
                            <!-- 积分规则 -->
                            <div class="width mt20">
                                <div class="width c666 font-16">积分规则说明</div>
                                <div class="width pdl20 mt20 c666 line22">
                                    <p>积分是用户在衡水老白干官方商城（www.lbg.com）购物情况给予的优惠，积分仅可在衡水老白干使用，如用户帐号暂停使用，则衡水老白干商城将取消该用户帐号内积分相关使用权益。 积分可直接用于支付官方商城订单，积分和现金抵扣的比例为100：1，积分支付不得超过每笔订单结算金额的20%。</p>
                                    <p>注：积分规则由衡水老白干制定并依据国家相关法律法规及规章制度予以解释和修改，规则以网站公布为准。</p>
                                    <p>如何获得积分？<br>购物：积分在订单已完成且未办理退货手续时，由衡水老白干按订单金额为用户发放积分。</p>
                                    <p>注：订单金额是指用户实际以现金/银行卡/支付宝/微信支付的金额。（以公司转账和邮局汇款方式支付不返积分）</p>
                                    <p>积分会在您发货后10个工作日内到达您的衡水老白干帐号内。</p>
                                    <p>每完成一次购物额外奖厉3个积分。</p>
                                    <p>即：我的积分=结算金额+3（一次购酒行为）</p>
                                </div>
                            </div>
                            <!-- 积分规则 -->
                        </div>
                        
                    </div>
                    <!-- /right -->
                </div>
            </div>
          
             
    </div>
<!--/wrap-->


<?php W('Home/foot');?>