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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">修改管理员</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('AdminUser/adminUserList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
                </div>

<!---------------[ /TITLE ]--------------->
            </div>
            <!--/page_right_header-->
            
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
            
            <!--List-->
            <div class="list_box">
<!---------------[ BODY ]--------------->
				
                
                <div class="ja_add_from mb20">
                	<div class="add_from_head">修改管理员</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('AdminUser/editAdminUser',array('id'=>$data['list']['admin_user_id'])); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">用户名</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="account" value="<?php echo $data['list']['account']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入用户名" errormsg="用户名由1-10位数字字母组成" nullmsg="请输入用户名" datatype="/^[0-9a-zA-Z]{1,10}$/"></td>
                      </tr>
					  
                      <tr>
                        <td align="left" valign="top" class="aft_l">所属角色</td>
                        <td align="left" valign="middle" class="aft_r">
							<select class="form-control the_text3 verify_text" name="admin_role_id" errormsg="请选择所属角色" nullmsg="请选择所属角色" datatype="/^[1-9][0-9]{0,}$/">
								<option value="">请选择所属角色</option>
								<option value="0" <?php if($data['list']['admin_role_id'] == '0'){echo 'selected';} ?>>超级管理员</option>
								<?php foreach($data['admin_role_list'] as $k=>$v){ ?>
									<option value="<?php echo $v['admin_role_id']; ?>" <?php if($data['list']['admin_role_id'] == $v['admin_role_id']){echo 'selected';} ?>><?php echo $v['role_name']; ?></option>
								<?php } ?>
                            </select>
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">登录密码(<font color="red">不修改则为空</font>)</td>
                        <td align="left" valign="middle" class="aft_r"><input type="password" name="password" class="form-control the_text3 verify_text"  placeholder="请输入登录密码" errormsg="登录密码由6-16位数字字母下划线组成" nullmsg="请输入登录密码" datatype="/^[0-9a-zA-Z_]{6,16}$/" ignore="ignore"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">真实姓名</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="real_name" value="<?php echo $data['list']['real_name']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入真实姓名" errormsg="真实姓名为1-20个字" nullmsg="请输入真实姓名" datatype="*1-20" ignore="ignore"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">性别</td>
						<td align="left" valign="middle" class="aft_r">
							<label class="radio-inline"><input type="radio" name="sex" value="1" <?php if($data['list']['sex']=='1'){echo 'checked';} ?> />男</label>
							<label class="radio-inline"><input type="radio" name="sex" value="2" <?php if($data['list']['sex']=='2'){echo 'checked';} ?> />女</label>
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">邮箱</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="email" value="<?php echo $data['list']['email']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入邮箱" errormsg="请输入正确格式的邮箱" nullmsg="请输入邮箱" datatype="e" ignore="ignore"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">手机号</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="telphone" value="<?php echo $data['list']['telphone']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入手机号码" errormsg="请输入正确格式的手机号码" nullmsg="请输入手机号码" datatype="m" ignore="ignore"></td>
                      </tr>
       
                    </table>

                    
                    <div class="add_from_table_bottom">
                    <button type="submit" class="btn btn-success btn-lg form_submit" ><i class="icon-ok-sign"></i> &nbsp; 提交表单</button>
                    <button type="reset" class="btn btn-warning btn-lg" ><i class="icon-undo"></i><span> &nbsp; 重置表单</button>
                    </div>
                    
                    
                    
                    </form>
                   	</div>
                </div>
                

                
                
                
<!---------------[ /BODY ]--------------->
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