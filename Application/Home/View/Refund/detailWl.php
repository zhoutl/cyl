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
                            <div class="password1-line"></div>
                            <div class="center pasxz2"><p class="password1-se">4</p><p class="c999">退货完成</p></div>
                        </li>
                    </ul>
                </div>
                <!-- 申请退货 -->
                <div class="width mt30">
                    <div class="account1">
 						<span class="f_l font-18 red">填写物流信息</span>
                    </div>
                    <div class="account22">
                        <form method="post"  action="" class="demoform mt20 expressfrom">
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
                      <?php if($data['OrdersRefund']['status']==2){ ?>
                            <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500">快递公司：</label>
                                <input type="text" name="express_name" value=""  placeholder="快递公司（如：顺丰快递）" datatype="*3-16" errormsg="请输入4-16位正确快递名称" nullmsg="请输入4-16位正确快递名称" class="form-control data-kk1 f_l"> 
                            </div>
                            <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500">快递单号：</label>
                                <input type="text" name="express_no" value=""  placeholder="请填写快递单号" datatype="*5-16" errormsg="请输入5-16位正确快递单号" nullmsg="请输入5-16位正确快递单号" class="form-control data-kk1 f_l">        
                            </div>
                            <input type="hidden" name="orders_refund_id" value="<?php echo $data['OrdersRefund']['orders_refund_id'] ;?>"  />
                            <div class="demoformbox">
                                <label class="wb15 f_l mr17 c666">&nbsp;</label>
                                <button type="button" id="submit" id="btn_sub" class="btn btn-blue mt10 save">提交</button>
                            </div>

                      <?php }else if($data['OrdersRefund']['status']==3){  ?>
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
                                    <p class="green font-20">退货中...我们将在收到您的退货后第一时间给您退款</p>
                                </div>
                            </div>

                       <?php }?>     
                    
                            

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

<script type="text/javascript">
var orders_refund_id='<?php echo $data['OrdersRefund']['orders_refund_id'] ;?>';
    $(document).ready(function(){
        $(".expressfrom").Validform({
            btnSubmit:"#submit", 
            tiptype:3,
            showAllError:true,
            beforeSubmit:function(curform){
                $.ajax({
                    cache: true,
                    type: "POST",
                    url:_URL+"/addExpress",
                    data:$(".expressfrom").serialize(),
                    async: false,
                    error: function(request) {
                        layer.alert('连接超时，请检查您的网络');
                    },
                    success: function(data) {
                        if(data.status){
                            window.location.href =_URL+"/refundDetail?orders_refund_id="+orders_refund_id;
                        }else{
                            layer.alert(data);
                        }
                    }
                }); 
                return false;
            },
            callback:function(data){
            }
        });
        
    });

</script>

<?php W('Home/foot');?>