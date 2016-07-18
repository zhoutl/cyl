<?php W('Home/head',array('seo_data'=>$seo_data));?>


<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div  class="thewidth">
            <div class="width font-12 c666">
                <a href="<?php echo U('Index/index');?>">首页 </a>><a href="<?php echo U('Account/index');?>">个人中心 </a>><a href="<?php echo U('Refund/index');?>">我的退货 </a>>退货详情
            </div>

            <!-- shopcar -->
            <div class="shopbox mt10">
                <div class="shoptop2 font-18">
                    <ul>
                        <li>
                            <div class="password1-line password1-line3"></div>
                            <div class="center pasxz2"><p class="password1-se current7">1</p><p class="green">申请退货</p></div>
                        </li>
                        <li>
                            <div class="password1-line password1-line3"></div>
                            <div class="center pasxz2"><p class="password1-se current7">2</p><p class="green">退货审核</p></div>
                        </li>
                        <li>
                            <div class="password1-line"></div>
                            <div class="center pasxz2"><p class="password1-se">3</p><p class="c999">填写物流信息</p></div>
                        </li>
                        <li>
                            <div class="password1-line"></div>
                            <div class="center pasxz2"><p class="password1-se">4</p><p class="c999">退货完成</p></div>
                        </li>
                    </ul>
                </div>
                <!-- 申请退货 -->
                <div class="width mt30">
                    <div class="account1">
                    <?php if($data['OrdersRefund']['status']==1){ ?>
						<span class="f_l font-18 c000">退货审核中----</span>
                    <?php }else if($data['OrdersRefund']['status']==-1){ ?>
 						<span class="f_l font-18 red">审核未通过</span>
                    <?php } ?>
                    </div>
                    <div class="account22">
                        <form method="post" class="demoform mt20">
                            <div class="demoformbox mb25">
                                <label class="wb15 f_l c666 mr17 tx-r font500">退货商品：</label>
                                <div class="wb70 f_l">
                                <?php foreach($data['OrdersRefundItem'] as $key=>$val):?>
                                     <div class="width mb10">
                                        <div class="order-pic img100 ml25">
                                        	<?php if(!empty($val['img_uri'])){ ?>
				                               <img src="__ROOT__{$val.img_uri}">
				                            <?php }else{ ?>
				                                <img src="__ROOT__/Public/upload/watermark.jpg">
				                            <?php } ?>
                                        </div>
                                        <div class="order-text2 ml10 blue"><?php echo $val['item_name'];?><br><span class="c666 line26">退货数量：<?php echo $val['quantity'];?>瓶</span></div>
                                    </div>
                                <?php endforeach;?>
                                    
                                   
                                    
                                </div>
                                
                            </div>
                            
                            <div class="demoformbox mb25">
                                <label class="wb15 f_l c666 mr17 tx-r font500">退货原因：</label>
                                <div class="wb65 f_l"><?php echo $data['OrdersRefund']['reason'];?></div>
                            </div>
                            
                            <div class="demoformbox mb25">
                                <label class="wb15 f_l c666 mr17 tx-r font500">退货金额：</label>
                                <div class="wb65 f_l"><?php echo $data['OrdersRefund']['refund_amount'];?>元</div>
                            </div>
                            <div class="demoformbox mb25">
                                <label class="wb15 f_l c666 mr17 tx-r font500">详细原因：</label>
                                <div class="wb65 f_l"><?php echo $data['OrdersRefund']['refund_reason_message'];?></div>
                            </div>
                            <div class="demoformbox mb25">
                                <label class="wb15 f_l c666 mr17 tx-r font500">上传凭证：</label>
                                <div class="wb65 f_l">
                                    <div class="photo img100">
                                        <ul>
                                        <?php foreach($data['OrdersRefundImage'] as $key=>$val):?>
                                        	<li><a ><img src="__ROOT__<?php echo $val['img_uri'];?>"></a></li>
                                        <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="demoformbox mb25">
                                <?php if($data['OrdersRefund']['status']==-1){ ?>
 								  <div class="ml-85">
                                    <p class="red font-20">您的退货申请不符合我们的退货条件，您可以完善更多信息已通过审核</p>
                                    <a href="<?php echo U('Refund/applyRefund',array('orders_id'=>$data['OrdersRefund']['orders_id']));?>" class="blue underline font-18">重新申请</a>
                                  </div>
                               <?php } ?>
                               
                            </div>
                            <div class="width border-t mt20 mb25"></div>
                            <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500">退款说明：</label>
                                <div class="wb65 f_l c333">
                                    <p>1、退货概不退还优惠券，现金券以及其他优惠产品</p>
                                    <p>2、请与退款客服人员协商之后，再填写退款金额</p>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
                <!-- /申请退货 -->

            </div>
            

        </div>  
    </div>
<!--/wrap-->



<?php W('Home/foot');?>