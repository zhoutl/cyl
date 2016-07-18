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

			            <!--page_right_menu-->
            <div class="page_right_menu the_highlighted2 clearfix">
				<div class="dropdown">
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Vouchers/addCashVoucher'); ?>">
                    <i class="icon-coffee"></i>
                    新增现金券
                  </a>
                </div>			
			</div>
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
			
				<!--list_heads-->
				<div class="list_heads mb20 clearfix">
					<form method="get" action="<?php echo U('Vouchers/cashVoucherList'); ?>">
						<div class="f_r list_heads_right clearfix" style="width:auto;display:inline-block;">
						
						<div class="input-group f_l the_text3">
						  <select class="form-control the_text1" name="status">
								<option value="">所有状态</option>
								<option value="1" <?php if($data['status'] == 1){echo 'selected';} ?>>已启用</option>
								<option value="0" <?php if(isset($data['status']) && $data['status'] == 0){echo 'selected';} ?>>已禁用</option>
							</select>
						</div>
						<div class="input-group f_l ml20 the_text3">
						  <input type="text" name="keywords" value="<?php echo $data['keywords']; ?>" class="form-control" placeholder="请输入现金券名称">
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
				    <th scope="col" class="th_w5">id</th>
                    <th scope="col" class="">现金券名称</th>
                    <th scope="col" class="th_w7">现金券面额</th>
                    <th scope="col" class="th_w5">总数</th>
					<th scope="col" class="th_w5">已用数量</th>
					<th scope="col" class="th_w7">开始时间</th>
					<th scope="col" class="th_w7">结束时间</th>
					<th scope="col" class="th_w5">是否可用</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['cash_voucher_id']; ?>">
					<td valign="middle" align="center"><?php echo $v['cash_voucher_id']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['voucher_name']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['voucher_amount']; ?></td>
					<td valign="middle" align="center"><?php echo $v['voucher_quantity']; ?></td>
					<td valign="middle" align="center"><?php echo M('Cash_voucher_detail')->where('cash_voucher_id='.$v['cash_voucher_id'].' and is_use=1')->count('cash_voucher_id'); ?></td>
					<td valign="middle" align="center"><?php echo date('Y-m-d H:i:s',$v['start_time']); ?></td>
					<td valign="middle" align="center"><?php echo date('Y-m-d H:i:s',$v['end_time']); ?></td>
					<td valign="middle" align="center">
						<?php if($v['status'] == '1'){ ?>
							<i class="icon-ok the_icon this_check" onclick="change_state('<?php echo $v['cash_voucher_id']; ?>','2','<?php echo U('Vouchers/changeCashVoucherState'); ?>',this);"></i>
						<?php }else{ ?>
							<i class="icon-remove the_icon this_check" onclick="change_state('<?php echo $v['cash_voucher_id']; ?>','1','<?php echo U('Vouchers/changeCashVoucherState'); ?>',this);"></i>
						<?php } ?>
					</td>
                    <td valign="middle" align="center" class="td_w_link">
						<a href="<?php echo U('Vouchers/cashVoucherDetailList',array('id'=>$v['cash_voucher_id'])); ?>" class="btn btn-info btn-xs"><i class="icon-search"></i>&nbsp;使用详情</a>
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