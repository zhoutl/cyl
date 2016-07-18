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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">新增会员</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('Account/accountList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
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
                	<div class="add_from_head">新增会员</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Account/addAccount'); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">邮箱号</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="email" class="form-control the_text3 verify_text"  placeholder="请输入邮箱号" errormsg="请输入正确格式的邮箱" nullmsg="请输入邮箱号" datatype="e" ignore="ignore"></td>
                      </tr>
        
                      <tr>
                        <td align="left" valign="top" class="aft_l">手机号</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="mobile" class="form-control the_text3 verify_text"  placeholder="请输入手机号" errormsg="请输入正确格式的手机号" nullmsg="请输入手机号" datatype="m" ignore="ignore"></td>
                      </tr>
					  
                      <tr>
                        <td align="left" valign="top" class="aft_l">登录密码</td>
                        <td align="left" valign="middle" class="aft_r"><input type="password" name="password" class="form-control the_text3 verify_text"  placeholder="请输入登录密码" errormsg="登录密码由6-16位数字字母下划线组成" nullmsg="请输入登录密码" datatype="/^[0-9a-zA-Z_]{6,16}$/"></td>
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