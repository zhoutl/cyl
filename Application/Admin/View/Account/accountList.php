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
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Account/addAccount'); ?>">
                    <i class="icon-coffee"></i>
                    新增会员
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
                    <th scope="col" class="">邮箱号</th>
                    <th scope="col" class="">手机号</th>
					<th scope="col" class="">会员消费积分</th>
                    <th scope="col" class="">会员成长值</th>
					<th scope="col" class="">注册时间</th>
					<th scope="col" class="th_w5">会员状态</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['account_id']; ?>">
                    <td valign="middle" align="center"><?php echo $v['email']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['mobile']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['pay_points']; ?></td>
					<td valign="middle" align="center"><?php echo $v['growth_value']; ?></td>
					<td valign="middle" align="center"><?php echo date("Y-m-d H:i:s",$v['register_time']); ?></td>
					<td valign="middle" align="center">
						<?php if($v['status'] == '1'){ ?>
							<i class="icon-ok the_icon this_check" onclick="change_state('<?php echo $v['account_id']; ?>','2','<?php echo U('Account/changeAccountState'); ?>',this);"></i>
						<?php }else{ ?>
							<i class="icon-remove the_icon this_check" onclick="change_state('<?php echo $v['account_id']; ?>','1','<?php echo U('Account/changeAccountState'); ?>',this);"></i>
						<?php } ?>
					</td>
                    <td valign="middle" align="center" class="td_w_link">
                        <a href="<?php echo U('Account/editAccount',array('id'=>$v['account_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
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