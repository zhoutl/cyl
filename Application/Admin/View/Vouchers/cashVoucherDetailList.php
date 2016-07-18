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

            <!--page_right_header-->
            <div class="page_right_header">
<!---------------[ TITLE ]--------------->

                <div class="f_l">
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title"><?php echo $data['voucher_name']; ?> 现金券券使用详情</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="javascript:window.history.go(-1);"><i class="icon-reorder"></i> &nbsp; 返回现金券列表</a>
                </div>

<!---------------[ /TITLE ]--------------->
            </div>
            <!--/page_right_header-->
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
            
            <!--List-->
            <div class="list_box">
            
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Usertb" class="jadmin_table">
                <thead>
                  <tr>
					<th scope="col" class="">现金券码</th>
					<th scope="col" class="th_w5">是否使用</th>
					<th scope="col" class="th_w7">使用时间</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['cash_voucher_id']; ?>">
                    <td valign="middle" align="center"><?php echo $v['voucher_code']; ?></td>
					<td valign="middle" align="center"><?php if($v['is_use']){echo '已使用';}else{echo '未使用';}  ?></td>
					<td valign="middle" align="center"><?php if($v['use_time']){echo date("Y-m-d H:i:s",$v['use_time']);} ?></td>
                    <td valign="middle" align="center" class="td_w_link">
						<?php if($v['orders_id']){ ?>
							<a href="<?php echo U('Order/orderInfo',array('id'=>$v['orders_id'])); ?>" class="btn btn-info btn-xs"><i class="icon-search"></i>&nbsp;查看订单</a>
						<?php }else{ ?>
							&nbsp;
						<?php } ?>
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