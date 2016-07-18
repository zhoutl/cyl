<?php W('Home/head',array('seo_data'=>$seo_data));?>

<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div  class="thewidth">
            <div class="width font-12 c666">
                <a href="<?php echo U('Index/index'); ?>">首页 </a>><a href="<?php echo U('Account/index'); ?>">个人中心 </a>><a href="<?php echo U('Account/myOrders'); ?>">我的订单 </a>>订单明细
            </div>

            <!-- shopcar -->
            <div class="shopbox mt10">
                <div class="shoptop2 font-18">
                    <ul>
                        <li>
                            <div class="password1-line5 password1-line2"></div>
                            <div class="center pasxz3"><p class="password1-de current1">待付款</p></div>
                        </li>
                        <li>
                            <div class="password1-line5 password1-line2"></div>
                            <div class="center pasxz3"><p class="password1-de current1">待发货</p></div>
                        </li>
                        <li>
                            <div class="password1-line5"></div>
                            <div class="center pasxz3"><p class="password1-de">待收货</p></div>
                        </li>
                        <li>
                            <div class="password1-line5"></div>
                            <div class="center pasxz3"><p class="password1-de">交易完成</p></div>
                        </li>
                    </ul>
                </div>
                <!-- 当前订单状态 -->
                <div class="width">
                    <div class="account1">
                        <span class="f_l font-18 c000">当前订单状态</span>
                    </div>
                    <div class="account2">
                       <div class="wb65 f_l ml32">
                           <div class="font-24 red">待发货</div>
                           <div class="c999 mt15">物流追踪（暂无）</div>
                       </div>
                    </div>
                </div>
                <!-- /当前订单状态 -->
                <!-- 订单信息 -->
                <div class="width mt15">
                    <div class="account1">
                        <span class="f_l font-18 c000">订单信息</span>
                    </div>
                    <div class="account2 c666">
                        <div class="wb85 f_l ml32">
                            <p>订单编号：<?php echo $data['list']['order_no']; ?></p>
							<p>下单时间：<?php echo date("Y-m-d H:i:s",$data['list']['add_time']); ?></p>
							<p>支付方式：<?php echo $data['list']['payment_name']; ?></p>
							<p>支付流水号：<?php echo $data['list']['serial_no']; ?></p>
							<p>支付时间：<?php echo date("Y-m-d H:i:s",$data['list']['pay_time']); ?></p>
                            <p>收货信息：<?php echo $data['list']['consignee']; ?>  <?php echo $data['list']['address']; ?>   <?php echo $data['list']['mobile']; ?> </p>
                            <?php if($data['list']['desc']): ?>
								<p>订单备注：<?php echo $data['list']['desc']; ?></p>
							<?php endif; ?>
                        </div>
                        
                    </div>
                </div>
                <!-- /订单信息 -->

                <table class="jftable jftable2 center mt15 f_l order-form js shoptable mb25" cellpadding="0">
                    <thead>
                        <tr>
                            <th class="wb40">商品信息</th>
                            <th class="wb20">单价</th>
                            <th class="wb20">数量</th>
                            <th class="wb20">金额</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach($data['item_list'] as $v): ?>
							<tr>
								<td class="wb40">
									<div class="order-pic img100 ml32">
										<a href="<?php echo U('Product/productDetail',array('item_id'=>$v['item_id'])); ?>" target="_blank">
											<?php if(!empty($v['img_uri'])){ ?>
											   <img src="<?php echo $v['img_uri'] ?>" width="73" height="73" />
											<?php }else{ ?>
												<img src="/Public/upload/watermark.jpg" width="73" height="73" />
											<?php } ?>
										</a>
									</div>
									<div class="order-text2 ml10 mp">
										<p><?php echo $v['item_name']; ?></p>
									</div>
								</td>
								<td class="wb20"><?php echo $v['price']; ?></td>
								<td class="wb20"><?php echo $v['quantity']; ?></td>
								<td class="wb20"><?php echo number_format($v['price']*$v['quantity'],2,'.',''); ?></td>
							</tr>
						<?php endforeach; ?>
                        <tr>
                            <td colspan="4">
                                <span class="f_r red font-20 mr25">￥<?php echo $data['list']['pay_amount']; ?></span>
                                <span class="f_r">实付金额：</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            

        </div>  
    </div>
<!--/wrap-->

<?php W('Home/foot');?>