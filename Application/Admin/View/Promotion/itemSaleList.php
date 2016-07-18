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
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Promotion/addItemSale'); ?>">
                    <i class="icon-coffee"></i>
                    新增促销商品
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
                    <th scope="col" class="">商品名称</th>
                    <th scope="col" class="th_w7">商品WEB价格</th>
                    <th scope="col" class="th_w7">商品APP价格</th>
					<th scope="col" class="th_w7">促销价格</th>
					<th scope="col" class="th_w7">开始时间</th>
					<th scope="col" class="th_w7">结束时间</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
					<?php $item_spec_price = M('Item_spec_price')->where('item_id='.$v['item_id'].' and item_spec_ids=0')->find(); ?>
					  <tr name="data_<?php echo $v['item_sale_id']; ?>">
						<td valign="middle" align="center"><?php echo M('Item')->where('item_id='.$v['item_id'])->getField('name'); ?></td>
						<td valign="middle" align="center"><?php echo $item_spec_price['online_price']; ?></td>
						<td valign="middle" align="center"><?php echo $item_spec_price['app_price']; ?></td>
						<td valign="middle" align="center"><?php echo $v['sale_price']; ?></td>
						<td valign="middle" align="center"><?php echo date("Y-m-d H:i:s",$v['start_time']); ?></td>
						<td valign="middle" align="center"><?php echo date("Y-m-d H:i:s",$v['end_time']); ?></td>
						<td valign="middle" align="center" class="td_w_link">
							<a href="<?php echo U('Promotion/editItemSale',array('id'=>$v['item_sale_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
							<a href="javascript:void(0);" onclick="delete_data('<?php echo $v['item_sale_id']; ?>','<?php echo U('Promotion/delItemSale'); ?>')" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i>&nbsp;&nbsp;删除</a>
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