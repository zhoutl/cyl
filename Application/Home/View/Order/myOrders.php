<?php W('Home/head',array('seo_data'=>$seo_data));?>


<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                   <a href="<?php echo U('Index/index'); ?>">首页 </a>><a href="<?php echo U('Account/index') ?>">个人中心 </a>>我的订单
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
                            <div class="width order-top"><span class="f_l font-20">我的订单</span></div>
                            <div class="integral center mb25 orderbg">
                                <em><img src="__PUBLIC__/Home/images/user/user-order_03.png"></em>
                                <span class="f_l c666 ml15">我的订单：</span>
                                <span class="f_l c666 meicolor font-20"><?php echo $data['count']; ?>单</span>
                            </div>
                            <!-- 订单明细 -->
                            <div class="width">
                                <div class="width c666 font-16">订单明细</div>
                                <div class="width mt20 c666">
									<form method="get" action="<?php echo U('Order/myOrders'); ?>">
                                    <div class="allorder">
                                        <ul>
                                            <li><a href="<?php echo U('Order/myOrders',array('type'=>1)); ?>" <?php if($data['type']=='1'){echo 'class="current6"';} ?>>所有订单</a></li>
                                            <li><a href="<?php echo U('Order/myOrders',array('type'=>2)); ?>" <?php if($data['type']=='2'){echo 'class="current6"';} ?>>待付款</a></li>
                                            <li><a href="<?php echo U('Order/myOrders',array('type'=>3)); ?>" <?php if($data['type']=='3'){echo 'class="current6"';} ?>>待发货</a></li>
											<li><a href="<?php echo U('Order/myOrders',array('type'=>4)); ?>" <?php if($data['type']=='4'){echo 'class="current6"';} ?>>待收货</a></li>
                                        </ul>
                                    </div>
                                    <input class="laydate-icon f_l" onclick="laydate()" name="add_time" value="<?php echo $data['add_time']; ?>" placeholder="请选择下单时间">
                                    <span class="f_l ml5 mt5">或</span>
                                    <input type="text" name="order_num" value="<?php echo $data['order_num']; ?>" placeholder="请输入订单号" class="order-kk f_l ml5">
                                    <button type="submit" class="btn btn-sm ml5 order-btn">查询</button>
									</form>
                                </div>
                                
                                <table class="jftable center mt10 f_l font-12 order-form" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th class="wb20">订单编号</th>
                                            <th class="wb40">
                                                <div class="wb70 f_l">酒品明细</div>
                                                <div class="wb30 f_l">商品总额</div>
                                            </th>
                                            <th class="wb15">下单时间</th>
                                            <th class="wb10">交易状态</th>
                                            <th class="wb15">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	
									<?php foreach($data['list'] as $v): ?>
										<tr>
											<td class="wb20"><?php echo $v['order_no']; ?></td>
											<?php if(count($v['item_list'])>1){ ?>
												<td class="wb40 border-r">
													<div class="width orderlist">
														<ul>
														<?php foreach($v['item_list'] as $v2){ ?>
															<li>
																<div class="wb70 f_l">
																	<div class="order-pic img100">
																		<a href="<?php echo U('Product/productDetail',array('item_id'=>$v2['item_id'])); ?>" target="_blank">
																		<?php if(!empty($v2['img_uri'])){ ?>
																		   <img src="<?php echo $v2['img_uri'] ?>" width="73" height="73" />
																		<?php }else{ ?>
																			<img src="/Public/upload/watermark.jpg" width="73" height="73" />
																		<?php } ?>
																		</a>
																	</div>
																	<div class="order-text ml10"><?php echo $v2['item_name'] ?>*<?php echo $v2['quantity']; ?></div>
																</div>
																<div class="wb30 f_l">
																	¥<?php echo number_format($v2['price']*$v2['quantity'],2,'.',''); ?><br>
																	<?php if($v['status'] == '3'): ?>
																		<?php if($v2['is_comment']){ ?>
																			已评价
																		<?php }else{ ?>
																			<a href="<?php echo U('ItemComment/itemComment',array('orders_id'=>$v['orders_id'],'item_id'=>$v2['item_id'])); ?>">评价商品</a>
																		<?php } ?>
																	<?php endif; ?>
																</div>
															</li>
														<?php } ?>
														</ul>
													</div>
												</td> 
											<?php }else{ ?>
												<td class="wb40">
													<?php foreach($v['item_list'] as $v2){ ?>
														<div class="wb70 f_l">
															<div class="order-pic img100">
																<a href="<?php echo U('Product/productDetail',array('item_id'=>$v2['item_id'])); ?>" target="_blank">
																<?php if(!empty($v2['img_uri'])){ ?>
																   <img src="<?php echo $v2['img_uri'] ?>" width="73" height="73" />
																<?php }else{ ?>
																	<img src="/Public/upload/watermark.jpg" width="73" height="73" />
																<?php } ?>
																</a>
															</div>
															<div class="order-text ml10"><?php echo $v2['item_name'] ?>*<?php echo $v2['quantity']; ?></div>
														</div>
														<div class="wb30 f_l">
															¥<?php echo number_format($v2['price']*$v2['quantity'],2,'.',''); ?><br>
															<?php if($v['status'] == '3'): ?>
																<?php if($v2['is_comment']){ ?>
																	已评价
																<?php }else{ ?>
																	<a href="<?php echo U('ItemComment/itemComment',array('orders_id'=>$v['orders_id'],'item_id'=>$v2['item_id'])); ?>">评价商品</a>
																<?php } ?>
															<?php endif; ?>
														</div>
													<?php } ?>
												</td>
											<?php } ?>
										
											<td class="wb15"><?php echo date("Y-m-d",$v['add_time']); ?></td>
											<td class="wb10">
												<?php if($v['status'] == '3'){ ?>
													<span class="green">交易成功</span>
												<?php }else if($v['status'] == '2'){ ?>
													<span class="yellow3">退货中</span>
												<?php }else if($v['status'] == '0'){ ?>
													<span class="c999">交易关闭</span>
												<?php }else{ ?>
													<?php if($v['pay_status'] == '0'){ ?>
														<span class="yellow3">待付款</span>
													<?php }else{ ?>
														<?php if($v['shipping_status'] == '0'){ ?>
															<span class="yellow3">待发货</span>
														<?php }else{ ?>
															<span class="yellow3">待收货</span>
														<?php } ?>
													<?php } ?>
												<?php } ?>
											</td>
											<td class="wb15">
												<?php if($v['status']=='1' && $v['pay_status']=='0'){ ?>
													<a href="<?php echo U('Pay/index',array('orders_id'=>$v['orders_id'])); ?>" class="order-xq font-12">立即付款</a><br>
												<?php } ?>
												<?php if($v['status']=='0' || $v['status']=='3'){ ?>
													<a href="javascript:;" class="order-xq font-12" onclick="delete_order('<?php echo $v['orders_id']; ?>');">删除订单</a><br>
												<?php } ?>
												<?php if($v['status'] == '1' && $v['shipping_status']=='0'){ ?>
													<a href="javascript:;" class="order-xq font-12" onclick="cancel_order('<?php echo $v['orders_id']; ?>');">取消订单</a><br>
												<?php } ?>
												<?php if($v['status'] =='1' && $v['shipping_status']=='1'){ ?>
													<a href="javascript:;" class="order-xq font-12" onclick="finish_order('<?php echo $v['orders_id']; ?>');">确认收货</a><br>
													<a href="<?php echo U('Refund/applyRefund',array('orders_id'=>$v['orders_id'])); ?>" class="order-xq font-12">申请退货</a><br>
												<?php } ?>
												<a href="<?php echo U('Order/orderDetail',array('orders_id'=>$v['orders_id'])); ?>" class="order-xq font-12">订单详情</a><br>
											</td>
										</tr>
									<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /订单明细 -->
                            
                        </div>
                        
                    </div>
                    <!-- /right -->
                </div>
            </div>
          
             
    </div>
<!--/wrap-->

<script type="text/javascript">
function delete_order(orders_id){
	layer.confirm('确定要删除此订单？', {
		btn: ['确定','取消'] //按钮
		}, function(){
			$.post("<?php echo U('Order/delOrder'); ?>",{orders_id:orders_id},function(data){
				if(data.status == -1){
					window.location.href="<?php echo U('Login/index'); ?>";
				}else{
					if(data.status){
						layer.alert(data.msg,function(){
							window.location.reload();
						});
					}else{
						layer.alert(data.msg);
					}
				}

			},"JSON");
		}, function(){
		  
		}
	);
}

function cancel_order(orders_id){
	layer.confirm('确定要取消此订单？', {
		btn: ['确定','取消'] //按钮
		}, function(){
			$.post("<?php echo U('Order/cancelOrder'); ?>",{orders_id:orders_id},function(data){
				if(data.status == -1){
					window.location.href="<?php echo U('Login/index'); ?>";
				}else{
					if(data.status){
						layer.alert(data.msg,function(){
							window.location.reload();
						});
					}else{
						layer.alert(data.msg);
					}
				}

			},"JSON");
		}, function(){
		  
		}
	);
}

function finish_order(orders_id){
	layer.confirm('确定要完成此订单？', {
		btn: ['确定','取消'] //按钮
		}, function(){
			$.post("<?php echo U('Order/finishOrder'); ?>",{orders_id:orders_id},function(data){
				if(data.status == -1){
					window.location.href="<?php echo U('Login/index'); ?>";
				}else{
					if(data.status){
						layer.alert(data.msg,function(){
							window.location.reload();
						});
					}else{
						layer.alert(data.msg);
					}
				}

			},"JSON");
		}, function(){
		  
		}
	);
}

</script>

<?php W('Home/foot');?>