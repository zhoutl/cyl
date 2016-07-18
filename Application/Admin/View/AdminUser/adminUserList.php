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
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('AdminUser/addAdminUser'); ?>">
                    <i class="icon-coffee"></i>
                    新增管理员
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
                    <th scope="col" class="">用户名</th>
                    <th scope="col" class="th_w7">所属角色</th>
					<th scope="col" class="">真实姓名</th>
					<th scope="col" class="">性别</th>
                    <th scope="col" class="">邮箱</th>
					<th scope="col" class="">手机号</th>
					<th scope="col" class="">添加时间</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['admin_user_id']; ?>">
                    <td valign="middle" align="center"><?php echo $v['account']; ?></td>
                    <td valign="middle" align="center">
						<?php 
							if($v['admin_role_id']){
								echo M('Admin_role')->where('admin_role_id='.$v['admin_role_id'])->getField('role_name'); 
							}else{
								echo '超级管理员';
							}
						?>
					</td>
                    <td valign="middle" align="center"><?php echo $v['real_name']; ?></td>
					<td valign="middle" align="center"><?php if($v['sex']=='1'){echo '男';}else{echo '女';}; ?></td>
					<td valign="middle" align="center"><?php echo $v['email']; ?></td>
					<td valign="middle" align="center"><?php echo $v['telphone']; ?></td>
					<td valign="middle" align="center"><?php echo date("Y-m-d H:i:s",$v['register_time']); ?></td>
                    <td valign="middle" align="center" class="td_w_link">
                        <a href="<?php echo U('AdminUser/editAdminUser',array('id'=>$v['admin_user_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
						<a href="javascript:void(0);" onclick="delete_data('<?php echo $v['admin_user_id']; ?>','<?php echo U('AdminUser/delAdminUser'); ?>')" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i>&nbsp;&nbsp;删除</a>
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