<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>
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
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
				<!--list_heads-->
				<div class="list_heads mb20 clearfix">
					<form method="get" action="<?php echo U('Order/orderList'); ?>">
						<div class="f_r list_heads_right clearfix" style="width:auto;display:inline-block;">
						
						<div class="input-group f_l ml20 the_text2 mb20">
						  <select class="form-control the_text1" name="status">
								<option value="0">请选择订单状态</option>
									<option value="1" <?php if($data['status']==1){echo 'selected';} ?>>未付款 交易关闭</option>
									<option value="2" <?php if($data['status']==2){echo 'selected';} ?>>已付款 交易关闭</option>
									<option value="3" <?php if($data['status']==3){echo 'selected';} ?>>待付款</option>
									<option value="4" <?php if($data['status']==4){echo 'selected';} ?>>待发货</option>
									<option value="5" <?php if($data['status']==5){echo 'selected';} ?>>待收货</option>
									<option value="6" <?php if($data['status']==6){echo 'selected';} ?>>交易完成</option>
									<option value="7" <?php if($data['status']==7){echo 'selected';} ?>>商品退货中</option>
									<option value="8" <?php if($data['status']==8){echo 'selected';} ?>>已付款</option>
									<option value="9" <?php if($data['status']==9){echo 'selected';} ?>>未付款</option>
									<option value="10" <?php if($data['status']==10){echo 'selected';} ?>>未发货</option>
									<option value="11" <?php if($data['status']==11){echo 'selected';} ?>>已发货</option>
							</select>
						</div>
						
						<div class="input-group f_l ml20 the_text2 mb20">
						  <select class="form-control the_text1" name="order_type">
								<option value="0">请选择订单类型</option>
								<option value="1" <?php if($data['order_type'] == '1'){echo 'selected';} ?>>普通订单</option>
								<option value="2" <?php if($data['order_type'] == '2'){echo 'selected';} ?>>活动订单</option>
							</select>
						</div>
						
						<div class="input-group f_l ml20 the_text2 mb20">
						  <select class="form-control the_text1" name="payment_id">
								<option value="0">请选择付款方式</option>
								<option value="1" <?php if($data['payment_id'] == '1'){echo 'selected';} ?>>支付宝</option>
								<option value="2" <?php if($data['payment_id'] == '2'){echo 'selected';} ?>>银联</option>
								<option value="3" <?php if($data['payment_id'] == '3'){echo 'selected';} ?>>微信</option>
							</select>
						</div>
						
						<div class="input-group f_l ml20 the_text2 mb20">
						  <select class="form-control the_text1" name="source">
								<option value="0">请选择订单来源</option>
								<option value="1" <?php if($data['source'] == '1'){echo 'selected';} ?>>PC端</option>
								<option value="2" <?php if($data['source'] == '2'){echo 'selected';} ?>>WAP端</option>
								<option value="3" <?php if($data['source'] == '3'){echo 'selected';} ?>>APP端</option>
								<option value="4" <?php if($data['source'] == '4'){echo 'selected';} ?>>PAD端</option>
							</select>
						</div>
						
						<div class="input-group f_l ml20 the_text3 mb20">
						  <input type="text" name="mobile" value="<?php echo $data['mobile']; ?>" class="form-control" placeholder="请输入收货人手机号">
						</div>
						
						<div class="input-group f_l ml20 the_text3 mb20">
						  <input type="text" name="consignee" value="<?php echo $data['consignee']; ?>" class="form-control" placeholder="请输入收货人">
						</div>
						
						<div class="input-group f_l ml20 mb20">
							<div style="float:left;width:70px;height:32px;line-height:32px;">下单时间:</div>
							<input type="text" value="<?php echo $data['start_add_time']; ?>" name="start_add_time" style="width:180px;margin-right:5px;" class="form-control f_l"   placeholder="下单开始时间"   onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
							<div style="float:left;width:20px;height:32px;line-height:32px;">至</div>
						    <input type="text" value="<?php echo $data['end_add_time']; ?>" name="end_add_time" style="width:180px;margin-right:5px;" class="form-control f_l"  placeholder="下单结束时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">   
						</div>
						
						<div class="input-group f_l ml20 mb20">
							<div style="float:left;width:70px;height:32px;line-height:32px;">付款时间:</div>
							<input type="text" value="<?php echo $data['start_pay_time']; ?>" name="start_pay_time" style="width:180px;margin-right:5px;" class="form-control f_l"   placeholder="付款开始时间"   onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
							<div style="float:left;width:20px;height:32px;line-height:32px;">至</div>
						    <input type="text" value="<?php echo $data['end_pay_time']; ?>" name="end_pay_time" style="width:180px;margin-right:5px;" class="form-control f_l"  placeholder="付款结束时间" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">   
						</div>
						
						<div class="input-group f_l ml20 mb20">
							<div style="float:left;width:70px;height:32px;line-height:32px;">总金额:</div>
							<input type="text" value="<?php echo $data['min_amount']; ?>" name="min_amount" style="width:90px;margin-right:5px;" class="form-control f_l"  >
							<div style="float:left;width:20px;height:32px;line-height:32px;">至</div>
						    <input type="text" value="<?php echo $data['max_amount']; ?>" name="max_amount" style="width:90px;margin-right:5px;" class="form-control f_l" >   
						</div>
						
						<div class="input-group f_l ml20 the_text3 mb20">
						  <input type="text" name="item_name" value="<?php echo $data['item_name']; ?>" class="form-control" placeholder="请输入商品名称">
						</div>
						
						<div class="input-group f_l ml20 the_text3 mb20">
						  <input type="text" name="order_no" value="<?php echo $data['order_no']; ?>" class="form-control" placeholder="请输入订单号">
						  <span class="input-group-btn">
							<button class="btn btn-default" type="submit">搜索</button>
						  </span>
						</div>
						
						</div>
					</form>
				
				</div>
				<!--/list_heads-->
            
            <!--List-->
            <div class="list_box">
            
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Usertb" class="jadmin_table">
                <thead>
                  <tr>
                    <th scope="col" class="">订单号</th>
                    <th scope="col" class="th_w7">下单时间</th>
                    <th scope="col" class="">收货人</th>
					<th scope="col" class="th_w7">总金额</th>
					<th scope="col" class="th_w7">实付金额</th>
					<th scope="col" class="th_w7">订单来源</th>
					<th scope="col" class="th_w7">订单状态</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
					  <tr name="data_<?php echo $v['orders_id']; ?>">
						<td valign="middle" align="center"><?php echo $v['order_no']; ?></td>
						<td valign="middle" align="center"><?php echo date("Y-m-d H:i:s",$v['add_time']);?></td>
						<td valign="middle" align="center">
							<?php echo $v['consignee']; ?><br />
							<?php echo $v['address'].' '.$v['mobile']; ?>
						</td>
						<td valign="middle" align="center"><?php echo $v['amount']; ?></td>
						<td valign="middle" align="center"><?php echo $v['pay_amount']; ?></td>
						<td valign="middle" align="center">
							<?php
								switch($v['source']){
									case '1':
										echo 'PC端';break;
									case '2':
										echo 'WAP端';break;
									case '3':
										echo 'APP端';break;
									case '4':
										echo 'PAD端';break;
								}
							?>
						</td>
						<td valign="middle" align="center">
							<?php if($v['status']=='0'){ ?>
								<?php if($v['pay_status'] == '0'){ ?>
								<p class="lb-gray">未付款 交易关闭</p>
								<?php }else{ ?>
								<p class="lb-gray">已付款 交易关闭</p>
								<?php } ?>
							<?php }else if($v['status'] == '3'){ ?>
								<p class="lb-green">交易完成</p>
							<?php }else if($v['status'] == '2'){ ?>
								<p class="lb-red">商品退货中</p>
							<?php }else{ ?>
								<?php if($v['pay_status'] == '0'){ ?>
									<p class="lb-yellow">待付款</p>
								<?php }else{ ?>
									<?php if($v['shipping_status'] == '0'){ ?>
										<p class="lb-blank">待发货</p>
									<?php }else{ ?>
										<p class="lb-blank">待收货</p>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						</td>
						<td valign="middle" align="center" class="td_w_link">
							<a href="<?php echo U('Order/orderDetail',array('id'=>$v['orders_id'])); ?>" class="btn btn-info btn-xs"><i class="icon-search"></i>&nbsp;订单明细</a>
						</td>
					  </tr>
				  <?php endforeach; ?>
                
                </tbody>
                
                </table>

				
                <div class="list_box_bottom">
					<div class="page">
						<?php echo $data['pagetion']->show(); ?>
					</div>
                </div>            
                
                
                
                
                
                
            </div>
            <!--/List-->
            
            
            
            </div>
            <!--/page_right_bodyer-->
        
        
        
        
        </div>
        <!--/right-->
        



        </td>
        </tr>
        </table>
            
        
    
    </div>
    <!--/main-->


<?php W('Admin/foot');?>