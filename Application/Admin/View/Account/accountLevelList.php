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
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Account/addAccountLevel'); ?>">
                    <i class="icon-coffee"></i>
                    新增会员等级
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
                    <th scope="col" class="">会员等级名称</th>
                    <th scope="col" class="">最低成长值</th>
                    <th scope="col" class="">会员等级备注</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['account_level_id']; ?>">
                    <td valign="middle" align="center"><?php echo $v['name']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['conditions']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['mark']; ?></td>
                    <td valign="middle" align="center" class="td_w_link">
                        <a href="<?php echo U('Account/editAccountLevel',array('id'=>$v['account_level_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
                        <a href="javascript:void(0);" onclick="delete_data('<?php echo $v['account_level_id']; ?>','<?php echo U('Account/delAccountLevel'); ?>')" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i>&nbsp;&nbsp;删除</a>
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