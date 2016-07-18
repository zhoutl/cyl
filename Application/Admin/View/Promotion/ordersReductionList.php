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
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Promotion/addOrdersReduction'); ?>">
                    <i class="icon-coffee"></i>
                    新增订单满减
                  </a>
                </div>			
			</div>
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">

            <!--List-->
            <div class="list_box">
            
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Usertb" class="jadmin_table">
                <thead>
                  <tr>
                    <th scope="col" class="">活动名称</th>
                    <th scope="col" class="th_w7">满额条件</th>
                    <th scope="col" class="th_w7">优惠金额</th>
					<th scope="col" class="th_w7">开始时间</th>
					<th scope="col" class="th_w7">结束时间</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['orders_reduction_id']; ?>">
                    <td valign="middle" align="center"><?php echo $v['name']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['limit_orders_amount']; ?></td>
					<td valign="middle" align="center"><?php echo $v['reduction_amount']; ?></td>
					<td valign="middle" align="center"><?php echo date('Y-m-d H:i:s',$v['start_time']); ?></td>
					<td valign="middle" align="center"><?php echo date('Y-m-d H:i:s',$v['end_time']); ?></td>
					<td valign="middle" align="center" class="td_w_link">
						<a href="<?php echo U('Promotion/editOrdersReduction',array('id'=>$v['orders_reduction_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
						<a href="javascript:void(0);" onclick="delete_data('<?php echo $v['orders_reduction_id']; ?>','<?php echo U('Promotion/delOrdersReduction'); ?>')" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i>&nbsp;&nbsp;删除</a>
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