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
							<p class="lb-blank">待发货</p>
						</td>
						<td valign="middle" align="center" class="td_w_link">
							<a href="<?php echo U('Order/doShipping',array('id'=>$v['orders_id'])); ?>" class="btn btn-info btn-xs"><i class="icon-search"></i>&nbsp;订单发货</a>
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