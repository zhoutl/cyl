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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">新增会员等级</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('Account/accountLevelList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
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
                	<div class="add_from_head">新增会员等级</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Account/addAccountLevel'); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">会员等级名称</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="name" class="form-control the_text3 verify_text"  placeholder="请输入会员等级名称" errormsg="会员等级名称为1-10个字" nullmsg="请输入会员等级名称" datatype="*1-10"></td>
                      </tr>
        
                      <tr>
                        <td align="left" valign="top" class="aft_l">最低成长值</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="conditions" class="form-control the_text3 verify_text"  placeholder="请输入最低成长值" errormsg="请输入数字" nullmsg="请输入最低成长值" datatype="n"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">备注</td>
                        <td align="left" valign="middle" class="aft_r">
							<textarea class="form-control the_text3 verify_text" rows="5" name="mark" placeholder="请输入备注" errormsg="备注为1-200个字" nullmsg="请输入备注" datatype="*1-200" ignore="ignore"></textarea>
						</td>
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