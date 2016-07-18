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
                            <div class="password1-line password1-line3"></div>
                            <div class="center pasxz2"><p class="password1-se current7">3</p><p class="green">填写物流信息</p></div>
                        </li>
                        <li>
                            <div class="password1-line password1-line3"></div>
                            <div class="center pasxz2"><p class="password1-se current7">4</p><p class="green">退货完成</p></div>
                        </li>
                    </ul>
                </div>
                <!-- 申请退货 -->
                <div class="width mt30">
                    <div class="account1">
                        <span class="f_l font-18 red">退货完成</span>
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

                            <div class="width border-t mt20 mb25"></div>
                            <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500">快递公司：</label>
                                <div class="wb65 f_l"><?php echo $data['OrdersRefund']['express_name'];?></div>
                            </div>
                            <div class="demoformbox mb25">
                                <label class="wb15 f_l c666 mr17 tx-r font500">快递单号：</label>
                                <div class="wb65 f_l"><?php echo $data['OrdersRefund']['express_no'];?></div>
                            </div>

                            <div class="demoformbox mb25">
                                <div class="ml-85">
                                    <p class="blue font-20">当前金额已经按原路退回，将在1-3个工作日内到账，请注意查收。</p>
                                </div>
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