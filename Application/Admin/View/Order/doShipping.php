<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>
<style>
	.add_from_table td{padding:5px 8px;}
	.add_from_table td.aft_l{padding-top:5px;}
	.add_from_table td.aft_c{padding:10px 10px;}
</style>
    <!--main-->
    <div id="main" class="clearfix">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="main_table_left" align="left" valign="top">

    	<?php W('Admin/menu',array(array('admin_user_id'=>$admin_user_id)));?>
        
        </td>
        <td class="main_table_right" align="left" valign="top">


        <!--right-->
			<div id="Right">
				<!--page_right_header-->
				<div class="page_right_header">
					<div class="f_l">
						<h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">订单详情</span></h4>
					</div>
					<div class="f_r">
						<a class="btn btn-success" href="<?php echo U('Order/orderList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
					</div>
				</div>
				<div class="page_right_bodyer">
					<div class="list_box">
						<div class="ja_add_from mb20">
							<div class="add_from_head">
								订单详情
								(<?php if($data['list']['status']=='0'){ ?>
									<?php if($data['list']['pay_status'] == '0'){ ?>
									未付款 交易关闭
									<?php }else{ ?>
									已付款 交易关闭
									<?php } ?>
								<?php }else if($data['list']['status'] == '3'){ ?>
									交易完成
								<?php }else if($data['list']['status'] == '2'){ ?>
									商品退货中
								<?php }else{ ?>
									<?php if($data['list']['pay_status'] == '0'){ ?>
										待付款
									<?php }else{ ?>
										<?php if($data['list']['shipping_status'] == '0'){ ?>
											待发货
										<?php }else{ ?>
											待收货
										<?php } ?>
									<?php } ?>
								<?php } ?>)
							</div>
							
							<div class="add_from_body">
								<form method="post" action="<?php echo U('Order/doShipping',array('id'=>$data['list']['orders_id'])); ?>"> 
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
										<tr>
											<td align="center" colspan="2" valign="" class="aft_c"><span style="color: red;">商品信息：</span></td>

										</tr>


										<tr>
											<td align="left" valign="top"  colspan="2" class="aft_l">
												<table width="100%">
													<?php foreach($data['item_list'] as $val){?>
													<tr>
														<td align="left" valign="top" class="" style="width:90px;">商品名称：</td>
														<td align="left" valign="left" class="" style="width:200px;">
															<p><span style=""><?php echo $val['item_name'];?></span></p>
														</td>
														
														<td align="left" valign="top" class="" style="width:90px;">商品单价：</td>
														
														<td align="left" valign="middle" class="" style="width:80px;">
															<p><span style=""><?php echo $val['price'];?></span></p>
														</td>
														
														<td align="left" valign="top" class="" style="width:90px;">购买数量：</td>
														
														<td align="left" valign="middle" class="" style="width:100px;">
															<p><span style=""><?php echo $val['quantity'];?></span></p>
														</td>
														<td align="left" valign="top" class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td align="left" valign="top" class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td align="left" valign="top" class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td align="left" valign="top" class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
														<td align="left" valign="top" class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	
													</tr>
													<?php  } ?>
												</table>
											</td>

										</tr>

										<tr>
											<td align="center" colspan="2" valign="" class="aft_c"><span style="color: red;">订单信息：</span></td>

										</tr>
										<tr>
											<td align="left" valign="top" class="aft_l">订单号：</td>
											<td align="left" valign="middle" class="aft_r">
												<span style=""><?php echo $data['list']['order_no'];?></span>
											</td>
										</tr>
										
										<?php if($data['list']['pay_status']=='1'){ ?>
										<tr>
											<td align="left" valign="top" class="aft_l">付款方式名称：</td>
											<td align="left" valign="middle" class="aft_r">
											   <span style=""><?php echo $data['list']['payment_name'];?></span>&nbsp;&nbsp;&nbsp;<span style=""><?php echo $data['list']['serial_no'];?></span>
											</td>
										</tr>

										<tr>
											<td align="left" valign="top" class="aft_l">付款时间</td>
											<td align="left" valign="middle" class="aft_r">
												<span style=""><?php echo date("Y-m-d H:i:s",$data['list']['pay_time']);?></span>
											</td>
										</tr>
										<?php } ?>

										<?php if(!empty($data['list']['add_time'])){ ?>
											<tr>
												<td align="left" valign="top" class="aft_l">下单时间：</td>
												<td align="left" valign="middle" class="aft_r">
													<span style=""><?php echo date("Y-m-d H:i:s",$data['list']['add_time']);?></span>
												</td>
											</tr>
										<?php  }?>

										<tr>
											<td align="left" valign="top" class="aft_l">用户名：</td>
											<td align="left" valign="middle" class="aft_r">
												<span style=""><?php echo $data['list']['account_name'];?></span>
											</td>
										</tr>
										<tr>
											<td align="left" valign="top" class="aft_l">收货信息：</td>
											<td align="left" valign="middle" class="aft_r">
												<p><span style="">
												<?php echo $data['list']['consignee'];?><br />
												<?php echo $data['list']['address']; ?> 
												<?php if($data['list']['mobile']){echo $data['list']['mobile'];} ?>   
												</span></p>
											</td>
										</tr>
										
										<tr>
											<td align="left" valign="top" class="aft_l">配送物流：</td>
											<td align="left" valign="middle" class="aft_r">
												<span style=""><?php echo $data['list']['delivery_mode_name']; ?> <?php if($data['list']['shipping_sn']){ echo "物流单号：".$data['list']['shipping_sn']; } ?></span>
											</td>
										</tr>
										<?php if($data['list']['shipping_time']){ ?>
										<tr>
											<td align="left" valign="top" class="aft_l">发货时间：</td>
											<td align="left" valign="middle" class="aft_r">
												<span style=""><?php echo date("Y-m-d H:i:s",$data['list']['shipping_time']); ?></span>
											</td>
										</tr>
										<?php } ?>
										
										<tr>
											<td align="left" valign="top" class="aft_l">发票信息：</td>
											<td align="left" valign="middle" class="aft_r">
												<p><span style="">
													<?php 
														if($data['list']['invoice_type_id'] == '1'){
															echo '不要发票';
														}else if($data['list']['invoice_type_id'] == '2'){
															echo '个人发票';
														}else{
															echo '公司发票';
															echo '（发票抬头：'.$data['list']['invo_cust_name'].'）';
														} 
													?>
												</span></p>
											</td>
										</tr>
										<?php if($data['list']['desc']){ ?>
										<tr>
											<td align="left" valign="top" class="aft_l">订单备注：</td>
											<td align="left" valign="middle" class="aft_r">
												<span style=""><?php echo $data['list']['desc'];?></span>
											</td>
										</tr>
										<?php } ?>
										<tr>
											<td align="left" valign="top" class="aft_l">订单金额：</td>
											<td align="left" valign="middle" class="aft_r">
<table width="100%">
										<tr>
											<td align="left" valign="top" class="" style="width:100px;">订单总金额：</td>
											<td align="left" valign="middle" class="" style="width:200px;">
												<p><span style=""><?php echo $data['list']['amount'];?></span></p>
											</td>
											<td align="left" valign="top" class=""  style="width:200px;">抵用积分（换算的金额）：</td>
											<td align="left" valign="middle" class=""  style="width:100px;">
												<p><span style=""><?php echo $data['list']['point_amount'];?></span></p>
											</td>
											<td align="left" valign="top" class="" style="width:100px;">现金券金额：</td>
											<td align="left" valign="middle" class=""  style="width:100px;">
												<p><span style="">
													<?php echo $data['list']['cash_voucher_amount'];?>
													<?php if($data['list']['voucher_name']){echo '['.$data['list']['voucher_name'].']';} ?>
												</span></p>
											</td>
											<td align="left" valign="top" class="">&nbsp;</td>
											<td align="left" valign="top" class="">&nbsp;</td>
											<td align="left" valign="top" class="">&nbsp;</td>

</tr>
<tr>
											<td align="left" valign="top" class="" style="width:100px;">优惠券金额：</td>
											<td align="left" valign="middle" class="" style="width:200px;">
												<p><span style="">
													<?php echo $data['list']['coupon_amount'];?>
													<?php if($data['list']['coupon_name']){echo '['.$data['list']['coupon_name'].']';} ?>
												</span></p>
											</td>
											<td align="left" valign="top" class="" style="width:100px;">订单满减金额：</td>
											<td align="left" valign="middle" class="" style="width:100px;">
												<p><span style=""><?php echo $data['list']['order_reduction_amount'];?></span></p>
											</td>
											<td align="left" valign="top" class="" style="width:100px;">实付金额：</td>
											<td align="left" valign="middle" class="" style="width:100px;">
												<p><span style=""><?php echo $data['list']['pay_amount'];?></span></p>
											</td>
											<td align="left" valign="top" class="">&nbsp;</td>
											<td align="left" valign="top" class="">&nbsp;</td>
											<td align="left" valign="top" class="">&nbsp;</td>
										</tr>
</table>

											</td>
										</tr>


										<tr>
											<td align="left" valign="top" class="aft_l">订单类型：</td>
											<td align="left" valign="middle" class="aft_r">
												<span style=""><?php if($data['list']['order_type']=='1'){echo '普通订单';}else{echo '活动订单';}?></span>
											</td>
										</tr>

										<tr>
											<td align="left" valign="top" class="aft_l">买家留言：</td>
											<td align="left" valign="middle" class="aft_r">
												<p><span style=""><?php echo $order_detail['desc'];?></span></p>
											</td>
										</tr>

										<tr>
											<td align="left" valign="top" class="aft_l">物流选择：</td>
											<td align="left" valign="middle" class="aft_r">
												 <select name="delivery_mode_id">
												 <?php foreach($data['delivery'] as $v){ ?>
													<option value="<?php echo $v['delivery_mode_id']; ?>" <?php if($v['delivery_mode_id'] == $order_detail['delivery_mode_id']){echo 'selected';} ?>><?php echo $v['name']; ?></option>
												 <?php } ?>
												 </select>
											</td>
										</tr>
										
										<tr>
											<td align="left" valign="top" class="aft_l">物流单号：</td>
											<td align="left" valign="middle" class="aft_r">													
												   <input name="shipping_sn" value="" />
											</td>
										</tr>

										
									</table>

									<div class="add_from_table_bottom">
										<input type="submit" class="btn btn-success btn-lg form_submit"  value="提交表单"> &nbsp;
									</div>
                                    </form>
							</div>
						</div>
					</div>
				</div>
			</div>
        <!--/right-->


        </td>
        </tr>
        </table>
            
        
    
    </div>
    <!--/main-->

<?php W('Admin/foot');?>